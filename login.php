
<?php
    session_start();

    if( isset($_SESSION['user'])){
        header("Location: profile.php");
    }

    if( isset( $_POST["submit"] ) )
    {   

        function valid($data){
            $data=trim(stripslashes(htmlspecialchars($data)));
            return $data;
        }

        $inuser = valid( $_POST["username"] );
        $inkey = valid( $_POST["password"] );

        include("connect.php");

        $query = "SELECT username, password, name, email, join_date FROM users WHERE username='$inuser'";

        $result = mysqli_query( $conn, $query);
        if(mysqli_error($conn)){
            echo "<script>window.alert('Something Goes Wrong. Try Again');</script>";
        }
        else if( mysqli_num_rows($result) > 0 ){
            while( $row = mysqli_fetch_assoc($result) ){
                $user = $row['username'];
                $pass = $row['password'];
                $name = $row['name'];
                $email = $row['email'];
                $date = $row['join_date'];
             }
 /* print_r($pass);
   print_r($$inkey);
  exit(); */
            if( $inkey == $pass ){
                $_SESSION['user'] = $user;
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                $_SESSION['date'] = $date;
                header('Location: index.php');
            }
            else{
                echo "<script>window.alert('Wrong Username or Password Combination. Try Again');</script>";
				
            }
        }
        else{
            echo "<script>window.alert('No Such User exist in database');</script>";
        }
        mysqli_close($conn);
    }
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
					max-width:480px;
				 
					}
			}
		</style>
    </head>
    <body id="_5">
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
					<a href="QA.php"><li>Your Q/A</li></a>
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
        <div id="content"  > 
            <center class="sear">
                <div class="heading">
                    <h1 class="logo"><div id="i">i</div><div id="cir">i</div><div id="ntro">nflibnet</div></h1>
                    <p id="tag-line">where questions are themselves the answers</p>
                </div>
                <form action="<?php echo htmlspecialchars( $_SERVER["PHP_SELF"] ); ?>" method="post" enctype="multipart/form-data">
                    <input name="username" id="user" type="text" title="Username" placeholder="Username" required>
                    <input name="password" id="key" type="password" title="Password" placeholder="Password" required>
                    <i class="material-icons" id="lock">lock</i>
                    <i class="material-icons" id="person">person</i> 
                    <div id="button-block">
                        <center>
                            <div class="buttons"><input name="submit" type="submit" value="Log In" class="up-in"></div>
                            <div class="buttons" id="new"><input type="button" value="Create a new account" class="up-in" id="tosign"></div>
                        </center>
                    </div>
                    <a href="contacts.php" id="trouble"><span>Having Trouble in login ? Contact Us</span></a>
                </form>
            </center>
        </div>
        
        
        <!-- Footer -->
        <div id="footer" class="topnav">
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