<?php
	include("db_connect.php");

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
	<table border="1">
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
				print "$client[Name]";
			?>
			</td>
			<td>
			<?php
				print "$client[Street]";
			?>
			</td>
			<td>
			<?php
				print "$client[City]";
			?>
			</td>
			<td>
			<?php
				print "$client[State]";
			?>
			</td>
			<td>
			<?php
				print "$client[Zip]";
			?>
			</td>
			<td>
			<?php
				print "$client[Country]";
			?>
			</td>
			<td>
			<?php
				print "$client[Phone]";
			?>
			</td>
			<td>
			<?php
				print "$client[FAX]";
			?>
			</td>
			<td>
			<?php
				print "$client[EmailAddress]";
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
