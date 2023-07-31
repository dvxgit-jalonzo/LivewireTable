<?php

namespace App\Http\Livewire;

use App\Exports\UsersExport;
use App\Models\User;
use Illuminate\Http\Response;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class UserTable extends Component
{

    use WithPagination;

    public $name = '';
    public $email = '';
    public $created_at = '';


    public $sortField = 'name';
    public $sortDirection = 'asc';

    protected $queryString = ['sortField', 'sortDirection'];


    public function getSelectedUsers()
    {
        return User::search('name', $this->name)
            ->search('email', $this->email)
            ->search('created_at', $this->created_at)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);
    }

    public function export($type)
    {
        if (!in_array($type, ['csv', 'xlsx', 'pdf'])) {
            abort(Response::HTTP_NOT_FOUND);
        }
        $users = $this->getSelectedUsers();
        return Excel::download(new UsersExport($users), 'users_' . now()->format('YmdHis.') . $type);
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }


    public function render()
    {
        return view('livewire.user-table', [
            'users' => $this->getSelectedUsers()
        ]);
    }
}
