<?php

namespace App\Http\Controllers;

use App\Models\Asset;
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
            'type' => 'required|in:Laptop,Desktop,Monitor',
            'os' => 'nullable|string',
            'processor' => 'nullable|string',
            'ram' => 'nullable|string',
            'gpu' => 'nullable|string',
            'ups' => 'nullable|string',
            'avr' => 'nullable|string',
            'last_maintenance' => 'nullable|date',
            'condition' => 'required|in:Excellent,Good,Fair',
        ]);

        Asset::create($request->only(['office', 'user', 'type', 'os', 'processor', 'ram', 'gpu', 'ups', 'avr', 'last_maintenance', 'condition']));

        return redirect('/asset')->with('success', 'Asset created successfully.');
    }

    public function edit(Asset $asset)
    {
        // Placeholder for edit view
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
            'ups' => 'nullable|string',
            'avr' => 'nullable|string',
            'last_maintenance' => 'nullable|date',
            'condition' => 'required|in:Excellent,Good,Fair',
        ]);

        $asset->update($request->only(['office', 'user', 'type', 'os', 'processor', 'ram', 'gpu', 'ups', 'avr', 'last_maintenance', 'condition']));

        return redirect('/asset')->with('warning', 'Asset updated successfully.');
    }

    public function destroy(Asset $asset)
    {
        $asset->delete();
        return redirect('/asset')->with('error', 'Asset deleted successfully.');
    }
}
