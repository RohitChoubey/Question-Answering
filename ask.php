<?php
    session_start();
    include('connect.php');
    if(!isset($_SESSION['user']))
        header("location: login.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Inflibnet </title>
        <link type="text/css" rel="stylesheet" href="css/style.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/material.css">
        <link type="text/css" rel="stylesheet" href="fonts/font.css">
        <link rel="icon" href="images/icon1.png" >
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>	
		<style>
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
			@media (max-width: 700px) {
			  
			  .topnav{
					max-width:490px;
					}
			}
			@media (max-width: 700px) {
			  .sear{
					max-width:300px;
				 
					}
			}
		</style>
    </head>
    <body id="ask">
        <!-- navigation bar -->
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
				<?php
					}
				?>
				<a href="QA.php">Your Q/A</a>
				<a href="categories.php">Categories</a>
				<a href="ask.php">Ask Question</a>	
				<a href="index.php">Home</a>

				  
		   
		  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
			<i class="fa fa-bars"></i>
		  </a>
		</div>
        
        <!-- content -->
        <div id="content">
            <div id="sf" class="sear">
                <center>
                    <div class="heading ask">
                        <h1 class="logo"><div id="i">i</div><div id="cir">i</div><div id="ntro">nflibnet</div></h1>
                        <p id="tag-line">where questions are themselves the answers</p>
                    </div>

                    <form action="<?php echo htmlspecialchars( $_SERVER["PHP_SELF"] ); ?>" method="post" enctype="multipart/form-data" style="500px;">

                        <input name="question" type="text" title="Your Question..." placeholder="Ask Your question on our Community for greate user expereince..." id="question" required>

                        <select name="cat" style="color:white;" required>
                            <option value="Category">Category</option>
                            <option value="Algorithms">Algorithms</option>
                            <option value="Architecture">Architecture</option>
                            <option value="Theory Of Computation">TOC</option>
                            <option value="Database Management">DBMS</option>
                            <option value="Probability &amp; Queuing">PQT</option>
                            <option value="Software Engineering">SE</option>
                            <option value="Other">Other</option>
                        </select>
                        <input name="submit" type="submit" class="up-in" id="ask_submit">
                    </form>
                </center>
            </div>
        </div>
        
        <div id="ask-ta">
            <h1>Thank You.<br>Stay tunned for updates.</h1>
        </div>
        
        <?php
        
            if( isset( $_POST["submit"] ) )
            {

                function valid($data){
                    $data=trim(stripslashes(htmlspecialchars($data)));
                    return $data;
                }
                $question = valid( $_POST["question"] );
                
                $no = valid( $_POST["cat"]);
                $question = addslashes($question);
                $q = "SELECT * FROM quans WHERE question = '$question'";
                $result = mysqli_query($conn,$q);
                if(mysqli_error($conn))
                    echo "<script>window.alert('Some Error Occured. Try Again or Contact Us.');</script>";
                else if( $no == "Category"){
                    echo "<script>window.alert('Choose a Category.');</script>";
                }
                else if( mysqli_num_rows($result) == 0 ){
                    $query = "INSERT INTO quans VALUES(NULL, '$question', NULL,'".$_SESSION['user']."',NULL)";
                    $query1 = "INSERT INTO quacat SELECT q.id, c.name FROM quans as q, category as c WHERE q.question = '".$question."' AND c.name = '".$_POST['cat']."'";
                    mysqli_query( $conn, $query);
                    if(mysqli_query( $conn, $query1)){
                        echo "<style>#sf{display: none;} #ask-ta{display:block;}</style>";
                    }
                    else{
                        echo "<script>window.alert('Some Error Occured. Try Again or Contact Us.');</script>";
                    }
                }
                else{
                    echo "<script>window.alert('Question was already Asked. Search it on Home Page.');</script>";
                }
                
                mysqli_close($conn);
            }
        
        ?>
        
        <!-- Footer -->
        <div id="footer" class="topnav" style="padding:30px;">
            &copy; 2020-21 &bull; Inflibnet.
        </div>
        
        <!-- Sripts -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script type="text/javascript" src="js/jquery-3.2.1.min.js"><\/script>')</script>
        <script type="text/javascript" src="js/script.js"></script>
        
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