<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;
use Exception;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    protected $request;
    protected $repository;

    public function __construct(Request $request, UserRepository $repository)
    {
      $this->request = $request;
      $this->repository = $repository;
    }

    public function validator($request)
    {
      $response = [];
      $model = new User();
      $request->id ? $model = User::where('id', $request->id)->first() : '';

      $validator = Validator::make($request->all(), 
      [
        'first_name' => 'required',
        'surname' => 'required',
        'username' => [
          'required',
          Rule::unique('pgsql.auth.users')->ignore($model)
        ],
        'birth_date' => 'required',
        'password' => 'required',
        'gender' => 'required'
      ],
      [
        'first_name.required' => 'Field is required.',
        'surname.required' => 'Field is required.',
        'username.required' => 'Field is required.',
        'username.unique' => 'Username has been taken.',
        'birth_date.required' => 'Field is required',
        'password.required' => 'Field is required',
        'gender.required' => 'Field is required'
      ]);
      if($validator->fails()) {
        $errors = $validator->errors();
        $response['result'] = 'error';
        $response['errors'] = [
          'firstName' => $errors->first('first_name'),
          'surname' => $errors->first('surname'),
          'username' => $errors->first('username'),
          'password' => $errors->first('password'),
          'birthDate' => $errors->first('birth_date'),
          'gender' => $errors->first('gender')
        ];
        return $response;
      }
      $response['result'] = 'success';
      return $response;
    }

    public function store(Request $request)
    {
      try {
        $validator = $this->validator($request);
        if($validator['result'] == 'error') {
          $data = [
            'message' => 'error',
            'errors' => $validator['errors']
          ];
          return response($data, 400);
        } else {
          $store = $this->repository->store($request);
          $data = [
            'message' => 'success',
            'data' => $store
          ];
          return response($data, 201);
        }
      } catch(Exception $e) {
        return response($e);
      }
    }
}
