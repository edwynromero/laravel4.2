<?php

class UserController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getIndex()
	{
		$users = User::orderBy('id','DESC')->get();
		return View::make('users.index')->with('users',$users);

	}

	public function getShow($id = null)
	{
		$user = User::find($id)->get();
		return View::make('users.show')->with('users',$user);
	}

	public function getCreate($id)
	{
		return View::make('users.create')->with('user',$user);
	}

	public function getEdit($id = null)
	{
     return View::make('users.edit')->with('user',$user);
	}

	public function store()
	{
		$user = new User;
		$user->name = Input::get('name');
		$user->twitter = Input::get('twitter');
		if ($user->save())
		{
		Session::flash('message','Se ha registrado de forma correcta');
		Session::flash('class','success');
		} else{
		Session::flash('message','No se ha registrado de forma correcta');
		Session::flash('class','danger');
		}
		return Redirect::to('users.create');

	}

	public function update($id)
	{
		$user = User::find($id);
		$user->name = Input::get('name');
		$user->twitter = Input::get('twitter');
		if ($user->save())
		{
		Session::flash('message','Se Actualizado de forma correcta');
		Session::flash('class','success');
		} else{
		Session::flash('message','No se actualizo de forma correcta');
		Session::flash('class','danger');
		}
		return Redirect::to('users.edit'.$id);

	}

	public function Destroy($id)
	{
		$user = User($id);
		if($user->delete())
		{
		Session::flash('message','Se elimino de forma correcta');
		Session::flash('class','success');
		} else{
		Session::flash('message','No se elimino de forma correcta');
		Session::flash('class','danger');
		}
		return Redirect::to('users');
	
	}

}
