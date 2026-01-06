<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeCrud extends Command
{
    // contoh:
    // php artisan make:crud Product --fields="name:string,price:integer,description:text,image:image"
    protected $signature = 'make:crud {name} {--fields=}';
    protected $description = 'Generate CRUD (model, migration, controller, views, route) for given name with dynamic fields + upload';

    public function handle()
    {
        $name = $this->argument('name');
        $namePlural = Str::pluralStudly($name);
        $table = Str::snake($namePlural);
        $modelFqn = "App\\Models\\{$name}";

        // 1. parse fields
        $fields = $this->parseFields($this->option('fields'));

        // 2. make model + migration
        $this->call('make:model', [
            'name' => $name,
            '--migration' => true,
        ]);

        // 3. rewrite migration
        $this->updateMigration($table, $fields);

        // 4. make controller
        $this->call('make:controller', [
            'name' => "{$name}Controller",
            '--resource' => true
        ]);

        $this->updateController($name, $table, $modelFqn, $fields);

        // 5. make views
        $this->makeViews($name, $table, $fields);

        // 6. append route
        $this->appendRoute($name, $table);

        $this->info("CRUD for {$name} generated successfully.");
    }

    protected function parseFields($fieldsOption)
    {
        if (!$fieldsOption) {
            return [
                ['name' => 'name', 'type' => 'string'],
                ['name' => 'price', 'type' => 'integer'],
                ['name' => 'description', 'type' => 'text'],
                ['name' => 'image', 'type' => 'image'],
            ];
        }

        $fields = [];
        $parts = explode(',', $fieldsOption);
        foreach ($parts as $part) {
            $pair = explode(':', $part);
            $fieldName = trim($pair[0]);
            $fieldType = isset($pair[1]) ? trim($pair[1]) : 'string';
            if ($fieldName) {
                $fields[] = [
                    'name' => $fieldName,
                    'type' => $fieldType,
                ];
            }
        }
        return $fields;
    }

    protected function updateMigration($table, $fields)
    {
        $migrations = File::files(database_path('migrations'));
        $targetFile = null;
        foreach ($migrations as $migration) {
            if (str_contains($migration->getFilename(), "create_{$table}_table")) {
                $targetFile = $migration->getPathname();
                break;
            }
        }

        if (!$targetFile) {
            $this->error('Migration file not found.');
            return;
        }

        $fieldsMigration = "";
        foreach ($fields as $field) {
            $fieldsMigration .= $this->fieldToMigration($field) . "\n        ";
        }

        $stub = <<<PHP
public function up(): void
{
    Schema::create('$table', function (Blueprint \$table) {
        \$table->bigIncrements('id');
        {$fieldsMigration}\$table->timestamps();
    });
}
PHP;

        $content = File::get($targetFile);
        $content = preg_replace(
            '/public function up\(\): void\s*\{[\s\S]*?\}/',
            $stub,
            $content
        );
        File::put($targetFile, $content);
    }

    protected function fieldToMigration($field)
    {
        $name = $field['name'];
        $type = $field['type'];

        return match ($type) {
            'string'    => "\$table->string('$name');",
            'integer'   => "\$table->integer('$name');",
            'text'      => "\$table->text('$name')->nullable();",
            'boolean'   => "\$table->boolean('$name')->default(false);",
            'date'      => "\$table->date('$name')->nullable();",
            'datetime'  => "\$table->dateTime('$name')->nullable();",
            'decimal'   => "\$table->decimal('$name', 10, 2)->default(0);",
            'image', 'file' => "\$table->string('$name')->nullable();",
            default     => "\$table->string('$name');",
        };
    }

    protected function updateController($name, $table, $modelFqn, $fields)
    {
        $controllerPath = app_path("Http/Controllers/{$name}Controller.php");
        if (!File::exists($controllerPath)) {
            $this->error('Controller not found.');
            return;
        }

        $modelVar = Str::camel($name);
        $modelVarPlural = Str::snake(Str::plural($name));               

        $rules = "";
        foreach ($fields as $field) {
            $rules .= $this->fieldToValidation($field) . "\n            ";
        }

        $fileFields = array_filter($fields, fn($f) => in_array($f['type'], ['image', 'file']));

        $fillable = array_map(fn($f) => "'".$f['name']."'", $fields);
        $fillableString = implode(', ', $fillable);

        $uploadStore = $this->buildUploadStore($fileFields);
        $uploadUpdate = $this->buildUploadUpdate($fileFields, $modelVar);

        $controllerTemplate = <<<PHP
<?php

namespace App\Http\Controllers;

use $modelFqn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class {$name}Controller extends Controller
{
    public function index()
    {
        // server-side pagination Laravel
        \${$modelVarPlural} = {$name}::latest()->paginate(10);
        return view('{$table}.index', compact('{$modelVarPlural}'));
    }

    public function create()
    {
        return view('{$table}.create');
    }

    public function store(Request \$request)
    {
        \$data = \$request->validate([
            {$rules}
        ]);

        {$uploadStore}

        {$name}::create(\$data);

        return redirect()->route('{$table}.index')->with('success', '{$name} created.');
    }

    public function show({$name} \${$modelVar})
    {
        return view('{$table}.show', compact('{$modelVar}'));
    }

    public function edit({$name} \${$modelVar})
    {
        return view('{$table}.edit', compact('{$modelVar}'));
    }

    public function update(Request \$request, {$name} \${$modelVar})
    {
        \$data = \$request->validate([
            {$rules}
        ]);

        {$uploadUpdate}

        \${$modelVar}->update(\$data);

        return redirect()->route('{$table}.index')->with('success', '{$name} updated.');
    }

    public function destroy({$name} \${$modelVar})
    {
        \${$modelVar}->delete();
        return redirect()->route('{$table}.index')->with('success', '{$name} deleted.');
    }
}
PHP;

        File::put($controllerPath, $controllerTemplate);

        $this->updateModelFillable($name, $fillableString);
    }

    protected function fieldToValidation($field)
    {
        $name = $field['name'];
        return match ($field['type']) {
            'integer'   => "'$name' => 'required|integer',",
            'text'      => "'$name' => 'nullable|string',",
            'boolean'   => "'$name' => 'boolean',",
            'date'      => "'$name' => 'nullable|date',",
            'datetime'  => "'$name' => 'nullable|date',",
            'decimal'   => "'$name' => 'required|numeric',",
            'image'     => "'$name' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',",
            'file'      => "'$name' => 'nullable|file|max:4096',",
            default     => "'$name' => 'required|string|max:255',",
        };
    }

    protected function buildUploadStore($fileFields)
    {
        if (empty($fileFields)) return '';

        $code = '';
        foreach ($fileFields as $field) {
            $name = $field['name'];
            $code .= <<<PHP
        if (\$request->hasFile('$name')) {
            \$data['$name'] = \$request->file('$name')->store('uploads', 'public');
        }

PHP;
        }
        return $code;
    }

    protected function buildUploadUpdate($fileFields, $modelVar)
    {
        if (empty($fileFields)) return '';

        $code = '';
        foreach ($fileFields as $field) {
            $name = $field['name'];
            $code .= <<<PHP
        if (\$request->hasFile('$name')) {
            if (\${$modelVar}->$name) {
                Storage::disk('public')->delete(\${$modelVar}->$name);
            }
            \$data['$name'] = \$request->file('$name')->store('uploads', 'public');
        }

PHP;
        }
        return $code;
    }

    protected function updateModelFillable($name, $fillableString)
    {
        $modelPath = app_path("Models/{$name}.php");
        if (!File::exists($modelPath)) return;

        $content = File::get($modelPath);

        if (!str_contains($content, 'fillable')) {
            $fillable = <<<PHP

    protected \$fillable = [$fillableString];
PHP;
            // Try to add after HasFactory first
            if (str_contains($content, 'use HasFactory;')) {
                $content = str_replace("use HasFactory;\n", "use HasFactory;$fillable\n", $content);
            } else {
                // If no HasFactory, add after the opening brace of the class, before any closing brace
                $content = preg_replace('/(class\s+\w+\s+extends\s+Model\s*\{)/', '$1' . $fillable, $content);
            }
            File::put($modelPath, $content);
        }
    }

    protected function makeViews($name, $table, $fields)
    {
        $viewsPath = resource_path("views/{$table}");
        if (!File::exists($viewsPath)) {
            File::makeDirectory($viewsPath, 0755, true);
        }
        if (!File::exists($viewsPath . '/partials')) {
            File::makeDirectory($viewsPath . '/partials', 0755, true);
        }

        File::put($viewsPath . '/index.blade.php', $this->indexView($name, $table, $fields));
        File::put($viewsPath . '/create.blade.php', $this->createView($name, $table));
        File::put($viewsPath . '/edit.blade.php', $this->editView($name, $table));
        File::put($viewsPath . '/show.blade.php', $this->showView($name, $table, $fields));
        File::put($viewsPath . '/partials/form.blade.php', $this->formView($name, $table, $fields));
    }

    protected function indexView($name, $table, $fields)
    {
        $title = Str::headline(Str::plural($name));

        $imageField = collect($fields)->first(fn($f) => in_array($f['type'], ['image', 'file']));
        $nonImageFields = array_values(array_filter($fields, fn($f) => !in_array($f['type'], ['image', 'file'])));
        $columns = array_slice($nonImageFields, 0, 2);

        $thead = "";
        if ($imageField) {
            $thead .= "<th>" . Str::headline($imageField['name']) . "</th>\n                        ";
        }
        foreach ($columns as $col) {
            $thead .= "<th>" . Str::headline($col['name']) . "</th>\n                        ";
        }

        $tbody = "";
        if ($imageField) {
            $fname = $imageField['name'];
            $tbody .= "<td>@if(\$item->$fname)<img src=\"{{ asset('storage/' . \$item->$fname) }}\" alt=\"\" width=\"60\">@endif</td>\n                        ";
        }
        foreach ($columns as $col) {
            $tbody .= "<td>{{ \$item->{$col['name']} }}</td>\n                        ";
        }

        $colspan = count($columns) + ($imageField ? 2 : 1) + 1; // ID + image + columns + action
        return <<<BLADE
@extends('layouts.dasher.app')

@section('title', '$title')

@section('content')
    <div class="mb-6">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-2">$title</h1>
                <p class="text-muted mb-0">Kelola data $title</p>
            </div>
            <div>
                <a href="{{ route('$table.create') }}" class="btn btn-primary">
                    <i class="ti ti-plus me-2"></i> Tambah {$name}
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            {$thead}<th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(\${$table} as \$item)
                        <tr>
                            <td>{{ \$item->id }}</td>
                            {$tbody}<td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('$table.show', \$item) }}" class="btn btn-sm btn-info">
                                        <i class="ti ti-eye"></i>
                                    </a>
                                    <a href="{{ route('$table.edit', \$item) }}" class="btn btn-sm btn-warning">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <form action="{{ route('$table.destroy', \$item) }}" method="POST" style="display:inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="$colspan" class="text-center">Tidak ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr class="table-footer">
                            <td colspan="$colspan" class="text-center py-3">
                                <div class="d-flex justify-content-between align-items-center px-3">
                                    <div class="text-muted small">
                                        <i class="ti ti-info-circle me-1"></i>
                                        Total Data: <strong>{{ \${$table}->total() }}</strong> {$name}
                                    </div>
                                    <div class="text-muted small">
                                        <i class="ti ti-calendar me-1"></i>
                                        Terakhir diperbarui: {{ now()->format('d M Y') }}
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        @if(\${$table}->hasPages())
        <div class="card-footer bg-white border-top d-flex align-items-center justify-content-between">
            <div class="text-muted small">
                Showing <b>{{ \${$table}->firstItem() }}</b> to <b>{{ \${$table}->lastItem() }}</b> of <b>{{ \${$table}->total() }}</b> entries
            </div>
            <div>
                {{ \${$table}->links() }}
            </div>
        </div>
        @endif
    </div>
