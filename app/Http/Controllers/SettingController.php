<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{

    public function index()
    {
        $setting = Setting::first();

        if (!$setting) {

            $setting = Setting::create([
                'nama_toko' => 'MitraMart',
                'nama_aplikasi' => 'MitraMart POS',
                'alamat'    => '',
                'telepon'   => '',
                'email'     => '',
                'pengelola' => '',
            ]);

        }

        return view('pengaturan.index', compact('setting'));
    }




    public function edit()
    {
        $setting = Setting::first();

        if (!$setting) {

            $setting = Setting::create([
                'nama_toko' => 'MitraMart',
                'nama_aplikasi' => 'MitraMart POS',
                'alamat'    => '',
                'telepon'   => '',
                'email'     => '',
                'pengelola' => '',
            ]);

        }


        return view('pengaturan.edit', compact('setting'));
    }





    public function update(Request $request)
    {

        $request->validate([

            'nama_toko'  => 'required|string|max:100',
            'alamat'     => 'nullable|string',
            'telepon'    => 'nullable|string|max:20',
            'email'      => 'nullable|email|max:100',
             'pengelola'  => 'nullable|string|max:100',

            'logo'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'nama_aplikasi' => 'nullable|string|max:100',
            'versi_aplikasi' => 'nullable|string|max:50',
            'deskripsi_aplikasi' => 'nullable|string',
            'developer' => 'nullable|string|max:100',

        ]);




        $setting = Setting::first();



        $data = $request->only([

            'nama_toko',
            'alamat',
            'telepon',
            'email',
            'pengelola',

            'nama_aplikasi',
            'versi_aplikasi',
            'deskripsi_aplikasi',
            'developer',

        ]);





        if ($request->hasFile('logo')) {


            if ($setting->logo && Storage::disk('public')->exists($setting->logo)) {

                Storage::disk('public')->delete($setting->logo);

            }



            $data['logo'] = $request->file('logo')
                ->store('logo', 'public');

        }




        $setting->update($data);



        return redirect()
            ->route('pengaturan.index')
            ->with('success', 'Pengaturan berhasil diperbarui.');

    }


}
