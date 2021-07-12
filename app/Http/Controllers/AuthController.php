<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;

use app\Models\User;

class AuthController extends Controller
{
  public function index(Request $request)
	{
		if (Auth::check()){
			return redirect('/');
		}
		
		return view('login.login');
	}

	public function login(Request $request)
	{
		if (Auth::check()){
			return redirect('/');
		}
		
		// Validates input.
		$rules = array(
			'email' => 'required|email|max:100',
			'password' => 'required|max:100'
		);
		$validator = Validator::make($request->all(), $rules);
		// Validation fails?
		if ($validator->fails()){
			return redirect()
				->back()
				->withErrors($validator)
				->withInput($request->except('password'));
		}
			//dd($request->all());
		if (!Auth::attempt($request->all())){
			//$request->session()->flash('errorMessages', array(trans('messages.errorInvalidLogin')));
			$request->session()->flash('errorLogin', 'Email atau Password Salah');
			return redirect()->back()
				->withInput($request->except('password'));
		};
    
		$request->session()->put('role', Auth::user()->getRole());
		$request->session()->put('name', Auth::user()->getName());
		return redirect()->intended(); 
	}
		
	public function logout(Request $request)
	{
		$request->session()->flush();
		Auth::logout();
		return redirect('/');
	}
}
