<?php

namespace App\Http\Controllers\Api;

use App\Models\Note;
use App\Models\Todo;
use Orion\Http\Controllers\Controller;
use Orion\Http\Requests\Request as Request;

class TodosController extends Controller
{
    protected $model = Todo::class;
}
