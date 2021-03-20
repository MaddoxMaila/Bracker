<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifications;
use App\Http\Controllers\AppHelper;

class NotificationsModelController extends Controller
{
    
    public function add(Request $request){

    	if(!$request->has('message')) return response()->json(AppHelper::error("Incomplete request"));

    	if(empty($request->message)) return response()->json(AppHelper::error("Incomplete request"));

    	$message = [
    		'user_name' => 'Admin',
    		'message'   => $request->message,
    		'message_time' => date('d/m/Y'),
    		'message_date' => date('g:ia'),
    		'message_id' => NULL
    	];

    	return response()->json($this->saveMessage($message));

    }

    public function getAll(Request $request){

    	$mNotification = Notifications::all();

    	if($mNotification->count() == 0) response()->json(AppHelper::error("No Alert Sent"));

    	return response()->json($this->showAlerts($mNotification->toArray()));

    }

    private function showAlerts(array $messages){

    	 $resp['message'] = 'Alerts found';
    	 $resp['error'] = false;

    	 foreach ($messages as $message) {
    	 		
    	 		$resp['notifications'][] = $this->modelMessages(new Notifications($message));

    	 }

    	 return $resp;

    }

    private function modelMessages($notification){

    	return [
    		'message' => $notification->message,
    		'message_time' => $notification->message_time,
    		'message_date' => $notification->message_date,
    		'user_name'		 => $notification->user_name
    	];

    }

    private function saveMessage($message){

    	 $mNotification = new Notifications($message);

    	 if($mNotification->save()){

    	 	return [

    	 		'error' => false,
    	 		'message' => 'Alert Sent'

    	 	];

    	 }else{

    	 	return AppHelper::error("Alert Sending Failed");

    	 }

    }

}
