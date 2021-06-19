<?php
include 'config.php';

if(isset($_POST['submit']))
{
    $from = $_GET['id'];
    $toUser = $_POST['to'];
    $amnt = $_POST['amount'];

    $sql = "SELECT * from users where id=$from";
    $query = mysqli_query($conn,$sql);
    $sql1 = mysqli_fetch_array($query); // returns  output of user from which the credits are to be transferred.

    $sql = "SELECT * from users where id=$toUser";
    $query = mysqli_query($conn,$sql);
    $sql2 = mysqli_fetch_array($query);
   


  
   //to print insufficient balance if there is.
 if($amnt > $sql1['credits'])
    {

        echo '<script type="text/javascript">';
        echo ' alert("Insufficient Balance")';  //  an alert box.
        echo '</script>';
    }

     else if($amnt == 0){
         echo "<script type='text/javascript'>alert('Enter Amount Greater than Zero');
    </script>";
     }
    else {

        //if not, sufficient amount,transaction begins
        $newCredit = $sql1['credits'] - $amnt;
        $sql = "UPDATE users set credits=$newCredit where id=$from";
        mysqli_query($conn,$sql);



        $newCredit = $sql2['credits'] + $amnt;
        $sql = "UPDATE users set credits=$newCredit where id=$toUser";
        mysqli_query($conn,$sql);

        $sender = $sql1['name'];
        $receiver = $sql2['name'];
        $det="INSERT INTO transaction(`sender`, `receiver`, `credits`) VALUES ('$sender','$receiver','$amnt')";
        $detsubmit=mysqli_query($conn,$det);
        if($det){
           echo "<script type='text/javascript'>
                    alert('Transaction Successfull!');
                    window.location='transaction.php';
                </script>";
        }
        
        
       $newCredit= 0;
       $amnt =0; 
    }

}
?>

<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>APEX BANKING SYSTEM</title>
        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="css/style.css" rel="stylesheet">
        <!-- jQuery -->
        <script src="js/jquery.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
         <style>
            .button {
                background-color: #5cb85c;
                border: none;
                color: white;
                padding: 5px 10px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                border-radius: 5px;
                
           
              }
              
              .astyle{
                  background-color: #5cb85c;
                  width: 600px;
                  height:100px;
                  
              }

                table, th, td {
                border: 1px solid #5cb85c ;
                border-collapse: collapse;
                }

                table.center {
                margin-left: auto; 
                margin-right: auto;
                }

        </style>
        
        
        </head>

    <body style="padding-top: 50px;">
        <!-- Header -->
       <!-- <div class="navbar navbar-inverse navbar-fixed-top" style="background-color:#5cb85c;">-->
            <div class="container"style="background-color:#5cb85c ; height: 50px;>
                <div class="navbar-header">

                    <a class="navbar-brand" href="index.php" style="text-decoration:none; color:white; font-size:25px;"> APEX BANKING SYSTEM</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar" style="display:flex;">
                    <ul class="nav navbar-nav navbar-right"style="list-style-type:none;">
                        <li><a href="users.php" style="text-decoration:none; color:black;"><i class="fas fa-users"></i>view customers</a></li> 
                        
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- body-->
        <div class="container " style="text-align: center">
        <h1>Transaction Here</h1><hr style="height:2px; width:50%; background-color:#5cb85c ;">
            <?php
                include 'config.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM  users where id=$sid";
                $query=mysqli_query($conn,$sql);
                if(!$query)
                {
                    echo "Error ".$sql."<br/>".mysqli_error($conn);
                }
                $rows=mysqli_fetch_array($query);
            ?>
            <form method="post" name="tcredit" class="tabletext" ><br/>
        <label> From: </label><br/>
       <div class="area"  style="text-align:center">
        
        <div>
                    <table class="table roundedCorners  tabletext table-hover  table-striped table-condensed astyle center" style="text-align:center; color:white;" >
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Amount Transferred</th>
                        </tr>
                        <tr>
                            <td><?php echo $rows['id'] ?></td>
                            <td><?php echo $rows['name'] ?></td>
                            <td><?php echo $rows['email'] ?></td>
                            <td><?php echo $rows['credits'] ?></td>
                        </tr>
                    </table>
                </div>

       </div>
        <br/><br/>
        <label>To:</label>
        <select class=" form-control"   name="to" style="margin-bottom:5%;" required style="text-align:center">
            <option value="" disabled selected> </option>
            <?php
                include 'config.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM users where id!=$sid";
                $query=mysqli_query($conn,$sql);
                if(!$query)
                {
                    echo "Error ".$sql."<br/>".mysqli_error($conn);
                }
                while($rows = mysqli_fetch_array($query)) {
            ?>
                <option class="table text-center table-striped " value="<?php echo $rows['id'];?>" >

                    <?php echo $rows['name'] ;?>
                    <!--(Credits:
                    <?php echo $rows['credits'] ;?> )-->

                </option>
            <?php
                }
            ?>
        </select> <br/><br/>
            <label>Amount:</label>
            <input type="number" id="amm" class="form-control" name="amount" min="0" required  />  <br/><br/>
                <div class="text-center btn3" >
            <button class="button" name="submit" type="submit" id="myBtn">Proceed</button>
            </div>
        </form>
    </div>
 </body>      
</html>       