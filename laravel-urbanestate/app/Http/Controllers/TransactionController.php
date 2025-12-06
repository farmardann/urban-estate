<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();

        return view('transaction.transaction', compact('transactions'));
    }
    public function cetak()
    {
        $transaction = Transaction::all();
        $pdf = Pdf::loadview('transaction.transaction-cetak', compact('transaction'));
        return $pdf->download('laporan-transaksi.pdf');
    }
    
}
