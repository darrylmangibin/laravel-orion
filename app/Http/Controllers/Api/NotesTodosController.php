<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;

class NotesTodosController extends Controller
{
    public function store(Note $note, Request $request)
    {
        $todo = $note->todos()->create($request->all());

        return response()->json($todo);
    }

    public function index(Note $note)
    {
        return response()->json($note->todos()->paginate());
    }
}
