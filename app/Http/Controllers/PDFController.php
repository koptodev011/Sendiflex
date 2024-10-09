<?php

namespace App\Http\Controllers;

use App\Models\Expence;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\total_payment;
use App\Models\Month;
use App\Models\Roadmap;
use App\Models\Subject;
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

    public function printroadmap(Request $request)
{
    $id = $request->input('id');

    // Get all roadmaps
    $roadmaps = Roadmap::all();

    // Prepare data to include subject details
    $roadmapData = $roadmaps->map(function ($roadmap) {
        $subject = Subject::find($roadmap->subject_id); // Fetch subject based on subject_id
        return [
            'title' => $roadmap->title,
            'description' => $roadmap->description,
            'subject_name' => $subject ? $subject->name : 'N/A', // Change 'name' to your actual subject field
        ];
    });

    $data = [
        'title' => "Roadmap",
        'date' => date('d/m/Y'),
        'roadmapData' => $roadmapData, // The formatted data with subject names
        'roadmaps' => $roadmaps // The original roadmaps data
    ];

    $pdf = Pdf::loadView('products.roadmap', $data);
    return $pdf->download('Expense.pdf');
}

}
