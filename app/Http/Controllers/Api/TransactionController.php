<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function update(Request $request, $id, TransactionService $transactionService)
    {
        $transactionService->changeStatus($id, $request->track_id);
        return response()->json(["message" => "success"], 200);
    }

}
