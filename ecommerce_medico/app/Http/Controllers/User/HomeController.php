<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
class HomeController extends Controller
{
    public $productModel  = Product::class;

    public function index(){
        $data['product'] =  $this->productModel::withoutTrashed()->where('is_publised' , 1)->orderBy("id" , 'desc')->limit(8)->get();
        return view('User.index')->with('data'  , $data);
    }
}
