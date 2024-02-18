<x-dashboard-layout>
    <div class="row mt-2 justify content center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5>Ticket Issued</h5>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <iframe src="/ViewerJS/#{{ Storage::URL($ticket->ticket_upload) }}" width='100%' height='850' allowfullscreen
                        webkitallowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
