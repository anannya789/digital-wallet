<?php 
	define("filepath", "user.json");
	$selectCategory = $tO = $amoUnt = "";
	$isValid = true;
	$selectCategoryErr = $tOErr = $amoUntErr = "";
	$tid=" ";

	if(isset($_COOKIE['tid'])) {
		$tid = $_COOKIE['tid'];
	}

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
		if($isValid) {
			$user_data = read();
			$user_data_array = explode("\n", $user_data);
			$found = false;
			for($i = 0; $i < count($user_data_array) - 1; $i++) {
				$user_data_array_decode = json_decode($user_data_array[$i]);
				if($selectCategory === $user_data_array_decode->selectCategory &&
				$tO === $user_data_array_decode->tO && $amoUnt===$user_data_array_decode->amount) {
					$found = true;
					break;
				}
			}
}
		
	}
}

	function read() {
		$resource = fopen(filepath, "r");
		$fz = filesize(filepath);
		$fr = "";
		if($fz > 0) {
			$fr = fread($resource, $fz);
		}
		fclose($resource);
		return $fr;
	} 
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title>transaction-history</title>
</head>
<body>

	<h1> Page 2 [Transaction History] </h1>

<h3>Digital Wallet</h3>

<p>1.<a href="Home.php">Home</a> 2.<a href="transaction-history.php">Transaction History</a></p>

 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">	
<style> table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}

th, td {
  padding: 5px;
  text-align: left;    
}

</style>

<h2>Total Records:</h2>

<table style="width:100%">
  <tr>
    <th>Transaction Category</th>
    <th>To</th>
    <th>Amount</th>
    <th>Transferred On</th>
  </tr>
  <tr>
    <td>Transaction Category</td>
    <td>To</td>
    <td>Amount</td>
    <td>Transferred On</td>
  </tr>
  
</table>

</form>
</body>
</html>