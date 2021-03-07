<?php
    session_start();
    include('connect.php');
        if(isset($_POST["ansubmit"])){
        function valid($data){
            $data = trim(stripslashes(htmlspecialchars($data)));
            return $data;
        }
        $answer = valid($_POST["answer"]);
        if($answer == NULL ||! isset($_SESSION['user']) ){
            echo "<script>window.alert('Login To Submit Your Answer');</script>";
			header("Location: login.php");
        }
        else{
            $que = "";
			if($_POST["nul"]==0){
                if(strpos($_POST["preby"],$_SESSION["user"]) === false)
                    $que = "update quans set answer=CONCAT(answer,'<br>or<br>".$_POST["answer"]."'), answeredby=CONCAT(answeredby,', @ ".$_SESSION["user"]."') where question like '%".$_POST["question"]."%'";
                else
                    $que = "update quans set answer=CONCAT(answer,'<br>or<br>".$_POST["answer"]."'), answeredby = '".$_SESSION["user"]."' where question like '%".$_POST["question"]."%'";
            }
            else
                $que = "update quans set answer='".$_POST["answer"]."', answeredby = '".$_SESSION["user"]."' where question like '%".$_POST["question"]."%'";
            if(mysqli_query($conn,$que)){
                echo "<style>#searchbox{display: none;} #tb{display: block;}</style>";
            }
            else
                echo mysqli_error($conn);
        }
    }
?> 
<!DOCTYPE html>
<html>
    <head>
        <title> Inflibnet </title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<link type="text/css" rel="stylesheet" href="css/style.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="css/material.css">
		<link type="text/css" rel="stylesheet" href="fonts/font.css">
		<link rel="icon" href="images/icon1.png" >
        
        <style>
            textarea{
                display: none;
                width: 300px;
                height: 50px;
                background: #333;
                color: #ddd;
                padding: 10px;
                margin: 5px 0 -14px; 
            }
            .ans_sub{
                display: none;
                padding: 0 10px;
                height: 30px;
                line-height: 30px;
            }
            .pop{
                display: none;
                text-align: center;
                margin: 151.5px auto;
                font-size: 12px;
            }
			 @media screen and (max-width: 600px) {
			  body:not(:first-child) {position: absolute;left: auto;display:contents;}
			  center:not(:first-child) {position: absolute; left:120px; display:contents;width:auto;}
			}

			/*@media screen and (max-width: 600px) {
			  body.responsive {position: absolute;}
				  body.responsive {
					body.responsive di {
						position: absolute; display:contents;width:auto
					}
				}	
			} */
			@media screen and (min-height: 450px) {
			  .sidenav {padding-top: 15px;}.sidenav a {font-size: 18px;}
			  
			}
			@media only screen 
				form (min-device-width : 320px) 
				and (max-device-width : 480px) {
				/* Styles */
			}
			body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

/* full logo */
.logo{
    display: block;
    padding-right: 15px;
}
.topnav {
	overflow: hidden;
	background-color: #515ada;
  
  
}

.topnav a {
  float: right;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
  margin-top:10px;
  
  	
}

.topnav a:hover {
  background: linear-gradient(90deg, #efd5ff 0%, #515ada 100%);
  color: black;
}

.topnav a.active {
  background-color: #4CAF50;
  color: white;
}

.topnav .icon {
  display: none;
}

@media screen and (max-width: 600px) {
  .topnav a:not(:first-child) {display: none;}
  .topnav a.icon {
    float: right;
    display: block;
  }
}


@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
}

body{
	background-color:rgb(240, 240, 240);
	color: #333;
	/* background-image: url(images/bg-01.jpg);
	background-position: center;
	background-repeat: no-repeat;
	background-size: cover;
	position: relative; */
}
// #content{
    // max-width: 900px;
    // color: #333;
    // box-sizing: border-box;
    // padding: 100px 0;
    // background-image: url(images/bg-01.jpg);
	// background-position: center;
	// background-repeat: no-repeat;
	// background-size: cover;
	// position: relative;
	// margin-bottom: 20px;
	// margin-left:100px;
