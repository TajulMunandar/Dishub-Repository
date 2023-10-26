<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function resetPasswordAdmin(Request $request, User $user)
    {
        try {
            $rules = [
                'password' => 'required|min:5|max:255',
            ];

            $validatedData = $request->validate($rules);
            $validatedData['password'] = Hash::make($validatedData['password']);

            User::where('id', $user->id)->update($validatedData);

            return redirect()->route('user.index')->with('success', 'Password berhasil diubah!');
        } catch (\Exception $e) {
            return back()->with('failed', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
