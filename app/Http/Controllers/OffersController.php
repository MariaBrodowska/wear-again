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
    public function edit(){
        return view('offers.edit');
    }
        public function single(){
        return view('offers.single');
    }
    public function user(){
        return view('offers.user');
    }
    public function favorite(){
        return view('offers.favorite');
    }

}
