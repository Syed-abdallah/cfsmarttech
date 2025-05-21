<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteSettings;
use Illuminate\Support\Facades\Storage;

class SiteSettingsController extends Controller
{
    
    public function update(Request $request)
    {
        $request->validate([
            'website_name' => 'nullable|string|max:50',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name_color' => 'nullable|string|regex:/^#[a-f0-9]{6}$/i',
        ]);

        $settings = SiteSettings::first();

        $settings->website_name = $request->website_name ?? $settings->website_name;
        $settings->name_color = $request->name_color ?? $settings->name_color;

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($settings->logo_path && file_exists(public_path($settings->logo_path))) {
                unlink(public_path($settings->logo_path));
            }

            // Store new logo
            $logo = $request->file('logo');
            $filename = 'site-logo.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('uploads'), $filename);
            
            $settings->logo_path = '/uploads/' . $filename;
        }

        $settings->save();

        return back()->with('success', 'Settings updated successfully!');
    }
}