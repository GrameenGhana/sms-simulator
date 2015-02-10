<?php

class UserController extends BaseController {

    public function __construct()
    {
//        $this->beforeFilter('auth');

        $this->roles = array('Admin'=>'Admin','Guest'=>'Guest','Manager'=>'Manager','API'=>'API User');

        $this->rules = array('username' => 'required|min:3|unique:users',
                    'password' => 'required|min:6',
                    'confirmpassword' => 'required|same:password',
                    'first_name' => 'required|min:2',
                    'last_name' => 'required|min:2',
                    'role' => 'required|min:2'
                   );

    }

    public function index()
    {
       $users = User::all();
       return View::make('users.index',array('users'=>$users));
    }

    public function create()
    {
       return View::make('users.create', array('roles'  => $this->roles));
    }

    public function edit($id)
    {
       $user = User::find($id);
       return View::make('users.edit',array('user'=> $user, 'roles'=>$this->roles));
    }

    public function store()
    {
            $validator = Validator::make(Input::all(), $this->rules);

            if ($validator->fails()) {
                //dd($validator->messages()->toJson());
                return Redirect::to('/appusers/create')
                        ->with('flash_error','true')
                        ->withInput()
                        ->withErrors($validator);
            } else {
                $user = new User;
                $user->username = Input::get('username');
                $user->password = Hash::make(Input::get('password'));
                $user->first_name = Input::get('first_name');
                $user->last_name = Input::get('last_name');
                $user->role = Input::get('role');
                $user->created_at = date('Y-m-d h:m:s');
                $user->modified_by = Auth::user()->id;
                $user->save();

                Session::flash('message',"{$user->getName()} created successfully");
                return Redirect::to('/appusers');
            }
    }

    public function update($id)
    {
           $this->rules = array('username' => 'required|min:3|unique:users,username,'.$id,
                    'password' => 'required|min:6',
                    'confirmpassword' => 'required|same:password',
                    'first_name' => 'required|min:2',
                    'last_name' => 'required|min:2',
                    'role' => 'required|min:2'
            );

            $validator = Validator::make(Input::all(), $this->rules);

            if ($validator->fails()) {
                return Redirect::to('appusers/'.$id.'/edit')
                        ->with('flash_error','true')
                        ->withInput()
                        ->withErrors($validator);
            } else {
                $user = User::find($id);
                $user->username = Input::get('username');
                $user->password = Hash::make(Input::get('password'));
                $user->first_name = Input::get('first_name');
                $user->last_name = Input::get('last_name');
                $user->role = Input::get('role');
                $user->modified_by = Auth::user()->id;
                $user->save();

                Session::flash('message',"{$user->getName()} updated successfully");
                return Redirect::to('/appusers');
            }
    }
}                                                            
