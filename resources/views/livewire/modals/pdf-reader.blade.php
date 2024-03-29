<div>
    <div class="modal-header">
        <h5 class="modal-title">{{ $title }}</h5>
        <button type="button" class="btn-close" wire:click="$dispatch('hideModal')" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        @if ($type != 'image')

            <iframe src="/ViewerJS/#{{ $url }}" width='100%' height='500' allowfullscreen
                webkitallowfullscreen></iframe>
        @else
            <img src="{{ $url }}" alt="image" class="img-fluid" style="width:auto;">
        @endif

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" wire:click="$dispatch('hideModal')">Close</button>
    </div>
</div>
