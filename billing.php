<?php
	include("db_connect.php");
	include("header.php");

	// set up query
	$query = "SELECT * FROM billing WHERE cid = $id";
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
			ID => $myrow[0],
			PaymentDue => $myrow[1],
			AmountReceived => $myrow[2],
			MonthlyFee => $myrow[3],
			Notes => $myrow[4],
			ReceivedOn=> $myrow[5],
		);
		array_push($data,$current);
	}
	
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
	<form method="post" action="save.php">
	<input type="hidden" name="id" value="<?php print $id?>">
	<input type="hidden" name="table" value="billing">
	<input type="submit" value="Add entry">
	<table border="1">
		<tr>
			<td>
				ID
			</td>
			<td>
				PaymentDue
			</td>
			<td>
				AmountReceived
			</td>
			<td>
				MonthlyFee
			</td>
			<td>
				Notes
			</td>
			<td>
				ReceivedOn
			</td>
			<td>
				RID
			</td>
		</tr>
<?php
	foreach ( $data as $client ) {
		print '
		<tr>
			<td>
		';
		print '
				<a href="index.php#'. $id . '">' . $id . '</a>
		';
		print '
			</td>
			<td>
					<input name="paymentdue" value="
		';
				print "$client[PaymentDue]";
		print '
					"/>
			</td>
			<td>
					<input name="amountreceived" value="
		';
					print "$client[AmountReceived]";
		print '
					"/>
			</td>
			<td>
					<input name="monthlyfee" value="
		';
					print "$client[MonthlyFee]";
		print '
					"/>
			</td>
			<td>
					<input name="notes" value="
		';
					print "$client[Notes]";
		print '
					"/>
			</td>
			<td>
					<input name="recievedon" value="
		';
					print "$client[ReceivedOn]";
		print '
					"/>
			</td>
			<td>
					<input name="rid" value="
		';
					print "$client[ID]";
		print '
					"/>
			</td>
		</tr>
		';
	}
?>
	</table>
	<input type="submit" name="submit" value="Save Changes">
	</form>
</html>
