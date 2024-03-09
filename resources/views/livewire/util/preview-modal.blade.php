<div wire:ignore.self class="modal fade" id="PreviewModal" tabindex="-1"
            aria-labelledby="ImagePreviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Document Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>

                <div class="modal-body text-center">

                    @if ($previewrequesteddocumentname)

                        <img src="{{Storage::URL($previewrequesteddocumentname)}}" alt="Itenary" width="600">



                    @endif

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
