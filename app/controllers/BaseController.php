<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
      

	public function isBrowser()
	{
    	$browser = get_browser(null, true);

       	if ($browser['browser']!='Default Browser') {
            return true;
       	} 

       	return false;
   }


   /** 
    * Send a POST requst using cURL 
    * @param string $url to request 
    * @param array $post values to send 
    * @param array $options for cURL 
    * @return string 
    */ 
   protected function curl_post($url, $post = NULL, $options = array()) 
   { 
        $defaults = array( 
                  CURLOPT_POST => 1, 
                  CURLOPT_HEADER => 0, 
                  CURLOPT_URL => $url, 
                  CURLOPT_FRESH_CONNECT => 1, 
                  CURLOPT_RETURNTRANSFER => 1, 
                  CURLOPT_FORBID_REUSE => 1, 
                  CURLOPT_TIMEOUT => 4, 
                  CURLOPT_POSTFIELDS => @http_build_query($post) ); 

        $ch = curl_init(); 
        curl_setopt_array($ch, ($options + $defaults)); 

        if( ! $result = curl_exec($ch)) 
        { 
            return curl_error($ch); 
        } 
        curl_close($ch); 

        return $result; 
   } 

   /** 
     * Send a POST requst using cURL 
     * @param string $url to request 
     * @param array $post values to send 
     * @param array $options for cURL 
     * @return string 
     */
    public function curl_json_post($url, $post)
    {
        $data = json_encode($post);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Accept: application/json',
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
        );                                                                                  
        
        if( ! $result = curl_exec($ch))
        {
            return curl_error($ch);
        }

        curl_close($ch);

        return $result;
    }
}
