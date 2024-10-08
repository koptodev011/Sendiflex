<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use PDF;
use App\Models\Branch;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class EmployeeController extends Controller
{



    public function employee(Request $request)
{
    $user = Auth::user();
    $branch = Branch::all();
    $deletedemployeelist = User::where('branch',  $user->branch)
    ->whereIn('role', [2, 3])
    ->where('is_delete', 1)->get();
    if($user->role==3){
        $employee = User::select('users.*','branches.branch_name')->where('users.branch',  $user->branch)
        ->leftJoin('branches','users.branch','=','branches.id')
        ->whereIn('users.role', [2, 3])
        ->where('users.is_delete', 0)
        ->orderBy('users.created_at', 'desc')
        ->get();
       
    }else{
       $employee = User::select('users.*','branches.branch_name')->whereIn('users.role', [2, 3])
       ->leftJoin('branches','users.branch','=','branches.id')
       ->orderBy('users.created_at', 'desc')
       ->where('users.is_delete', 0)
       ->get();
        
    }
   
    $updatedEmployees = $employee->map(function ($employees) {
        $employees->role = ($employees->role == 2) ? 'Trainer' : 'Manager';
        $employees->shift = ($employees->shift == 1) ? "8:00 AM to 12:00 PM" : "1:00 PM to 4:00 PM";
        return $employees;
    });
    return view('employee', compact('employee','branch','deletedemployeelist'));
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
    


    public function createEmployee(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|unique:users,email',
            'user_address' => 'required|nullable|string',
            'user_phone' => 'required|nullable|string|max:10',
            'user_password' => 'required|string',
            'user_role' => 'nullable',
            'user_shift' => 'nullable',
            'user_sclary' => 'nullable',
            'user_branch' => 'nullable',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ]);
        }
    
        $randomId = $this->generateRandomId();
    
        $profilePhotoPath = null;
        if ($request->hasFile('profile_photo')) {
            $profilePhoto = $request->file('profile_photo');
            $profilePhotoName = time() . '_' . $profilePhoto->getClientOriginalName();
            $profilePhoto->move(public_path('profile_photos'), $profilePhotoName);
            $profilePhotoPath = 'profile_photos/' . $profilePhotoName;
        }
    
        $user = new User();
        $user->name = $request->input('user_name');
        $user->email = $request->input('user_email');
        $user->mobile_number = $request->input('user_phone');
        $user->sclary = $request->input('user_sclary');
        $user->address = $request->input('user_address');
        $user->password = Hash::make($request->input('user_password'));
        $user->profile_picture = $profilePhotoPath;
        $user->role = $request->input('user_role');
        $user->branch = $request->input('user_branch');
        $user->registration_no = $randomId;
        $user->shift = $request->input('user_shift');
        $user->is_delete = 0;
        $user->save();
    
        return response()->json(['success' => true, 'message' => 'Employee created successfully.']);
    }
    
    






public function editemployee(Request $request)
{
    $id = $request->id;
    // $employee = User::find($id);
     $employee = User::select('users.*','branches.branch_name','branches.id as branch_id')
            ->leftJoin('branches','users.branch','=','branches.id')
            ->where('users.id', $id)
            ->first();
             $branch = Branch::where('id' , '<>' , $employee->branch)->get();
       
    return view('editemployee', compact('employee','branch'));
}





public function updateemployee(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'user_name' => 'required|string',
        'user_email' => 'required|email|unique:users,email,' . $id,
        'user_address' => 'required|string',
        'user_phone' => 'required|string',
        'user_salary' => 'required',
        'profile_photo' => 'image|mimes:jpeg,png,jpg|max:2048',
        'branch' => 'required'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Validation Error: ' . $validator->errors()->first()
        ]);
    }

    $employee = User::findOrFail($id);

    if ($request->hasFile('profile_photo')) {
        $profilePhoto = $request->file('profile_photo');
        $profilePhotoName = time() . '_' . $profilePhoto->getClientOriginalName();
        $profilePhoto->move(public_path('profile_photos'), $profilePhotoName);
        $profilePhotoPath = 'profile_photos/' . $profilePhotoName;
        $employee->profile_picture = $profilePhotoPath;
    }

    $updated = $employee->update([
        'name' => $request->user_name,
        'email' => $request->user_email,
        'address' => $request->user_address,
        'mobile_number' => $request->user_phone,
        'sclary' => $request->user_salary,
        'branch' => $request->branch
    ]);

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

   





public function delete($id)
{
    $user = User::find($id);

    if (!$user) {
        return redirect()->back()->with('error', 'User not found');
    }
    User::where('id', $id)->update(['is_delete' => 1]);
    Alert::success('success','User registered Successifully');
    return redirect()->route('employee')->with('success', 'User updated successfully.');
   
}


public function deletedemployeelist($id)
{
    $plan = Plane::find($id);
    if (!$plan) {
        return redirect()->back()->with('error', 'User not found');
    }
    Plane::where('id', $id)->update(['active' => 1]);
    return redirect()->route('planeManagement')->with('success', 'User updated successfully.');
}




public function employeeAttendanse(Request $request){
    
    $user = $request->user();
    if ($user->role == 2) {
       
        $currentDate = Carbon::now()->toDateString();

        $attendance = Attendance::whereDate('created_at', $currentDate)
                                 ->where('user_id', $user->id)
                                 ->first();

              

        if ($attendance) {
            return response()->json(['message' => "Your attendance has already been recorded for today."]);
        } else {
            $attendance = new Attendance(); 
            $attendance->user_id = $user->id;
            $attendance->shift = 0;
            $attendance->status = 0;
            $attendance->role = $user->role;
            $attendance->branch = $user->branch;
            $attendance->approval=0;
            $attendance->save();


            return response()->json(['message' => "Your attendance marked successfully."]);
          
        }
    } else {
        return response()->json(['message' => 'You are not a student.']);
    }
    
}


public function managerattendance(Request $request){
    dd("Working");
}










}