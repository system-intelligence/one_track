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
            'user_names' => 'required|array',
            'user_names.*' => 'string',
            'descriptions' => 'required|array',
            'descriptions.*' => 'nullable|string',
        ]);

        $userNames = implode(', ', array_map('ucwords', $request->user_names));
        $descriptions = array_filter($request->descriptions, function($desc) {
            return trim($desc) !== '';
        });

        if (empty($descriptions)) {
            $descriptions = [''];
        }

        $createdMaintenances = [];

        foreach ($descriptions as $desc) {
            $maintenance = Maintenance::create([
                'date' => $request->date,
                'user_name' => $userNames,
                'description' => trim($desc),
            ]);

            $createdMaintenances[] = $maintenance;

            // Log the creation
            HistoryLog::create([
                'action' => 'CREATE',
                'model_type' => 'Maintenance',
                'model_id' => $maintenance->id,
                'new_values' => $maintenance->toArray(),
                'description' => "Maintenance scheduled for {$maintenance->user_name} on {$maintenance->date}",
            ]);
        }

        return redirect()->back()->with('success', count($createdMaintenances) . ' maintenance(s) scheduled successfully.');
    }
}
