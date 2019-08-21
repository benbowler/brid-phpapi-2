<a href="index.php">Back</a>
<?php

require_once('lib/BridApi.php');

try{
	$api = new BridApi(array('auth_token'=>'<YOUR_AUTHORIZATION_KEY>'));
	?>
	<h2>Json</h2>
    <?php 
        $post = array('data[Partner][partner_id]'=>13085, 'data[Partner][domain]'=>'example.com');
	    $return = $api->post(['partners', 'add'], $post);
	    print_r($return);
	?>
	
	<?php
}catch(Exception $e){
	echo $e->getMessage();
}
?>