<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Enums\RoleEnum;
use App\Models\Organization;
use Livewire\Component;
use Livewire\WithPagination;
use Log;

class ManageOrganizationsComponent extends Component
{
    use WithPagination;

    public $label;
    public $status;

    #[Url(history::true)]
    public $search = '';

    #[Url()]
    public $perPage = 10;

    #[Url(history::true)]
    public $sortBy = 'created_at';

    #[Url(history::true)]
    public $sortDirection = 'desc';


    public function mount()
    {

    }

    public function setSortBy($sortColumn)
    {
        Log::info('Entered SortBy in Admin Countries Listing for sorting by ' . $sortColumn);


        if ($this->sortBy  === $sortColumn) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortBy = $sortColumn;
    }

    public function upddatingSearch()
    {
        $this->resetPage();
    }


    public function paginationView()
    {
        return 'livewire.util.pagination';
    }

    public function render()
    {

        $dealers = Organization::search($this->search)
        ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        Log::info('Admin dealers Listing Results: ' . json_encode($dealers));

        return view('livewire.admin.manage-organizations-component', [
            'dealers'=>$dealers,
        ]);

    }



}
