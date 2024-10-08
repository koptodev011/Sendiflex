<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plane;
use App\Models\Car;
use App\Models\Payment;
use App\Models\PaymentHistory;
use App\Models\Branch;
use Validator;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use PDF;

class PlaneManagementController extends Controller
{
    // public function planeManagement(Request $request){
    //     // $plane = Plane::all();
    //     $plane = Plane::where('active', 0)->get();
    //     $deactivated=Plane::where('active', 1)->get();
    //     $showBatchColumn = true;
    //     return view('planemanagement', compact('plane','deactivated','showBatchColumn'));
    // }


    public function planeManagement(Request $request)
{
    $plane = Plane::SELECT('planes.*','branches.branch_name')
    ->leftJoin('branches','planes.branch','=','branches.id')
    ->where('planes.isdelete', 0)
    ->where('active', 0)
    ->get();
    
    $deactivated = Plane::SELECT('planes.*','branches.branch_name')
    ->leftJoin('branches','planes.branch','=','branches.id')
    ->where('active', 1)->get();
    $showBatchColumn = true;
    $branch = Branch::all();
    return view('planemanagement', compact('plane', 'deactivated', 'showBatchColumn','branch'));
}


   

// PlaneManagementController.php
// PlaneManagementController.php
public function addPlaneDetails(Request $request)
{
    $validator = Validator::make($request->all(), [
        'plane_name' => 'required|string|max:255',
        'plane_fees' => 'required|numeric',
        'plane_duration' => 'nullable|string',
        'plane_description' => 'required|string',
        'branch' => 'required|integer',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 400);
    }

    $plane = new Plane(); 
    $plane->plane_name = $request->input('plane_name');
    $plane->plane_fees = $request->input('plane_fees');
    $plane->plane_duration = $request->input('plane_duration');
    $plane->plane_description = $request->input('plane_description');
    $plane->branch = $request->input('branch');
    
    $plane->save();

    return response()->json(['success' => true, 'message' => 'Plane details added successfully.']);
}






    public function editplanDetails(Request $request)
    {
        $id = $request->id;
        // $editplandetails = Plane::find($id);
        $editplandetails = Plane::SELECT('planes.*','branches.branch_name','branches.id as branch_id' )
        ->leftJoin('branches','planes.branch','=','branches.id')
        ->where('planes.isdelete', 0)
        ->where('planes.active', 0)
        ->where('planes.id', $id)
        ->first();
        $branch = Branch::where('id' , '<>' , $editplandetails->branch)->get();
       
       
        return view('editplan', compact('editplandetails','branch'));
    }


    












