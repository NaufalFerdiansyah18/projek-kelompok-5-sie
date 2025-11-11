<div class="row mb-4">
    <div class="col-lg-6 col-sm-12">
        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" name="name" id="name"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $product->name ?? '') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Price -->
        <div class="mb-3">
            <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
            <input type="number" name="price" id="price" step="0.01"
                   class="form-control @error('price') is-invalid @enderror"
                   value="{{ old('price', $product->price ?? '') }}" required>
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-lg-6 col-sm-12">
        <!-- Image -->
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="image"
                   class="form-control @error('image') is-invalid @enderror"
                   accept="image/*">
            @if(isset($product->image) && $product->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="" class="img-thumbnail" style="max-width: 150px;">
                    <p class="text-muted small mt-1">Current image</p>
                </div>
            @endif
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<!-- Description -->
<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea name="description" id="description" rows="4"
              class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

