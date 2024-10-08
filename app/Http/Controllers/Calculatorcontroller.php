<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Calculatorcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function calculator()
    {
        return view('calculator');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function calculate(Request $request){
        $request->validate([
            'first'=>'required',
            'second'=>'required',
            'operator'=>'required'
        ]);
        $first=$request->first;
        $second=$request->second;
        $operator=$request->operator;

        if ($operator=='+') {
            $ans=$first+$second;
        }elseif($operator=='-'){
           $ans= $first-$second;
        }
        elseif($operator=='*'){
            $ans=$first*$second;
        } elseif($operator=='/'){
            $ans=$first/$second;
        }else{
            $ans="You entered wrong symbol";
        }
        
        return view('calculator', compact('ans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
