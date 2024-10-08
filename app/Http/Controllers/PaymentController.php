<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Attendance;
use Validator;
use App\Models\User;
use App\Models\Plane;
use App\Models\Payment;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use PDF;
use Illuminate\Support\Facades\DB;
use App\Models\Video;
use App\Models\PaymentHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;

class PaymentController extends Controller
{
    public function yearlyAnalysis()
    {
        $user = Auth::user();
        $currentYear = now()->year;
        $yearlySums = [];
        
        for ($i = 0; $i < 4; $i++) {
            $yearToQuery = $currentYear - $i;
            $yearSum = Payment::whereYear('created_at', $yearToQuery)
                ->where('branch', $user->branch)
                ->sum('amount');
            
            $yearlySums[$yearToQuery] = $yearSum;
        }
        $currentYearSum = $yearlySums[$currentYear];
        $percentageChanges = [];
        
        foreach ($yearlySums as $year => $sum) {
            if ($year != $currentYear) {
                if ($sum == 0) {
                    $percentageChanges[$year] = $currentYearSum > 0 ? 100 : 0;
                } else {
                    $percentage = (($currentYearSum - $sum) / $sum) * 100;
                    $roundedPercentage = ceil($percentage);
                    $percentageChanges[$year] = $roundedPercentage;
                }
            } else {
                $percentageChanges[$year] = 0;
            }
        }
        
        $years = array_keys($percentageChanges);
        $percentages = array_values($percentageChanges); 
        
        return [$years, $percentages];
    }
    
    
    public function branchAnalysis()
    {
        $branches = Branch::all();
        $percentageChanges = [];
    
        foreach ($branches as $branch) {
            $branchId = $branch->id;
            $currentYear = now()->year;
            
            $currentYearSum = Payment::where('branch', $branchId)
                ->whereYear('created_at', $currentYear)
                ->sum('amount');
    
            $previousYearSum = Payment::where('branch', $branchId)
                ->whereYear('created_at', $currentYear - 1)
                ->sum('amount');
                // echo("CorrentYearSum $currentYearSum");
                // echo("previousYearSum $previousYearSum");
    
            $percentageChange = 0;
            if ($previousYearSum != 0) {
                $percentageChange = (($currentYearSum - $previousYearSum) / $previousYearSum) * 100;
            }
            
            $percentageChanges[$branch->branch_name] = number_format($percentageChange, 2);
        }
    
        // Prepare data for the view
        $branchNames = array_keys($percentageChanges);
        $percentages = array_values($percentageChanges);
    
        return view('home', [
            'branchNames' => $branchNames,
            'percentages' => $percentages,
        ]);
    }


    

    public function planAnalysis() {
        $user = Auth::user();
        $plans = Plane::all();
        $currentYear = now()->year;
        $degrees = [];
        
        if ($user->role == 4) {
            $yearSum = Payment::whereYear('created_at', $currentYear)->sum('amount');
            foreach ($plans as $plan) {
                $id = $plan->id;
                $planSum = Payment::whereYear('created_at', $currentYear)
                                  ->where('plan_id', $id)
                                  ->sum('amount');
                
                $percentage = ($planSum / $yearSum) * 100;
                $degree = ($percentage / 100) * 360;
                $degrees[] = [
                    'id' => $id,
                    'name' => $plan->name, 
                    'degree' => $degree
                ];
            }
        } else {
            $yearSum = Payment::whereYear('created_at', $currentYear)
                              ->where('branch', $user->branch)
                              ->sum('amount');
                              
            foreach ($plans as $plan) {
                $id = $plan->id;
                $planSum = Payment::whereYear('created_at', $currentYear)
                                  ->where('branch', $user->branch)
                                  ->where('plan_id', $id)
                                  ->sum('amount');
            
                if($yearSum > 0){

                    $percentage = ($planSum / $yearSum) * 100;
                    $degree = ($percentage / 100) * 360;
    
                    $degrees[] = [
                        'id' => $id,
                        'name' => $plan->name, 
                        'degree' => $degree
                    ];
                }else{
                    $degrees[] = [
                        'id' => $id,
                        'name' => $plan->name, 
                        'degree' => 0
                    ];
                }
                
               
                
            }
          
        }
        return [$degrees];
    }


    public function monthlyAnalysis()
    {
        $user = Auth::user();
        $currentYear = Carbon::now()->year;
        $monthlyData = [];
        $totalYearlySum = 0;

        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    
        // Calculate total amount for the entire year
        for ($month = 1; $month <= 12; $month++) {
            $startDate = Carbon::createFromDate($currentYear, $month, 1)->startOfMonth();
            $endDate = Carbon::createFromDate($currentYear, $month, 1)->endOfMonth();
            $sum = Payment::where('branch', $user->branch)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->sum('amount');
    
            $totalYearlySum += $sum;
    
            // Only include months with positive sum
            if ($sum > 0) {
                $monthlyData[] = [
                    'month' => $months[$month - 1], // Adjust month index to match array (0-based index)
                    'amount' => $sum,
                ];
            }
        }
    
        // Calculate percentages if totalYearlySum is greater than 0
        if ($totalYearlySum > 0) {
            foreach ($monthlyData as &$data) {
                $percentage = ($data['amount'] / $totalYearlySum) * 100;
                $data['percentage'] = $percentage;
            }
        }
    
        return $monthlyData;
        // return view('home', compact('monthlyData'));
    }
    
    



