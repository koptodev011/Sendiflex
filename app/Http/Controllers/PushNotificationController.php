<?php

namespace App\Http\Controllers;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Notification;
use App\Notifications\SendPushNotification;
use Illuminate\Http\Request;

use Kreait\Laravel\Firebase\Facades\Firebase; 
use App\Models\PushNotification;   
use App\Models\User;   
use App\Models\Branch;   




class PushNotificationController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $push_notifications = PushNotification::orderBy('created_at', 'desc')->get();
        return view('notification', compact('push_notifications'));
    }

    public function bulksend(Request $req)
    {
       
        $req->validate([
            'title' =>'required',
            'body' =>'required',
            'branch' =>'required',
            'user' =>'required',
        ]);
       
            $users=User::where('push_notification',1)
            ->where('is_delete',0)
            ->where('role' , $req->user)
            ->where('branch',$req->branch)
            ->get();
           
          
            foreach($users as $user){
                // if($fcm->fcm){
                    //   $fcm='fxAxwiI7SbijeB5z8ehwe9:APA91bFiAinBnmxLR4YEJEwQe_zflrKfsbrwgWctP3KqDca4-7fCmLnYB5g-bwi_4mAREX114igrijDz_t0B-Q9tCaUJKXbpMc-8Lf0yovUTG-Fdn0L9GNCIi6XLMz921pGSPH37HWXU';
                // $url = 'https://fcm.googleapis.com/v1/projects/813442066136/messages:send';
                // $dataArr = array('click_action' => 'FLUTTER_NOTIFICATION_CLICK', 'id' => $req->id,'status'=>"done");
                // $notification = array('title' =>$req->title, 'body' => $req->body, 'sound' => 'default', 'badge' => '1',);
                // $arrayToSend = array('to' => $fcm->fcm, 'notification' => $notification, 'data' => $dataArr, 'priority'=>'high');
                // $fields = json_encode ($arrayToSend);
                // $headers = array (
                //     // 'Authorization: key=' . "AAAACO3TT6M:APA91bEoxRxmtpM4npJ4m9S3Nss2-lmiKeVF5Usu55hB3H6HWYCKqn_73eGvYxlsIRmt5lY118kUIUA1p2dPsIZUSfC1U6sQFkAOIoPmyUtr1zAqhds9xcpEhI9rOzptTSBWcu_58oG0",
                //     'Authorization: Bearer=' . "AIzaSyB3YaHVsfa6bX1SZKBZ0wnaxoTrJjKJOj0",
                //     'Content-Type: application/json'
                // );
                
                // $ch = curl_init ();
                // curl_setopt ( $ch, CURLOPT_URL, $url );
                // curl_setopt ( $ch, CURLOPT_POST, true );
                // curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
                // curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
                // curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
                // $result = curl_exec ( $ch );
                //   dd($result);
                // //var_dump($result);
                // curl_close ( $ch );
                
               
                $comment = new PushNotification();
                $comment->title = $req->input('title');
                $comment->body = $req->input('body');
                $comment->user_id = $user->id;
                $comment->save();
                // }
                
            }
          
        
       
        return redirect()->back()->with('success', 'Notification Send successfully');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
        $users= User::where('users.push_notification',1)
        ->where('users.is_delete',0)
        ->get();

        $branch = Branch::all();

        
        return view('notification',compact('users','branch'));
    }

  


}