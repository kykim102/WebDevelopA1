<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="UTF-8">
        <title>Post Status</title>
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
        
        <!-- Form -->
        <form action="poststatusprocess.php" method="post" class="post-form">
            <div class="container">
                <h1 class="text-center">Status Posting System</h1>
                
                <div class="item">
                    <lable>Status Code (required):</lable><br>
                    <input class="textbox" type="text" name ="code" placeholder="e.g. S0001">
                </div>
                
                <div class="item">
                    <lable>Status (required):</lable><br>
                    <input class="textbox" type="text" name = "status" placeholder="e.g. Working on Assignment 1">
                </div>
                
                <div class="item">
                    <lable>Share:</lable><br>
                    <input type="radio" name="share" value="Public"><lable>Public</lable>
                    <input type="radio" name="share" value="Friends"><lable>Friends</lable>
                    <input type="radio" name="share" value="Only Me"><lable>Only Me</lable>
                </div>
                
                <div class="item">
                    <lable>Date:</lable><br>
                    <?php 
                        $date = new DateTime(); 
                        $dt= $date -> format ('Y-m-d'); 
                        echo "<input type='date' name='date' value='$dt'>";
                    ?>               
                </div>
                
                <div class="item">
                    <lable>Permission Type:</lable><br>
                    <input type="checkbox" name="permission[]" value="Allow Like"><lable>Allow Like</lable>
                    <input type="checkbox" name="permission[]" value="Allow Comment"><lable>Allow Comment</lable>
                    <input type="checkbox" name="permission[]" value="Allow Share"><lable>Allow share</lable>
                </div>  
                 
                <div class="item-buttons">
                    <input type="submit" name="submit" value="Post" class="btn btn-primary">
                    <input type="reset" name="reset" value="Reset" class="btn btn-primary">
                </div>
                
            </div>
        </form>

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>