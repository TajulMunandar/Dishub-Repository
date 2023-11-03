<?php

namespace App\Http\Controllers;

use App\Models\BeritaAcara;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staff = Staff::count();
        $approve = BeritaAcara::where('isApprove', 1)->count();
        $disapprove = BeritaAcara::where('isApprove', 0)->count();

        $now = Carbon::now();
        $today = $now->format('Y-m-d');
        $yesterday = $now->subDay()->format('Y-m-d');
        $lastWeek = $now->subWeek()->format('Y-m-d');
        $lastMonth = $now->subMonth()->format('Y-m-d');

        $harian = BeritaAcara::whereDate('created_at', $today)->count();
        $kemarin = BeritaAcara::whereDate('created_at', $yesterday)->count();
        $minggu_lalu = BeritaAcara::whereBetween('created_at', [$lastWeek, $yesterday])->count();
        $bulan_lalu = BeritaAcara::whereBetween('created_at', [$lastMonth, $lastWeek])->count();

        return view('dashboard.index')->with(compact('staff', 'approve', 'disapprove', 'harian', 'kemarin', 'minggu_lalu', 'bulan_lalu'));
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
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
