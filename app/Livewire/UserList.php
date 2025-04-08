<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Illuminate\Support\Facades\Storage;

class UserList extends Component
{
    use WithPagination, WithoutUrlPagination;


    public $searchTerm = null;
    public $activePageNumber = 1;

    public $sortColumn = 'id';
    public $sortOrder = 'asc';

    public function sortBy($columnName) {
        if ($this->sortColumn === $columnName) {
            $this->sortOrder = $this->sortOrder === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortColumn = $columnName;
            $this->sortOrder = 'asc';
        }
    }

    public function fetchPosts() {
        return User::where('name', 'like', '%' . $this->searchTerm . '%')
        ->orWhere('email', 'like', '%' . $this->searchTerm . '%')
        ->orderBy($this->sortColumn, $this->sortOrder)->paginate(5);
    }


    public function render()
    {
        $users = $this->fetchPosts();

         return view('livewire.user-list', compact('users'));
    }


    public function deletePost(User $user) {

        if ($user) {

            $deleteResponse = $user->delete();

            if ($deleteResponse) {

                session()->flash('success', 'User deleted successfully!');
            } else {
                session()->flash('error', 'Unable to delete User. Please try again!');
            }
        }
        else {
            session()->flash('error', 'User not found. Please try again!');
        }

        $user = $this->fetchPosts();

        if ($user->isEmpty() && $this->activePageNumber > 1) {
            # Redirect to the Active page - 1 (Previous Page)
            $this->gotoPage($this->activePageNumber - 1);
        }
        else {
            # Redirect to the Active Page
            $this->gotoPage($this->activePageNumber);
        }

        // return $this->redirect('/posts', navigate: true);
    }


    public function updatingPage($pageNumber) {
        $this->activePageNumber = $pageNumber;
    }

}
