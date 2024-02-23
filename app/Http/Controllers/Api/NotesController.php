<?php

namespace App\Http\Controllers\Api;

use App\Models\Note;
use Illuminate\Http\Request;
use Orion\Http\Controllers\Controller;

class NotesController extends Controller
{
    protected $model = Note::class;
}
