<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.Permission.index', [
            'permissions' => Permission::withCount('roles')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.Permission.create', [
            'modules' => Permission::query()
                ->whereNotNull('module')
                ->where('module', '!=', '')
                ->distinct()
                ->orderBy('module')
                ->pluck('module'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return view('admin.Permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        return redirect()
            ->route('admin.permissions.index')
            ->with('success', 'Permission deleted successfully.');
    }
}
