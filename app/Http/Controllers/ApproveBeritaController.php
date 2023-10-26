<?php

namespace App\Http\Controllers;

use App\Models\BeritaAcara;
use App\Models\Staff;
use Illuminate\Http\Request;

class ApproveBeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staff = Staff::all();
        $beritas = BeritaAcara::all();
        return view('dashboard.approve.index')->with(compact('beritas', 'staff'));
    }

    public function approve()
    {

    }

    public function disapprove()
    {

    }
}
