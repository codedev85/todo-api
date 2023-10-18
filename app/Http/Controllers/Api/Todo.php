<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Todo\TodoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Todo extends Controller
{
    protected TodoService $todoService;

    public function __construct(TodoService $todoService)
    {
       $this->todoService =  $todoService;
    }

    public function allTodos(): JsonResponse
    {

       $filter = request()->has('filter') ? request()->filter : 'all';

       $todos =  $this->todoService->allTodos($filter,auth()->user());

       $todos['status'] ?

       $response = $this->sendResponse($todos['data'], $todos['message']) :

       $response = $this->sendError($todos['message'],$todos['errors'] ,$todos['statusCode']);

       return $response;
    }

    public function addTodos(Request $request): JsonResponse
    {

        $addTodos =  $this->todoService->addTodos($request->all(),auth()->user());

        $addTodos['status'] ?

        $response = $this->sendResponse($addTodos['data'], $addTodos['message']) :

        $response = $this->sendError($addTodos['message'],$addTodos['errors'] ,$addTodos['statusCode']);

        return $response;
    }


    public function markAsComplete($todo_id): JsonResponse
    {

        $markAsComplete =  $this->todoService->markAsComplete($todo_id);

        $markAsComplete['status'] ?

        $response = $this->sendResponse($markAsComplete['data'], $markAsComplete['message']) :

        $response = $this->sendError($markAsComplete['message'],$markAsComplete['errors'] ,$markAsComplete['statusCode']);

        return $response;
    }


    public function deleteTodo($todo_id): JsonResponse
    {

        $deleteTodo =  $this->todoService->deleteTodo($todo_id);

        $deleteTodo['status'] ?

        $response = $this->sendResponse($deleteTodo['data'], $deleteTodo['message']) :

        $response = $this->sendError($deleteTodo['message'],$deleteTodo['errors'] ,$deleteTodo['statusCode']);

        return $response;
    }




}
