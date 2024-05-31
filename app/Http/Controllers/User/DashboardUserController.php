<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Absensi;

class DashboardUserController extends Controller
{
    public function index(){
        $user_id = Auth::user()->id;
        $today = date('Y-m-d');
        $in = Absensi::with(['user'])->where('date',$today)->latest()->get();

        $absensi = Absensi::where([
            ['user_id','=', $user_id],
            ['date','=', $today],
            ['description','=', 'Hadir'],
        ])->latest()->first();

        return view('pages.user.dashboard',[
            'in' => $in,
            'absensi' => $absensi,
        ]);
    }
}
