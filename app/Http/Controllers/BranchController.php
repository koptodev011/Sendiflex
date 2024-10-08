<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Attendance;
use App\Models\Branch;

use Validator;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use PDF;
use Illuminate\Support\Facades\DB;
use App\Models\Video;
use Carbon\Carbon;
class BranchController extends Controller
{
    public function branch(Request $request)
    {
        $branch = Branch::all();
        // $videos = Video::whereIn('role', [1])->get();
        return view('branch', compact('branch'));
    }

    

    public function createbranch(Request $request)
    {
        // Validate input data
        $validator = Validator::make($request->all(), [
            'branch_name' => 'required|string|max:255',
            'branch_address' => 'nullable|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
    
        // Save the branch
        $branch = new Branch();
        $branch->branch_name = $request->input('branch_name');
        $branch->branch_address = $request->input('branch_address');
        $branch->save();
    
        return response()->json(['success' => true, 'message' => 'Branch created successfully.']);
    }
    

    // Send data to the employee page


    public function editbranchDetails(Request $request)
{
   
    $id = $request->id;
    $branch = Branch::find($id);
    return view('editbranch', compact('branch'));
}
    

public function updateBranchDetails(Request $request, $id)
{
    // Validate input data
    $validator = Validator::make($request->all(), [
        'branch_name' => 'required|string|max:255',
        'branch_address' => 'nullable|string',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 400);
    }

    // Find and update the branch
    $branch = Branch::find($id);

    if (!$branch) {
        return response()->json(['success' => false, 'message' => 'Branch not found.'], 404);
    }

    $branch->branch_name = $request->input('branch_name');
    $branch->branch_address = $request->input('branch_address');
    $branch->save();

    return response()->json(['success' => true, 'message' => 'Branch updated successfully.']);
}



public function deletebranchdetails($id)
    {
        $user = Branch::findOrFail($id);
        $user->delete();
        return redirect()->route('branch')->with('success', 'User updated successfully.');
    }

}
