<?php

namespace App\Repositories;
use Exception;
use App\Models\User;

class UserRepository
{
  protected $model;

  public function __construct()
  {
    $this->model = new User();
  }

  public function initModel($id = null)
  {
    $model = $this->model;
    if(!empty($id)) $model = $this->model->where('id', $id)->first();
    return $model;
  }

  public function store($request, $id = null)
  {
    try {
      $data = $this->initModel($id);
      $data->first_name = $request->first_name;
      $data->surname = $request->surname;
      $data->username = $request->username;
      $data->birth_date = $request->birth_date;
      $data->gender = $request->gender;
      $data->password = password_hash($request->password, PASSWORD_DEFAULT);
      $data->save();
      return $data;
    } catch(Exception $e) {
      throw new Exception($e->getMessage());
    }
  }
}