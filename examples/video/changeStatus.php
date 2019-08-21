<a href="index.php">Back</a>
<?php

require_once('lib/BridApi.php');

try{
	$api = new BridApi(array('auth_token'=>'<YOUR_AUTHORIZATION_KEY>'));
	?>
	<h2>Json</h2>
    <?php 
        $post = array('data[partner_id]'=><SITE_ID>, 'data[id]'=><VIDEO_ID>, 'data[status]'=>0, 'data[controller]'=>'videos');
	    $return = $api->post(['videos', 'changeStatus'], $post);
	    print_r($return);
	?>
	
	<?php
}catch(Exception $e){
	echo $e->getMessage();
}
?>