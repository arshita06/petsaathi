<?php

namespace App\Http\Controllers\admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;

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
            'settings'     => ['nullable', 'array'],
            'settings.*'   => ['nullable', 'string', 'max:191'],
            'appearance'   => ['required', 'in:light,dark'],
            'site_logo'    => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'site_favicon' => ['nullable', 'file', 'mimes:png,ico,svg,jpg,jpeg,webp', 'max:1024'],
            'new_key'      => ['nullable', 'string', 'max:191'],
            'new_value'    => ['nullable', 'string', 'max:191', 'required_with:new_key'],
        ]);

        // These keys hold uploaded file paths, so they never take a plain text value.
        $fileKeys = ['site_logo', 'site_favicon'];

        foreach (Arr::except($request->input('settings', []), $fileKeys) as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value ?? '']);
        }

        Setting::updateOrCreate(
            ['key' => 'appearance'],
            ['value' => $request->input('appearance')]
        );

        foreach ($fileKeys as $key) {
            if (! $request->hasFile($key)) {
                continue;
            }

            $oldPath = Setting::getValue($key);

            if ($oldPath && File::exists(public_path($oldPath))) {
                File::delete(public_path($oldPath));
            }

            $file = $request->file($key);
            $fileName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->move(public_path('uploads/settings'), $fileName);

            Setting::updateOrCreate(['key' => $key], ['value' => 'uploads/settings/' . $fileName]);
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

        return view('admin.settings.show', compact('settings'));
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
