<div class="row mb-3">
    <div class="col">
        <label for="formFile" class="form-label">User Image</label>
        <input class="form-control" type="file" id="formFile" name="photo">
        @error('photo')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>

<!-- Save Profile Picture Button -->
<div class="flex items-center gap-4">
    <button type="submit" class="btn btn-primary">{{ __('Save Photo') }}</button>
    @if (session('status') === 'photo-updated')
        <p class="text-sm text-green-600">{{ __('Profile photo updated successfully.') }}</p>
    @endif
</div>
