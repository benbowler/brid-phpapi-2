<a href="index.php">Back</a>
<?php

require_once('lib/BridApi.php');

try{
	$api = new BridApi(array('auth_token'=>'<YOUR_AUTHORIZATION_KEY>'));
	?>
	<h2>Json</h2>
    <?php 
        $post = array('data[date_from]'=>'2019-08-01', 'data[date_to]'=>'2019-08-09', 'data[metric]'=>'Geography','data[filter]'=>'all','data[results]'=>'by day');
	    $return = $api->post(['stats', 'user', 'bandwidth'], $post);
        print_r($return);
        //print_r($api);
	?>
	
	<?php
}catch(Exception $e){
	echo $e->getMessage();
}
?>