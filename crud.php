<?php
include_once 'db_connection.php';
function selectdata($sql)
{
  $conn = OpenCon();
  
  $result = $conn->query($sql) or die($conn->error);
  if($result)
  {
    if($result->num_rows > 0)
    {
      return $result;
    }
    else
    {
      return "zero";
    }
  }
  else
  {
    return $result->error;
  }
}

function updatedata($sql)
{
  $conn = OpenCon();
  
  $result = $conn->query($sql) or die($conn->error);
  if($result)
  {
    return $result;
  }
  else
  {
    return $result->error;
  }
}


?>