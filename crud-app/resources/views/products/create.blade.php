<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body style="background-color: #f8f9fa;">
    <div class="container mt-5">
        <!-- Title Section -->
        <div class="text-center mb-4">
            <h1 class="text-primary">CRUD</h1>
        </div>

        <!-- Back Button -->
        <div class="d-flex justify-content-end mb-4">
            <a href="{{ route('products.index') }}" class="btn btn-success">Back</a>
        </div>

        <!-- Main Form Card -->
        <div class="card shadow-lg">
            <div class="card-header">
                <h4 class="mb-0">Create Product</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Name Input -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="Product Name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- SKU Input -->
                    <div class="mb-3">
                        <label for="sku" class="form-label">SKU</label>
                        <input type="text" name="sku" value="{{ old('sku') }}" class="form-control form-control-lg @error('sku') is-invalid @enderror" placeholder="SKU">
                        @error('sku')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Price Input -->
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" name="price" value="{{ old('price') }}" class="form-control form-control-lg @error('price') is-invalid @enderror" placeholder="Price">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description Input -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control form-control-lg" rows="5" placeholder="Product Description">{{ old('description') }}</textarea>
                    </div>

                    <!-- Image Input -->
                    <div class="mb-3">
                        <label for="image" class="form-label">Product Image</label>
                        <input type="file" name="image" class="form-control form-control-lg">
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-OoI7Nqa5IR2gmwnkXgFhO1U7DQ0V1rCkD5GF7DVi8KOGLVrrtYeaWeK1pybFqGM9" crossorigin="anonymous"></script>
</body>
</html>
