<?php
	include("db_connect.php");
	include("header.php");

	// set up query
	$query = "SELECT * FROM billing WHERE amountreceived = '0.00' AND receivedon = '' AND cid = $id";
	$result = pg_exec($db,$query);

	if (!$result) {
		printf("Error");
		$errormessage = pg_errormessage($db);
		print "$errormessage";
		exit;
	}

	$numrows = pg_numrows($result);

	$billingData = array();

	for ( $row=0; $row < $numrows; $row++) {
		$myrow = pg_fetch_row($result,$row);
		$current = array(
			ID => $myrow[0],
			PaymentDue => $myrow[1],
			AmountReceived => $myrow[2],
			MonthlyFee => $myrow[3],
			Notes => $myrow[4],
			ReceivedOn => $myrow[5],
			BillingCycle => '01',
		);
		array_push($billingData,$current);
	}

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

	$contactData = array();

	for ( $row=0; $row < $numrows; $row++) {
		$myrow = pg_fetch_row($result,$row);
		$contactData = array(
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
	}
?>

<html>
	<head>
		<title>
			Bill
		</title>
	</head>
	<center>
		<big>
			Bill
		</big>
	</center>
	<br>
	<input type="hidden" name="id" value="<?php print $id?>">
	<input type="hidden" name="table" value="generateBill">
<pre>
Remit To:                                                        000000005
                                              Account Number :   4
AnyHosting Services c/o Robert Helmer                   Page :   1
532 Liberty St.                                 Invoice Date :   <?php $date = date("d/m/Y"); print "$date\n"; ?>
El Cerrito, CA 94530                          Invoice Number :   00001
 
Bill To:
 
<?php 
print "$contactData[Name]\n";
print "$contactData[Street]\n";
print "$contactData[City], $contactData[State] $contactData[Zip]";
?>
 
===============================================================================
 
Date:        Description                  Qty (mo)    Price       Amount
----------   --------------------------   --------  --------    ---------
<?php
$total = '';
foreach ( $billingData as $client ) {
	$subtotal = ($client[MonthlyFee] * $client[BillingCycle]);
	$total = ($total + $subtotal);
	print "$client[PaymentDue]   Web, Email, Domain Hosting   $client[BillingCycle]        \$$client[MonthlyFee]      \$$subtotal\n\n";
}
?>
                                                                ---------
                                               Balance Due:     <?php print "\$$total\n" ?>
                                                                =========
</pre>
</html>
