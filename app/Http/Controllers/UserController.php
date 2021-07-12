<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\User;
use DB;
use DataTables;
use Validator;

class UserController extends Controller
{
  public function index(Request $request)
	{
		return view('user.index');
	}

  public function grid()
  {
    return Datatables::of(User::all())->make(true);
  }

  public function edit(Request $request, $id = null)
  {
    $db = new \StdClass();
    $data = $this->field($db);
    if($id){
      $data = User::where('id', $id)->firstOrFail();
    }
    
    return view('user.edit')->with('data', $data);
  }
  
  private function field($db)
  {
    $db->id = null;
    $db->name = null;
    $db->email = null;
    $db->role = null;

    return $db;
  }

  public function save(Request $request)
  {
    $inputs = $request->all();
    if($inputs['id']){
      $rules = array(
        'name' => 'required',
        'email' => 'required|email'
      );
    } else {
      $rules = array(
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required'
      );
    }

		$validator = validator::make($inputs, $rules);
		if ($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($inputs);
		}

    if($inputs['id']){
      $user = User::findOrFail($inputs['id']);

      $user->name = $inputs['name'];
      $user->email = $inputs['email'];
      $user->role = $inputs['role'];
      $user->saveQuietly();
    } else {
      $user = User::create([
        'email' => $inputs['email'],
        'name' => $inputs['name'],
        'role' => $inputs['role'],
        'password' => bcrypt($inputs['password']),
      ]);
    }
    
		$request->session()->flash('status','Berhasil menambah user baru');
		return redirect()->action([UserController::class, 'index']);
  }

  public function delete($id)
  {
    $user = User::find($id);
    $status = "nok";
    if($user){
      $user->delete();
      $status = "ok";
    }

		return response()->json($status);
  }
}
