<?php

namespace App\Http\Controllers;

use App\Models\HistoryLog;
use Illuminate\Http\Request;

class HistoryLogController extends Controller
{
    public function index()
    {
        $logs = HistoryLog::orderBy('created_at', 'desc')->paginate(20);
        return view('history-logs', compact('logs'));
    }
}
