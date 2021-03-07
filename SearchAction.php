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
        <link type="text/css" rel="stylesheet" href="css/style.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/material.css">
        <link type="text/css" rel="stylesheet" href="fonts/font.css">
        <link rel="icon" href="images/icon1.png" >
        <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>	
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
			/* full logo */
			.logo{
				display: block;
				padding-right: 15px;
			}
			.topnav {
			  overflow: hidden;
			  background-color: #333;
			  
			  
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
					max-width:500px;
					margin-right:500px;
				 
					}
			}
        </style>
    </head>
    <body id="_1">
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
 
 <?php

                if(isset($_POST["submit"])) {
                    function valid($data){
                        $data = trim(stripslashes(htmlspecialchars($data)));
                        return $data;
                    }

                    function check($data){
                        $data = strtolower($data);
                        if( $data != "what" && $data != "how" && $data != "who" && $data != "whom" && $data != "when" && $data != "why" && $data != "which" && $data != "where" && $data != "whose" && $data != "is" && $data != "am" && $data != "are" && $data != "do" && $data != "don't" && $data != "does" && $data != "did" && $data != "done" && $data != "was" && $data != "were" && $data != "has" && $data != "have" && $data != "will" && $data != "shall" && $data != "the" && $data != "i" && $data != "a" && $data != "an" && $data != "we" && $data != "he" && $data != "she" && $data != "")
                            return 1;
                        return 0;
                    }
                    $text = valid($_POST["text"]);
                    if($text == NULL){
                        echo "<script>window.alert('Please Enter something to search.');</script>";
                    }
                    else{
                        $text = preg_replace("/[^A-Za-z0-9]/"," ",$text);
                        $words = explode(" ",$text);
                        $format = "select * from quans where question like '%";
                        $query = "";
                        foreach($words as $word){
                            if(check($word)){
                                if($query == "")
                                    $query = $format.$word."%'";
                                else
                                    $query .= " union ".$format.$word."%'";
                            }
                        }
                        if(!$query){
                            echo "<script>window.alert('Search appropriate question.');</script>";
                        }
                        else{
                            $r = mysqli_query($conn, $query);
                            if(mysqli_error($conn))
                                echo "<script>window.alert('Some Error Occured. Try Again or Contact Us.');</script>";
                            else if(mysqli_num_rows($r)>0) {
            ?>
                <style>.open{display: block;} </style>
                <center>
                    <div class='open' style='height: auto; margin: 60px auto -135px;' >
                        
                        <div id='topic' >
                            <h2 id='topic-head' style="font-weight: normal; border:none; font-size: 22px;">Your Search Results for '<?php echo $text; ?>' are :</h2>
                        </div>

            <?php $n = 1; $nul=0; while( $row = mysqli_fetch_assoc($r) ) { ?>
                        
                        <div id="qa-block" class="sear">
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
                                    <label style="margin-bottom: -25px;"><a id="ans_b<?php echo $n; ?>" href="#area<?php echo $no; ?>"><u>Submit your answer</u></a></label>
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
                                    <textarea id="area<?php echo $n; ?>" name="answer" placeholder="Your Answer..." required></textarea>
                                    <input style="display: none;" name="question" value="<?php echo $row['question'] ?>" >
                                    <input style="display: none;" name="nul" value="<?php echo $nul ?>">
                                    <input style="display: none;" name="preby" value="<?php echo $row['answeredby'] ?>">
                                    <br>
                                    <input type="submit" name="ansubmit" value="Submit" class="up-in ans_sub" id="ar<?php echo $n; ?>">
                                    
                                </form>
                            </div>
                        </div>
                            <?php $n++; } ?>
                    </div>
					<?php
							}
						}
					}
				}
					?>
		<div id="footer" class="topnav" style="margin-top:220px;">
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