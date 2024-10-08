<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Edusection;
use App\Models\Subsection;
use App\Models\Subject;
use App\Models\Roadmap;

class Educationalplan extends Controller
{
    public function edusection(){
        $edu=Edusection::all();
        return view('edusection',compact('edu'));
    }


    public function addsection(Request $request){
        $request->validate([
            'sectionname'=>'required',
        ]);
        $sectionname=new Edusection();
        $sectionname->section_name=$request->sectionname;
        $sectionname->save();
        return response()->json(['success' => true, 'message' => ' data submitted successfully.']);
    }


  public function subsectionupdated(Request $request){
    $id = $request->query('id');
    $subsection=Subject::where('section_id',$id)->get();
    return view('subsection',compact('subsection'));
}


public function addsubject(Request $request)
{
    $validatedData = $request->validate([
        'sectionname' => 'required|string|max:255'
    ]);
    $subject = new Subject();
    $subject->subject_name=$request->sectionname;
    $subject->section_id=$request->id;
    $subject->save();
    return redirect()->back()->with('success', 'Subjects added successfully!');
}






public function material(Request $request){

    $roadmap=Roadmap::where('subject_id',$request->id)->get();
    return view('Material',compact('roadmap'));
}

public function settimeline(Request $request){
    $request->validate([
        'subjectname'=>'required',
        'start_date'=>'required',
        'end_date'=>'required'
    ]);
    $enddate=$request->end_date;
    $settime=new Roadmap();
    $settime->name=$request->subjectname;
    $settime->start_date=$request->start_date;
    $settime->end_time=$enddate;
    $settime->subject_id=$request->id;
    $settime->save();
    return response()->json(['success' => true, 'message' => ' data submitted successfully.']);
}

 // Make sure to import the Subject model

public function addroadmaps(Request $request)
{
    $request->validate([
        'sectionname.*' => 'required',
        'start_date.*' => 'required|date',
        'end_date.*' => 'required',
        'number_selection.*' => 'required|integer',
         // Validate the ID exists in the subjects table
    ]);
    foreach ($request->sectionname as $key => $subjectName) {
        $roadmap = new Roadmap();
        $roadmap->start_date = $request->start_date[$key];
        $roadmap->end_time = $request->end_date[$key];
        $roadmap->subject_id = $subjectName; // This should be valid now due to the validation
        $roadmap->priority = $request->number_selection[$key];
        $roadmap->save();
    }

    return redirect()->back()->with('success', 'Subjects added successfully!');
}







}

