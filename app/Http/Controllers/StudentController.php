<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;
use App\Models\Batch;
use App\Models\Plane;
use App\Models\Payment;
use App\Models\Attendance;
use App\Models\PaymentHistory;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use PDF;

class StudentController extends Controller
{
    // public function student(){
    //     $user = Auth::user();

    //     $branch = Branch::all();
    //     $plans = Plane::where('active', 0)->get();
    //     $batch = Batch::all();

    //     $deletedstudentlist = User::where('branch',  $user->branch)
    //     ->where('is_delete', 1)
    //     ->where('role', 1)
    //     ->get();

    //     if($user->role==3){
    //         $student = User::where('branch',  $user->branch)
    //         ->where('role', 1)
    //         ->where('is_delete', 0)
    //         ->get();
    //     }else{
    //        $student = User::where('role', 1)->get();
    //     }
    //     $updatedStudents = $student->map(function ($student) {
    //         $student->role = ($student->role == 1) ? 'Student' : $student->role;
    //         $student->shift = ($student->shift == 1) ? '8:00 To 12:00' : '1:00 To 4:00';
    //         return $student;
    //     });
    //     return view('student', compact('student','branch','plans','batch','deletedstudentlist'));
    // }


    public function student()
    {
        $user = Auth::user();
        $branch = Branch::all();
        $plans = Plane::all();
        $batch = Batch::all();

        // Query to get deleted students
        $deletedstudentlist = User::select('users.*', 'branches.branch_name')
            ->leftJoin('branches', 'users.branch', '=', 'branches.id')
            ->where('users.shift', $user->branch)
            ->where('users.is_delete', 1)
            ->where('users.role', 1)
            ->orderBy('users.created_at', 'desc')
            ->get();

        // Determine if the user is an admin or not and build the student query accordingly
        if ($user->role == 3) {
            $student = User::select('users.*', 'branches.branch_name', 'batches.batch_time')
                ->leftJoin('branches', 'users.branch', '=', 'branches.id')
                ->leftJoin('batches', 'users.shift', '=', 'batches.id') // Adjust this join as per your schema
                ->where('users.branch', $user->branch)
                ->where('users.role', 1)
                ->where('users.is_delete', 0)
                ->orderBy('users.created_at', 'desc')
                ->get();
        } else {
            $student = User::select('users.*', 'branches.branch_name', 'batches.batch_time')
                ->leftJoin('branches', 'users.branch', '=', 'branches.id')
                ->leftJoin('batches', 'users.shift', '=', 'batches.id') // Adjust this join as per your schema
                ->where('users.role', 1)
                ->where('users.is_delete', 0)
                ->orderBy('users.created_at', 'desc')
                ->get();
        }

        // Update role field
        $updatedStudents = $student->map(function ($student) {
            $student->role = ($student->role == 1) ? 'Student' : $student->role;
            return $student;
        });


        return view('student', compact('student', 'branch', 'plans', 'batch', 'deletedstudentlist'));
    }






 // app/Http/Controllers/YourController.php
 public function branchandplan(Request $request)
 {
     $branchId = $request->input('branch_id');
     $plans = Plane::where('branch', $branchId)
     ->where('active',0)->get();
     $batch = Batch::where('branch_id', $branchId)->get();
     return response()->json(['plans' => $plans, 'batch' => $batch]);
 }







    public function generateRandomId()
    {
        $length = 8;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }



