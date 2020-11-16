<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $expenses = Expenses::orderBy('created_at','asc')->paginate();
        return response()->json($expenses, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'description' => 'required|min:3',
            'amount_entered' => 'required|min:1',
            'budget' => 'required|min:1',
            'current_balance' => 'required|min:1'

        ]);

        $expenses = new Expenses();
        $expenses->name =  $request->name;
        $expenses->description =  $request->description;
        $expenses->amount_entered =  $request->amount_entered;
        $expenses->budget =  $request->budget;
        $expenses->current_balance =  $request->current_balance;

        if ($expenses->save()){
            return response()->json($expenses, 200);
        }
        else{
            return response()->json(['message' => 'Error occured in save', 'status_code'=>500], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function show(Expenses $expenses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function edit(Expenses $expenses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expenses $expenses)
    {
        $request->validate([
            'name' => 'required|min:3',
            'description' => 'required|min:3',
            'amount_entered' => 'required|min:1',
            'budget' => 'required|min:1',
            'current_balance' => 'required|min:1'
        ]);

        $expenses->name = $request->name;
        $expenses->description =  $request->description;
        $expenses->amount_entered =  $request->amount_entered;
        $expenses->budget =  $request->budget;
        $expenses->current_balance =  $request->current_balance;
        
        if($expenses->save()){
            return response()->json($expenses, 200);
        }
        else{
            return response()->json(['message' => 'Error occured in save', 'status_code'=>500], 500);
        }

        // dd($request->all(), $expenses);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expenses $expenses)
    {

        if($expenses->delete()){
            return response()->json([
                'message' => 'Succesfully',
                'status_code' => 200
            ], 200);
        } 
        
        //not really working but if i remove the else, it will soft delete but not permanently delete
        //500 not working for some reasons..
       
        // else{
        //     return response()->json([
        //         'message' => 'Not Succesfully',
        //         'status_code' => 500
        //     ], 500);
        // }

        ////////////////full code but error//////////////

        // if ($expenses->delete()){
        //     return response()->json([
        //         'message' => 'Success',
        //          'status_code'=>200
        //         ], 200);
        // }
        // else{
        //     return response()->json([
        //         'message' => 'Nope',
        //          'status_code'=>500
        //         ], 500);
        // }

    }
}
