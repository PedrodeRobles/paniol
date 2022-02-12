<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Person;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();
        $people = Person::all();
        

        return view('transaction.index', [
            'orders' => $orders,
            'people' => $people
        ]);
    }

    // public function create()
    // {
    //     //
    // }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'person_id' => 'required',
        ]);

        Transaction::create($request->all());

        return redirect()->route('transaction.index');
    }

    public function show(Transaction $transaction)
    {
        return view('transaction.show', compact('transaction'));
    }

    // public function edit(Transaction $transaction)
    // {
    //     //
    // }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'order_id' => 'required',
            'person_id' => 'required',
        ]);
        
        $transaction->update($request->all());

        return redirect()->route('transaction.blade');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transaction.blade');
    }
}
