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
				print '<input name="name" value="';
				print $client[Name];
				print '">';
			?>
			</td>
			<td>
			<?php
				print '<input name="name" value="';
				print "$client[Street]";
				print '">';
			?>
			</td>
			<td>
			<?php
				print '<input name="name" value="';
				print "$client[City]";
				print '">';
			?>
			</td>
			<td>
			<?php
				print '<input name="name" value="';
				print "$client[State]";
				print '">';
			?>
			</td>
			<td>
			<?php
				print '<input name="name" value="';
				print "$client[Zip]";
				print '">';
			?>
			</td>
			<td>
			<?php
				print '<input name="name" value="';
				print "$client[Country]";
				print '">';
			?>
			</td>
			<td>
			<?php
				print '<input name="name" value="';
				print "$client[Phone]";
				print '">';
			?>
			</td>
			<td>
			<?php
				print '<input name="name" value="';
				print "$client[FAX]";
				print '">';
			?>
			</td>
			<td>
			<?php
				print '<input name="name" value="';
				print "$client[EmailAddress]";
				print '">';
			?>
			</td>
			<td>
			<?php
				print '<input name="name" value="';
				print "$client[Notes]";
				print '">';
			?>
			</td>
		</tr>
	</table>
</html>
