<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Transaction::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'passport_id' => 'required|integer',
            'receiver_id' =>  'required|integer',
            'attachments' =>  'string'
        ]);
        
        $user = auth()->user();
        $validated['sender_id'] = ($user) ? $user->id : 0; //if not authenticated, then id = 0

        $transaction = new Transaction($validated);

        $transaction->save();
        
        return response()->json([
            'message' => 'Successfully created transaction!',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return $transaction;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        // $validated = $request->validate([
        //     'sender_id' => 'required|string'
        // ]);

        // $transaction->update($validated);
        $transaction->update(["received" => 1]);

        return response()->json([
            'message' => 'Successfully updated transaction!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return response()->json([
            'message' => 'Successfully deleted transaction!'
        ]);
    }
}
