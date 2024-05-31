<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Exports\AbsensiExport;

use Maatwebsite\Excel\Facades\Excel;

class ReportAdminController extends Controller
{
    public function index(Request $request)
    {
        $users = collect();
        $date1 = null;
        $date2 = null;
        $searchPerformed = false;

        if ($request->has('search')) {
            $searchPerformed = true;
            $date1 = $request->date1;
            $date2 = $request->date2;

            $users = User::where('role_id', '2')->orderBy('name', 'ASC')->get();
        }

        return view('pages.admin.report.index',[
            'users' => $users,
            'date1' => $date1,
            'date2' => $date2,
            'searchPerformed' => $searchPerformed
        ]);
    }

    public function export_data($date1, $date2){
        $export = new AbsensiExport($date1, $date2);

        return Excel::download($export, 'Laporan Absensi Tanggal '.$date1.' sd '.$date2.'.xlsx');
    }
}
