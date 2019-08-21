<a href="index.php">Back</a>
<?php

require_once('lib/BridApi.php');

try{
	$api = new BridApi(array('auth_token'=>'<YOUR_AUTHORIZATION_KEY>'));
	?>
	<h2>Json</h2>
    <?php 
        $post = array('data[Playlist][partner_id]'=><SITE_ID>, 'data[Playlist][id]'=><PLAYLIST_ID>,'data[Playlist][video_id]'=><VIDEO_IDs>);
	    $return = $api->post(['playlists', 'removeVideo'], $post);
	    print_r($return);
	?>
	
	<?php
}catch(Exception $e){
	echo $e->getMessage();
}
?>