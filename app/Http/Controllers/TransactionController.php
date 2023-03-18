<?php

namespace App\Http\Controllers;


use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {  
        $userId = Auth::id();

        if($id){
            $transactions = Transaction::where(['category_id'=>$id,'user_id'=>$userId])->get();
        }
        else{
            $transactions = Transaction::where(['user_id'=>$userId])->paginate(10);
        }
        return view('transactions.index',compact('transactions'));
    }

   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $transaction = new Transaction();
        return view('transactions.create', compact('categories','transaction'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge(['user_id'=>Auth::id()]);

        $request->validate([
            'user_id'=>'required',
            'description'=>'required',
            'category_id'=>'required',
            'amount'=>'required|numeric'
        ]);
        
        Transaction::create($request->all());

        return redirect()->route('transactions.index')->with(['status'=>'Transaction created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        $categories = Category::all();
        
        return view('transactions.edit', compact('transaction','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransactionRequest  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'description'=>'required',
            'category_id'=>'required',
            'amount'=>'required|integer'
        ]);

        $transaction->update($request->all());

        return redirect()->route('transactions.index')->with(['status'=>'Transaction updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with(['status'=>'Transaction deleted']);
    }
}
