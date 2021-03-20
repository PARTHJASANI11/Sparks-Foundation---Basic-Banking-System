<html>
<head>
	<title> Fund Transfer Form </title>
	<style>
		.error 
		{
			color:#FF0000 ;

		}

		#FT1
		{
			background-image: url("SF3.jpg");
			background-size: 3200px;
			background-repeat: no-repeat;
			padding: 20px;
			border: 5px solid black;
			margin: 25px 30px;
			height: 1000px;
			width: 1100px;
			border-radius: 25px;
		}
		#FT2
		{
			border: 5px solid black;
			text-align: left;
			padding: 20px;
			margin: 25px 30px;
			width: 500px;
			border-radius: 15px;
		}

		input[type='text']
		{
			border: 5px solid black;
			border-radius: 4px;
			width: 200px;
			padding: 12px 20px;
		}

		input[type='number']
		{
			border: 5px solid black;
			border-radius: 4px;
			width: 200px;
			padding: 12px 20px;
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
<center>
<div id="FT1">
	<center><h1> Fund Transfer Form </h1> <br>
	<p><span class="error">* required field</span></p></center>

	<?php

	include_once('connection_sparks.php');
	$to_customer_id = $to_customer_name = $amount="";
	$to_customer_id_err = $to_customer_name_err = $amount_err= "";
	
	function success()
	{
		echo "<h2> <center> Successfully Transfered! </center> </h2>";
		header( "refresh:5;url=customers_list.php" );
	}

	function test_input($data) 
	{
  		$data = trim($data);
  		$data = stripslashes($data);
  		$data = htmlspecialchars($data);
  		return $data;
  	}

	if(isset($_POST['transfer']))
	{
		$customer_id = test_input($_POST['customer_id']);
		$customer_name = test_input($_POST['customer_name']);
		$amount = test_input($_POST['amount']);
		$amount = (float)$amount;
	}

	if(isset($_POST['pay']))
	{
		

		$customer_id = test_input($_POST['from_customer_id']);
		$customer_name = test_input($_POST['from_customer_name']);	
		$to_customer_id = test_input($_POST['to_customer_id']);
		$to_customer_name = test_input($_POST['to_customer_name']);
		$to_amount = test_input($_POST['amount']);
		$to_amount = (float)$to_amount;
		


		$query = "select customer_id, customer_name, current_balance from customer_info";
		$result = mysqli_query($conn_sparks, $query) or die(mysqli_query($conn_sparks));

		$count_id = 0;
		$count_name = 0;
		$count_balance = 0;
		$count_balance_type = 0;
		$count = 0;

		while($row = mysqli_fetch_array($result))
		{
			if(($row['customer_id']==$to_customer_id) && ($to_customer_id!=$customer_id))
			{
				$count_id++;
			}

			if(($row['customer_id']==$to_customer_id) && (strtoupper($row['customer_name'])==strtoupper($to_customer_name)))
			{
				$count_name++;
			}	
				
			if(is_int($to_amount) or is_float($to_amount))
			{
				$count_balance_type++;
			}	
			
			if(($row['customer_id']==$customer_id) && ($to_amount <= $row['current_balance']))
			{
				$count_balance++;
				$from_amount = $row['current_balance'];
			}

			if(($row['customer_id']==$to_customer_id))
			{
				$transfer_amount = $row['current_balance'];
			}
			
				
		}
			

			
		if($count_id<=0)
		{
			$to_customer_id_err="Please enter correct Customer ID!";
		}
		if($count_name<=0)
		{
			$to_customer_name_err="Please enter correct Customer Name!";
		}
		if($count_balance_type<=0)
		{
			$amount_err = "Please enter correct data!";
		}
		if($count_balance<=0)
		{
			$amount_err = "You have no sufficient balance!";
		}

		if($count_id>0 && $count_name>0 && $count_balance>0 && $count_balance_type>0)
		{
			

			$from_amount = $from_amount - $to_amount;
			$transfer_amount = $transfer_amount + $to_amount;


			$query_1 = "UPDATE customer_info SET current_balance = '$from_amount' WHERE customer_id='$customer_id'";
			$result_1 = mysqli_query($conn_sparks, $query_1) or die( mysqli_error($conn_sparks));

			$query_2 = "UPDATE customer_info SET current_balance = '$transfer_amount' WHERE customer_id='$to_customer_id'";
			$result_2 = mysqli_query($conn_sparks, $query_2) or die( mysqli_error($conn_sparks));

			$query_3 = "insert into transfer_info (transfer_from_id, transfer_to_id, transfer_amount) values('$customer_id', '$to_customer_id', '$to_amount')";
			$result_3 = mysqli_query($conn_sparks, $query_3) or die( mysqli_error($conn_sparks));

			if($result_1 and $result_2 and $result_3)
			{
				success();
				
			}

		}



		

		
	}
	?>
	<div id="FT2">
		<form method="post" action="fund_transfer_form.php">
			<h2> Customer ID: <input type = "text" value= "<?php echo $customer_id ?>" name="from_customer_id" readonly> <br> <br>
			Customer Name: <input type = "text" value= "<?php echo $customer_name ?>" name="from_customer_name" readonly><br><br>
			Transfer_ID To: <input type="text" name="to_customer_id" value="<?php echo $to_customer_id;?>" required> &nbsp <span class="error">*</span>
			<h4> <span class="error"> <?php echo $to_customer_id_err;?></span> </h4>
			<h2> Transfer_Name To: <input type="text" name="to_customer_name" value="<?php echo $to_customer_name;?>" required> &nbsp <span class="error">*</span>
			<h4> <span class="error"><?php echo $to_customer_name_err;?></span></h4>
			<h2> Amount: <input type="number" name="amount" value="<?php echo $to_amount; ?>" required> &nbsp <span class="error">*</span>
			<h4> <span class="error"> <?php echo $amount_err;?></span><br><br></h4>
			<center><input type="submit" value="pay" name="pay"> </h2></center>
		</form>
	</div>
	</div>
</center>
</body>
</html>