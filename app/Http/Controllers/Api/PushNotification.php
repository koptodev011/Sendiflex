<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\Models\User;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\PushNotification as Notification;


class PushNotification extends Controller
{
    //
    public function push_notification(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $status = $request->push_notification;

        if($user){
            if ($status == 'on') {
                $user->push_notification = 1;
                $validatedData['push_notifications'] = 1;
            } else {
                $user->push_notification = 0;
                $validatedData['push_notifications'] = 0;
            }
    
            $status = $user->update();
    
            return response()->json(['status' => 200, 'message' => 'Push notification setting changed successfully']);
        }else{
            return response()->json(['status' => 400, 'error' => 'User not found'], Response::HTTP_BAD_REQUEST);
        }
        
    }
    
    public function getNotification(){
        $userId = Auth::id();

        $notification=Notification::select('*')
        ->where('user_id',$userId)
        ->orderBy('created_at','desc')
        ->get();

        $unread_count=Notification::select('id')
        ->where('user_id',$userId)
        ->where('is_read',0)
        ->count();
        
        if($notification){
            return response()->json(['status' => 200, 'data' => $notification , 'unread count'=> $unread_count]);
            }else{
                return response()->json(['status' => 400, 'error' => 'Error getting notification'], Response::HTTP_BAD_REQUEST);
            }
    }

    public function readtNotification(Request $request){
        $id = $request->get('id');
        $notification=Notification::find($id);
        if($notification){
            $notification->is_read = '1';
            $notification->update();
           }
        if($notification){
            return response()->json(['status' => 200, 'data' => $notification]);
            }else{
                return response()->json(['status' => 400, 'error' => 'Error reading notification'], Response::HTTP_BAD_REQUEST);
            }
    }

    public function clearNotifications(Request $request)
    {
        $ids = $request->input('ids');
        $PushNotification=Notification::whereIn('id', $ids)->delete();
        if($PushNotification){
            return response()->json(['status' => 200, 'msg' => 'Notifications cleared successfully']);
            }else{
                return response()->json(['status' => 400, 'error' => 'Error deleting notification'], Response::HTTP_BAD_REQUEST);
            }

    }
}
