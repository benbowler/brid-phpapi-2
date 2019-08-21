<a href="index.php">Back</a>
<?php

require_once('lib/BridApi.php');

try{
	$api = new BridApi(array('auth_token'=>'<YOUR_AUTHORIZATION_KEY>'));
	?>
	<h2>Json</h2>
    <?php 
        $post = array('data[url]'=>'<YOUTUBE_VIDEO_URL>', 'data[Video][partner_id]'=><SITE_IDE>,'data[Video][name]'=>'VIDEO_TITLE','data[Video][channel)id]'=><CHANNEL_ID>);
	    $return = $api->post(['videos', 'fetchYoutube'], $post);
	    print_r($return);
	?>
	
	<?php
}catch(Exception $e){
	echo $e->getMessage();
}
?>