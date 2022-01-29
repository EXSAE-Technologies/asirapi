<?php

namespace App\Http\Controllers;

use Fshangala\Cws\Core\WalletCore;
use Fshangala\Cws\Models\Wallet;
use Fshangala\Cws\Models\Transaction;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware('auth');
    }

    public function allWallets()
    {
        $this->authorize('permission',[['action'=>'read','resource'=>'wallets']]);
        $entries = Wallet::all();
        return response($entries);
    }

    public function allTransactions()
    {
        $this->authorize('permission',[['action'=>'read','resource'=>'transactions']]);
        $entries = Transaction::all();
        return response($entries);
    }

    public function getUserWallet(Request $request)
    {
        $entry = Wallet::where('user_id',$request->user()->id)->firstOrFail();
        $this->authorize('permission',[['action'=>'read','resource'=>'wallets','target'=>$entry->id]]);
        $entry['transactions'] = $entry->transactions;
        $wallet = new WalletCore();
        $balance = $wallet->totalWalletBalance($request->user()->id);
        $entry['balance'] = $balance['debit'] - $balance['credit'];
        return response($entry);
    }

    public function billWallet(Request $request)
    {
        $validData = $this->validate($request,[
            'wallet_id'=>'required|exists:wallets,id',
            'currency'=>'required',
            'credit'=>'required',
            'reference'=>'required',
        ]);
        $validData['debit']=0;
        $validData['status']='pending';
        $entry = Transaction::create($validData);
        return response($entry);
    }

}
