<?php

namespace App\Services\Todo;




use App\Models\Todo;
use Illuminate\Support\Facades\Validator;

class TodoService
{

    public function allTodos($filter ,$user): array
    {
        try {

            $filter === Todo::STATUS_ALL ?

            $todos = Todo::where('user_id',$user['id'])->get() :

            $todos = Todo::where(['user_id' => $user['id'] , 'status' => $filter])->get();

            return [
                'status'  => true,
                'message' =>'Todos fetched successfully',
                'errors'  => 'Todos fetched  successfully',
                'statusCode' => '201',
                'data' =>  $todos
            ];

        } catch (\Throwable $th) {

            return [
                'status' => false,
                'message' => 'An issue occurred',
                'errors' => $th->getMessage(),
                'statusCode' => 500,
                'data'=> null
            ];
        }
    }

    public function addTodos($data,$user): array
    {
        try {

            $validateData = Validator::make($data,
                [
                    'title' => 'required|string',
                    'from' => 'required|datetime',
                    'to' => 'required|datetime',

                ]);

            if($validateData->fails()){
                return [
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateData->errors(),
                    'statusCode' => 400
                ];
            }

            $todo = new Todo();
            $todo->title   = $data['title'];
            $todo->from    = $data['from'];
            $todo->to      = $data['to'];
            $todo->user_id = $user['id'];
            $todo->save();


            return [
                'status'  => true,
                'message' =>'Todo created successfully',
                'errors'  => 'Todos created successfully',
                'statusCode' => '201',
                'data' =>  $todo
            ];

        } catch (\Throwable $th) {

            return [
                'status' => false,
                'message' => 'An issue occurred',
                'errors' => $th->getMessage(),
                'statusCode' => 500,
                'data'=> null
            ];
        }
    }

    public function markAsComplete($todo_id): array
    {
        try {

             $todo = Todo::where('id',$todo_id)->first();

             if(!$todo){
                 return [
                     'status' => false,
                     'message' => 'Todo Not Found',
                     'errors' => 'Todo Not Found',
                     'statusCode' => 404,
                     'data'=> null
                 ];
             }

            $todo->update(['status' => Todo::COMPLETE]);

            return [
                'status'  => true,
                'message' =>'Todo mark as complete successfully',
                'errors'  => 'Todo mark as complete successfully',
                'statusCode' => '201',
                'data' =>  $todo
            ];

        } catch (\Throwable $th) {

            return [
                'status' => false,
                'message' => 'An issue occurred',
                'errors' => $th->getMessage(),
                'statusCode' => 500,
                'data'=> null
            ];
        }
    }


    public function deleteTodo($todo_id): array
    {
        try {

            $todo = Todo::where('id',$todo_id)->first();

            if(!$todo){
                return [
                    'status' => false,
                    'message' => 'Todo Not Found',
                    'errors' => 'Todo Not Found',
                    'statusCode' => 404,
                    'data'=> null
                ];
            }

            $todo->delete();

            return [
                'status'  => true,
                'message' =>'Todo deleted successfully',
                'errors'  => 'Todo deleted successfully',
                'statusCode' => '201',
                'data' =>  $todo
            ];

        } catch (\Throwable $th) {

            return [
                'status' => false,
                'message' => 'An issue occurred',
                'errors' => $th->getMessage(),
                'statusCode' => 500,
                'data'=> null
            ];
        }
    }
}
