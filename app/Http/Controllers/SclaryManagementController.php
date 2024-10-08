<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Attendance;
use Validator;
use App\Models\User;    
use App\Models\Branch;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use PDF;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class SclaryManagementController extends Controller
{



// public function sclaryManagement()
// {
//     $currentMonth = Carbon::now()->month;
//     $currentYear = Carbon::now()->year;
   

//     $startDate = Carbon::createFromDate($currentYear, $currentMonth, 1)->startOfMonth();
   
//     $endDate = Carbon::createFromDate($currentYear, $currentMonth, 1)->endOfMonth();


//     $daysExcludingSundays = 0;
//     for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
//         if ($date->dayOfWeek != Carbon::SUNDAY) {
//             $daysExcludingSundays++;
//         }
//     }


//     $sclarydata = User::with(['attendance' => function ($query) use ($currentMonth, $currentYear) {
//         $query->whereMonth('created_at', $currentMonth)
//               ->whereYear('created_at', $currentYear);
//     }])->get();


//     $sclaryDataArray = [];


//     foreach ($sclarydata as $user) {
//         $attendanceCount = $user->attendance->count();
//         $sclary = ($user->sclary / $daysExcludingSundays) * $attendanceCount;
        
//         $sclary = ceil($sclary);

//         $sclaryDataArray[] = [
//             'user' => $user,
//             'attendanceCount' => $attendanceCount,
//             'sclary' => $sclary,
//         ];
//     }

//     // You can pass $sclaryDataArray, $sclary, and $sclarydata to the view
//     return view('sclarymanagement', compact('sclaryDataArray', 'sclary', 'sclarydata'));
// }


public function sclaryManagement()
{
    $branches = Branch::all();

    // Fetch distinct years from the attendance table
    $years = \App\Models\Attendance::selectRaw('YEAR(created_at) as year')
                ->distinct()
                ->orderBy('year', 'desc')
                ->pluck('year')
                ->toArray();

    // Add the current year to the list if it's not already present
    $currentYear = date('Y');
    if (!in_array($currentYear, $years)) {
        $years[] = $currentYear;
    }

    // Sort years again to ensure the current year is at the top
    rsort($years);

    return view('sclarymanagement', [
        'branches' => $branches,
        'years' => $years,
    ]);
}











// public function searchRecords(Request $request) {
//     // Validate the request
//     $validator = Validator::make($request->all(), [
//         'month' => 'required|string|max:255',
//         'year' => 'required|numeric|digits:4',
        
//     ]);

//     if ($validator->fails()) {
//         return redirect()->back()->withErrors($validator)->withInput();
//     }

//     // Retrieve the input values
//     $currentMonth = $request->input('month');
//     $currentYear = $request->input('year');

//     // Define start and end dates for the month
//     $startDate = Carbon::createFromDate($currentYear, $currentMonth, 1)->startOfMonth();
//     $endDate = Carbon::createFromDate($currentYear, $currentMonth, 1)->endOfMonth();

//     $daysExcludingSundays = 0;
//     for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
//         if ($date->dayOfWeek != Carbon::SUNDAY) {
//             $daysExcludingSundays++;
//         }
//     }

//     // Fetch users with their attendance data
//     $sclarydata = User::whereIn('role', [2, 3])->where('is_delete', 0)
//         ->with(['attendance' => function ($query) use ($currentMonth, $currentYear) {
//             $query->whereMonth('created_at', $currentMonth)
//                   ->whereYear('created_at', $currentYear);
//         }])->get();

//     // Initialize the sclaryDataArray
//     $sclaryDataArray = [];
    
//     // Process each user
//     foreach ($sclarydata as $user) {
//         $attendanceCount = $user->attendance->count();
//         $sclary = ($user->sclary / $daysExcludingSundays) * $attendanceCount;
//         $sclary = ceil($sclary);

//         $sclaryDataArray[] = [
//             'user' => $user,
//             'attendanceCount' => $attendanceCount,
//             'sclary' => $sclary,
//         ];
//     }
//     return view('viewsalarycalculation', [
//         'sclaryDataArray' => $sclaryDataArray,
//         'sclarydata' => $sclarydata
//     ]);
// }



public function searchRecords(Request $request) {

    $validator = Validator::make($request->all(), [
        'month' => 'required|string|max:255',
        'year' => 'required|numeric|digits:4',
        'branch' => 'required|exists:branches,id',  // Add branch validation
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Retrieve the input values
    $currentMonth = $request->input('month');
    $currentYear = $request->input('year');
    $branchId = $request->input('branch');

    // Define start and end dates for the month
    $startDate = Carbon::createFromDate($currentYear, $currentMonth, 1)->startOfMonth();
    $endDate = Carbon::createFromDate($currentYear, $currentMonth, 1)->endOfMonth();

    $daysExcludingSundays = 0;
    for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
        if ($date->dayOfWeek != Carbon::SUNDAY) {
            $daysExcludingSundays++;
        }
    }
    $sclarydata = User::whereIn('role', [2, 3])
        ->where('is_delete', 0)
        ->where('branch', $branchId)  // Filter by branch
        ->with(['attendance' => function ($query) use ($currentMonth, $currentYear) {
            $query->whereMonth('created_at', $currentMonth)
                  ->whereYear('created_at', $currentYear);
        }])->get();
    $branches = Branch::all();
    $sclaryDataArray = [];
    
    // Process each user
    foreach ($sclarydata as $user) {
        $attendanceCount = $user->attendance->count();
        $sclary = ($user->sclary / $daysExcludingSundays) * $attendanceCount;
        $sclary = ceil($sclary);
        

        $sclaryDataArray[] = [
            'user' => $user,
            'attendanceCount' => $attendanceCount,
            'sclary' => $sclary,
            'branch' => $user->branch,  // Add branch data to sclaryDataArray
        ];
    }


    return view('viewsalarycalculation', [
        'sclaryDataArray' => $sclaryDataArray,
        'sclarydata' => $sclarydata,
        'branches' => $branches,  // Pass branches to the view
    ]);
}





}