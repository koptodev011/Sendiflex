<?php

namespace App\Http\Controllers;

use App\Models\Expence;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\total_payment;
use App\Models\Month;
use Illuminate\Support\Facades\Auth;

use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{

    public function printexpencelist(Request $request)
    {
        $id = $request->input('id');
        $month = Month::where('id', $id)->first();
        $expence = Expence::where('month_id', $id)->get();
        $user = Auth::user();
        $sumExpense = Expence::where('month_id', $id)->sum('expence_amount');
        $remainingamount = total_payment::where('month_id',$id)->first();

        $data = [
            'title' => $user->name,
            'date' => date('d/m/Y'),
            'users' => $expence,
            'month_name' => $month->month_name,
            'totalExpence' => $sumExpense
        ];
        $pdf = Pdf::loadView('products.expence', $data);
        return $pdf->download('Expence.pdf');
    }

    public function printroadmap(Request $request){
        $id = $request->input('id');
        $month = Month::where('id', $id)->first();
        $expence = Expence::where('month_id', $id)->get();
        $user = Auth::user();
        $sumExpense = Expence::where('month_id', $id)->sum('expence_amount');
        $remainingamount = total_payment::where('month_id',$id)->first();

        $data = [
            'title' => $user->name,
            'date' => date('d/m/Y'),
            'users' => $expence,
            'month_name' => $month->month_name,
            'totalExpence' => $sumExpense
        ];
        $pdf = Pdf::loadView('products.roadmap', $data);
        return $pdf->download('Expence.pdf');
    }
}
