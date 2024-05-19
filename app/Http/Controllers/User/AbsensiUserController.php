<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AbsensiUserController extends Controller
{
    public function index(){
        return view('pages.user.absensi.index');
    }
}
