<?php
    
    session_start();

	$link = mysqli_connect("localhost", "root", "one") or die("Connect Error " . mysql_error());
	mysqli_select_db($link, "final") or die ("Database Error " . mysqli_error($link));
	
	$waiver = mysqli_real_escape_string($link, htmlspecialchars($_POST["waiver"]));
	
	if($stmt = mysqli_prepare($link, "INSERT INTO waiver (name) VALUES (?)") or die ("prepare error" . mysqli_error($link))){
			
		mysqli_stmt_bind_param($stmt, "s", $waiver) or die ("bind param" . mysqli_stmt_error($stmt));
		mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
			
		if(mysqli_affected_rows($link)){
				
			print "Added";
		}
	}
?>