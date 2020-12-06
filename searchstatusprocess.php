<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="UTF-8">
        <title>Search Result</title>
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
                        <a class="nav-link" href="poststatusform.php">Post Status</a>
                    </li>
                    <li class="nav-link active">
                        <a class="nav-link" href="searchstatusform.html" style="font-weight: 600;">Search</a>
                    </li>
                </ul>
            </div>
        </nav>
        
        <!-- Content of the search -->
        <div class="content-search">
              <h1 class="result-head">Status Information</h1>
               <?php
                    //Retrieve data from form            
                    if(isset($_GET['submit'])){
                     
                        $status = $_GET['status'];
                        
                    }
            
                    $errorcount = 0;
                    
                    //checking for required field
                    if(empty($status) == true){

                            echo '<p class="error"><strong style="color:red;">*</strong>Required field need to be submitted. </p><br>';
                            $errorcount += 1;
                            
                    }
            
                    //status criteria validation
                    if(!@preg_match('/^[A-Za-z0-9\ \.\?\!]+$/', $status)){
                        
                        echo '<p class="error"><strong style="color:red;">*</strong>Status can only contain alpanumeric charcters including spaces, comma, full stop, exclamation point and question mark.</p><br>';
                        $errorcount += 1;
                        
                    }
            
                    if($errorcount == 0){
                        //login to database
                        require_once('../../conf/sqlinfo.inc.php');

                        $connection = mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_db);

                        if(!$connection){

                            echo "<p class='error'>Error occured during the connection to the server.</p>";

                        } else {
                            //Search for user input from Database
                            @$query = "SELECT * FROM statuses WHERE status LIKE '%{$status}%'";

                            $result = mysqli_query($connection, $query);

                            //Checking if result are found
                            $count = mysqli_num_rows($result);

                            //Check the count and start display.
                            if($count > 0){

                                //Display information to user
                                while($row = mysqli_fetch_array($result)){

                                    echo "<div class='search-result'>";
                                    echo "<h6>Status: " . $row['status'] . "</h6>";
                                    echo "<h6>Status Code: " . $row['code'] . "</h6>";
                                    echo "<h6 class='share'>Share: " . $row['share'] . "</h6>";

                                    //Date convertion
                                    $row['date'] = date('F d, Y', strtotime($row['date']));

                                    echo "<h6>Date Posted: " . $row['date'] . "</h6>";
                                    echo "<h6>Permission: " . $row['permission'] . "</h6>";
                                    echo "</div>";
                                }

                            } else{

                                //Display when there is no match result
                                echo '<p class="error"><strong style="color:red;">*</strong>There is no  matching result for that search. Try Again.</p><br>';
                            }

                        }

                        mysqli_close($conn);  
                    }
                ?>
                
            <!-- Buttons -->
            <div class="item-buttons">
                <form>
                    <input type="submit", value="Back to Search" formaction="searchstatusform.html" class="btn btn-primary">                
                    <input type="submit", value="Back to Home" formaction="index.html" class="btn btn-primary">
                </form>
            </div> 
        </div>

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>