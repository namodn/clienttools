<?php

	include("db_connect.php");
	include("header.php");

	$id = $_GET['id'];

	// set up query
	$query = "SELECT * FROM contact WHERE id = $id";
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
			Name => $myrow[1],
			Street => $myrow[2],
			City => $myrow[3],
			State => $myrow[4],
			Zip => $myrow[5],
			Country => $myrow[6],
			Phone => $myrow[7],
			FAX => $myrow[8],
			EmailAddress => $myrow[9],
			Notes => $myrow[10],
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
			Contact
		</title>
	</head>
	<center>
		<big>
			Contact
		</big>
	</center>
	<br>
	<form method="post" action="save.php">
	<table border="1">
	<input type="hidden" name="id" value="<?php print $id?>">
	<input type="hidden" name="table" value="contact">
		<tr>
			<td>
				ID
			</td>
			<td>
				Name
			</td>
			<td>
				Street
			</td>
			<td>
				City
			</td>
			<td>
				State
			</td>
			<td>
				Zip
			</td>
			<td>
				Country
			</td>
			<td>
				Phone
			</td>
			<td>
				FAX
			</td>
			<td>
				EmailAddress
			</td>
			<td>
				Notes
			</td>
		<tr>
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
				print '<input name="name" value="';
				print $client[Name];
				print '">';
			?>
			</td>
			<td>
			<?php
				print '<input name="street" value="';
				print "$client[Street]";
				print '">';
			?>
			</td>
			<td>
			<?php
				print '<input name="city" value="';
				print "$client[City]";
				print '">';
			?>
			</td>
			<td>
			<?php
				print '<input name="state" value="';
				print "$client[State]";
				print '">';
			?>
			</td>
			<td>
			<?php
				print '<input name="zip" value="';
				print "$client[Zip]";
				print '">';
			?>
			</td>
			<td>
			<?php
				print '<input name="country" value="';
				print "$client[Country]";
				print '">';
			?>
			</td>
			<td>
			<?php
				print '<input name="phone" value="';
				print "$client[Phone]";
				print '">';
			?>
			</td>
			<td>
			<?php
				print '<input name="fax" value="';
				print "$client[FAX]";
				print '">';
			?>
			</td>
			<td>
			<?php
				print '<input name="emailaddress" value="';
				print "$client[EmailAddress]";
				print '">';
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
