<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;

class HomeController extends Controller
{
    public function index(){
        $mostExpensive = Material::orderBy('price', 'desc')->limit(5)->get();
        $biggestChange = Material::orderBy('price_change', 'desc')->limit(5)->get();

        return view("home", [
            'mostExpensive' => $mostExpensive,
            'biggestChange' => $biggestChange
        ]);
    }
}
