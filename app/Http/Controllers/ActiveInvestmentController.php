<?php

namespace App\Http\Controllers;
use App\Models\Month;
use App\Models\activeinvestment;
use App\Models\Investment;
use Illuminate\Http\Request;

class ActiveInvestmentController extends Controller
{

    public function activeinvestment()
    {
        $months = Month::all();
        return view('activeinvestment', compact('months'));
    }
    public function viewinvestments(Request $request){
        $id = $request->query('id');
        $investments = Investment::where('month_id', $id)->get();
         return view('viewinvestments',compact('investments'));
    }


    public function addinvestments(Request $request){
        $request->validate([
            'investmenttitle' => 'required|string|max:255',
            'rateofinterest' => 'nullable',
            'period' =>'nullable',
            'amount' => 'required|numeric|min:0',
            'id' => 'nullable|integer'
        ]);

        $investmentarea = $request->input('investmenttitle');
        $amount = $request->input('amount');
        $rate = $request->input('rateofinterest');
        $period = $request->input('period');
        $id = $request->input('id');



        $investments = new Investment();
        $investments->investment_area=$investmentarea;
        $investments->rate_of_interest=$rate;
        $investments->duration=$period;
        $investments->amount=$amount;
        $investments->month_id=$id;
        $investments->save();


        return response()->json(['success' => true, 'message' => 'Details added successfully.']);
    }

    public function editinvestments(Request $request){
        $id = $request->query('id');
        $investment=Investment::where('id',$id)->first();
        return view('editinvestments',compact('investment'));
    }

    public function deleteinvestmentdetails($id){
        $user = Investment::findOrFail($id);
        $user->delete();
        return redirect()->route('activeinvestment')->with('success', 'User updated successfully.');
    }

}
