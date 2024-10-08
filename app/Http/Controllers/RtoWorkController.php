<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rto_Works;
use App\Models\Branch;
use Illuminate\Support\Facades\Auth;

use RealRashid\SweetAlert\Facades\Alert;

use Barryvdh\DomPDF\Facade\Pdf;

class RtoWorkController extends Controller
{
    //
    public function index(){
        $branch = Branch::all();
        return view('rtowork')->with(['branch' => $branch]);
    }

    public function save(Request $request){
        $request->validate([
            'name' =>'required|string|max:255',
            'email' =>'required|email|unique:rtowork',
            'phone' =>'required|numeric|digits:10',
            'topic' =>'required|string',
            'branch_id' =>'required|integer',
        ]);

      
        // Save to database
        Rto_Works::create([
            'name' =>$request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'rto_topic' => $request->topic,
            // Additional fields can be added here as per the requirements...  //...
            'other' => $request->other,
            'branch_id' => $request->branch_id
        ]);
        //...

        return redirect()->back()->with('success', 'Form submitted successfully.');
    }

    public function list(){
        $user = Auth::user();
        $branch = Branch::all();
        
        if($user->role==3){
            $rtowork = Rto_Works::select('rto_works.*','branches.branch_name')->where('rto_works.branch_id',  $user->branch)
            ->leftJoin('branches','rto_works.branch_id','=','branches.id')
            ->get();
           
        }else{
           $rtowork = Rto_Works::select('rto_works.*','branches.branch_name')
           ->leftJoin('branches','rto_works.branch_id','=','branches.id')
           ->get();
            
        }
     
        return view('rtowork_list')->with(['rtoworks' => $rtowork, 'branch' => $branch]);
    }

    public function export(Request $request)
    {
        $validatedData = $request->validate([
           
            'format' => 'required',
        ]);
 
       
        $format = $request->input('format');
 
 
        $user = Auth::user();
      
        if($user->role==3){
            $rtowork = Rto_Works::select('rto_works.*','branches.branch_name')->where('rto_works.branch_id',  $user->branch)
            ->leftJoin('branches','rto_works.branch_id','=','branches.id')
            ->get();
           
        }else{
           $rtowork = Rto_Works::select('rto_works.*','branches.branch_name')
           ->leftJoin('branches','rto_works.branch_id','=','branches.id')
           ->get();
            
        }
 
 
  $data=[
     'title' => 'Shiv Suman Motors',
     'date' => date('m/d/Y'),
     'rtowork' => $rtowork
 ];
 $pdf=Pdf::loadView('products/rtowork_list',$data);
 return $pdf->download('RTO_Work.pdf');
    }

    public function delete($id)
    {
        $rtowork = Rto_Works::find($id);

        if (!$rtowork) {
            return redirect()->back()->with('error', 'Data Not found');
        }
        Rto_Works::where('id', $id)->delete();
        Alert::success('success','Data Deleted Successfully');
        return redirect()->back()->with('success', 'Data Deleted Successfully');
    }
}