@endsection

@push('styles')
<style>
    .table-footer {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        border-top: 2px solid #059669;
    }
    
    .table-footer td {
        color: #065f46;
        font-weight: 500;
    }
    
    .table thead {
        background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
        border-bottom: 2px solid #059669;
    }
    
    .table thead th {
        color: #065f46;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.875rem;
        letter-spacing: 0.5px;
        padding: 12px 16px;
    }
</style>
@endpush
BLADE;
    }

    protected function createView($name, $table)
    {
        $title = "Tambah " . Str::headline($name);
        return <<<BLADE
@extends('layouts.dasher.app')

@section('title', '$title')

@section('content')
    <div class="mb-6">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-2">$title</h1>
                <p class="text-muted mb-0">Form untuk menambahkan data {$name} baru</p>
            </div>
            <div>
                <a href="{{ route('$table.index') }}" class="btn btn-outline-secondary">
                    <i class="ti ti-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('$table.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-4">
                    <div class="col-lg-6 col-sm-12">
                        @include('$table.partials.form')
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-check me-2"></i> Simpan
                    </button>
                    <a href="{{ route('$table.index') }}" class="btn btn-outline-secondary">
                        <i class="ti ti-x me-2"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
BLADE;
    }

    protected function editView($name, $table)
    {
        $modelVar = Str::camel($name);
        $title = "Edit " . Str::headline($name);
        return <<<BLADE
@extends('layouts.dasher.app')

@section('title', '$title')

@section('content')
    <div class="mb-6">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-2">$title</h1>
                <p class="text-muted mb-0">Form untuk mengubah data {$name}</p>
            </div>
            <div>
                <a href="{{ route('$table.index') }}" class="btn btn-outline-secondary">
                    <i class="ti ti-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('$table.update', \${$modelVar}) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row mb-4">
                    <div class="col-lg-6 col-sm-12">
                        @include('$table.partials.form')
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-check me-2"></i> Update
                    </button>
                    <a href="{{ route('$table.index') }}" class="btn btn-outline-secondary">
                        <i class="ti ti-x me-2"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
BLADE;
    }

    protected function showView($name, $table, $fields)
    {
        $modelVar = Str::camel($name);

        $rows = "";
        foreach ($fields as $field) {
            $label = Str::headline($field['name']);
            if (in_array($field['type'], ['image', 'file'])) {
                $rows .= "<p><strong>{$label}:</strong> @if(\${$modelVar}->{$field['name']})<br><img src=\"{{ asset('storage/' . \${$modelVar}->{$field['name']}) }}\" width=\"120\">@endif</p>\n            ";
            } else {
                $rows .= "<p><strong>{$label}:</strong> {{ \${$modelVar}->{$field['name']} }}</p>\n            ";
            }
        }

        $title = "Detail " . Str::headline($name);
        return <<<BLADE
@extends('layouts.dasher.app')

@section('title', '$title')

@section('content')
    <div class="mb-6">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-2">$title</h1>
                <p class="text-muted mb-0">Detail informasi {$name}</p>
            </div>
            <div>
                <a href="{{ route('$table.index') }}" class="btn btn-outline-secondary">
                    <i class="ti ti-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            {$rows}
            <div class="mt-4">
                <a href="{{ route('$table.edit', \${$modelVar}) }}" class="btn btn-warning">
                    <i class="ti ti-edit me-2"></i> Edit
                </a>
                <a href="{{ route('$table.index') }}" class="btn btn-outline-secondary">
                    <i class="ti ti-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>
@endsection
BLADE;
    }

    protected function formView($name, $table, $fields)
    {
        $modelVar = Str::camel($name);

        $inputs = "";
        foreach ($fields as $field) {
            $inputs .= $this->fieldToFormInput($field, $modelVar) . "\n\n";
        }

        return $inputs;
    }

    protected function fieldToFormInput($field, $modelVar)
    {
        $name = $field['name'];
        $type = $field['type'];
        $label = Str::headline($name);

        return match ($type) {
            'text' => <<<BLADE
<div class="mb-3">
    <label for="$name" class="form-label">$label <span class="text-danger">*</span></label>
    <textarea name="$name" id="$name" rows="4"
              class="form-control @error('$name') is-invalid @enderror" required>{{ old('$name', \${$modelVar}->$name ?? '') }}</textarea>
    @error('$name')
        <div class="invalid-feedback">{{ \$message }}</div>
    @enderror
</div>
BLADE,
            'integer', 'decimal' => <<<BLADE
<div class="mb-3">
    <label for="$name" class="form-label">$label <span class="text-danger">*</span></label>
    <input type="number" name="$name" id="$name"
           class="form-control @error('$name') is-invalid @enderror"
           value="{{ old('$name', \${$modelVar}->$name ?? '') }}" required>
    @error('$name')
        <div class="invalid-feedback">{{ \$message }}</div>
    @enderror
</div>
BLADE,
            'image', 'file' => <<<BLADE
<div class="mb-3">
    <label for="$name" class="form-label">$label</label>
    <input type="file" name="$name" id="$name"
           class="form-control @error('$name') is-invalid @enderror"
           accept="image/*">
    @if(isset(\${$modelVar}->$name) && \${$modelVar}->$name)
        <div class="mt-2">
            <img src="{{ asset('storage/' . \${$modelVar}->$name) }}" alt="" class="rounded" style="max-width: 200px;">
        </div>
    @endif
    @error('$name')
        <div class="invalid-feedback">{{ \$message }}</div>
    @enderror
</div>
BLADE,
            default => <<<BLADE
<div class="mb-3">
    <label for="$name" class="form-label">$label <span class="text-danger">*</span></label>
    <input type="text" name="$name" id="$name"
           class="form-control @error('$name') is-invalid @enderror"
           value="{{ old('$name', \${$modelVar}->$name ?? '') }}" required>
    @error('$name')
        <div class="invalid-feedback">{{ \$message }}</div>
    @enderror
</div>
BLADE,
        };
    }

    protected function appendRoute($name, $table)
    {
        $routePath = base_path('routes/web.php');
        $route = "Route::resource('{$table}', \\App\\Http\\Controllers\\{$name}Controller::class);\n";
        File::append($routePath, $route);
    }
}
