<?php
require_once 'client.php';
class Http{
  // DON'T CHANGE THIS
  const OAUTH_API_KEY    = 'NTM3MzI5MGMwZDFmYjNj';
  const OAUTH_API_SECRET = 'ff187f0b484dd77e8554796b78c750f00b4bf965';
  const OAUTH_PROVIDER     = 'https://vladan.brid.tv';
  const API_ENDPOINT       = 'https://vladan.brid.tv/apiv2';
  const AUTHORIZATION_PATH = '/api/authorize';
  const TOKEN_PATH         = '/api/token';
  
  public $output = 'array';

  /**
   *  To grab oauth_token @see https://brid.zendesk.com/hc/en-us/articles/200645271-Generate-Authorization-Url-Request-Access-Token
   */
  public function __construct($options=array()) {
    if(isset($options['auth_token']) && $options['auth_token']=='ENTER YOUR AUTH CODE HERE'){
      throw new Exception('Invalid token.');
    }
    $this->oauth_token    = isset($options['auth_token']) ? $options['auth_token'] : ''; // access_token
    $this->oauth_provider = isset($options['oauth_provider']) ? $options['oauth_provider'] : self::OAUTH_PROVIDER;
    $this->api_endpoint   = isset($options['api_endpoint']) ? $options['api_endpoint'] :  self::API_ENDPOINT;
    if(isset($options['output'])){
    	$this->output = $options['output'];
    }
    $this->client         = new OAuth2Client(self::OAUTH_API_KEY, self::OAUTH_API_SECRET, OAuth2Client::AUTH_TYPE_FORM);
    $this->client->setAccessTokenType(OAuth2Client::ACCESS_TOKEN_BEARER);
    $this->client->setAccessToken($this->oauth_token);
    
  }
  
  
  /**
   * Get authorization URL
   * @param (string) $redirect_uri Redirect Uri
   * @return (string) Authentication Url
   */
  public function authorizationUrl($redirect_uri) {
    return $this->client->getAuthenticationUrl($this->oauth_provider.self::AUTHORIZATION_PATH, $redirect_uri);
  }
  /*
   * Set access token
   * @param (string) $token
   */
  public function setAccessToken($token){
    $this->oauth_token =  $token;
    $this->client->setAccessToken($this->oauth_token);
  }
  /**
   * Get access token
   * @param (array) $params['refresh_token'] = 'refresh_token_value'
   */
  public function accessToken($params) {
    $response = $this->client->getAccessToken($this->oauth_provider.self::TOKEN_PATH, OAuth2Client::GRANT_TYPE_AUTH_CODE, $params);
    return $response['body'];
  }
  /**
   * Refresh access token
   */
  public function refreshToken($params) {
    $response = $this->client->getAccessToken($this->oauth_provider.self::TOKEN_PATH, OAuth2Client::GRANT_TYPE_REFRESH_TOKEN, $params);
    return $response['body'];
  }
  
  public function call($url_path, $data=null){
  	
  	$args = [];
  	
  	$args['url'] = implode('/', $url_path);
  	
  	if(!empty($data)){
  		$args['params'] = $data;
  	}
  	
  	return $this->execute($args);
  	
  }
  /**
   * Make APi GET/POST call
   * @param (array) $arguments - array('url'=>'method_name', 'params'=>'POST ARRAY if we want to make post request - optional')
   * @param bool $encode (if true response will be json_encode if false it will be stdClass object)
   */
	public function execute($arguments){
  	  
  	  
	  $url = $this->api_endpoint.'/'.$arguments['url'].'.json';
	  
	  //echo $url;
	  	
      if(isset($arguments['params']))
      {
      	//POST
        $response = $this->client->fetch($url, $arguments['params'], OAuth2Client::HTTP_METHOD_POST, $this->http_headers());
        
      }else{ 
        //GET
        $response = $this->client->fetch($url, array(), OAuth2Client::HTTP_METHOD_GET, $this->http_headers());

      }
      
      if (isset($response['body'])){ 
       
        $this->body = $response['body'];
      }
     
      $this->code = $response['code'];
      

      //Will issue on nignix or apache not set to parse these responses
      if(!headers_sent()){
          header('Brid-Api-Url: '.$url);
      }
      if($this->output=='json' && !headers_sent()) {
        header('Content-type: application/json');
      }
     
      //Return body on success
   		if($this->code==500 || $this->code==404){
	       
        	$response['body'] = empty($response['body']) || !$response['body'] ? '{"msg":"Unknown error or empty error response. No response from api."}' : $response['body'];
        	
        }
      
      return $this->parseOutput($response['body']);
  }
  
  /**
   * Parse response body depending of the output
   * @param unknown $response_body
   * @param string $output
   */
  private function parseOutput($response_body){
  	switch($this->output){
  
  		case 'json':
  			return $response_body;
  			break;
  
  		case 'array':
  			return json_decode($response_body, true);
  			break;
  
  		case 'obj':
  		default:
  			return json_decode($response_body);
  			break;
  	}
  }
  /**
   * Set custom WP headers
   */
  public function http_headers() {
  
  	return array(
  			'User-Agent' => "Api | BridVideo",
  			'X-Site' => $_SERVER['HTTP_HOST'],
  	);
  }
}