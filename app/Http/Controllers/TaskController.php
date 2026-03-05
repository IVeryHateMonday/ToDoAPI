<?php

namespace App\Http\Controllers;

use App\Application\Tasks\UseCases\CreateTaskCommand;
use App\Application\Tasks\UseCases\CreateTaskHandler;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request, CreateTaskHandler $handler)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
        ]);

        $task = $handler->handle(
            new CreateTaskCommand($validated['title'])
        );

        return response()->json([
            'title'  => $task->getTitle()->getValue(),
            'status' => $task->getStatus()->value,
        ], 201);
    }

    public function findById(Request $request)
    {

    }
}
