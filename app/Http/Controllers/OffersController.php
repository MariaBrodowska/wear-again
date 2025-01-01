<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OffersController extends Controller
{
    public function index(){
        return view('offers.index');
    }
    public function create(){
        return view('offers.create');
    }
}
