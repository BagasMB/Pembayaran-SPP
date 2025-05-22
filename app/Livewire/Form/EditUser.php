<?php

namespace App\Livewire\Form;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class EditUser extends Component
{
    public $editId, $name, $username, $email, $userRole;
    public $roles;

    public function mount($userID)
    {
        if (!Auth::user()->hasRole('Super Admin')) {
            abort(404); // atau redirect()->route('home')
        }
        $this->roles = Role::pluck('name')->toArray();
        $user = User::with('roles')->findOrFail($userID);
        $this->editId = $user->id;
        $this->username = $user->username;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->userRole = $user->roles->first()?->name ?? '';
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
        flash()->success('Data Berhasil Di Simpan 🎉');
        $this->reset(['editId', 'username', 'name', 'email', 'userRole']);
        return redirect()->route('user.index');
    }

    public function render()
    {
        return view('livewire.edit-user');
    }
}
