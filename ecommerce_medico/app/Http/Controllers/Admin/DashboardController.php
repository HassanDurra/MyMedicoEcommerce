<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
class DashboardController extends Controller
{
    public  $notification = Notification::class;
    public function index(){
        return view('Admin.dashboard');
    }
    public function check_notification(){
        $notification  = $this->notification::orderBy('id' , 'desc')->limit(10)->get();

        if($notification->count() > 0){
          return  response()->json($notification);
        }
        else{
            echo "No Data";
        }
    }
}
