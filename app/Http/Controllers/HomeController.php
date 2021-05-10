<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;

class HomeController extends Controller
{
    public function index(){
        $mats = Material::orderBy('price', 'desc')->limit(5)->get();

        return view("home", [
            'mats' => $mats
        ]);
    }
}
