<?php
	$server_path		=	$_POST['server_path'];
	$server_password	=	$_POST['server_password'];
	$target				=	$_POST['target'];
	$localizationFile	=	$_FILES['localization'];
	
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
				$ftp_url_localization	=	'/htdocs/DevBuild/'.$server_path.'/'.$server_path.'/client/media/localization/';
				$ftp_url_client			=	'/htdocs/DevBuild/'.$server_path.'/'.$server_path.'/client/media/json/';				
				$ftp_url_server			=	'/htdocs/DevBuild/'.$server_path.'/'.$server_path.'/server/configs/files/';
			}
			else
			{
				$ftp_url_localization	=	'/htdocs/DailyBuild/'.$server_path.'/'.$server_path.'/client/media/localization/';
				$ftp_url_client	=	'/htdocs/DailyBuild/'.$server_path.'/'.$server_path.'/client/media/json/';
				$ftp_url_server	=	'/htdocs/DailyBuild/'.$server_path.'/'.$server_path.'/server/configs/files/';
			}
			
			// Upload file quest.xfj.txt										
			ssh2_scp_send( $connect_id, 'quest.xfj.txt', $ftp_url_client.'quest.xfj' );
			echo 'Uploaded <b>quest.xfj</b> to <b>'.$ftp_url_client.'</b>... <br/>';		

			// Upload file Task.conf.php.txt										
			ssh2_scp_send( $connect_id, 'Task.conf.php.txt', $ftp_url_server.'Task.conf.php' );
			echo 'Uploaded <b>Task.conf.php</b> to <b>'.$ftp_url_server.'</b>... <br/>';	
			
			// Upload file Quest.conf.php.txt									
			ssh2_scp_send( $connect_id, 'Quest.conf.php.txt', $ftp_url_server.'Quest.conf.php' );
			echo 'Uploaded <b>Quest.conf.php</b> to <b>'.$ftp_url_server.'</b>... <br/>';	
			
			// Upload localization file if exist
			if( $localizationFile && 
				strlen($localizationFile['name']) != 0 &&
				strlen($localizationFile['tmp_name']) != 0 )
			{
				ssh2_scp_send( $connect_id, $localizationFile['tmp_name'], $ftp_url_localization.$localizationFile['name'] );
				echo 'Uploaded <b>'.$localizationFile['name'].'</b> to <b>'.$ftp_url_localization.'</b>... <br/>';	
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