<x-dashboard-layout>
    <div class="row mt-2 justify content center">
        <div class="col-md-12 mt-2">
            <h5 class="bg-light p-2 mt-0 mb-4">
                <a href="{{ route('authorizeAndSend', $authFile->app_id) }}" class="btn btn-success"><i
                        class="ri-mail-send-line font-13"></i> Send
                    Authorization Email</a>
            </h5>
        </div>
        <div class="col-md-12">
            <iframe src="/ViewerJS/#{{ Storage::URL($authFile->unsigned_document) }}" width='100%' height='500' allowfullscreen
            webkitallowfullscreen></iframe>
        </div>
    </div>
</x-dashboard-layout>
