<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Role.index', [
            'roles' => Role::withCount(['permissions', 'users'])->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::orderBy('module')->orderBy('access')->get();

        return view('Role.create', [
            'permissions' => $permissions,
            'permissionGroups' => $this->groupPermissions($permissions),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles,name'],
            'description' => ['nullable', 'string'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['exists:permissions,name'],
        ]);

        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'web',
            'description' => $request->description,
        ]);
        $role->syncPermissions($request->input('permissions', []));

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Role created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::orderBy('module')->orderBy('access')->get();
        $role->load('permissions');

        return view('Role.edit', [
            'role' => $role,
            'permissions' => $permissions,
            'permissionGroups' => $this->groupPermissions($permissions),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('roles', 'name')->ignore($role->id)],
            'description' => ['nullable', 'string'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['exists:permissions,name'],
        ]);

        $role->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        $role->syncPermissions($request->input('permissions', []));

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Role deleted successfully.');
    }

    /**
     * Group permissions by their module for display.
     */
    private function groupPermissions($permissions)
    {
        return $permissions->groupBy(fn (Permission $permission) => $permission->module ?: Str::of($permission->name)->before('.')->title()->toString());
    }
}
