<a href="index.php">Back</a>
<?php

require_once('lib/BridApi.php');

try{
	$api = new BridApi(array('auth_token'=>'<YOUR_AUTHORIZATION_KEY>'));
	?>
	<h2>Json</h2>
    <?php 
        $post = array('data[Playlist][partner_id]'=><SITE_ID>, 'data[Video][ids]'=><VIDEO_IDs>,
        'data[Playlist][name]'=>'<PLAYLIST_TITLE>', 'data[Playlist][publish]'=>'01-07-2019');
	    $return = $api->post(['playlists', 'add'], $post);
	    print_r($return);
	?>
	
	<?php
}catch(Exception $e){
	echo $e->getMessage();
}
?>