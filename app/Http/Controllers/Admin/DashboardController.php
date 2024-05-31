<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Absensi;

class DashboardController extends Controller
{
    public function index(){
        $today = date('Y-m-d');
        $user = User::where('role_id','2')->count();
        $hadir = Absensi::where([
            ['date','=',$today],
            ['description','=','Hadir'],
        ])->count();
        $izin = Absensi::where([
            ['date','=',$today],
            ['description','=','Izin'],
        ])->count();
        $sakit = Absensi::where([
            ['date','=',$today],
            ['description','=','Sakit'],
        ])->count();

        $in = Absensi::with(['user'])->where('date',$today)->latest()->get();

        return view('pages.admin.dashboard',[
            'user' => $user,
            'hadir' => $hadir,
            'izin' => $izin,
            'sakit' => $sakit,
            'in' => $in
        ]);
    }
}
