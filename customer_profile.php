<html>
<head>
	<title> Customer's Profile </title>
	<style>
		table,th,td
		{
			border:5px solid black;
			border-collapse: collapse;
			padding: 30px;
			text-align: center;
		}
		#CP1
		{
			background-image: url("SF3.jpg");
			background-size: 3500px;
			background-repeat: no-repeat;
			padding: 20px;
			border: 5px solid black;
			margin: 25px 30px;
			height: 1000px;
			width: 1100px;
			border-radius: 25px;

		}
		input[type='submit']
		{
			border: 2px solid black;
			border-radius: 10px;
			width: 200px;
			padding: 12px 20px;
			background-color: black;
			color: white;
			font-size: 30px;
		}
	</style>
</head>
<body>
	<?php
		include_once('connection_sparks.php');
		if(isset($_POST['view_profile']))
		{
			$customer_id = $_POST['customer_id'];
			$query = "select * from customer_info where customer_id = '$customer_id'";
			$result = mysqli_query($conn_sparks, $query) or die(mysqli_query($conn_sparks));
		}
		
	?>
	<center>
	<div id="CP1">
	<h1> Customer's Profile </h1>
	<table>
	<?php
	
	while($row = mysqli_fetch_array($result))
	{
		$customer_name = $row['customer_name'];
		$amount = $row['current_balance'];
		echo "<tr>";
		echo "<th><h2>" . "Customer ID" . "</h2></th>";
		echo "<th><h2>" . $row['customer_id'] ."</h2></th>";
		echo "</tr>";
		echo "<tr>";
		echo "<th><h2>" . "Customer's Name" . "</h2></th>";
		echo "<th><h2>" . $row['customer_name'] ."</h2></th>";
		echo "</tr>";
		echo "<tr>";
		echo "<th><h2>" . "Customer's Email" . "</h2></th>";
		echo "<th><h2>" . $row['customer_email'] ."</h2></th>";
		echo "</tr>";
		echo "<tr>";
		echo "<th><h2>" . "Customer's Mobile No" . "</h2></th>";
		echo "<th><h2>" . $row['customer_mobile'] ."</h2></th>";
		echo "</tr>";
		echo "<tr>";
		echo "<th><h2>" . "Current Balance" . "</th>";
		echo "<th><h2>" . $row['current_balance'] ."</h2></th>";
		echo "</tr>";
		
		
	}
	
	?>
	</table>
	<br>
	<br>
	<form method="post" action="fund_transfer_form.php">
		<input type="submit" value="Transfer" name="transfer">
		<input type="hidden" value="<?php echo $customer_id;?>" name="customer_id">
		<input type="hidden" value="<?php echo $customer_name;?>" name="customer_name">
		<input type="hidden" value="<?php echo $amount;?>" name="amount">
	</form>
	</center>
</div>

</body>
</html>