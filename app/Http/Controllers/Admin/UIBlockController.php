<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UIBlock;
use App\Http\Requests\StoreUIBlockRequest;
use App\Http\Requests\UpdateUIBlockRequest;
use Illuminate\Http\Request;

class UIBlockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blocks = UIBlock::orderBy('display_order', 'asc')->get();
        return view('admin.blocks.index', compact('blocks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blocks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUIBlockRequest $request)
    {
        $validated = $request->validated();
        
        // Handle checkbox status
        $validated['status'] = $request->has('status');

        // Set display_order to max + 1 if not provided
        if (!isset($validated['display_order'])) {
            $validated['display_order'] = UIBlock::max('display_order') + 1;
        }

        UIBlock::create($validated);

        return redirect()->route('admin.blocks.index')
            ->with('success', 'UI Block created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UIBlock $block)
    {
        return view('admin.blocks.edit', compact('block'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUIBlockRequest $request, UIBlock $block)
    {
        $validated = $request->validated();
        $validated['status'] = $request->has('status');

        $block->update($validated);

        return redirect()->route('admin.blocks.index')
            ->with('success', 'UI Block updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UIBlock $block)
    {
        $block->delete();

        return response()->json([
            'success' => true,
            'message' => 'UI Block deleted successfully.'
        ]);
    }

    /**
     * Toggle the active status of a block.
     */
    public function toggleStatus(UIBlock $block)
    {
        $block->status = !$block->status;
        $block->save();

        return response()->json([
            'success' => true,
            'status' => $block->status,
            'message' => 'Block status updated successfully.'
        ]);
    }

    /**
     * Update order of UI blocks via AJAX.
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer|exists:ui_blocks,id'
        ]);

        foreach ($request->order as $index => $id) {
            UIBlock::where('id', $id)->update(['display_order' => $index + 1]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Blocks reordered successfully.'
        ]);
    }
}
