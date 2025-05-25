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
            // Social Media
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'instagram_url' => 'nullable',
            'indeed_url' => 'nullable',
            'youtube_url' => 'nullable',
            // Contact
            'phone_number' => 'nullable|string|max:20',
            // App Stores
            'app_store_url' => 'nullable',
            'play_store_url' => 'nullable',
            'video_url' => 'nullable',
        ]);
        
   
        $settings = SiteSettings::first();

        // Basic Settings
        $settings->website_name = $request->website_name ?? $settings->website_name;
        $settings->name_color = $request->name_color ?? $settings->name_color;

        // Social Media Links
        $settings->facebook_url = $request->facebook_url ?? $settings->facebook_url;
        $settings->twitter_url = $request->twitter_url ?? $settings->twitter_url;
        $settings->instagram_url = $request->instagram_url ?? $settings->instagram_url;
        $settings->indeed_url = $request->indeed_url ?? $settings->indeed_url;
        $settings->youtube_url = $request->youtube_url ?? $settings->youtube_url;
        $settings->video_url = $request->video_url ?? $settings->video_url;

        // Contact Info
        $settings->phone_number = $request->phone_number ?? $settings->phone_number;

        // App Store Links
        $settings->app_store_url = $request->app_store_url ?? $settings->app_store_url;
        $settings->play_store_url = $request->play_store_url ?? $settings->play_store_url;

        // Logo Handling
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($settings->logo_path && file_exists(public_path($settings->logo_path))) {
                unlink(public_path($settings->logo_path));
            }

            // Store new logo
            $logo = $request->file('logo');
            $filename = 'site-logo-' . time() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('uploads'), $filename);
            
            $settings->logo_path = '/uploads/' . $filename;
        }

        $settings->save();
          session()->flash('toast', [
            'type'    => 'success', //        
            'message' => 'Settings update successfully',
            'timer'   => 3000,                
            'bar'     => true,                 
        ]);

        return back();
    }
}