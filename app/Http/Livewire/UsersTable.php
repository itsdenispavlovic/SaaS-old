<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $perRow;
    public $orderBy = "first_name";
    public $direction = "asc";
    public $search = '';

    public function mount()
    {
        $this->perRow = 5;
    }

    public function render()
    {
        $users = User::orderBy($this->orderBy, $this->direction);

        if(!empty($this->search))
        {
            $searchQuery = $this->search;
            $users = $users->where(function($query) use ($searchQuery) {
                $query->where('first_name', 'LIKE', "%$searchQuery%")
                      ->orWhere('last_name', 'LIKE', "%$searchQuery%")
                      ->orWhere('email', 'LIKE', "%$searchQuery%");
            });
        }

        $users = $users->paginate($this->perRow);

        return view('livewire.users-table', compact('users'));
    }
}
