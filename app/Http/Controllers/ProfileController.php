<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $jabatan = auth()->user()->staff->jabatan->id;
        $atasan = Staff::where('id_jabatan', $jabatan)->where('isKetua', 1)->get();
        return view('auth.profile', [
            'staff' => Staff::all(),
            'jabatans' => Jabatan::all(),
            'atasan' => $atasan,
        ]);
    }

    public function update(Request $request, Staff $profile)
    {
        $rules = [
            'name' => 'required',
            'id_jabatan' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'sk' => 'required',
            'aktif' => 'required',
            'hp' => 'required',
            'email' => 'required',
            'unit_kerja' => 'required',
        ];

        $validatedData = $request->validate($rules);

        Staff::where('id', $profile->id)->update($validatedData);

        return redirect('/profile')->with('success', 'User berhasil diperbarui!');
    }
}
