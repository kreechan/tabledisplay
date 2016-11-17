<?php

if(isset($_POST['search']))
{
      $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `user`  WHERE CONCAT(`id`, `fname`, `lname`, `department`) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
    
    
}
else{
    $query = "SELECT * FROM `user` LIMIT 10";
    $search_result =  filterTable($query);
}

function filterTable($query)
{
    $connect = mysqli_connect("localhost","root","","tabledisplay");
    
    $filter_Result = mysqli_query($connect, $query);
   
    return $filter_Result;
  
}

if(isset($_REQUEST['delete'])){
 
 $connect = mysqli_connect("localhost","root","","uscregister");
$query = mysqli_query($connect, "TRUNCATE TABLE user") or die("Error: ".mysql_error());
    header('Location: index.php');
 //clearDB($connect);
}else{
    echo ("");
}

//function clearDB($connect){
//    $msg = ("SUCCESS");
//echo '<script type="text/javascript">alert("' . $msg . '")</script>';
    //
//}
?>


<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <script src="js/bootstrap.min.js"></script>
    <title></title>
</head>

<body><br><br>
    <div class="container">
        <form action="index.php" method="post">
           <div class="row">
               <div class="col-sm-3"></div>
                <div class="col-sm-3"></div>
            <div class="col-sm-3">
               <input type="text" class="form-control" name="valueToSearch" placeholder="Search">
            </div>
            <div class="col-sm-3">
               <input type="submit" class="form-control" value="Search" name="search">
            </div>
            </div>
            <br>
           <div class="panel panel-default">
           <div class="panel-heading">
           <h4>User Information</h4>
           </div>
            <table class="table table-hover">
              <tr>
                   <th>ID</th> 
                   <th>First Name</th>
                   <th>Middle Name</th>
                   <th>Last Name</th>
                   <th>Department</th>
               </tr>
               <?php while($row = mysqli_fetch_array($search_result)): ?>
               <tr>
                   <td><strong><?php echo $row['id']; ?></strong></td>
                   <td><?php echo $row['fname']; ?></td>
                   <td><?php echo $row['mname']; ?></td>
                   <td><?php echo $row['lname']; ?></td>
                   <td width="15%"><?php echo $row['department']; ?></td>
                   <td width="100px"><button type="submit" class="btn btn-success">Sign in</button></td>
                   
                   
               </tr>
              <?php endwhile; ?>
            </table>
            </div>
        </form>
    <!-- <button class="btn btn-warning" onClick="deletedb()">DELETE DATABASE</button> -->
    
    <form method="" action="index.php">
    <input class="btn btn-warning" type="submit" value="DELETE DATABASE" onClick="test();">
    </form>
    
    </div>
    <script>
    function test(){
        
        confirm("Are you sure?");

    }
    </script>
</body>
</html>