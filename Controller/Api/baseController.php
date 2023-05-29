<?php
class BaseController {
    public function __call($name, $arguments) // it’s called when you try to call a method that doesn't exist
    {
        $this->sendOutput('', array('HTTP/1.1 404 Not Found'));
    }
    /** 
* Get URI elements. 
* 
* @return array 
*/
    protected function getUriSegments() //  It’s useful when we try to validate the REST endpoint called by the user
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode( '/', $uri );
        return $uri;
    }
    /** 
* Get querystring params. 
* 
* @return array 
*/
    protected function getQueryStringParams() // used to get the query string parameters
    {
        return parse_str($_SERVER['QUERY_STRING'], $query);
    }
    /** 
* Send API output. 
* 
* @param mixed $data 
* @param string $httpHeader 
*/
    protected function sendOutput($data, $httpHeaders=array()) // used to send the API response
    {
        header_remove('Set-Cookie');
        if (is_array($httpHeaders) && count($httpHeaders)) {
            foreach ($httpHeaders as $httpHeader) {
                header($httpHeader);
            }
        }
        echo $data;
        exit;
    }
}