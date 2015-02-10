<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SystemApplicationController
 *
 * @author seth
 */
class SystemApplicationController extends BaseController {

    public function __construct() {
        $this->createRules = array(
            'app_name' => 'required|min:1|max:100',
        );
    }
    
    function create(){
        
           return View::make('apps.create');
    }

    public function index() {
        $cats = SystemApplication::all();
        return View::make('apps.index')
                        ->with('apps', $cats);
    }

    public function store() {
        $errStatus = true;
        $errMsgs = array();

        $validator = Validator::make(Input::all(), $this->createRules);

        if ($validator->fails()) {
//            echo "Validation ".$validator->fails();
            $errors = $validator->messages();
            $errStatus = true;
            $errMsgs = $errors->toArray();

//            Session::flash('message',"{$user->getName()} created successfully");
            return Redirect::to('apps/create')->with('flash_error', 'true')
                            ->withInput()
                            ->withErrors($validator);
            ;
        } else {

            $i = Input::all();
            $data = array();
            foreach ($i as $k => $v) {
                $data[$k] = $v;
            }

            $app = $this->createApp($data, "");

            Session::flash('message', "{$app->app_name} created successfully");
            $cats = SystemApplication::all();
            return View::make('apps.index')
                            ->with('apps', $cats);
        }
    }

    public function show($id) {
        $app = SystemApplication::find($id);
        return View::make('apps.edit')
                        ->with('cat', $app);
    }

    public function createApp($data, $user) {
        $app = new SystemApplication();
        $app->app_name = $data["app_name"];
        $app->created_at = date('Y-m-d H:i:s');
        $app->status = $data["status"];
        $app->created_by = $user;

        $app->save();

        $app->api_key = $this->generateApi($app);
        $app->save();
        return $app;
    }

    public function update($id) {
        $app = SystemApplication::find($id);

        $validator = Validator::make(Input::all(), $this->createRules);

        if ($validator->fails()) {
            return Redirect::to('apps/edit/' . $app->id)->with('cat', $app)->with('flash_error', 'true')
                            ->withInput()
                            ->withErrors($validator);
        } else {
            $app->outbound_url = Input::get("outboundurl");
            $app->app_name = Input::get("app_name");
            $app->status = Input::get("status");
            if (Input::get("genapikey") == "1") {
                $app->api_key = $this->generateApi($app);
            }
            $app->save();

            $cats = SystemApplication::all();
            return View::make('apps.index')
                            ->with('apps', $cats);
        }
    }

    function updateAPIKey() {

        $app = SystemApplication::find(Input::get("id"));
        $app->api_key = $this->generateApi($app);
        $app->save();
    }

    public function generateApi($application) {
        return strtoupper(sha1(md5(str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT) . "-" . $application->status . "-" . $application->app_name . "-" . $application->created_at . $application->id)));
    }

}