    public function submitForm(Request $request)
    {

        $user = new User();
        $plan = Plane::find($request->input('user_plan'));
        $authorizedUser = Auth::user();
        $payment = new Payment();
        $paymenthistory = new PaymentHistory();

        $validator = Validator::make($request->all(), [
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|unique:users,email',
            'user_address' => 'required|string',
            'user_paid_amount'=>'required|numeric',
            'user_phone' => 'nullable|string|max:10',
            'user_password' => 'required|string',
            'user_shift' => 'required',
            'user_branch' => 'nullable',
            'user_plan' => 'nullable|exists:planes,id',
            'user_paid_amount' => 'required',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'user_type' => 'nullable',
        ]);


        $amount=$request->input('user_paid_amount');

        if ($validator->fails()) {
           dd("error");
        }


        $profilePhotoPath = null;
        if ($request->hasFile('profile_photo')) {
            $profilePhoto = $request->file('profile_photo');
            $profilePhotoName = time() . '_' . $profilePhoto->getClientOriginalName();
            $profilePhoto->move(public_path('profile_photos'), $profilePhotoName);
            $profilePhotoPath = 'profile_photos/' . $profilePhotoName;
        }


        if ($authorizedUser && $authorizedUser->role == 3) {
            $user->branch = $authorizedUser->branch;
            $payment->branch = $authorizedUser->branch;
            $paymenthistory->branch = $authorizedUser->branch;
        } else {
            $user->branch = $request->input('user_branch');
            $payment->branch = $request->input('user_branch');
            $paymenthistory->branch = $request->input('user_branch');
        }

        $user->name = $request->input('user_name');
        $user->email = $request->input('user_email');
        $user->mobile_number = $request->input('user_phone');
        $user->address = $request->input('user_address');
        $user->password = Hash::make($request->input('user_password'));
        $user->profile_picture = $profilePhotoPath;
        $user->role = 1;
        $user->shift = $request->input('user_shift');
        $user->plan_id = $request->input('user_plan');
        $user->registration_no = $this->generateRandomId();
        $user->type = $request->input('user_type');
        $user->is_delete = 0;
        $user->save();


        if ($request->input('user_plan')) {
            if ($plan->plane_fees == $request->input('user_paid_amount')) {
                $payment->plan_id = $plan->id;
                $payment->user_id = $user->id;
                $payment->paid = 0;
                $payment->payment_provider_response = "cash";
                $payment->amount = $plan->plane_fees;
                $payment->total_amount = $plan->plane_fees;
                $payment->pending_amount = 0;
                $payment->save();

                $paymenthistory->user_id = $user->id;
                $paymenthistory->total_amount = $plan->plane_fees;
                $paymenthistory->paid_amount = $request->input('user_paid_amount');
                $paymenthistory->remaining_amount = 0;
                $paymenthistory->save();
            }else{
                $payment->plan_id = $plan->id;
                $payment->user_id = $user->id;
                $payment->paid = 1;
                $payment->payment_provider_response = "cash";
                $payment->amount = $request->input('user_paid_amount');
                $payment->total_amount = $plan->plane_fees;
                $payment->pending_amount = $plan->plane_fees - $request->input('user_paid_amount');
                $payment->save();

                $paymenthistory->user_id = $user->id;
                $paymenthistory->total_amount = $plan->plane_fees;
                $paymenthistory->paid_amount = $request->input('user_paid_amount');
                $paymenthistory->remaining_amount = $plan->plane_fees - $request->input('user_paid_amount');
                $paymenthistory->save();

            }
        }
        return response()->json(['success' => true, 'message' => 'Form submitted successfully.']);

        // return redirect()->route('student');
    }










public function editstudent(Request $request)
{
    $id = $request->id;
    // $student = User::find($id);
     $student = User::select('users.*','branches.branch_name','branches.id as branch_id')
            ->leftJoin('branches','users.branch','=','branches.id')
            ->where('users.id', $id)
            ->first();
    $batch = Batch::all();
      $branch = Branch::where('id' , '<>' , $student->branch)->get();

    return view('editstudent', compact('student','batch','branch'));
}














public function updatestudent(Request $request)
{

    $validator = Validator::make($request->all(), [
        'user_name' => 'required|string',
        'user_email' => 'required|email|unique:users,email,' . $request->id,
        'user_address' => 'required|string',
        'user_phone' => 'required|string',
        'user_shift' => 'required',
        'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'branch' => 'required'
    ]);

    if ($validator->fails()) {
        // SweetAlert for validation errors
        alert()->error('Validation Error', 'Please fill out all required fields correctly.')
            ->showConfirmButton('Okay');

        return redirect()->back()->withErrors($validator)->withInput();
    }

    $student = User::findOrFail($request->id);

    // Handle profile photo upload
    if ($request->hasFile('profile_photo')) {
        $profilePhoto = $request->file('profile_photo');
        $profilePhotoName = time() . '_' . $profilePhoto->getClientOriginalName();
        $profilePhoto->move(public_path('profile_photos'), $profilePhotoName);
        $profilePhotoPath = 'profile_photos/' . $profilePhotoName;

        $student->profile_picture = $profilePhotoPath;
    }
    $updated = $student->update([
        'name' => $request->user_name,
        'email' => $request->user_email,
        'address' => $request->user_address,
        'mobile_number' => $request->user_phone,
        'shift' => $request->user_shift,
        'branch' => $request->branch
    ]);

    // Redirect with success or error message based on update result
    if ($updated) {
        return response()->json([
            'success' => true,
            'message' => 'User updated successfully.'
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'User update failed.'
        ]);
    }
}








public function deletestudent($id)
{
    $user = User::find($id);
    if (!$user) {
        return redirect()->back()->with('error', 'User not found');
    }
    User::where('id', $id)->update(['is_delete' => 1]);


    return redirect()->route('student');
}



public function deletedstudentlist($id)
{
    $plan = Plane::find($id);
    if (!$plan) {
        return redirect()->back()->with('error', 'User not found');
    }
    Plane::where('id', $id)->update(['active' => 1]);
    return redirect()->route('planeManagement')->with('success', 'User updated successfully.');
}




public function studentAttendanse(Request $request)
{
    $user = $request->user();
    if ($user->role == 1) {
        $currentDate = Carbon::now()->toDateString();

        $attendance = Attendance::whereDate('created_at', $currentDate)
                                 ->where('user_id', $user->id)
                                 ->first();

        if ($attendance) {
            return response()->json(['message' => "Your attendance has already been recorded for today."]);
        } else {
            // Create a new attendance record
            $attendance = new Attendance();
            $attendance->user_id = $user->id;
            $attendance->shift = $user->shift;
            $attendance->status = 0;
            $attendance->branch=$user->branch; // Assuming default status is 0 (or 'absent')
            $attendance->role = $user->role;
            $attendance->save();

            return response()->json(['message' => "Your attendance request has been send to your trainer successfully."]);
        }
    } else {
        return response()->json(['message' => 'You are not a student.']);
    }

}


public function approveAttendance(Request $request){


  $currentDate = Carbon::now()->toDateString();

   $id=$request->id;
        $attendance = Attendance::where('user_id', $id)->whereDate('created_at', $currentDate)->first();
        if (!$attendance) {
            return response()->json(['message' => 'Attendance not found.']);
        }
        $attendance->approval = $request->status;
        $attendance->save();
        return response()->json(['message' => 'Student Attandance Updated Successfully.']);
}


}