// }

        </style>
		

    </head>
    <body id="_1" > 
		<div class="topnav" id="myTopnav">
		<a href="index.php" style="margin-top:-30px;float: left;">
					<div id="log">
						<div id="i">i</div><div id="cir">i</div><div id="ntro">nflibnet</div>
					</div>
				</a><br/><br/>
		    
				<?php 
					if(! isset($_SESSION['user'])){
				?>
				<a href="login.php">Log In</a>
				<a href="signup.php">Sign Up</a>
				<?php
					}
					else{
				?>
					<a href="#">Hi, <?php echo $_SESSION["user"]; ?></a>
					<a href="logout.php">Log Out</a>
					<a href="QA.php">Your Q/A</a>
				<?php
					}
				?>
				<a href="categories.php">Categories</a>
				<a href="ask.php">Ask Question</a>	
				<a href="index.php">Home</a>

				  
		   
		  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
			<i class="fa fa-bars"></i>
		  </a>
		</div>
        <!-- content -->
		
        <div id="content" >
            <div id="searchbox">
                <center >
                    <div class="heading">
                        <h1 class="logo"><div id="i">i</div><div id="cir">i</div><div id="ntro">nflibnet</div></h1>
                        <p id="tag-line">where questions are themselves the answers</p>
                    </div>
                    <form action="SearchAction.php" method="post" enctype="multipart/form-data" >
                        <input name="text" id="search" type="text" title="Question your Answers" placeholder="Looking for Answers to Some Question, simply just search here... " style="max-width:450px;">
                        <i class="material-icons" id="sign">search</i>
                        <input name="submit" type="submit" value="Search" class="up-in" id="qsearch">
                    </form>
                </center>
            </div>
            <div class="pop" id="ta">
                <h1><b style="font-size: 1.5em; margin: -60px auto 10px; display: block;">:(</b>Sorry, Your search didn't match any documents.</h1>
            </div>
            <div class="pop" id="tb">
                <center><h1><b style="font-size: 1.5em; margin: -60px auto 10px; display: block;">:)</b>Thank You For Your Answer.</h1></center>
            </div>
           
					
					
					
					<?php
						 include('connect.php');
						 $limit = 5;  
						if (isset($_GET["page"])) {
							$page  = $_GET["page"]; 
						} 
						else{ 
							$page=1;
						};
						$start_from = ($page-1) * $limit;
						$result = mysqli_query($conn,"SELECT * FROM quans ORDER BY id DESC LIMIT $start_from, $limit");
						if (mysqli_num_rows($result) > 0) {
							$i=0;
							while($row = mysqli_fetch_array($result)) { 
					?>
				<center>
					<div id="qa-block" class="Qa">
						<div class="question ">
							<div id="Q">Q.</div>
							<?php 
								echo $row["question"]."<small id='sml'>Asked By: @".$row['askedby']."</small>";  
							?>
						</div>
						<div class="answer" style="font-size: 20px;">
							<?php
								 if($row["answer"]) {
									$nul=0;
									echo $row["answer"]."<br><small>Answered By: @".$row['answeredby']."</small>";
								}
								else {
									$nul=1;
									echo "<em>*** Not Answered Yet ***</em>";
								} 
							?>
							<form style="margin-bottom: -25px;" action="<?php echo htmlspecialchars( $_SERVER["PHP_SELF"] ); ?>" method="post">
								
								<textarea name="answer" placeholder="Your Answer..." style="padding: 12px 20px;"></textarea>
								
								<input name="answer"  placeholder="Your Answer..." style="padding: 25px 20px;"><br/>
								<input style="display: none;"name="question" value="<?php echo $row['question'] ?>">
								<input style="display: none;" name="nul" value="<?php echo $nul ?>">
								<input style="display: none;" name="preby" value="<?php echo $row['answeredby'] ?>">
								<br/>
								<input type="submit" name="ansubmit" value="Submit" class="up-in">
								<br><br>
							</form>
						</div>
                    </div>
                </center>
            <?php     
                         } 
						$i++;}	
						// if for no. of rows
                        else{
                           echo "Nothing to Display";
                        } 
                       
                     // a non null if
                 // isset for submit
           		include('connect.php');	
				$result_db = mysqli_query($conn,"SELECT COUNT(id) FROM quans"); 
				$row_db = mysqli_fetch_row($result_db);  
				$total_records = $row_db[0];  
				$total_pages = ceil($total_records / $limit); 
				/* echo  $total_pages; */
				$pagLink = "<center><ul class='pagination'>";  
				for ($i=1; $i<=$total_pages; $i++) {
							  $pagLink .= "<li class='page-item'><a class='page-link' href='index.php?page=".$i."'>".$i."</a></li>";	
				}
				echo $pagLink . "</ul></center>";  
			?>
		
        </div>
		
		
        <!-- Footer -->
        <div id="footer">
            &copy; 2020-21 &bull; Inflibnet.
        </div>
        
    </body>
<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>
</html>




