<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Item;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
    public function index()
    {
        $item = Item::all();
        return response()->json([
            'message' => 'Items retrieved successfully',
            'data' => TaskResource::collection($item)
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'sku' => 'required|string|unique:items,sku',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);
        $item = Item::create($validated);
        return response()->json([
            'message' => 'Item created successfully',
            'data' => new TaskResource($item)
        ], 201);
    }

    public function show($id)
    {
        $item = Item::find($id);
        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }
        return response()->json([
            'message' => 'Item retrieved successfully',
            'data' => new TaskResource($item)
        ]);
    }

    public function update(Request $request, $id)
    {
        $item = Item::find($id);
        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }
        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'sku' => 'sometimes|required|string|unique:items,sku',
            'description' => 'sometimes|nullable|string',
            'price' => 'sometimes|required|numeric',
            'stock' => 'sometimes|required|integer',
        ]);
        $item->update($validated);
        return response()->json([
            'message' => 'Item updated successfully',
            'data' => new TaskResource($item)
        ]);
    }

    public function destroy($id)
    {
        $item = Item::find($id);
        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }
        $item->delete();
        return response()->json(['message' => 'Item deleted successfully']);
    }
}
