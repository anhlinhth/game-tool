<?php
	$server_path		=	$_POST['server_path'];
	$server_password	=	$_POST['server_password'];
	$target				=	$_POST['target'];
	$mediaFile			=	$_FILES['media'];
	$jsonFile			=	$_FILES['json'];
	
	if( ! $server_path )
	{
		echo 'Please enter server path';
		exit;
	}
	
	///////////////////////////////
	$result	=	false;		
		
	// Login to ftp server
	$connect_id	=	ssh2_connect( '10.30.9.103', 22 );	
	if( $connect_id )
	{
		echo 'Establish connection... '. $connect_id . '<br/>';
		$login_result	=	ssh2_auth_password( $connect_id, 'root', $server_password );
		if( $login_result )
		{
			echo 'Login to server... ' . $login_result . '<br/><br/>';
			
			// Build FTP server address
			if( $target == 'DevBuild' )
			{
				$ftp_url_media	=	'/htdocs/DevBuild/'.$server_path.'/'.$server_path.'/client/media/swf/';
				$ftp_url_json	=	'/htdocs/DevBuild/'.$server_path.'/'.$server_path.'/client/media/json/';
			}
			else
			{
				$ftp_url_media	=	'/htdocs/DailyBuild/'.$server_path.'/'.$server_path.'/client/media/swf/';
				$ftp_url_json	=	'/htdocs/DailyBuild/'.$server_path.'/'.$server_path.'/client/media/json/';
			}
			
			// Upload swf file if exist
			if( $mediaFile && 
				strlen($mediaFile['name']) != 0 &&
				strlen($mediaFile['tmp_name']) != 0 )
			{
				ssh2_scp_send( $connect_id, $mediaFile['tmp_name'], $ftp_url_media.$mediaFile['name'] );
				echo 'Uploaded <b>'.$mediaFile['name'].'</b> to <b>'.$ftp_url_media.'</b>... <br/>';	
			}
			
			// Upload json file if exist
			if( $jsonFile && 
				strlen($jsonFile['name']) != 0 &&
				strlen($jsonFile['tmp_name']) != 0 )
			{
				ssh2_scp_send( $connect_id, $jsonFile['tmp_name'], $ftp_url_json.$jsonFile['name'] );
				echo 'Uploaded <b>'.$jsonFile['name'].'</b> to <b>'.$ftp_url_json.'</b>... <br/>';	
			}
			
			$result	=	true;	
		}
		else
			echo 'Can not login to FTP server...<br/>';
	}
	else
		echo 'Can not connect to FTP server...<br/>';
	
	/////////////////////
	echo '<br/>';
	if( $result )
		echo '<h2>Uploading Succeeded !!!</h2>';
	else
		echo '<h2>Uploading Failed !!!</h2>';
?>