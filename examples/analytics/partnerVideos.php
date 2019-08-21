<a href="index.php">Back</a>
<?php

require_once('lib/BridApi.php');

try{
	$api = new BridApi(array('auth_token'=>'<YOUR_AUTHORIZATION_KEY>'));
	$post = array('data[date_from]'=>'2019-08-01', 'data[date_to]'=>'2019-08-08', 'data[metric]'=>'Overview');
	$return = $api->post(['stats', 'partner', 'videos', <SITE_ID>], $post);
	print_r($return);
}catch(Exception $e){
	echo $e->getMessage();
}
?>