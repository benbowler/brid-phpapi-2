<a href="index.php">Back</a>
<?php

require_once('lib/BridApi.php');

try{
	$api = new BridApi(array('auth_token'=>'<YOUR_AUTHORIZATION_KEY>'));
	?>
	<h2>Json</h2>
	<?php 
	
	$return = $api->get(['channels', 'catalog', <SITE_ID>]);
	
	print_r($return);
	?>
	
	<?php
}catch(Exception $e){
	echo $e->getMessage();
}
?>