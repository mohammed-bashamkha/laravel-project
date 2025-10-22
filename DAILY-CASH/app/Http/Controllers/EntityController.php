<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntityController extends Controller
{
    public function index() {
        $entities = Auth::user()->entities;
        return response()->json($entities);
    }

    public function store(Request $request) {
        $user_id = Auth::user()->id;
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:worker,project',
            'phone' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);
        $data['user_id'] = $user_id;

        $entity = Entity::create($data);
        return response()->json($entity, 201);
    }

    public function update(Request $request, $id) {
        $user_id = Auth::user()->id;
        $entity = Entity::findOrFail($id);
        if ($entity->user_id !== $user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'type' => 'sometimes|required|in:worker,project',
            'phone' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);
        $entity->update($data);
        return response()->json($entity);
    }

    public function show($id) {
        $user_id = Auth::user()->id;
        $entity = Entity::findOrFail($id);
        if ($entity->user_id !== $user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return response()->json($entity);
    }

    public function destroy($id) {
        $user_id = Auth::user()->id;
        $entity = Entity::findOrFail($id);
        if ($entity->user_id !== $user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $entity->delete();
        return response()->json(['message' => 'Entity deleted successfully']);
    }
}
