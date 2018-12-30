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
            'passport_id' => 'required|string',
            'sender_id' => 'required|string',
            'receiver_id' =>  'required|string',
            'send_date' =>  'required|string',
            'attachments' =>  'string'
        ]);

        $transaction = new Transaction($validated);

        $transaction->save();

        return response()->json([
            'message' => 'Successfully created transaction!'
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
        $validated = $request->validate([
            'passport_id' => 'required|string',
            'sender_id' => 'required|string',
            'receiver_id' =>  'required|string',
            'sent_date' =>  'required|string',
            'attachments' =>  'string'
        ]);

        $transaction->update($validated);

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
        $passport->delete();

        return response()->json([
            'message' => 'Successfully deleted transaction!'
        ]);
    }
}
