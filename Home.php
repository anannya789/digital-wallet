<?php 

define("filepath", "data.json");
	$selectCategory = $tO = $amoUnt = "";
	$isValid = true;
	$selectCategoryErr = $tOErr = $amoUntErr = "";
	$successfulMessage = $errorMessage = "";

	if($_SERVER['REQUEST_METHOD'] === "POST") {
		$selectCategory = $_POST['select category'];
		$tO = $_POST['to'];
		$amoUnt = $_POST['amount'];
		if(empty($selectCategory)) {
			$selectCategoryErr = "Select category can not be empty!";
			$isValid = false;
		}
		if(empty($tO)) {
			$tOErr = "To can not be empty!";
			$isValid = false;
		}
		if(empty($amoUnt)) {
			$amoUntErr = "Amount can not be empty!";
			$isValid = false;
		}
		if($isValid) {
			$selectCategory = test_input($selectCategory);
			$tO = test_input($tO);
			$amoUnt = test_input($amoUnt);

			$arr1 = array('select category' => $selectCategory, "to" => $tO, "amount" => $amoUnt);
			$arr1_encode = json_encode($arr1);
			$response  = write($arr1_encode);
			if($response) {
				$successfulMessage = "Successfully saved.";
			}
			else {
				$errorMessage = "Error while saving.";
			}
		}
	}
	function write($content) {
			$resource = fopen(filepath, "a");
			$fw = fwrite($resource, $content . "\n");
			fclose($resource);
			return $fw;
	}
	function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
	}



 ?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Home</title>
</head>
<body>
<h1> Page 1 [Home] </h1>

<h3>Digital Wallet</h3>

<p>1.<a href="Home.php">Home</a> 2.<a href="transaction-history.php">Transaction History</a></p>



 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
 	
<h3>Fund Transfer:</h3>

<label for="select category">Select Category : </label>
		<select id="select category" name="select category">
			<option value="select a value">Select a value</option>
			<option value="merchant pay">Merchant Pay</option>
			<option value=" mobile recharge ">Mobile Recharge </option>
			<option value="send money">Send Money</option>
			<span style="color: red;"> <?php echo $selectCategoryErr; ?> </span>
			</select>
			<br><br>

			<label for="to">To:</label>
			<input type=""tel" name="to" id="to">
			<span style="color:red"><?php echo $tOErr; ?></span>

			<br><br>

			<label for="amount">Amount:</label>
			<input type="amount" name="amount" id="amount">
			<span style="color:red"><?php echo $amoUntErr; ?></span>

			<br><br>

			<input type="submit" name="submit" value="Submit">
 </form>

 <p style="color:green;"><?php echo $successfulMessage; ?></p>
	<p style="color:red;"><?php echo $errorMessage; ?></p>
	<br>

</body>
</html>