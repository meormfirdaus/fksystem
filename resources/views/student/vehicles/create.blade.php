@extends('layouts.app-shell')

@section('content')
<div class="container-fluid">

    {{-- PAGE HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Register Vehicle</h2>
            <p class="text-muted mb-0">Submit your vehicle for approval</p>
        </div>

        <a href="{{ route('student.vehicles.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i> Back
        </a>
    </div>

    <div class="row g-4">

        {{-- LEFT : FORM --}}
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-md-5">

                    <form method="POST"
                          action="{{ route('student.vehicles.store') }}"
                          enctype="multipart/form-data">
                        @csrf

                        {{-- PLATE NUMBER --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Plate Number</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="bi bi-car-front"></i>
                                </span>
                                <input type="text"
                                       id="plate_no"
                                       name="plate_no"
                                       class="form-control @error('plate_no') is-invalid @enderror"
                                       placeholder="e.g. WWA 1234"
                                       value="{{ old('plate_no') }}">
                            </div>
                            <small class="text-muted">Plate number will be auto-capitalized</small>
                            @error('plate_no')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- VEHICLE TYPE --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Vehicle Type</label>
                            <select name="type"
                                    class="form-select @error('type') is-invalid @enderror">
                                <option value="">-- Select Type --</option>
                                <option value="car" {{ old('type')=='car' ? 'selected' : '' }}>🚗 Car</option>
                                <option value="motorcycle" {{ old('type')=='motorcycle' ? 'selected' : '' }}>🏍 Motorcycle</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- BRAND --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Brand (optional)</label>
                            <input type="text" name="brand" class="form-control" value="{{ old('brand') }}">
                        </div>

                        {{-- MODEL --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Model (optional)</label>
                            <input type="text" name="model" class="form-control" value="{{ old('model') }}">
                        </div>

                        {{-- GRANT FILE --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Vehicle Grant</label>

                            <div class="border rounded-4 p-4 bg-light text-center">
                                <i class="bi bi-cloud-upload fs-2 text-primary mb-2"></i>
                                <p class="fw-medium mb-1">Upload Vehicle Grant</p>
                                <small class="text-muted">PDF / JPG / PNG (Max 5MB)</small>

                                <input type="file"
                                       name="grant"
                                       id="grant"
                                       class="form-control mt-3 @error('grant') is-invalid @enderror">
                                @error('grant')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- ACTION --}}
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('student.vehicles.index') }}" class="btn btn-outline-secondary">
                                Cancel
                            </a>
                            <button class="btn btn-primary px-4">
                                <i class="bi bi-send me-2"></i> Submit
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

        {{-- RIGHT : PREVIEW --}}
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">Grant Preview</h6>
                    <div id="previewBox"
                         class="border rounded-4 bg-light d-flex align-items-center justify-content-center"
                         style="height:220px">
                        <span class="text-muted">No file selected</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- SCRIPT --}}
<script>
document.getElementById('plate_no').addEventListener('input', function () {
    this.value = this.value.toUpperCase();
});

document.getElementById('grant').addEventListener('change', function () {
    const file = this.files[0];
    const preview = document.getElementById('previewBox');
    preview.innerHTML = '';
    if (!file) return;

    if (file.type.includes('image')) {
        const img = document.createElement('img');
        img.src = URL.createObjectURL(file);
        img.className = 'img-fluid rounded';
        img.style.maxHeight = '200px';
        preview.appendChild(img);
    } else if (file.type === 'application/pdf') {
        preview.innerHTML = `
            <div class="text-center">
                <i class="bi bi-file-earmark-pdf fs-1 text-danger"></i>
                <p class="mt-2 mb-0">${file.name}</p>
            </div>`;
    }
});
</script>
@endsection
