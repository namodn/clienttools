<?php

	include("db_connect.php");

	$id = $_GET['id'];

	// set up query
	$query = "SELECT * FROM services WHERE id = $id";
	$result = pg_exec($db,$query);

	if (!$result) {
		printf("Error");
		$errormessage = pg_errormessage($db);
		print "$errormessage";
		exit;
	}

	$numrows = pg_numrows($result);

	$data = array();

	for ( $row=0; $row < $numrows; $row++) {
		$myrow = pg_fetch_row($result,$row);
		$current = array(
			Shell => $myrow[1],
			Web => $myrow[2],
			Domain => $myrow[3],
			Email => $myrow[4],
			FTP => $myrow[5],
			Notes => $myrow[6],
		);
		$data = array(
			$id => $current,
		);
	}
	

	$client = $data[$id];
?>

<html>
	<head>
		<title>
			Services
		</title>
	</head>
	<center>
		<big>
			Services
		</big>
	</center>
	<br>
	<table border="1">
		<tr border="1">
			<td>
				ID
			</td>
			<td>
				Shell
			</td>
			<td>
				Web
			</td>
			<td>
				Domain
			</td>
			<td>
				Email
			</td>
			<td>
				FTP
			</td>
			<td>
				Notes
			</td>
		</tr>
			<td>
				<?php
					print ' 
				<a href="index.php#'. $id . '">' . $id . '</a> 
					'; 
				?>
			</td>
			<td>
				<?php
					print "$client[Shell]";
				?>
			</td>
			<td>
				<?php
					print "$client[Web]";
				?>
			</td>
			<td>
				<?php
					print "$client[Domain]";
				?>
			</td>
			<td>
				<?php
					print "$client[Email]";
				?>
			</td>
			<td>
				<?php
					print "$client[FTP]";
				?>
			</td>
			<td>
				<?php
					print "$client[Notes]";
				?>
			</td>
		</tr>
	</table>
</html>
