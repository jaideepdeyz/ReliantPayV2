<?php

namespace App\Livewire\Admin;

use App\Livewire\Admin\AdminActions;
use App\Models\User;
use App\Enums\RoleEnum;
use App\Models\Organization;
use Livewire\Component;
use Livewire\WithPagination;
use Log;

class ManageOrganizations extends Component
{
    use WithPagination;

    public $label;
    public $status;
    private $adminActions;
    public $org;

    #[Url(history::true)]
    public $search = '';

    #[Url()]
    public $perPage = 10;

    #[Url(history::true)]
    public $sortBy = 'created_at';

    #[Url(history::true)]
    public $sortDirection = 'desc';

    public function __construct()
    {
        $this->adminActions = new AdminActions();
    }

    public function setSortBy($sortColumn)
    {
        Log::info('Entered Sort By in Admin Countries Listing for sorting by ' . $sortColumn);


        if ($this->sortBy  === $sortColumn) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortBy = $sortColumn;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function activateDeactivate($id)
    {
        $this->adminActions->org = Organization::find($id);
        if($this->adminActions->org->user->is_active == 'Yes')
        {
            $this->adminActions->deactivate();
        }else{
            $this->adminActions->activate();
        }
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

        return view('livewire.admin.manage-organizations', [
            'dealers'=>$dealers,
        ])->layout('layouts.dashboard-layout');

    }



}
