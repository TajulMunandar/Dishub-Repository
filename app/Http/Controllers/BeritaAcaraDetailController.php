<?php

namespace App\Http\Controllers;

use App\Models\BeritaAcaraDetail;
use App\Models\Staff;
use Illuminate\Http\Request;

class BeritaAcaraDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staff = Staff::all();
        $beritas = BeritaAcaraDetail::all();
        return view('dashboard.berita_acara.index')->with(compact('beritas', 'staff'));
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
                'waktu' => 'required',
                'uraian' => 'required',
                'ket' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->route('berita.show', $request->id_berita_acara)->with('failed', $exception->getMessage());
        }
        $validatedData['id_berita'] = $request->id_berita_acara;

        BeritaAcaraDetail::create($validatedData);

        return redirect()->route('berita.show', $request->id_berita_acara)->with('success', 'Berita baru berhasil ditambahkan!');
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
    public function update(Request $request, BeritaAcaraDetail $berita_detail)
    {
        try {
            $rules = [
                'waktu' => 'required',
                'uraian' => 'required',
                'ket' => 'required',
            ];

            $validatedData = $this->validate($request, $rules);

            $validatedData['id_berita'] = $request->id_berita_acara;

            BeritaAcaraDetail::where('id', $berita_detail->id)->update($validatedData);

            return redirect()->route('berita.show', $request->id_berita_acara)->with('success', "Data Berita $berita_detail->uraian berhasil diperbarui!");
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->route('berita.show', $request->id_berita_acara)->with('failed', 'Data gagal diperbarui! ' . $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BeritaAcaraDetail $berita_detail, Request $request)
    {
        try {
            BeritaAcaraDetail::destroy($berita_detail->id);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                //SQLSTATE[23000]: Integrity constraint violation
                return redirect()->route('berita.show', $request->id_berita_acara)->with('failed', "Berita $berita_detail->uraian tidak dapat dihapus, karena sedang digunakan pada tabel lain!");
            }
        }

        return redirect()->route('berita.show', $request->id_berita_acara)->with('success', "Berita $berita_detail->uraian berhasil dihapus!");
    }
}