    public function dashborddata()
    {
        $user = Auth::user();
        $currentYear = now()->year;
        $branch = Branch::where('id', $user->branch)->first();
        if($user->role==4){
            $plans = Plane::where('active', 0)->get();
        }else{
            $plans = Plane::where('active', 0)->where('branch', $user->branch)->get();
        }
        $yearSums = [];
        $tempYear = $currentYear;
       

        for ($i = 0; $i < 2; $i++) {
            if($user->role==4){
                $currentYearSum = Payment::whereYear('created_at', $tempYear)
                ->sum('amount');
            }else{
            $currentYearSum = Payment::where('branch', $user->branch)
            ->whereYear('created_at', $tempYear)
            ->sum('amount');
            }
            $yearSums[$tempYear] = $currentYearSum;
            $tempYear--;
        }


        $currentYearSum = isset($yearSums[date('Y')]) ? $yearSums[date('Y')] : 0;
 
        $previousYearSum = isset($yearSums[date('Y') - 1]) ? $yearSums[date('Y') - 1] : 0;
        $growthrate = ($previousYearSum != 0) ? (($currentYearSum - $previousYearSum) / $previousYearSum) * 100 : 0;

        list($years, $percentages) = $this->yearlyAnalysis();
        list($degrees) = $this->planAnalysis();
        $monthlyData = $this->monthlyAnalysis();
    
        if ($branch) {
            $branchName = $branch->branch_name;
        } else {
            $branchName = 'Admin';
        }
    
        // Return view with data
        return view('home', [
            'growthrate' => $growthrate,
            'currentYearSum' => $currentYearSum,
            'plan' => count($plans),
            'branch' => $branchName,
            'user' => $user,
        ], compact('years', 'percentages', 'degrees', 'monthlyData'));
    }
    


    public function paymentmanagement() {
        $user = Auth::user();
        $query = Payment::select('payments.*', 'users.name as user_name', 'branches.branch_name', 'planes.plane_name')
            ->leftJoin('users', 'payments.user_id', '=', 'users.id')
            ->leftJoin('branches', 'payments.branch', '=', 'branches.id')
            ->leftJoin('planes', 'payments.plan_id', '=', 'planes.id');
        if ($user->role != 4) {
            $query->where('payments.branch', $user->branch);
        }
        $results = $query->get();
        $branches = Branch::all();
        return view('payment', compact('results', 'branches'));
    }


    public function filterpayment(Request $request){
        $branch=$request->branch;
        $branches = Branch::all();
        $query = Payment::select('payments.*', 'users.name as user_name', 'branches.branch_name', 'planes.plane_name')
            ->leftJoin('users', 'payments.user_id', '=', 'users.id')
            ->leftJoin('branches', 'payments.branch', '=','branches.id' )
            ->leftJoin('planes', 'payments.plan_id', '=', 'planes.id')
            ->where('payments.branch', $branch);
             $results = $query->get();
            return view('payment', compact('results','branches'));
    }
    



    public function viewpaymentdetails(Request $request)
{
    $userid = $request->user_id;
    $paymentdetails = PaymentHistory::select('payment_histories.*', 'users.name as user_name')
        ->leftJoin('users', 'payment_histories.user_id', '=', 'users.id')
        ->where('user_id', $userid)
        ->get()
        ->map(function ($payment) {
            // Format the created_at date to display only the date part
            $payment->created_at = $payment->created_at->format('Y-m-d');
            return $payment;
        });

    return view('viewpaymentdetails', compact('paymentdetails'));
}


public function addpaymentDetails(Request $request) {
    $userId = $request->input('user_id');
    $amount = $request->input('amount');
    
    // Fetch the payment record for the user
    $payment = Payment::where('user_id', $userId)->first();

    if ($payment) {
        $paidamount = $amount + $payment->amount;
        $pendingamount = $payment->total_amount - $paidamount;
        
        // Check if the entered amount exceeds the remaining amount
        if ($amount > $payment->pending_amount) {
            return response()->json([
                'success' => false,
                'message' => 'You entered more amount than the pending amount.'
            ]);
        }

        // Update the payment record
        $updated = Payment::where('user_id', $userId)
            ->update([
                'amount' => $paidamount,
                'pending_amount' => $pendingamount,
            ]);

        if ($updated) {
            // Save the payment history
            $paymentHistory = new PaymentHistory();
            $paymentHistory->user_id = $userId;
            $paymentHistory->paid_amount = $amount;
            $paymentHistory->total_amount = $payment->total_amount;
            $paymentHistory->remaining_amount = $pendingamount;
            $paymentHistory->save();

            return response()->json([
                'success' => true,
                'message' => 'Payment details updated successfully.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update payment details.'
            ]);
        }
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Payment record not found.'
        ]);
    }
}


 
    



    



    }
