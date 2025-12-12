<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\HistoryLog;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function create()
    {
        return view('asset-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'office' => 'required|string',
            'user' => 'nullable|string',
            'type' => 'required|in:Laptop,Desktop',
            'os' => 'nullable|string',
            'processor' => 'nullable|string',
            'ram' => 'nullable|string',
            'gpu' => 'nullable|string',
            'peripherals' => 'nullable|array',
            'peripherals.*.type' => 'required|string',
            'peripherals.*.details' => 'nullable|string',
            'peripherals.*.condition' => 'nullable|in:working,needs repair,broken',
            'surge_protector' => 'nullable|in:UPS,AVR,None',
            'condition' => 'nullable|in:working,needs repair,broken',
        ]);

        $asset = Asset::create($request->only(['office', 'user', 'type', 'os', 'processor', 'ram', 'gpu', 'peripherals', 'surge_protector']));

        // Log the creation
        HistoryLog::create([
            'action' => 'CREATE',
            'model_type' => 'Asset',
            'model_id' => $asset->id,
            'new_values' => $asset->toArray(),
            'description' => "Asset #{$asset->id} created in {$asset->office} office",
        ]);

        return redirect('/asset')->with('success', 'Asset created successfully.');
    }

    public function edit(Asset $asset)
    {
        return view('asset-edit', compact('asset'));
    }

    public function update(Request $request, Asset $asset)
    {
        $request->validate([
            'office' => 'required|string',
            'user' => 'nullable|string',
            'type' => 'required|in:Laptop,Desktop,Monitor',
            'os' => 'nullable|string',
            'processor' => 'nullable|string',
            'ram' => 'nullable|string',
            'gpu' => 'nullable|string',
            'peripherals' => 'nullable|array',
            'peripherals.*.type' => 'required|string',
            'peripherals.*.details' => 'nullable|string',
            'peripherals.*.condition' => 'nullable|in:working,needs repair,broken',
            'surge_protector' => 'nullable|in:UPS,AVR,None',
            'condition' => 'nullable|in:working,needs repair,broken',
        ]);

        $oldValues = $asset->toArray();
        $asset->update($request->only(['office', 'user', 'type', 'os', 'processor', 'ram', 'gpu', 'peripherals', 'surge_protector']));

        // Log the update
        HistoryLog::create([
            'action' => 'UPDATE',
            'model_type' => 'Asset',
            'model_id' => $asset->id,
            'old_values' => $oldValues,
            'new_values' => $asset->toArray(),
            'description' => "Asset #{$asset->id} updated",
        ]);

        return redirect('/asset')->with('warning', 'Asset updated successfully.');
    }

    public function destroy(Asset $asset)
    {
        $oldValues = $asset->toArray();

        // Log the deletion before deleting
        HistoryLog::create([
            'action' => 'DELETE',
            'model_type' => 'Asset',
            'model_id' => $asset->id,
            'old_values' => $oldValues,
            'description' => "Asset #{$asset->id} deleted from {$asset->office} office",
        ]);

        $asset->delete();
        return redirect('/asset')->with('error', 'Asset deleted successfully.');
    }
}
