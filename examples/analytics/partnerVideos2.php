<a href="index.php">Back</a>
<?php

require_once('lib/BridApi.php');

try{
	$api = new BridApi(array('auth_token'=>'<YOUR_AUTHORIZATION_KEY>'));
	?>
	<h2>Json</h2>
    <?php 
        $post = array('data[date_from]'=>'2019-08-01', 'data[date_to]'=>'2019-08-09', 'data[metric]'=>'Traffic Sources','data[filter]'=>'all', 'data[results]'=>'by day');
	    $return = $api->post(['stats', 'partner', 'videos', <SITE_ID>], $post);
	    print_r($return);
	?>
	
	<?php
}catch(Exception $e){
	echo $e->getMessage();
}
?>