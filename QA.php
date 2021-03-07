<?php
    session_start();
	if(! isset($_SESSION['user'])){
        header("Location: login.php");
	}
    include('connect.php');
        if(isset($_POST["ansubmit"])){
        function valid($data){
            $data = trim(stripslashes(htmlspecialchars($data)));
            return $data;
        }
        $answer = valid($_POST["answer"]);
        if($answer == NULL){
            echo "<script>window.alert('Please Enter something.');</script>";
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
        <link type="text/css" rel="stylesheet" href="css/style.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/material.css">
        <link type="text/css" rel="stylesheet" href="fonts/font.css">
        <link rel="icon" href="images/icon1.png" >
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
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
    <body id="_4">
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
        <div id="content" class="clearfix" style="margin-top:20px;">
			<div id="box-2">
                <div id="text">
					<center>
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
							$user = $_SESSION["user"];
							$qu ="select question, answer,askedby,answeredby from quans where askedby ='".$user."'ORDER BY id DESC LIMIT $start_from, $limit"; 
							//  $qu ="select question, answer from quans where askedby =".$user; 
							//   if($re = mysqli_query($conn,$qu)){
							$retval = mysqli_query($conn,$qu);
							/* print_r($retval);
							exit(); */
							if(! $retval ) {
							  die('Could not get data:');
							}
							while($row  = mysqli_fetch_array($retval)){
								/* print_r("hs");
								exit(); */
								//echo
								/* "Question : {$row['question']} <br> ".
								"Answer : {$row['answer']} <br> ".
								"--------------------------------<br>"; */
							//}
						?>
						<div id="qa-block">
							<div class="question">
									<div id="Q">Q.</div><?php echo $row["question"]."<small id='sml'>Asked By: @".$row['askedby']."</small>"; ?>
								</div>
							<div class="answer">
                                <?php
                                    if($row["answer"]){
                                        $nul=0;
                                        echo $row["answer"]."<br><small>Answered By: @".$row['answeredby']."</small>";
                                    }
                                    else{
                                        $nul=1;
                                        echo "<em>*** Not Answered Yet ***</em>";
                                    }
                                ?>
                                <form id="f<?php echo $n; ?>" style="margin-bottom: -25px;" action="<?php echo htmlspecialchars( $_SERVER["PHP_SELF"] ); ?>" method="post" enctype="multipart/form-data">
<!--                                    <input type="button" value="Click here to answer." id="ans_b" >-->
                                    <label style="margin-bottom: -25px;"><a id="ans_b<?php echo $n; ?>" href="#area<?php echo $no; ?>"><!--<u>Submit your answer</u>--></a></label>
                                    <br>
                                    <script>
                                        $(function(){
                                            $('#ans_b<?php echo $n; ?>').click(function(e){
                                                e.preventDefault();
                                                $('#area<?php echo $n; ?>').css("display","block");
                                                $('#ar<?php echo $n; ?>').css("display","block");
                                                $('#f<?php echo $n; ?>').css("margin-bottom","0px");
                                            });
                                        });
                                    </script>
                                    <textarea id="area<?php echo $n; ?>" name="answer" placeholder="Your Answer..." style="padding: 12px 20px;"></textarea>
                                    <input style="display: none;" name="question" value="<?php echo $row['question'] ?>">
                                    <input style="display: none;" name="nul" value="<?php echo $nul ?>">
                                    <input style="display: none;" name="preby" value="<?php echo $row['answeredby'] ?>">
                                    <br>
                                    <input type="submit" name="ansubmit" value="Submit" class="up-in ans_sub" id="ar<?php echo $n; ?>">
                                    <br><br>
                                </form>
                                
       
                        </div>
					</div>	
					<?php  } ?>
					
					<?php  
						include('connect.php');
						$user = $_SESSION["user"];
						$result_db = mysqli_query($conn,"SELECT COUNT(id) FROM quans where askedby ='".$user."'"); 
						$row_db = mysqli_fetch_row($result_db);  
						$total_records = $row_db[0];  
						$total_pages = ceil($total_records / $limit); 
						/* echo  $total_pages; */
						$pagLink = "<ul class='pagination'>";  
						for ($i=1; $i<=$total_pages; $i++) {
									  $pagLink .= "<li class='page-item'><a class='page-link' href='QA.php?page=".$i."'>".$i."</a></li>";	
						}
						echo $pagLink . "</ul>";  
					?>
										
				</div>
			</div>
		</div>
    
        <!-- Footer -->
        <div id="footer" class="topnav">
            &copy; 2020- 21&bull; Inflibnet.
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