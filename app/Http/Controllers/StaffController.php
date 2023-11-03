<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view(
            'dashboard.staff.index',
            [
                'title' => 'Data Staff',
                'staff' => Staff::all(),
                'jabatans' => Jabatan::all(),
                'users' => User::all(),
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'id_jabatan' => 'required',
                'isKetua' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->route('staff.index')->with('failed', $exception->getMessage());
        }

        $userData = [
            'name' => $validatedData['name'],
            'username' => $validatedData['name'],
            'password' => Hash::make($validatedData['name']),
            'isAdmin' => 2,
        ];

        User::create($userData);

        $validatedData['id_user'] = User::where('username', $validatedData['name'])->first(['id'])->id;

        Staff::create($validatedData);

        return redirect()->route('staff.index')->with('success', 'User baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, Staff $staff)
    {
        try {
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
                'isKetua' => 'required',
                'id_user' => 'required',
            ];

            $validatedData = $this->validate($request, $rules);

            Staff::where('id', $staff->id)->update($validatedData);

            return redirect()->route('staff.index')->with('success', "Data Staff $staff->name berhasil diperbarui!");
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->route('staff.index')->with('failed', 'Data gagal diperbarui! ' . $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff)
    {
        try {
            Staff::destroy($staff->id);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                //SQLSTATE[23000]: Integrity constraint violation
                return redirect()->route('staff.index')->with('failed', "Staff $staff->name tidak dapat dihapus, karena sedang digunakan pada tabel lain!");
            }
        }

        return redirect()->route('staff.index')->with('success', "Staff $staff->name berhasil dihapus!");
    }
}
