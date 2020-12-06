<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="UTF-8">
        <title>Post Result</title>
        <link rel="stylesheet" href="poststatusform.css?<?php echo time(); ?>" type="text/css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   

    </head>
    <body>
       
       <!--Nav bar-->
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-link active">
                        <a class="nav-link" href="index.html">Home</a>
                    </li>
                    <li class="nav-link active">
                        <a class="nav-link" href="about.html">About</a>
                    </li>
                    <li class="nav-link active">
                        <a class="nav-link" href="poststatusform.php" style="font-weight: 600;">Post Status</a>
                    </li>
                    <li class="nav-link active">
                        <a class="nav-link" href="searchstatusform.html">Search</a>
                    </li>
                </ul>
            </div>
        </nav>
        
        <!--Main Content-->
        <div class="content">
               <?php
                    //Retrieve data from form            
                    if(isset($_POST['submit'])){
                        
                        $code = $_POST['code'];
                        $status = $_POST['status'];
                        $share = @$_POST['share'];                       
                        $date = @$_POST['date'];     
                        $permissions = @$_POST['permission'];
                        $permission = @implode(', ', $permissions); 
                        
                    }
                    
                    //Counting error number
                    $errorcount = 0;    
            
                    //checking for required field
                    if(empty($code) || empty($status) == true){

                            echo '<p class="error"><strong style="color:red;">*</strong>Required field need to be submitted. </p><br>';
                            $errorcount += 1;
                            
                    }
            
                    //code length validation
                    if(strlen($code) > 5 || strlen($code) < 5){
                        
                            echo '<p class="error"><strong style="color:red;">*</strong>Code need to be 5 length long. </p><br>';
                            $errorcount += 1;
                            
                    }
            
                    //code criteria validation
                    if (!preg_match('/^S\d{4}$/', $code)){
                            
                            echo '<p class="error"><strong style="color:red;">*</strong>Code need to start with an upper case letter "S" followed by 4 numbers. </p><br>';
                            $errorcount += 1;
                            
                    }
                    
                    //status criteria validation
                    if(!preg_match('/^[A-Za-z0-9\ \.\?\!]+$/', $status)){
                        
                        echo '<p class="error"><strong style="color:red;">*</strong>Status can only contain alpanumeric charcters including spaces, comma, full stop, exclamation point and question mark.</p><br>';
                        $errorcount += 1;
                        
                    }
            
                    //login to database
                    require_once('../../conf/sqlinfo.inc.php');

                    // login and retreive data from database
                    $conn = mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_db);
            
                    $query = "SELECT * FROM statuses WHERE code = '$code'";
                        
                    $result = mysqli_query($conn, $query);
                            
                        
                    //Checking for code from database and comparing.
                    if (@mysqli_num_rows($result)>0){
                        
                        $errorcount += 1;
                        die ("<p class='error'><strong style='color:red;'>*</strong>Status Code '".$code ."' is already in used</p><br>
                                <div class='item-buttons'>
                                    <form>
                                        <input type='submit', value='Back to Post' formaction='poststatusform.php' class='btn btn-primary'>   
                                        <input type='submit', value='Back to Home' formaction='index.html' class='btn btn-primary'>
                                    </form>
                                </div>");
                                
                    }      
            
                    if($errorcount == 0){
                    ?>    
                        <!--Show result-->
                        <div class='confirm-result'>
                            <h6>Status: <?php echo $code; ?></h6>
                            <h6>Status Code: <?php echo $status; ?></h6>
                            <h6 class='share'>Share: <?php echo $share; ?></h6>
                            <h6>Date Posted: <?php echo $date; ?></h6>
                            <h6>Permission: <?php echo $permission; ?></h6>
                        </div>

                    <?php
                                                        
                        echo '<p class="success">Status has been uploaded succeefully.</p><br>';

                        if (true == $conn){
                            //Inserting data to database
                            $query = "INSERT INTO statuses(code, status, share, date, permission)";

                            $query .= "VALUES ('$code', '$status', '$share', '$date', '$permission')";

                            $result = mysqli_query($conn, $query);

                        }                   
                     
                    }
                
                mysqli_close($conn);

                ?>
            
            <!-- Buttons -->
            <div class="item-buttons">
                <form>
                    <input type="submit" value="Back to Post" formaction="poststatusform.php" class="btn btn-primary">                
                    <input type="submit" value="Back to Home" formaction="index.html" class="btn btn-primary">
                </form>
            </div> 
        </div>

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>