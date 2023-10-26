<?php

namespace App\Http\Controllers;

use App\Models\BeritaAcara;
use App\Models\BeritaAcaraDetail;
use App\Models\Staff;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;

class BeritaAcaraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->isAdmin == 1) {
            $staff = Staff::all();
            $beritas = BeritaAcara::all();
        } else {
            $staff = Staff::where('id_user', auth()->user()->id)->first();
            $beritas = BeritaAcara::where('id_staff', $staff->id)->get();
        }
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
                'name' => 'required',
                'id_staff' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->route('berita.index')->with('failed', $exception->getMessage());
        }

        $validatedData['isApprove'] = 0;

        BeritaAcara::create($validatedData);

        return redirect()->route('berita.index')->with('success', 'Berita baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(BeritaAcara $beritum)
    {
        $staff = Staff::all();
        $beritas = BeritaAcaraDetail::where('id_berita', $beritum->id)->get();
        return view('dashboard.berita_acara.detail.index')->with(compact('beritas', 'staff', 'beritum'));
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
    public function update(Request $request, BeritaAcara $beritum)
    {
        try {
            $rules = [
                'name' => 'required',
                'id_staff' => 'required',
            ];

            $validatedData = $this->validate($request, $rules);

            BeritaAcara::where('id', $beritum->id)->update($validatedData);

            return redirect()->route('berita.index')->with('success', "Data Berita $beritum->name berhasil diperbarui!");
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->route('berita.index')->with('failed', 'Data gagal diperbarui! ' . $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BeritaAcara $beritum)
    {
        $beritum->BeritaAcaraDetail->each(function ($beritaAcaraDetail) {
            $beritaAcaraDetail->delete();
        });
        BeritaAcara::destroy($beritum->id);

        return redirect()->route('berita.index')->with('success', "Berita $beritum->name berhasil dihapus!");
    }

    public function approve(BeritaAcara $beritum)
    {
        BeritaAcara::where('id', $beritum->id)->update(['isApprove' => 1]);

        return redirect()->route('berita.index')->with('success', "Berita $beritum->name diterima!");
    }

    public function disapprove(BeritaAcara $beritum)
    {
        BeritaAcara::where('id', $beritum->id)->update(['isApprove' => 2]);

        return redirect()->route('berita.index')->with('success', "Berita $beritum->name Ditolak!");
    }

    public function generatePDF(BeritaAcara $berita)
    {
        $details = BeritaAcaraDetail::where('id_berita', $berita->id)->get();
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $pdf = new Dompdf();

        $htmlContent = view('dashboard.template.berita', compact('berita', 'details'))->render();
        $pdf->loadHtml($htmlContent);
        $pdf->setPaper('A4', 'potrait');

        $pdf->render();

        return $pdf->stream('berita.pdf');
    }
}
