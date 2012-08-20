<?php
	// Include our class
	include( 'includes/class.blogspot.parser.php' );
	
	if( isset( $_POST['parse'] ) && isset( $_FILES['backupfile']['name'] ) )
	{
		// Check that file exists
		if( !file_exists( $_FILES['backupfile']['tmp_name'] ) )
		{
			die( 'zomfg shit, file doesn\'t exist' );
		}
		// Read file
		$fh = fopen( $_FILES['backupfile']['tmp_name'], "r" );
		$backupdata = fread( $fh, filesize( $_FILES['backupfile']['tmp_name'] ) );
		fclose( $fh );
		
		//
		// Start parsing data
		//
		$parser = new Blogspotparser( $backupdata );
		
		// Do what you want with the output
		echo '<pre>';
		print_r( $parser->fetch_entries_clean() );
		echo '</pre>';
		
		die();
	}
?>
<html>
	<head>
		<title>Blogspot parser</title>
	</head>
	<body>
		<fieldset>
			<legend>Upload your XML backup file</legend>
			<form enctype="multipart/form-data" action="index.php" method="POST">
				<input name="backupfile" type="file" />
				<input type="hidden" name="parse" value="1" />
				<input type="submit" name="submit" value="submit" />
			</form>
		</fieldset>
	
	
	</body>
</html>	