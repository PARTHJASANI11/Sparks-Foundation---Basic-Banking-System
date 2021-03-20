<html>
<head>
	<title> List of Customers </title>
	<style>
		table,th,td
		{
			border:5px solid black;
			border-collapse: collapse;
			padding: 15px;
			text-align: center;
		}
		#CL1
		{
			background-image: url("SF4.jpg");
			background-size: 2000px;
			background-repeat: no-repeat;
			padding: 20px;
			border: 5px solid black;
			margin: 25px 30px;
			height: 800px;
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

		$query = "select * from customer_info";
		$result = mysqli_query($conn_sparks, $query) or die(mysqli_query($conn_sparks));
	?>

	<div id="CL1">
<center> <h1> List of Customers </h1> 
<table>
	
	<tr>
	<th> <h2> Customer ID  </h2></th>
	<th> <h2> Customer's Name </h2></th>
	<th> <h2> Profile </h2> </th>
	</tr>
	<?php
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
		echo "<th>" . "<h3>" .$row['customer_id'] . "</h3>" ."</th>";
		echo "<th>" . "<h3>" . $row['customer_name'] . "</h3>"."</th>";
		$cid = $row['customer_id'];
		echo "<th>" . "<form method='post' action='customer_profile.php'>" . "<input type='submit' value='View Profile' name='view_profile'>" . "<input type='hidden' value=$cid name='customer_id'>" . "</form>" . "</th>";
		echo "</tr>";
	}
	
	?>
</table> </center>
</div>
</body>