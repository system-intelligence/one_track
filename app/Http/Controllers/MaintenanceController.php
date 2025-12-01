<?php

namespace App\Http\Controllers;

use App\Models\HistoryLog;
use App\Models\Maintenance;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'user_name' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $maintenance = Maintenance::create($request->all());

        // Log the creation
        HistoryLog::create([
            'action' => 'CREATE',
            'model_type' => 'Maintenance',
            'model_id' => $maintenance->id,
            'new_values' => $maintenance->toArray(),
            'description' => "Maintenance scheduled for {$maintenance->user_name} on {$maintenance->date}",
        ]);

        return redirect()->back()->with('success', 'Maintenance scheduled successfully.');
    }
}
