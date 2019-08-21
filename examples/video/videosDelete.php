<a href="index.php">Back</a>
<?php

require_once('lib/BridApi.php');

try{
	$api = new BridApi(array('auth_token'=>'<YOUR_AUTHORIZATION_KEY>'));
	?>
	<h2>Json</h2>
    <?php 
        $post = array('data[Video][partner_id]'=><SITE_ID>, 'data[Video][ids]'=><VIDEO_ID>);
	    $return = $api->post(['videos', 'delete'], $post);
	    print_r($return);
	?>
	
	<?php
}catch(Exception $e){
	echo $e->getMessage();
}
?>