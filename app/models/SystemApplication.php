<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SystemApplication
 *
 * @author seth
 */
class SystemApplication extends Eloquent {
  protected $fillable = array('app_name', 'api_key', 'outbound_url', 'created_at', 'created_by', 'updated_by','status');
   
    protected $table = 'application';

    public function sms() {
        return $this->hasMany('SMS');
    }

}
