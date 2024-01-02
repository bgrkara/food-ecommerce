<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\SettingsService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function index() : View
    {
        return view('admin.setting.index');
    }

    public function updateGeneralSetting(Request $request)
    {
       $validateData = $request->validate([
          'site_name' => ['required', 'max:255'],
          'site_default_currency' => ['required', 'max:4'],
          'site_currency_icon' => ['required', 'max:4'],
          'site_currency_icon_position' => ['required', 'max:255'],
       ],
       [
           'site_name.required' => 'Site Adı Alanı Zorunludur.',
           'site_currency_icon.required' => 'Site Para Birimi Simgesi Alanı Gereklidir.'
       ]);

        foreach($validateData as $key => $value){

            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );

        }

        $settingsService = app(SettingsService::class);
        $settingsService->clearCachedSettings();

        toastr()->success('Güncelleme İşlemi Başarılı');
        return redirect()->back();
    }



}
