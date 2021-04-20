<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sparks Bank</title>
	<link rel="stylesheet" href="Style/style.css">
</head>
<script src="JS/sweetalert.js"></script>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
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
    <div id="d01">
    <?php
        $payeeErr = $payerErr = $amountErr = "";
        $payee = $payer = $amount = "";


        if ($_SERVER["REQUEST_METHOD"] == "POST") 
        {
            $payer = test_input($_POST["payer"]);
            $payee = test_input($_POST["payee"]);
            $amount = test_input($_POST["amount"]);
            if(empty($_POST["payer"]) or empty($_POST["payee"]) or empty($_POST["amount"]))
            {
                if (empty($_POST["payer"])) {
                    $payerErr = "Account number is required";
                } 
                if (empty($_POST["payee"])) {
                    $payeeErr = "Account Number is required";
                } 
                if (empty($_POST["amount"])) {
                    $amountErr = "Amount is required";
                } 
            }
            else if(!preg_match("/^[0-9]*$/",$payer) or !preg_match("/^[0-9]*$/",$payee) or !preg_match("/^[0-9]*$/",$amount))
            {
                if (!preg_match("/^[0-9]*$/",$payer)) 
                {
                    $payerErr = "Only positive digits are allowed";
                }
                if (!preg_match("/^[0-9]*$/",$payee))  
                {
                    $payeeErr = "Only positive digits are allowed";
                }
                if (!preg_match("/^[0-9]*$/",$amount))  
                {
                    $amountErr = "Only positive digits are allowed";
                }

            }
            else if($payer == $payee)
            {
                ?>
                    <script>
                        swal({
                        title: "Transfering to same account",
                        icon: "warning",
                        button: "Ok",
                        });
                    </script>
                <?php
            }
            else
            {            
                $pay1 = $_POST["payer"];
                $pay2 = $_POST["payee"];
                $amt = $_POST["amount"];
                include 'crud.php';
                $sql = "SELECT * FROM `customers` where accnum=$pay1";
                $result = selectdata($sql);
                if($result != "zero")
                {
                    $row = $result->fetch_assoc();
                    if($row["amount"] >= $amt)
                    {
                        $payername=$row["cname"];
                        $amt=$row["amount"]-$amt;
                        $sql = "UPDATE `customers` SET `amount` = $amt WHERE `customers`.`accnum` = $pay1";
                        $result = updatedata($sql);
                        ?>
                        <script>
                            swal({
                            title: "Transfer Successfully!!!",
                            icon: "success",
                            button: "Ok",
                            });
                        </script>
                        <?php
                        $amt = $_POST["amount"];
                        $sql1 = "SELECT * FROM `customers` where accnum=$pay2";
                        $result1 = selectdata($sql1);
                        if($result1 != "zero")
                        {
                            $row = $result1->fetch_assoc();
                            $payeename=$row["cname"];
                            $amount=$_POST["amount"];
                            $amt=$row["amount"]+$amt;
                            $sql1 = "UPDATE `customers` SET `amount` = $amt WHERE `customers`.`accnum` = $pay2";
                            $result1 = updatedata($sql1);                            
                            include 'cad.php';
                            $sql = "INSERT INTO history(payername,payeraccnum,payeename,payeeaccnum,amount,reg_date,reg_time) 
                            VALUES ('$payername',$pay1,'$payeename',$pay2,$amount,CURDATE(),CURTIME())";
                            $result = MultiQuery($sql); 
                        }
                        else{
                            ?>
                        <script>
                            swal({
                            title: "Insufficient balance",
                            icon: "error",
                            button: "Ok",
                            });
                        </script>
                        <?php
                        }
                    }
                    else
                    {
                        ?>
                        <script>
                            swal({
                            title: "Insufficient balance",
                            icon: "error",
                            button: "Ok",
                            });
                        </script>
                        <?php
                    }
                }
                else{
                    ?>
                        <script>
                            swal({
                            title: "Wrong Account number",
                            icon: "error",
                            button: "Ok",
                            });
                        </script>
                        <?php
                }
            }
        }
       
        function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
        }
        ?>

        
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
        <table class=transfer-form>
            <thead>
                <tr>
                    <th colspan="2"><h1> Transfer</h1></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Payer Account Number:</td>
                    <td><input type="text" name="payer">
                        <span class="error">* <?php echo $payerErr;?></span>
                    </td>
                </tr>
                <tr>
                    <td>Payee Account Number:</td>
                    <td><input type="text" name="payee">
                        <span class="error">* <?php echo $payeeErr;?></span>
                </td>
                </tr>
                <tr>
                    <td>Amount(in Ruppees):</td>
                    <td><input type="text" name="amount">
                        <span class="error">* <?php echo $amountErr;?></span>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <td></td>
                <td><input type="submit" name="submit" value="Submit"> </td> 
            </tfoot>

        </table>
        </form>
    </div>
    <footer>Designed and Coded by: Rajat Srivastava</footer>
</body>
</html>