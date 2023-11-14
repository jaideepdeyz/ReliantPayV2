<div>
    <div class="modal-header">
        <h5 class="modal-title">Select {{$type}} Country</h5>
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
                            <th>Code</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($countries as $country)
                            <tr>
                                <td>{{$country->code}}</td>
                                <td>{{$country->name}}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" wire:click="selectCountry('{{$country->code}}')">Select</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$countries->links()}}
            </div>
        </div>
    </div>
    {{-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary"  wire:click="$dispatch('hideModal')">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
    </div> --}}
</div>