    public function updateplandetails(Request $request, $id)
    {
        // Find the plan by ID
        $plan = Plane::findOrFail($id);
    
        // Validate request data
        $validator = Validator::make($request->all(), [
            'plan_name' => 'required|string|max:255',
            'plan_fees' => 'required|numeric',
            'plan_duration' => 'nullable|string',
            'plan_description' => 'required|string',
            'branch' => 'required|integer',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
    
        // Update the plan with validated data
        $plan->plane_name = $request->input('plan_name');
        $plan->plane_fees = $request->input('plan_fees');
        $plan->plane_duration = $request->input('plan_duration');
        $plan->plane_description = $request->input('plan_description');
        $plan->branch = $request->input('branch');
        $plan->save();
    
        // Return a success response
        return response()->json(['success' => true, 'message' => 'Plan updated successfully.']);
    }
    








    public function Activeplan(Request $request)
    {
       
        $planeId = $request->input('plane_id');
       
        $deactivated=Plane::where('active', 1)->get();
       
        $affectedRows = Plane::where('id', $planeId)
                             ->update(['active' => 0]);
        return redirect()->route('planeManagement')->with('success', 'User updated successfully.');
    }
  


    public function deactivateplan($id)
    {
        $plan = Plane::find($id);
        if (!$plan) {
            return redirect()->back()->with('error', 'User not found');
        }
        Plane::where('id', $id)->update(['active' => 1]);
        return redirect()->route('planeManagement')->with('success', 'User updated successfully.');
    }

   
    public function allCourseDetails(Request $request)
    {
        $user=$request->user();
        
        $planes = Plane::where('active', 0)
        ->where('branch',$user->branch)->get();
        $razorpay_key = env('RAZORPAY_KEY');
         $razorpay_secret_key = env('RAZORPAY_SECRET');
         
        return response()->json([
            'planes' => $planes,
            'razorpay_key' => $razorpay_key,
            'razorpay_secret_key' => $razorpay_secret_key,
            
        ]);
    }


    public function PreUpgradeCourse(Request $request){
        $user = Auth::user();
        $id=$user->id;

        $validatedData = $request->validate([
            'name' => 'required|string',
            'registration_no' => 'required|string',
            'email' => 'required|email',
            'plan_id' => 'required|integer',
        ]);
        try {
            $user = $request->user();
            if ($user->registration_no !== $validatedData['registration_no'] || $user->email !== $validatedData['email']) {
                return response()->json(['error' => 'Registration number or email does not match.'], 400);
            }
    
            
            $payment = Payment::where('user_id', $id)->first();
            // $updatedAmount=$payment->amount+$plan->plane_fees;
            

        
            if ($payment->plan_id == $validatedData['plan_id']) {
                return response()->json(['message' => 'You have already used this plan'],400);
            }if($payment->pending_amount>0){
                return response()->json(['message' => 'You have outstanding dues. Please contact the manager.'],400);
            }
           
    
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to upgrade plan. Please try again.'], 500);
        }
       
    }












    public function UpgradeCourse(Request $request){
        $user = Auth::user();
        $id=$user->id;
       

        $validatedData = $request->validate([
            'name' => 'required|string',
            'registration_no' => 'required|string',
            'email' => 'required|email',
            'plan_id' => 'required|integer',
        ]);
   
        try {
            $user = $request->user();
            if ($user->registration_no !== $validatedData['registration_no'] || $user->email !== $validatedData['email']) {
                return response()->json(['error' => 'Registration number or email does not match.'], 400);
            }
    
            $user->update(['plan_id' => $validatedData['plan_id']]);
            
            $plan=Plane::find($validatedData['plan_id']);
            $payment = Payment::where('user_id', $id)->first();
            $updatedAmount=$payment->amount+$plan->plane_fees;
            

        
if ($payment->plan_id == $validatedData['plan_id']) {
    return response()->json(['message' => 'You have already used this plan'],400);
}if($payment->pending_amount>0){
    return response()->json(['message' => 'You have outstanding dues. Please contact the manager.'],400);
}
else{
    $total_amout =
    $paymenthistory=new PaymentHistory();
    $paymenthistory->user_id=$id;
    $paymenthistory->total_amount=$payment->total_amount+$plan->plane_fees;
    $paymenthistory->remaining_amount=0;
    $paymenthistory->paid_amount=$plan->plane_fees;
    $paymenthistory->branch=$user->branch;
    $paymenthistory->save();
  


    $payment->update(['amount'=>$payment->amount+$plan->plane_fees]);
    $payment->update(['total_amount'=>$payment->total_amount+$plan->plane_fees]);
    $payment->update(['remaining_amount'=>$payment->remaining_amount]);
    $payment->update(['plan_id' =>$validatedData['plan_id']]);


    
    return response()->json(['message' => 'Plan upgraded successfully']);
}
           
    
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to upgrade plan. Please try again.'], 500);
        }
    }


    public function Currentcourse(Request $request){

        $user = $request->user();
        

        $plan = Plane::find($user->plan_id);
         
        return response()->json([
            'plan' => $plan,
        ]);
    }



    public function Allpaymentdetails(){
       
        $payments = Payment::all();
        return response()->json([
            'payments' => $payments,
        ]);
    }
    

}
