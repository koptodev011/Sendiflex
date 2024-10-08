<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use App\Models\Feedback;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Batch;
use App\Models\Attendance;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
class Allocatedstdent extends Controller
{
    public function Allocatedstdents(Request $request)
    {
        $user = $request->user();
        $currentDate = now()->toDateString();
        $allocatedStudentIds = Feedback::where('trainer_id', $user->id)
                                       ->whereDate('created_at', $currentDate)
                                       ->pluck('user_id')
                                       ->toArray();

        if (empty($allocatedStudentIds)) {
            return response()->json(['Message' => "Manager has not allocated any students to you today."]);
        }
    
        $allocatedStudents = [];
        foreach ($allocatedStudentIds as $userId) {
            $allocatedStudent = User::find($userId);
            
            if ($allocatedStudent) {
                $batchTime = Batch::find($allocatedStudent->shift);
                if ($batchTime) {
                    $allocatedStudent->shift = $batchTime->batch_time;
                }
    
                // Fetch attendance
                $studentAttendance = Attendance::whereDate('created_at', $currentDate)
                                                ->where('user_id', $userId)
                                                ->first();
                
                if ($studentAttendance) {
                    // $attendanse = $studentAttendance->approval == 0 ? "False" : "True";
                    if($studentAttendance->approval == 0){
                       $attendanse = 'Request';
                    }elseif($studentAttendance->approval == 1){
                         $attendanse = 'Accepted';
                    }elseif($studentAttendance->approval == 2){
                         $attendanse = 'Rejected';
                    }
                } else {
                    $attendanse = "Not Approved";
                }
    
                // Add attendance status and student details to the response
                $allocatedStudent->attendance = $attendanse;
                $allocatedStudent->image_picture = asset('/' . $allocatedStudent->profile_picture);
                $allocatedStudents[] = $allocatedStudent;
            }
        }
    
        return response()->json(['allocatedStudents' => $allocatedStudents]);
    }


    
    
    public function Studentdetails(Request $request){
    
        $Studentdetails = User::select('users.*','batches.batch_time','batches.id as batches_id')
        ->leftJoin('batches','users.shift','=','batches.id')
        ->where('users.id', $request->id)
        ->first();
      

        return response()->json(['studentdetails' =>  $Studentdetails]);
    }
 

    public function getStudentDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $student = User::find($request->id);
        if (!$student) {
            return response()->json(['error' => 'Student not found'], 404);
        }
        return response()->json(['student' => $student]);
    }
    


    // public function feedback(Request $request)
    // {
    //     $userId = $request->id;
    //     $feedbackText = $request->feedback;
    //     $batch = $request->batch;
    
    //     $currentDate = now()->toDateString(); // Get the current date
   
    //     $updated = Feedback::where('user_id', $userId)
    //                        ->where('batch', $batch)
    //                        ->whereDate('created_at', $currentDate) // Additional condition for current date
    //                        ->update(['feedback' => $feedbackText]);
    
    //     if ($updated) {
    //         return response()->json(['message' => 'Feedback updated successfully']);
    //     } else {
    //         return response()->json(['message' => 'Student feedback not found for today'], 404);
    //     }
    // }

    public function feedback(Request $request)
    {
        $validator = Validator::make($request->all(), [
           'id' => 'required|integer',
          'feedback' => 'required|string',
        ]);

        $userId = $request->id;

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }
        $currentDate = Carbon::now()->toDateString();

        $attendance = Attendance::whereDate('created_at', $currentDate)
        ->where('user_id', $userId)
        ->first();
        if(!$attendance){
            return response()->json(['message' => 'Student not  found for today'], 404);
        }
      
        if($attendance['approval'] == 0 || $attendance['approval'] == 2){
            return response()->json(['message' => 'Please mark your attendance'], 404);
        }
      
        $feedbackText = $request->feedback;

        $currentDate = now()->toDateString();
        $updated = Feedback::where('user_id', $userId)
                           ->whereDate('created_at', $currentDate)
                           ->update(['student_feedback' => $feedbackText]);
    
        if ($updated) {
            return response()->json(['message' => 'Feedback updated successfully']);
        } else {
            return response()->json(['message' => 'Student not found for today'], 404);
        }
    }
    

    
    
    
}
