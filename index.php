<?php
	include("db_connect.php");

	// set up query
	$query = "SELECT id,name FROM contact";

	$result = pg_exec($db,$query);

	if (!$result) {
		printf("Error");
		$errormessage = pg_errormessage($db);
		print "$errormessage";
		exit;
	}

	$numrows = pg_numrows($result);

	// all the clients go into a standard 1-dimensional array
	$clients = array();

	for ( $row=0; $row < $numrows; $row++) {
		$myrow = pg_fetch_row($result,$row);
		
		$client = array(
			id =>$myrow[0],
			name => $myrow[1],
		);
		array_push($clients,$client);
	}

?>
<html>
	<head>
		<title>
			Hosting Clients
		</title>
	</head>
	<center>
		<big>
			Hosting Clients
		</big>
	</center>
	<br>
	<a href="add.php">Add user</a>
	<table border="1">
<?php
	foreach( $clients as $client) {

		$id = $client[id];
		$name = $client[name];

		print '
		<tr>
			<td>

				<a name="id" id="' . $id . '">' . $id . '</a>
			</td>
			<td>
				' . $name . '
			</td>
			<td>
				<a href="billing.php?id=' . $id . '">
					billing
				</a>
			</td>
			<td>
				<a href="contact.php?id=' . $id . '">
					contact
				</a>
			</td>
			<td>
				<a href="services.php?id=' . $id . '">
					services
				</a>
			</td>
			<td>
				<input type="button" name="disable"
				 value="Disable user">
			</td>
		</tr>
		';
	}
?>
	</table>
</html>
