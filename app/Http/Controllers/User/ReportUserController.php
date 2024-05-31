<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Absensi;

class ReportUserController extends Controller
{
    public function index(Request $request)
    {
        $absensi = collect();
        $date1 = null;
        $date2 = null;
        $jumlah_hadir = null;
        $jumlah_izin = null;
        $jumlah_sakit = null;
        $searchPerformed = false;

        if ($request->has('search')) {
            $searchPerformed = true;
            $date1 = $request->date1;
            $date2 = $request->date2;
            $user_id = Auth::user()->id;

            $absensi = Absensi::with(['user'])->where([
                ['user_id','=', $user_id],
            ])->whereBetween('date', [$date1, $date2])->orderBy('id', 'ASC')->get();

            $jumlah_hadir = Absensi::with(['user'])->where([
                ['user_id','=', $user_id],
                ['description','=', 'Hadir'],
            ])->whereBetween('date', [$date1, $date2])->count();

            $jumlah_izin = Absensi::with(['user'])->where([
                ['user_id','=', $user_id],
                ['description','=', 'Izin'],
            ])->whereBetween('date', [$date1, $date2])->count();

            $jumlah_sakit = Absensi::with(['user'])->where([
                ['user_id','=', $user_id],
                ['description','=', 'Sakit'],
            ])->whereBetween('date', [$date1, $date2])->count();

            
        }

        return view('pages.user.report.index',[
            'absensi' => $absensi,
            'date1' => $date1,
            'date2' => $date2,
            'searchPerformed' => $searchPerformed,
            'jumlah_hadir' => $jumlah_hadir,
            'jumlah_izin' => $jumlah_izin,
            'jumlah_sakit' => $jumlah_sakit,
        ]);
    }
}
