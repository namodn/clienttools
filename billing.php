<?php
	include("db_connect.php");
	$id = $_GET['id'];

	// set up query
	$query = "SELECT * FROM billing WHERE id = $id";
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
			LastPayment => $myrow[1],
			MonthlyFee => $myrow[2],
			NextPayment => $myrow[3],
			Notes => $myrow[4],
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
			Billing
		</title>
	</head>
	<center>
		<big>
			Billing
		</big>
	</center>
	<br>
	<table border="1">
		<tr>
			<td>
				ID
			</td>
			<td>
				LastPayment
			</td>
			<td>
				NextPayment
			</td>
			<td>
				MonthlyFee
			</td>
			<td>
				Notes
			</td>
		</tr>
		<tr>
			<td>
				<?php
					print '
				<a href="index.php#'. $id . '">' . $id . '</a>
					';
				?>
			</td>
			<td>
				<?php
					print "$client[LastPayment]";
				?>
			</td>
			<td>
				<?php
					print "$client[NextPayment]";
				?>
			</td>
			<td>
				<?php
					print "$client[MonthlyFee]";
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
