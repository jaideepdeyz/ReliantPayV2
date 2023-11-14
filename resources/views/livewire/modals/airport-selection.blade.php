<div>
    <div class="modal-header">
        <h5 class="modal-title">Select {{$type}} Airport</h5>
        <button type="button" class="btn-close" wire:click="$dispatch('hideModal')" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-12">
                <input type="text" class="form-control" wire:model.live="search" placeholder="Search">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12 mb-2">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>IDENT</th>
                            <th>Name</th>
                            <th>City</th>
                            <th>Country</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($airports as $airport)
                            <tr>
                                <td>{{$airport->ident}}</td>
                                <td>{{$airport->name}}</td>
                                <td>{{$airport->municipality}}</td>
                                <td>{{$airport->iso_country}}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" wire:click="selectAirport({{$airport->id}})">Select</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$airports->links()}}
            </div>
        </div>
    </div>
    {{-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary"  wire:click="$dispatch('hideModal')">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
    </div> --}}
</div>
