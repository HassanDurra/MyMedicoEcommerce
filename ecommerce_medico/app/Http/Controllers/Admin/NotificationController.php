<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
class NotificationController extends Controller
{
    public $parentModel = Notification::class;

    // public function destroy($id= null){
    //     $notificationData = $this->parentModel::where('id' , $id)->first();
    //     $url = $notificationData->route;
    //     if($notificationData){
    //         $delete  = $this->parentModel::where("id" , $id)->delete();
    //         return redirect($url);
    //     }
    // }
}
