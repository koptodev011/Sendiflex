<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enquiry;
use App\Models\Branch;
use Illuminate\Support\Facades\Auth;

use RealRashid\SweetAlert\Facades\Alert;

class EnquiryController extends Controller
{
    //
    public function index(){
        
        return view('enquiry');
    }

    public function save(Request $request){
        $request->validate([
            'name' =>'required|string|max:255',
            'email' =>'required|email|unique:rtowork',
            'phone' =>'required|numeric|digits:10',
            'enquiry' =>'required|string',
        ]);

      if(Auth::check()){
         // Save to database
         Enquiry::create([
            'name' =>$request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'enquiry' => $request->enquiry,
            // Additional fields can be added here as per the requirements...  //...
            'user_id' => Auth::user()->id,
            'branch_id' => Auth::user()->branch
        ]);
        //...

        return redirect()->back()->with('success', 'Enquiry submitted successfully.');
      }
       
    }

    public function list(){
        $user = Auth::user();
        $branch = Branch::all();
       
        if($user->role==3){
            $enquiry = Enquiry::select('enquiry.*','branches.branch_name')->where('enquiry.branch_id',  $user->branch)
            ->leftJoin('branches','enquiry.branch_id','=','branches.id')
            ->get();
           
        }else{
           $enquiry = Enquiry::select('enquiry.*','branches.branch_name')
           ->leftJoin('branches','enquiry.branch_id','=','branches.id')
           ->get();
            
        }

     
        return view('enquiry_list')->with(['enquiry' => $enquiry, 'branch' => $branch]);
    }

    public function delete($id)
    {
        $enquiry = Enquiry::find($id);

        if (!$enquiry) {
            return redirect()->back()->with('error', 'Data Not found');
        }
        Enquiry::where('id', $id)->delete();
        Alert::success('success','Data Deleted Successfully');
        return redirect()->back()->with('success', 'Data Deleted Successfully');
    }
}
