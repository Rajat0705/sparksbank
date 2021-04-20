<?php
include_once 'db_connection.php';

function MultiQuery($quries)
{
  $conn = OpenCon();
  
  
  if($conn->multi_query($quries) === true)
  {
    CloseCon($conn);
    return true;
  }
  else
  {
    return $conn->error;
  }
}

function ExecuteQuery($sql,$name)
{
  $conn = OpenCon();
  if ($conn->query($sql) === TRUE) 
  {
        return $name;
  } 
  else 
  {
    $error = "Error creating table: " . $conn->error;
    CloseCon($conn);
        return $error;
  }
}
?>