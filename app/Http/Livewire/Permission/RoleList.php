<?php

namespace App\Http\Livewire\Permission;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class RoleList extends Component
{
    public array|Collection $roles;

    protected $listeners = ['success' => 'updateRoleList'];

    public function render()
    {
        $this->roles = Role::with('permissions')->get();

        return view('livewire.permission.role-list');
    }

    public function updateRoleList()
    {
        $this->roles = Role::with('permissions')->get();
    }
}
