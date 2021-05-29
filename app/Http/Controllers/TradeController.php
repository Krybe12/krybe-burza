<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
  public function tradeButtons($id){
    if(!Auth::user()) return "Log in to begin trading";
    $storage = Auth::user()->storage->where('material_id', $id)->first();
    return view('assets.trade_buysell', [
      'storage' => $storage,
      'id' => $id
    ]);
  }
  public function sell($id){
    $status = "succesfully sold!";
    $amount = $_POST['amount'];
    $user = User::find(Auth::user()->id);
    $material = Auth::user()->storage->where('material_id', $id)->first();
    if(!$material){
      $status = "you dont own this material!";
    } else if ($amount > $material->amount){
      $status = "you own that many of selected material";
    } else {
      $material->amount = $material->amount - $amount;
      if ($material->amount <= 0){
        $material->delete();
      } else {
        $material->save();
      }
      $user->money += $material->material->price * $amount;
      $user->save();
    }
    return redirect('/trade')->with('status', $status);;
  }
  public function buy($id){
    $status = "succesfully bought!";
    $amount = $_POST['amount'];
    $user = User::find(Auth::user()->id);
    $storage = Auth::user()->storage->where('material_id', $id)->first();
    $materialPrice = Material::find($id)->price;
    if ($user->money < $amount * $materialPrice){ 
      $status = "you dont have enough money";
    } else {
      $user->money -= $amount * $materialPrice;
      $user->save();
      if (!$storage){
        $storage = New Storage;
        $storage->user_id = $user->id;
        $storage->material_id = $id;
        $storage->amount = 0;
        $storage->save();
      }
      $storage->amount = $storage->amount + $amount;
      $storage->save();
    }
    return redirect('/trade')->with('status', $status);
  }
}
