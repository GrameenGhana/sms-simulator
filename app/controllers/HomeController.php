<?php

class HomeController extends BaseController {

    public function showHome() {
        $response = "";
        $cnt = 0;

        $results = DB::select(DB::raw("SELECT a.app_name,count(*) as cnt  FROM sms s inner join application a  on  s.application = a.id  group by s.application"));
        foreach ($results as $value) {
            if ($cnt > 0)
                $response.=",";
            $response.="['" . $value->app_name . "'," . $value->cnt . "]";

            $cnt+=$value->cnt;
        }
        $todays = DB::select(DB::raw("SELECT count(*) as today  FROM sms  where date(created_at)=date(now()) "));
        foreach ($todays as $value) {
            $today = $value->today;
        }
        
        $mnths = DB::select(DB::raw("SELECT count(*) as month  FROM sms  where created_at like '" . date("Y-m") . "%' "));
        foreach ($mnths as $value) {
            $mnth = $value->month;
        } 
//        
//        $mnths = DB::select(DB::raw("SELECT count(id) as month  FROM sms  where created_at like '" . date("Y-m") . "%' group by application"));
//        foreach ($mnths as $value) {
//            $mnth = $value->month;
//        }

        return View::make('index')->with('respond', $response)->with("res", $response)->with("totalsms", $cnt)->with("today", $today)->with("month", $mnth);
        ;
    }

    public function showLogin() {
        return View::make('login');
    }

    public function doLogin() {
        // validate the info, create rules for the inputs
        $rules = array(
            'username' => 'required|alphaNum|min:3',
            'password' => 'required|alphaNum|min:3'
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('login')
                            ->with('flash_error', 'true')
                            ->withErrors($validator)
                            ->withInput(Input::except('password'));
        } else {
            $userdata = array(
                'username' => Input::get('username'),
                'password' => Input::get('password')
            );

            if (Auth::attempt($userdata)) {
                return Redirect::to('/');
            } else {
                return Redirect::to('login')
                                ->with('flash_error', 'true')
                                ->withInput(Input::except('password'));
            }
        }
    }

    public function doLogout() {
        Auth::logout();
        return Redirect::to('login');
    }

}
