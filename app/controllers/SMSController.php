<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SMSController
 *
 * @author seth
 */
class SMSController extends BaseController {

    public function __construct() {
        $this->createRules = array(
            'from' => 'required|min:1|max:11',
            'message' => 'required',
            'to' => 'required|numeric',
        );
    }

    public function index() {
        $cats = SMS::paginate(5);
        return View::make('sms.index')
                        ->with('sms', $cats)->with("selectedApp",0);
    }

    public function create() {

        return View::make('sms.create');
    }

    public function searchByApplication($id) {
        $sms = SMS::whereRaw('application = ? ', array($id))->paginate(5);
        return View::make('sms.index')
                        ->with('sms', $sms)->with("selectedApp",$id);
    }

    public function respond($id, $app) {
        $sms = SMS::whereRaw('recipient = ? and application= ?', array($id, $app))->get();
        $apps = SystemApplication::find($app);
        return View::make('sms.trace')
                        ->with('sms', $sms)->with('app', $apps)->with('recipient', $id);
    }

    public function search() {
        $sms = SMS::whereRaw(' (recipient like ? or sender like ? or message like ?) and application = ? ', array('%' . Input::get("q") . '%', '%' . Input::get("q") . '%', '%' . Input::get("q") . '%', Input::get("a")))->paginate(5);
//        $apps = SystemApplication::find($app);

        return View::make('sms.index')
                        ->with('sms', $sms);
    }

    public function store() {
        $errStatus = true;
        $errMsgs = array();

        $validator = Validator::make(Input::all(), $this->createRules);

        if ($validator->fails()) {
            $errors = $validator->messages();
            $errStatus = true;
            $errMsgs = $errors->toArray();
        } else {
            $i = Input::all();
            $data = array();
            foreach ($i as $k => $v) {
                $data[$k] = $v;
            }
            if (Input::get("type") == "w") {
                $data["source"] = "WEB";
                $app = SystemApplication::find($data["from"]);
            } else {
                $data["source"] = "API";
                $app = SystemApplication::whereRaw('api_key = ? ', array($data["api_key"]))->first();
            }


            if (null != $app) {
                $errStatus = true;
                $this->createSMS($data, $app->id);
                $errMsgs = "API Created";
            } else {
                $errMsgs = "Invalid API";
                $errStatus = false;
            }
        }
        if (Input::get("type") == "w") {
            $cats = SMS::paginate(5);
            ;
            return View::make('sms.index')
                            ->with('sms', $cats);
        }

        return json_encode(array("error" => $errMsgs, "message" => $errMsgs));
    }

    public function createSMS($data, $application) {
        $sub = new SMS;
        $sub->application = $application;
        $sub->sender = $data['from'];
        $sub->recipient = $data['to'];
        $sub->message = $data['message'];
        $sub->source = $data['source'];
        $sub->direction = (@isset($data["direction"])) ? $data["direction"] : "IN";
        $sub->created_at = date('Y-m-d H:i:s');
        $sub->updated_by = $application;
        $app = SystemApplication::find($application);
        if (strlen($app->outbound_url) > 0 && $sub->direction == "OUT") {
            $ar = array("msg" => $data["message"],
                "msisdn" => $sub->recipient,
                "date" => time());
            $this->processOutbound($app->outbound_url, $ar);
        }

        $sub->save();
    }

    function processOutbound($url, $ar) {

        foreach ($ar as $key => $value) {
            $url = str_replace("#$key", $value, $url);
        }
        $http = new HTTPComm();
        $http->fire($url);
    }

    public function groupMsgByApp() {
        $response = "";
        $cnt = 0;
        $results = DB::select(DB::raw("SELECT a.app_name,count(*) as cnt  FROM sms s inner join application a  on  s.application = a.id WHERE group by a.application"));
        foreach ($result as $value) {
            if ($cnt > 0)
                $response.=",";
            $response.="['" . $value["app_name"] . "'," . $value["cnt"] . "]";
            $cnt++;
        }
    }

}
