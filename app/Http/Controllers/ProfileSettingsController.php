<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileSettingsController extends Controller
{
    public function updateSettings(Request $request)
    {
        $request->validate([
            'website_name' => 'nullable|string|max:50',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           
            'name_color' => 'nullable|regex:/^#[a-f0-9]{6}$/i'
        ]);

        $user = Auth::user();

        if ($request->has('website_name')) {
            $user->website_name = $request->website_name;
        }

        if ($request->has('name_color')) {
            $user->name_color = $request->name_color;
        }

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($user->logo_path) {
                Storage::delete($user->logo_path);
            }

            // Store new logo
            $path = $request->file('logo')->store('public/logos');
            $user->logo_path = $path;
        }

        $user->save();

        return back()->with('status', 'Settings updated successfully!');
    }
}