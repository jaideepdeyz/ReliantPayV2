<div class="form-group last mb-3">
    <button type="button"
        class="mt-2 inline-flex items-center px-3 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 reload"
        id="reload" class="btn btn-danger" style="background: rgb(27, 29, 29)">
        ↻
    </button>
    <div class="captcha d-inline">
        <span>{!! captcha_img('flat') !!}</span>
    </div>

</div>
<div class="form-group last mb-3">
    <input type="text" class="form-control @error('captcha') is-invalid @enderror" placeholder="Enter captcha"
        id="captcha" name="captcha" required>
    @error('captcha')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
