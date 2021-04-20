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
        <table class="database"  id="t01">
            <tr>
            <th> S.NO</th>
            <th> Account Number</th>
            <th> Name</th>
            <th> Email</th>
            <th> Balance</th>
            </tr>
            <?php
            include 'crud.php';
            $sql = "SELECT * FROM `customers`";
            $result = selectdata($sql);
            if($result != "zero")
                {
            
            while($row = $result->fetch_assoc())
            {
            echo "<tr>";
            echo "<td>" . $row['id']. "</td>";
            echo "<td>" . $row['accnum']. "</td>";
            echo "<td>" . $row['cname']. "</td>";
            echo "<td>" . $row['email']. "</td>"; 
            echo "<td>" . $row['amount']. "</td>"; 
            echo "</tr>";
            }
            
            
            }
            else
            {
            echo $result;
            }
            ?>
        </table>
    </center>
    <footer>Designed and Coded by: Rajat Srivastava</footer>
</body>
</html>