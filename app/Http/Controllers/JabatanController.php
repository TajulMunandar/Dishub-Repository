<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jabatans = Jabatan::all();
        return view('dashboard.jabatan.index')->with(compact("jabatans"));
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
            ]);
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->route('jabatan.index')->with('failed', $exception->getMessage());
        }

        Jabatan::create($validatedData);

        return redirect()->route('jabatan.index')->with('success', 'Jabatan baru berhasil ditambahkan!');
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
    public function update(Request $request, Jabatan $jabatan)
    {
        try {
            $rules = [
                'name' => 'required|max:255',
            ];

            $validatedData = $this->validate($request, $rules);

            Jabatan::where('id', $jabatan->id)->update($validatedData);

            return redirect()->route('jabatan.index')->with('success', "Data Jabatan $jabatan->name berhasil diperbarui!");
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->route('jabatan.index')->with('failed', 'Data gagal diperbarui! ' . $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jabatan $jabatan)
    {
        try {
            Jabatan::destroy($jabatan->id);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                //SQLSTATE[23000]: Integrity constraint violation
                return redirect()->route('jabatan.index')->with('failed', "Jabatan $jabatan->name tidak dapat dihapus, karena sedang digunakan pada tabel lain!");
            }
        }

        return redirect()->route('jabatan.index')->with('success', "Jabatan $jabatan->name berhasil dihapus!");
    }
}
