<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;


class TradeController extends Controller
{
  public function index(){
    return view('trade');
  }
  public function tradeTable(){
    $materials = Material::orderBy('name', 'asc')->get();
    return view('assets.trade_table', [
        'materials' => $materials
    ]);
  }
  public function selectMaterial($id){
    session(['selectedID' => $id]);
  }
  public function getGraph($id){
    $data = Material::find($id);
    $shortDates = [];
    $fullDates = [];
    $prices = [0];
    $colors = [];
    foreach($data->price_log as $row){
      array_push($shortDates, date_format($row['created_at'], "m/d H:i"));
      array_push($fullDates, date_format($row['created_at'], "Y/m/d H:i:s"));
      array_push($colors, $row['price'] > $prices[count($prices) - 1] ? 'rgba(0, 150, 0, 1)' : 'rgba(255, 0, 0, 1)');
      array_push($prices, $row['price']);
    }
    array_shift($prices);
    return [
      'shortDates' => $shortDates,
      'fullDates' => $fullDates,
      'prices' => $prices,
      'materialName' => $data->name,
      'colors' => $colors
    ];
  }
}
