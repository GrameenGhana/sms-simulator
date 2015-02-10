<?php

class HTTPComm {

    public  function fire($url) {
//        echo $url;
        return $this->myget($url);
        
    }

    protected  function myget($url) {
        $opts = array('http' => array('method' => "GET", 'timeout' => 10));
        $context = stream_context_create($opts);
        try {
            $file = file_get_contents($url, false, $context);
        } catch (Exception $e) {
            $file = 0;
        }
        return $file;
    }

    /**
     * Send a POST requst using cURL 
     * @param string $url to request 
     * @param array $post values to send 
     * @param array $options for cURL 
     * @return string 
     */
    protected function curl_post($url, $post = NULL, $options = array()) {
        $defaults = array(
            CURLOPT_POST => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_URL => $url,
            CURLOPT_FRESH_CONNECT => 1,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FORBID_REUSE => 1,
            CURLOPT_TIMEOUT => 4,
            CURLOPT_POSTFIELDS => @http_build_query($post));

        $ch = curl_init();
        curl_setopt_array($ch, ($options + $defaults));

        if (!$result = curl_exec($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);

        return $result;
    }

}
