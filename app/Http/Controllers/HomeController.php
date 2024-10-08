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
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;
use App\Models\Batch;
use App\Models\Plane;
use App\Models\Payment;
use App\Models\Attendance;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use App\Models\Feedback;



use App\Helpers\TokenCodeHelper;
use App\Mail\ForgotPasswordRequested;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Mail;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Mail\TestMail;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
   public function index(){
    $user = Auth::user();
    $user=User::find(Auth::user()->id);
    return view('layouts.layout', compact('user'));
   }


   public function profile(){
    $profile = Auth::user();
    return view('profile', compact('profile'));
   }






   public function updateprofile(Request $request)
   {
       $validator = Validator::make($request->all(), [
           'user_name' => 'required|string',
           'user_email' => 'required|email|unique:users,email,' . $request->id,
           'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
       ]);

       if ($validator->fails()) {
           return redirect()->back()->withErrors($validator)->withInput();
       }

       $student = User::findOrFail($request->id);

       if ($request->hasFile('profile_photo')) {
           $profilePhoto = $request->file('profile_photo');
           $profilePhotoName = time() . '_' . $profilePhoto->getClientOriginalName();
           $profilePhoto->move(public_path('profile_photos'), $profilePhotoName);
           $student->profile_picture = 'profile_photos/' . $profilePhotoName;
       }

       $student->name = $request->user_name;
       $student->email = $request->user_email;
       $updated = $student->save();

       if ($updated) {
           return response()->json([
               'success' => true,
               'message' => 'User updated successfully.'
           ]);
       } else {
           return response()->json([
               'success' => false,
               'message' => 'Failed to update user.'
           ]);
       }
   }


public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }



    public function forgotPassword(Request $request)
    {
        $profile = Auth::user();
        $attributes = $request->validate([
            'email' => ['required', 'email', 'max:255', Rule::exists('users', 'email')],
        ]);

        $user = User::where('email', $attributes['email'])
        ->where(function ($query) {
            $query->whereNull('is_delete')
                ->orWhere('is_delete', 0);
        })
        ->whereIn('role', [3, 4])
        ->first();


            if($user){
                $tokenCode = TokenCodeHelper::newCode();

                $passwordReset = PasswordReset::where('email', $attributes['email'])->first();

                if($passwordReset != null) {
                    $passwordReset->update([
                        'token' => $tokenCode
                    ]);
                } else {
                    $passwordReset = PasswordReset::create([
                        'email' => $attributes['email'],
                        'token' => $tokenCode
                    ]);
                }
                mail("$user->email","Shiv Suman","$tokenCode",);

                return redirect()->route('verifyOtppage')->with('success', 'User updated successfully.');

        }else {
            return redirect()->back()->withErrors(['email' => 'Invalid email address.']);
        }
    }


    public function verifyOtppage(Request $request){

        return view('varifyotp');
    }


    public function verifyOtp(Request $request)
    {
        // Validate request data
        $attributes = $request->validate([
            'email' => 'required|email',
            'otp' => 'required|string',
        ]);

        // Find the user
        $user = User::where('email', $attributes['email'])
            ->where(function ($query) {
                $query->whereNull('is_delete')
                    ->orWhere('is_delete', 0);
            })->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }

        // Find the password reset record
        $passwordReset = PasswordReset::where('email', $user->email)->first();

        if (!$passwordReset) {
            return response()->json([
                'success' => false,
                'message' => 'OTP record not found',
            ], 400);
        }

        // Check if the OTP matches
        if ($passwordReset->token != $attributes['otp']) {
            return response()->json([
                'success' => false,
                'message' => 'OTP mismatch',
            ], 400);
        }

        // Optional: Mark OTP as used or delete the password reset record
        // $passwordReset->delete();

        // Successful OTP verification
        return response()->json([
            'success' => true,
            'message' => 'OTP verified successfully',
            'redirectUrl' => route('resetPasswordView'), // Redirect URL after successful OTP verification
        ], 200);
    }
    public function resetPasswordView(Request $request){
        return view('resetpassword');
    }






    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'max:255', 'exists:users,email'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422); // 422 Unprocessable Entity
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404); // 404 Not Found
        }

        try {
            $user->password = Hash::make($request->password);
            $user->save();

            // Optional: Delete user tokens if using API authentication
            $user->tokens()->delete();

            return response()->json([
                'success' => true,
                'message' => 'Password has been changed. Please relogin',
                'redirectUrl' => route('login') // Redirect URL to the login page
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500); // 500 Internal Server Error
        }
    }

    public function terms(){
        return view('terms_services');
    }


     public function privacy_policy(){
        return view('privacy_policy');
    }


}
