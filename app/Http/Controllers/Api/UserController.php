<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Branch;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
 
public function profile(Request $request)
{
    // Assuming you have a route named 'user.profile' which points to the user's profile
    $user = $request->user();
   
    $branch_name= Branch::select('branch_name')->where('id', $user->branch)->first();
    $user['branch_name'] = $branch_name['branch_name'];
    $profileUrl = url('/' . $user->profile_picture);

    return JsonResource::make([
        'user' => array_merge($user->toArray(), ['profile_url' => $profileUrl]),
    ]);
}

    // public function editProfile(Request $request)
    // {
    //     $id = $request->user()->id;
    //     $user = User::find($id);

    //     $request->validate([
    //        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $request->user()->id],
    //        'mobile_number' => ['required', 'min:10'],
    //        'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
    //     ]);

        
        // if ($request->hasFile('profile_picture')) {
        //     if ($user->profile_picture) {
        //         Storage::delete($user->profile_picture);
        //     }

        //     $profilePicture = $request->file('profile_picture');
        //     $originalFilename = $profilePicture->getClientOriginalName();
        //     $fileExtension = $profilePicture->getClientOriginalExtension();


        //     $publicPath = 'profile_pictures/' . str_replace(" ", "", time() . "_" . md5($originalFilename) . "." . $fileExtension);
           
        //     Storage::disk('public')->put($publicPath, file_get_contents($profilePicture));
        //     $fullUrl = Storage::disk('public')->url($publicPath);

        //     $finalUrl = str_replace('storage', 'public/storage', $fullUrl);
        //     $user->profile_picture = $finalUrl;
        //     $user->update();
        // }
        // if($request->hasFile('profile_picture')) {
        //     $image_name = str()->uuid() . '.' . $request->profile_picture->getClientOriginalExtension();
        //     $path = $request->profile_picture->storeAs('profile_pictures', $image_name,'public');

        //     $validatedData['profile_picture'] = $path;

        //     $user->update($validatedData);
        // }
      
        // $validatedData['email'] = $request->email;
        // $validatedData['mobile_number'] = $request->mobile_number;
       
        // $user->update($validatedData);
        // $profile_picture = storage_path();

        // return JsonResource::make([
        //     'user' => $user,
        // ]);
    // }


    public function editProfile(Request $request) {
        $id = $request->user()->id;
    
        // Validate request data
        $validator = Validator::make($request->all(), [
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'name' => ['required' , 'string'],
            'mobile_number' => ['required', 'integer', 'min:10'],
            'profile_picture' => 'image|mimes:jpeg,png,jpg',  // Changed to profile_picture
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
    
        // Find user by ID
        $user = User::findOrFail($id);
    
        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture');
            $profilePictureName = time() . '_' . $profilePicture->getClientOriginalName();
            $profilePicture->move(public_path('profile_pictures'), $profilePictureName);  // Changed to profile_pictures
            $profilePicturePath = 'profile_pictures/' . $profilePictureName;  // Changed to profile_pictures
            
            // Delete old profile picture if it exists
            if ($user->profile_picture) {
                Storage::delete('public/' . $user->profile_picture);
            }
    
            // Update user's profile picture path
            $user->profile_picture = $profilePicturePath;
        }
        
        
    
        // Update user details
        $user->update([
            'name' => $request->input('name'),
            'mobile_number' => $request->input('mobile_number'),
        ]);
    
        // Generate URL for the updated profile picture
        $profilePictureUrl = url('/') . '/' . $user->profile_picture;
    
        return response()->json(['message' => 'Profile updated successfully', 'profile_picture_url' => $profilePictureUrl], 200);  // Changed to profile_picture_url
    }
    












    
   public function setFcm(Request $request)
    {
        $request->validate([
            'token' => 'required'
        ]);
        $token = $request->token;
        $userId = Auth::user()->id;

        $user = User::find($userId);
        $user->fcm = $token;
        $user->save();
      
        
        return response()->json(['status' => 200]);
    }
    
}
