<?php
require_once 'Http.php';
/**
 * Brid Api Class
 * @version 1.1
 */
class BridApi extends Http{

  protected $options=array();

  public function __construct($options=array()) {
  	if(isset($options['auth_token']) && $options['auth_token']=='ENTER YOUR AUTH CODE HERE'){
  		throw new Exception('Invalid token.');
  	} 
  	$this->options = array_merge($this->options, $options);
  	parent::__construct($options);
  }
  
  public function output($output='array'){
  	$this->options['output'] = $output;
  }
  
  public function get($url_path){
  	return $this->call($url_path);
  }
  
  public function post($url_path, $data){
  	return $this->call($url_path, $data);
  }
  
}

?>
