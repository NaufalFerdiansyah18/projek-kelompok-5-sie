<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pelanggan::query()->orderByDesc('pelanggan_id');

        if ($request->filled('gender')) {
            $query->whereIn('gender', $this->genderQueryValues($request->input('gender')));
        }

        $search = $request->input('search');
        $query->search($search);

        $clearSeachQuery = $this->canonicalGender($request->input('gender'));
        $activeFilters = array_filter([
            'gender' => $clearSeachQuery,
            'search' => $search,
        ], fn ($value) => $value !== null && $value !== '');

        $data['dataPelanggan'] = $query->paginate(3)->appends($activeFilters);
        $data['filters'] = [
            'gender' => $clearSeachQuery,
            'search' => $search,
        ];

        return view('admin.pelanggan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:pelanggan,email',
            'files.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,doc,docx|max:5120',
        ]);

        $data['first_name'] = $request->first_name;
        $data['last_name'] = $request->last_name;
        $data['birthday'] = $request->birthday;
        $data['gender'] = $this->canonicalGender($request->gender);
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;

        // Handle multiple file uploads
        if ($request->hasFile('files')) {
            $files = [];
            foreach ($request->file('files') as $file) {
                $path = $file->store('pelanggan_files', 'public');
                $files[] = $path;
            }
            $data['files'] = $files;
        }

        Pelanggan::create($data);

        return redirect()->route('admin.pelanggan.index')->with('success','Penambahan Data Berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelanggan $pelanggan)
    {
        $data['dataPelanggan'] = $pelanggan;
        return view('admin.pelanggan.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelanggan $pelanggan)
    {
        $data['dataPelanggan'] = $pelanggan;
        return view('admin.pelanggan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pelanggan $pelanggan)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:pelanggan,email,' . $pelanggan->pelanggan_id . ',pelanggan_id',
            'files.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,doc,docx|max:5120',
        ]);

        $pelanggan->first_name = $request->first_name;
        $pelanggan->last_name = $request->last_name;
        $pelanggan->birthday = $request->birthday;
        $pelanggan->gender = $this->canonicalGender($request->gender);
        $pelanggan->email = $request->email;
        $pelanggan->phone = $request->phone;

        // Handle multiple file uploads
        if ($request->hasFile('files')) {
            $existingFiles = $pelanggan->files ?? [];
            $newFiles = [];
            
            foreach ($request->file('files') as $file) {
                $path = $file->store('pelanggan_files', 'public');
                $newFiles[] = $path;
            }
            
            // Merge with existing files
            $pelanggan->files = array_merge($existingFiles, $newFiles);
        }

        $pelanggan->save();
        return redirect()->route('admin.pelanggan.index')->with('success', 'Data Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();
        return redirect()->route('admin.pelanggan.index')->with('success', 'Data Berhasil Dihapus!');
    }

    /**
     * Normalize gender values to canonical Indonesian labels.
     */
    protected function canonicalGender(?string $gender): ?string
    {
        if ($gender === null || trim($gender) === '') {
            return null;
        }

        return match ($gender) {
            'Male', 'Laki-laki' => 'Laki-laki',
            'Female', 'Perempuan' => 'Perempuan',
            default => $gender,
        };
    }

    /**
     * Return possible stored values for legacy compatibility.
     */
    protected function genderQueryValues(?string $gender): array
    {
        return match ($gender) {
            'Male', 'Laki-laki' => ['Laki-laki', 'Male'],
            'Female', 'Perempuan' => ['Perempuan', 'Female'],
            default => array_filter([$gender]),
        };
    }
}
