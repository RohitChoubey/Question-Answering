<?php
    session_start();
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
            if(mysqli_query($conn,$que))
                echo "<style>#box0,.open{display: none;} #tb{display: block;}</style>";
            else
                header("Location: index.php");
        }
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <title> Inflibnet </title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link type="text/css" rel="stylesheet" href="css/style.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/material.css">
        <link type="text/css" rel="stylesheet" href="fonts/font.css">
        <link rel="icon" href="images/icon1.png" >
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		
		
        <!-- Sripts -->
        <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
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
                margin: 195.5px auto;
                font-size: 12px;
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
@media (max-width: 700px) {
  
  .topnav{
		
		max-width:490px;
		}
}
@media (max-width: 700px) {
  .cat{
		max-width:200px;
	}
}
@media (max-width: 700px) {
  .cat{
		max-width:500px;
		margin-left:;
	}
}
@media (max-width: 700px) {
  .catt{
		max-width:450px;
		margin-right:500px;
	}
}
        </style>
    </head>
    <body id="_3" class="toppp">
	
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
					<a href="profile.php">Hi, <?php echo $_SESSION["user"]; ?></a>
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
            <h4>
                <a id="title-head" href="categories.php">Categories</a>
            </h4>
					<div id="box0" class="cat">
						<center>
							<div class="container-fluid">
								<div class="row">
									<div class="col-sm-3" >
										<a id="ada" href="#box1">
											<div id="algo" class="img">
												<div id="p" title="Open">Algorithm</div>
											</div>
										</a>
									</div>
									<div class="col-sm-3" >
										<a id="cso" href="#box2">
											<div id="archi" class="img">
												<div id="p" title="Open">Architecture</div>
											</div>
										</a>
									</div>
									<div class="col-sm-3" >
										<a id="t" href="#box3">
											<div id="toc" class="img">
												<div id="p" title="Open">Theory of Computation</div>
											</div>
										</a>
									</div>
								</div>
							</div>
						</center>
						<center>
							<div class="container-fluid">
								<div class="row">
									<a id="db" class="col-sm-3" href="#box4">
										<div id="database" class="img">
											<div id="p"  title="Open">Database Management</div>
										</div>
									</a>
									<a id="pqt" class="col-sm-3" href="#box5">
										<div id="prob" class="img">
											<div id="p" title="Open">Probability &amp; Queuing Theory</div>
										</div>
									</a>
									<a id="se" class="col-sm-3" href="#box6">
										<div id="soft" class="img">
											<div id="p" title="Open">Software Engineering</div>
										</div>
									</a>
								</div>
							</div>
						</center>
					</div>
			
            <div class="pop" id="tb">
                <center><h1><b style="font-size: 1.5em; margin: -60px auto 10px; display: block;">:)</b>Thank You For Your Answer.</h1></center>
            </div>
            <center>
                <?php
                    $no = 1;
                    $n = 1;
                    $nul=0; 
                    while($no < 7){
                ?>
                <div id="box<?php echo $no; ?>" class="open catt">
                    <a href=""><div id="close">X</div></a>
                    <div id="topic">
                        <?php 
                            echo "<h2 id='topic-head'>";
                            $q = 'select name, description from category where id='.$no;
                            $r = mysqli_query($conn,$q);

                            $d = mysqli_fetch_assoc($r);
                            echo $d['name'].'</h2><p id="topic-desc">'.$d['description']."<br>Explore our home page for more questions.</p>";
                        ?>
                    </div>
                    
                    <center>
                        <?php
                            $qu = "select q.question, q.answer, q.askedby, q.answeredby from quans as q, quacat as r, category as c where q.id=r.id and r.category=c.name and c.id='$no' Limit 8";
                            $re = mysqli_query($conn,$qu);
                            while($da = mysqli_fetch_assoc($re)){
                        ?>
                        <div id="qa-block">
                            <div class="question">
                                <div id="Q">Q.</div>
                                <?php echo $da['question']."<small id='sml'>Asked By: @".$da['askedby']."</small>"; ?>
                            </div>
                            <div class="answer">
                                <?php 
                                    if($da["answer"]){
                                        $nul=0;
                                        echo $da["answer"]."<br><small>Answered By: @".$da['answeredby']."</small>";
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
                                    <textarea id="area<?php echo $n; ?>" name="answer" placeholder="Your Answer..."></textarea>
                                    <input style="display: none;" name="question" value="<?php echo $da['question'] ?>">
                                    <input style="display: none;" name="nul" value="<?php echo $nul ?>">
                                    <input style="display: none;" name="preby" value="<?php echo $da['answeredby'] ?>">
                                    <br>
                                    <input type="submit" name="ansubmit" value="Submit" class="up-in ans_sub" id="ar<?php echo $n; ?>">
                                    
                                </form>
                                

                                
                            </div>
                        </div>
                        <?php $n++; } ?>
                    </center>
                    
                </div><!-- box1 -->
                <?php
                    $no++;
                }
                ?>
            </center>
            
        </div><!-- content -->
        
        <!-- Footer -->
        <div id="footer" class="cat">
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