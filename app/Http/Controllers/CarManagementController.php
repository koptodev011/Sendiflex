<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

use Validator;
use App\Models\User;
use App\Models\Branch;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use PDF;

class CarManagementController extends Controller
{
    
    public function carManagement(Request $request)
    {
        $branch = Branch::all();
        $cars = Car::select('cars.*','branches.branch_name')
        ->leftJoin('branches','cars.branch','=','branches.id')
        ->where('cars.isdelete', 1)
        ->get();
        $deletedcars = Car::where('isdelete', 0)->get();
        return view('carmanagement', compact('cars','deletedcars','branch'));
    }

    
  // In your CarController.php

public function addCarDetails(Request $request)
{
    // Validate the request
    $validator = Validator::make($request->all(), [
        'car-name' => 'required|string|max:255',
        'car-number' => 'required|numeric',
        'car-fuel' => 'nullable|string',
        'branch' => 'required|integer',
    ]);

    if ($validator->fails()) {
        return response()->json(['success' => false, 'message' => 'Validation failed', 'errors' => $validator->errors()], 400);
    }

    try {
        // Process the form data
        $car = new Car();
        $car->car_name = $request->input('car-name');
        $car->car_number = $request->input('car-number');
        $car->fuel_type = $request->input('car-fuel');
        $car->branch = $request->input('branch');
        $car->save();

        // Return success response
        return response()->json(['success' => true, 'message' => 'Car details added successfully!']);
      
    } catch (\Exception $e) {
        // Return error response
        return response()->json(['success' => false, 'message' => 'An error occurred. Please try again later.']);
    }
}




    public function editCarDetails(Request $request)
    {
        $id = $request->id;
       $editcardetails = Car::select('cars.*','branches.branch_name','branches.id as branch_id')
        ->leftJoin('branches','cars.branch','=','branches.id')
        ->where('cars.isdelete', 1)
        ->where('cars.id', $id)
        ->first();
       
        $branch = Branch::where('id' , '<>' , $editcardetails->branch)->get();
       
        return view('editcardetails', compact('editcardetails','branch'));  
    }




    // public function updatecardetails(Request $request, $id)
    // {
    //     // $car = Car::findOrFail($id);
    //     $car = Car::select('cars.*','branches.branch_name')
    //     ->leftJoin('branches','cars.branch','=','branches.id')
    //     ->where('cars.isdelete', 1)
    //     ->where('cars.id', $id)
    //     ->get();


        
    //     // Validate the request
    //     $validator = Validator::make($request->all(), [
    //         'car-name' => 'required|string|max:255',
    //         'car-number' => 'required',
    //         'car-fuel' => 'nullable|string',
    //         'branch' => 'required|integer',
    //     ]);
    
     

    //     if ($validator->fails()) {
    //         return response()->json(['success' => false, 'message' => $validator->errors()->first()], 400);
    //     }
    
    //     // Update car details
    //     $car->car_name = $request->input('car-name');
    //     $car->car_number = $request->input('car-number');
    //     $car->fuel_type = $request->input('car-fuel');
    //     $car->branch = $request->input('branch');
    //     $car->save();

    
    //     return response()->json(['success' => true, 'message' => 'Car details updated successfully.']);
    // }
    
    public function updatecardetails(Request $request, $id)
{
    // Validate incoming request data
    $validator = Validator::make($request->all(), [
        'car-name' => 'required|string|max:255',
        'car-number' => 'required',
        'car-fuel' => 'nullable|string',
        'branch' => 'required|integer'
    ]);

    if ($validator->fails()) {
        return response()->json(['success' => false, 'message' => $validator->errors()->first()], 400);
    }

    try {
        $car = Car::findOrFail($id);
        $car->update([
            'car_name' => $request->input('car-name'),
            'car_number' => $request->input('car-number'),
            'fuel_type' => $request->input('car-fuel'),
            'branch' => $request->input('branch')
        ]);

        return response()->json(['success' => true, 'message' => 'Car updated successfully.']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Failed to update car details.'], 500);
    }
}





    public function deletecar($id)
    {
        $car = Car::find($id);
        if (!$car) {
            return redirect()->back()->with('error', 'User not found');
        }
        Car::where('id', $id)->update(['isdelete' => 0]);
        return redirect()->route('carManagement')->with('success', 'User updated successfully.');
    }

}