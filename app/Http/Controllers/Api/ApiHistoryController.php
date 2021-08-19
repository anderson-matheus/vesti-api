<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\HistoryRepository;
use Illuminate\Http\Request;

class ApiHistoryController extends Controller
{
    private $historyRepository;

    public function __construct()
    {
        $this->historyRepository = new HistoryRepository();
    }

    public function fetch(Request $request)
    {
        try {
            $histories = $this->historyRepository->fetch($request->all());
            return response()->json(['histories' => $histories], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
