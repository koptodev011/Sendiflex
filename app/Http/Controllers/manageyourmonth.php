<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Earning;
use App\Models\Month;
use App\Models\Payment;
use App\Models\Expence;
use App\Models\total_payment;
use Illuminate\Support\Facades\Log;
use Validator;
class manageyourmonth extends Controller
{

    public function month(){
        $months=Month::all();
        $totalpayment = total_payment::sum('remaining_amount');
        if ($totalpayment === null) {
            $totalpayment = new \stdClass();
            $totalpayment->total_payment = 0;
        }
        return view('month', ['earnings' => $months,'totalpayment' => $totalpayment]);
    }


    public function addmonth(Request $request){
        $request->validate([
            'month'=>'required',
        ]);
        $month=new Month();
        $month->month_name=$request->month;
        $month->save();
        return response()->json(['success' => true, 'message' => ' data submitted successfully.']);
    }


    public function manageyourmonth(Request $request) {
        $id = $request->query('id');
        $earnings = Earning::where('month_id', $id)->get();
        $totalpayment = total_payment::where('month_id', $id)->first();
        if ($totalpayment === null) {
            $totalpayment = new \stdClass();
            $totalpayment->total_payment = 0;
        }

        return view('manageyourmonth', ['earnings' => $earnings, 'totalpayment' => $totalpayment]);
    }



    public function editearning(Request $request){
        $id = $request->query('id');
        $earning=Earning::where('id',$id)->first();
        return view('edittotalearnings',compact('earning'));
    }


    public function viewexpence(Request $request)
    {
        $id = $request->query('id');
        $expences = Expence::where('month_id', $id)->get();
        $totalpayment = total_payment::where('month_id', $id)->first();
        if ($totalpayment === null) {
            $totalpayment = new \stdClass();
            $totalpayment->total_payment = 0;
        }
        return view('viewexpence', compact('expences','totalpayment'));
    }



    public function totalpayment(Request $request)
    {
        $request->validate([
            'area-of-earning.*' => 'required|string|max:255',
            'amount.*' => 'required|numeric|min:0',
            'id' => 'nullable|integer'
        ]);

        $areaofearnings = $request->input('area-of-earning');
        $planeFees = $request->input('amount');
        $id = $request->input('id');

        if (count($areaofearnings) !== count($planeFees)) {
            return redirect()->back()->withErrors('Mismatch in the number of areas of earning and amounts.');
        }

        foreach ($areaofearnings as $index => $name) {
            $earning = new Earning();
            $earning->earning_resource = $name;
            $earning->amount = $planeFees[$index];
            $earning->month_id = $id;
            $earning->save();
        }
        $totalpayment = total_payment::where('month_id', $id)->first();
        $totalearning = Earning::where('month_id', $id)->sum('amount');

        if ($totalpayment) {
            $totalpayment->total_payment = $totalearning;
            $totalpayment->remaining_amount=$totalearning;
            $totalpayment->save();
        } else {
            $totalpayment = new total_payment();
            $totalpayment->total_payment = $totalearning;
            $totalpayment->month_id = $id;
            $totalpayment->remaining_amount=$totalearning;
            $totalpayment->save();
        }
        return response()->json(['success' => true, 'message' => 'Details added successfully.']);
    }




    //This is the add expence function

    public function addexpence(Request $request){
        $request->validate([
            'area-of-expence.*' => 'required|string|max:255',
            'amount.*' => 'required|numeric|min:0',
            'id' => 'nullable|integer'
        ]);
        $areaofexpences = $request->input('area-of-expence');
        $amount = $request->input('amount');
        $id = $request->input('id');
        $totalAmount=0;
        foreach ($areaofexpences as $index => $name) {
            $earning = new Expence();
            $earning->expence_title = $name;
            $earning->expence_amount = $amount[$index];
            $earning->month_id = $id;
            $earning->save();
            $totalAmount += $amount[$index];
        }
        $total_payment=total_payment::where('month_id',$id)->first();
        if($total_payment){
            $total_payment->remaining_amount=$total_payment->remaining_amount-$totalAmount;
            $total_payment->save();
        }

        return response()->json(['success' => true, 'message' => 'Details added successfully.']);
    }





    public function updateearningdetails(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'earningresource' => 'required|string|max:255',
        'amount' => 'nullable|string',
    ]);
    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 400);
    }

    $earning = Earning::find($id);

    if (!$earning) {
        return response()->json(['success' => false, 'message' => 'Branch not found.'], 404);
    }

    $earning->earning_resource = $request->input('earningresource');
    $earning->amount = $request->input('amount');
    $earning->save();


    return response()->json(['success' => true, 'message' => 'Earning updated successfully.']);
}

public function deleteearningdetails($id){
    $user = Earning::findOrFail($id);
    $user->delete();
    return redirect()->route('month')->with('success', 'User updated successfully.');
}

public function deleteexpencedetails($id){
    $user = Expence::findOrFail($id);
    $user->delete();
    return redirect()->route('month')->with('success', 'User updated successfully.');
}
public function displayexpence(){
    view('viewandprintexpence');
}


}
