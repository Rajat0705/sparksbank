<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sparks Bank</title>
	<link rel="stylesheet" href="Style/style.css">
</head>
<body>
<header>
    <h1>Sparks Bank</h1>
</header>
<nav>
    <a class = "button" href="index.php">Home</a>
    <a class = "button" href="db.php">View Customer</a>
    <a class = "button" href="transfer.php">Transfer</a>
    <a class = "button" href="history.php">Transfer History</a>
</nav> 
    <center>
    <table id="t01">
        <tr>
        <th> S.NO</th>
        <th> Payer Name</th>
        <th> Payer Account Number</th>
        <th> Payee Name</th>
        <th> Payee Account Number</th>
        <th> Amount</th>
        <th> Timestamp</th>
        </tr>
        <?php
        include 'crud.php';
        $sql = "SELECT * FROM `history`";
        $result = selectdata($sql);
        if($result != "zero")
        {        
        while($row = $result->fetch_assoc())
        {
        echo "<tr>";
        echo "<td>" . $row['id']. "</td>";
        echo "<td>" . $row['payername']. "</td>";
        echo "<td>" . $row['payeraccnum']. "</td>";
        echo "<td>" . $row['payeename']. "</td>"; 
        echo "<td>" . $row['payeeaccnum']. "</td>"; 
        echo "<td>" . $row['amount']. "</td>"; 
        echo "<td>" .  $row['reg_time']."</td>"; 
        echo "</tr>";
        }
        
        
        }
        /*include 'cad.php';
        $sql = "ALTER TABLE history AUTO_INCREMENT=1;";
        $result = ExecuteQuery($sql,"Set 1");*/
        ?>
    </table>
    <br>
    <br>
    <br>
    </center>
<footer>Designed and Coded by: Rajat Srivastava</footer>
</body>
</html>