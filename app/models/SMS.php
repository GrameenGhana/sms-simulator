<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SMS
 *
 * @author seth
 */
class SMS extends Eloquent {

    protected $fillable = array('sender', 'recipient', 'message', 'created_at', 'application', 'created_by','source');
    protected $table = 'sms';

    public function applicationDetail() {
        return $this->belongsTo('SystemApplication', 'application','id');
    }

}
