<?php

namespace App\Services;

use App\Models\Stock;
use App\Models\Timeline;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;

class TransactionService
{

    public function changeStatus($transaction_id, $track_id): void
    {

        $transaction = Transaction::where('id', $transaction_id)->firstOrFail();
        if ($track_id == 3 && $transaction->order_type == 1) {
            Stock::where("size_id", $transaction->size_id)->decrement('stock', 1);
        }

        $transaction->track_id = $track_id;
        $transaction->save();

        Timeline::create([
            "track_id" => $transaction->track_id,
            "transaction_id" => $transaction->id
        ]);

    }

}
