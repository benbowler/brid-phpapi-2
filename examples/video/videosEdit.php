<a href="index.php">Back</a>
<?php

require_once('lib/BridApi.php');

try{
	$api = new BridApi(array('auth_token'=>'b1437c94847d7e19268ad3bda0e46f8f6bc36f45'));
	?>
	<h2>Json</h2>
    <?php 
        $post = array('data[Video][id]'=><VIDEO_ID>, 'data[Video][partner_id]'=><SITE_ID>,'data[Video][name]'=>'<>VIDEO_TITLE');
	    $return = $api->post(['videos', 'edit'], $post);
	    print_r($return);
	?>
	
	<?php
}catch(Exception $e){
	echo $e->getMessage();
}
?>