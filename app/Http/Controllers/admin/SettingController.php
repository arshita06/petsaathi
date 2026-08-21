<?php

namespace App\Http\Controllers\admin;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->show('general');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('admin.settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'settings'   => ['nullable', 'array'],
            'settings.*' => ['nullable', 'string', 'max:191'],
            'new_key'    => ['nullable', 'string', 'max:191'],
            'new_value'  => ['nullable', 'string', 'max:191', 'required_with:new_key'],
        ]);

        foreach ($request->input('settings', []) as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value ?? '']);
        }

        if ($request->filled('new_key')) {
            Setting::updateOrCreate(
                ['key' => $request->input('new_key')],
                ['value' => $request->input('new_value')]
            );
        }

        return redirect()->route('admin.settings.index')->with('success', 'Settings saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $settings = Setting::pluck('value', 'key');

        return view('settings.show', compact('settings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
