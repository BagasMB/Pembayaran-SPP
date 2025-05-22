<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]
class UserPage extends Component
{
    use WithPagination;

    public $search;
    public $editId, $name, $username, $email, $userRole;
    public $roles;
    public $paginate = 10;
    protected $paginationTheme = 'bootstrap';

    public function updateSearch()
    {
        $this->resetPage(); // Reset ke halaman 1 saat search berubah
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function mount()
    {
        if (!Auth::user()->hasRole('Super Admin')) {
            abort(404); // atau redirect()->route('home')
        }
        $this->roles = Role::pluck('name')->toArray();
    }

    public function updateUser()
    {
        $this->validate([
            'username' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'userRole' => 'required|exists:roles,name'
        ]);

        $user = User::findOrFail($this->editId);
        $user->update([
            'username' => $this->username,
            'name' => $this->name,
            'email' => $this->email,
        ]);

        // Ganti role user
        $user->syncRoles([$this->userRole]);
        $this->reset(['editId', 'username', 'name', 'email', 'userRole']);
        flash()->success('Data Berhasil Di Simpan 🎉');
    }

    public function render()
    {
        // dd($this->paginate);
        return view('livewire.user-page', [
            'userList' => User::with('roles')->search($this->search)->paginate($this->paginate),
        ]);
    }
}
