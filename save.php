<?php
/*
 * Save changes to the DB
 */
	include("db_connect.php");

	$id = $_POST['id'];
	$table = $_POST['table'];
	// values to update
	$values;

	if ($table == 'billing') {
		$values = array(
			paymentdue => $_POST['paymentdue'],
			amountreceived => $_POST['amountreceived'],
			monthlyfee => $_POST['monthlyfee'],
			notes => $_POST['notes'],
			receivedon => $_POST['recievedon'],
		);
		header("Location: billing.php?id=$id");
	}

	if ($table == 'contact') {
		$values = array(
			id => $_POST['id'],
			name => $_POST['name'],
			street => $_POST['street'],
			city => $_POST['city'],
			state => $_POST['state'],
			zip => $_POST['zip'],
			country => $_POST['country'],
			phone => $_POST['phone'],
			fax => $_POST['fax'],
			emailaddress => $_POST['emailaddress'],
			notes => $_POST['notes'],
		);
	
		header("Location: contact.php?id=$id");
	}

	if ($table == 'services') {
		$id = $_POST['id'];
		$shell = $_POST['shell'];
		if ($shell == 'on' ) {
			$shell = 1;
		}
		$web = $_POST['web'];
		if ($web == 'on' ) {
			$web = 1;
		}
		if ($email == 'on' ) {
			$email = 1;
		}
		$ftp = $_POST['ftp'];
		if ($ftp == 'on' ) {
			$ftp = 1;
		}

		$values = array(
			shell => $shell,
			web => $web,
			domain => $_POST['domain'],
			email => $email,
			ftp => $ftp,
			notes => $_POST['notes'],
		);
	
		header("Location: services.php?id=$id");
	}

	// do the update
	foreach ($values as $column => $value) {
		$update = "UPDATE $table SET $column='$value' where ID='$id'";
		$result = pg_exec($db,$update);
	
		if (!$result) { 
			printf("Error"); 
			$errormessage = pg_errormessage($db); 
			print "$errormessage"; 
			exit; 
		}
	}
?>
