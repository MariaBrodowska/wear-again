<?php

namespace App\Http\Controllers;
abstract class DashboardController extends Controller
{
    public function index(){
        $user = auth()->user();
        return view('dashboard');
    }
}
