<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Models\Role;

Route::middleware('auth')->prefix('admin')->as('admin.')->group(function (){
    Route::resource('user', UserController::class);

    Route::get('roles', function () {
        return view('Role.index', [
            'roles' => Role::withCount(['permissions', 'users'])->latest()->get(),
        ]);
    })->name('roles.index');

    Route::get('roles/create', function () {
        $permissions = Permission::orderBy('module')->orderBy('access')->get();

        return view('Role.create', [
            'permissions' => $permissions,
            'permissionGroups' => $permissions->groupBy(fn (Permission $permission) => $permission->module ?: str($permission->name)->before('.')->title()->toString()),
        ]);
    })->name('roles.create');

    Route::post('roles', function (Request $request) {
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
    })->name('roles.store');

    Route::get('roles/{role}/edit', function (Role $role) {
        $permissions = Permission::orderBy('module')->orderBy('access')->get();
        $role->load('permissions');

        return view('Role.edit', [
            'role' => $role,
            'permissions' => $permissions,
            'permissionGroups' => $permissions->groupBy(fn (Permission $permission) => $permission->module ?: str($permission->name)->before('.')->title()->toString()),
        ]);
    })->name('roles.edit');

    Route::put('roles/{role}', function (Request $request, Role $role) {
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
    })->name('roles.update');

    Route::delete('roles/{role}', function (Role $role) {
        $role->delete();
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Role deleted successfully.');
    })->name('roles.destroy');

    Route::get('permissions', function () {
        return view('Permission.index', [
            'permissions' => Permission::withCount('roles')->latest()->get(),
        ]);
    })->name('permissions.index');

    Route::get('permissions/create', function () {
        return view('Permission.create', [
            'modules' => Permission::query()
                ->whereNotNull('module')
                ->where('module', '!=', '')
                ->distinct()
                ->orderBy('module')
                ->pluck('module'),
        ]);
    })->name('permissions.create');

    Route::post('permissions', function (Request $request) {
        $validated = $request->validate([
            'module' => ['required', 'string', 'max:255'],
            'access' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);
        $name = Str::slug($validated['module']).'.'.Str::slug($validated['access']);
        $request->merge(['name' => $name]);

        $request->validate([
            'name' => ['unique:permissions,name'],
            'module' => [Rule::unique('permissions', 'module')->where('access', $validated['access'])],
        ], [
            'name.unique' => 'This permission already exists.',
            'module.unique' => 'This module and access permission already exists.',
        ]);

        Permission::create([
            'name' => $name,
            'module' => $validated['module'],
            'access' => $validated['access'],
            'guard_name' => 'web',
            'description' => $validated['description'] ?? null,
        ]);
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        return redirect()
            ->route('admin.permissions.index')
            ->with('success', 'Permission created successfully.');
    })->name('permissions.store');

    Route::get('permissions/{permission}/edit', function (Permission $permission) {
        return view('Permission.edit', compact('permission'));
    })->name('permissions.edit');

    Route::put('permissions/{permission}', function (Request $request, Permission $permission) {
        $validated = $request->validate([
            'module' => ['required', 'string', 'max:255'],
            'access' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);
        $name = Str::slug($validated['module']).'.'.Str::slug($validated['access']);
        $request->merge(['name' => $name]);

        $request->validate([
            'name' => [Rule::unique('permissions', 'name')->ignore($permission->id)],
            'module' => [
                Rule::unique('permissions', 'module')
                    ->where('access', $validated['access'])
                    ->ignore($permission->id),
            ],
        ], [
            'name.unique' => 'This permission already exists.',
            'module.unique' => 'This module and access permission already exists.',
        ]);

        $permission->update([
            'name' => $name,
            'module' => $validated['module'],
            'access' => $validated['access'],
            'description' => $validated['description'] ?? null,
        ]);
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        return redirect()
            ->route('admin.permissions.index')
            ->with('success', 'Permission updated successfully.');
    })->name('permissions.update');

    Route::delete('permissions/{permission}', function (Permission $permission) {
        $permission->delete();
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        return redirect()
            ->route('admin.permissions.index')
            ->with('success', 'Permission deleted successfully.');
    })->name('permissions.destroy');
});
