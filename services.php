<?php

	include("db_connect.php");
	include("header.php");

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
	<form method="post" action="save.php">
	<input type="hidden" name="id" value="<?php print $id?>">
	<input type="hidden" name="table" value="services">
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
					print '<input type="checkbox" name="shell"';
					print "$client[Shell]";

					if ($client[Shell]) {
						print ' checked>';
					} else {
						print '>';
					}	
				?>
			</td>
			<td>
				<?php
					print '<input type="checkbox" name="web"';
					print "$client[Web]";
					if ($client[Web]) {
						print ' checked>';
					} else {
						print '>';
					}	
				?>
			</td>
			<td>
				<?php
					print '<input name="domain" value="';
					print "$client[Domain]";
					print '">';
				?>
			</td>
			<td>
				<?php
					print '<input type="checkbox" name="email"';
					print "$client[Email]";

					if ($client[Email]) {
						print ' checked>';
					} else {
						print '>';
					}	
				?>
			</td>
			<td>
				<?php
					print '<input type="checkbox" name="ftp"';
					print "$client[FTP]";

					if ($client[FTP]) {
						print ' checked>';
					} else {
						print '>';
					}	
				?>
			</td>
			<td>
				<?php
					print '<input name="notes" value="';
					print "$client[Notes]";
					print '">';
				?>
			</td>
		</tr>
	</table>
	<input type="submit" name="submit" value="Save changes">
	</form>
</html>
