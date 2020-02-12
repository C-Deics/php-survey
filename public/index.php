<?php 
/* -- 
A multi part session application that saves data
from the user and into the database

 -- */
	session_start(); 
	if (!isset($_SESSION['mode'])){
		$_SESSION['mode'] = "Display";
	}
	//require_once("./includes/db_operations.php"); 
	
	require_once("./formPurchases.php");
	require_once("./formBasics.php");
	require_once("./displayErrors.php");
	require_once("./formRatings.php");
	require_once("./saveData.php");
	require_once("./summary.php");
	
	
?>
<html>
	<head>
		<title>Survey</title>
		<link rel="stylesheet" href="style.css">
		<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
		<meta content="width=device-width, initial-scale=1" name="viewport" />
	</head>
	<body>
<div class="container">
<?php

if (isset($_POST['survey_b_start']) && ($_POST['survey_b_start'] == "Start Survey")){
	$_SESSION['mode'] = "Display";
	$_SESSION['mode'] = "Start";
	$_SESSION['nav_part'] = 0;
	
} 



if(($_SESSION['mode'] == "Start") && ($_SERVER['REQUEST_METHOD'] == "GET")){ 
	switch ($_SESSION['nav_part']) {
		case 0:
		case 1:
			form_1();
			break;
		case 2:
			form_2();
			break;
		case 3:
			form_3();
			break;
		case 4:
			summary();
			break;
		case 5: formDisplayThanks();
			break;
		
		default:
	}
} else if($_SESSION['mode'] == "Start"){ 
	switch ($_SESSION['nav_part']) {
		case 0:
			echo '<p class="title"> Customer Feedback Survey </p>';
			$_SESSION['nav_part'] = 1;
			form_1();
			break;
		case 1:
			echo '<p class="title"> Customer Feedback Survey </p>';
			$err_msgs = validateBasicInfo();
			if (count($err_msgs) > 0){
				displayErrors($err_msgs);
				form_1();
			}else {
				basicInfoPostToSession();
				$_SESSION['nav_part'] = 2;
				form_2();
			}

				
			
			break;
		case 2:
			echo '<p class="title"> Customer Feedback Survey </p>';
			$err_msgs = validatePurchases();
			if (count($err_msgs) > 0){
				displayErrors($err_msgs);
				form_2();
			} else if ((isset($_POST['survey_b_next']))
					&& ($_POST['survey_b_next'] == "Next")){
				purchasesPostToSession();
				$_SESSION['nav_part'] = 3;
				form_3();
			} else if ((isset($_POST['survey_b_back']))
						&& ($_POST['survey_b_back'] == "Back")){
				purchasesPostToSession();
				$_SESSION['nav_part'] = 1;
				form_1();
			}
			break;
		case 3:
			echo '<p class="title"> Customer Feedback Survey </p>';
			$err_msgs = validateRatings();
			if (count($err_msgs) > 0){
				displayErrors($err_msgs);
				form_3();
			} else if ((isset($_POST['survey_b_next']))
					&& ($_POST['survey_b_next'] == "Next")){
				ratingsPostToSession();
				$_SESSION['nav_part'] = 4;
				summary();
			} else if ((isset($_POST['survey_b_back']))
						&& ($_POST['survey_b_back'] == "Back")){
				ratingsPostToSession();
				$_SESSION['nav_part'] = 2;
				form_2();
			}
			break;
		
		
		case 4:
		
			if ((isset($_POST['survey_b_save']))
					&& ($_POST['survey_b_save'] == "Save")){
				
				$_SESSION['nav_part'] = 5;
				
				$_SESSION['mode'] = "Display";
				save_data();
				formThanksDisplay();
			} else if ((isset($_POST['survey_b_back']))
						&& ($_POST['survey_b_back'] == "Back")){
				
				$_SESSION['nav_part'] = 3;
				form_3();
			}
			break;
		default:
	}
}  else if($_SESSION['mode'] == "Display"){ 
	formSurveyDisplay();
} 
?>
</div>
	</body>
</html>
<?php
function formSurveyDisplay(){
?>

<p class="title"> Customer Feedback Survey </p>
			<p >Hello, Welcome to the best survey ever.
			Please follow the directions at every step
			In the following survey you will answer questions about your current student status,
			what you purchased,and how you purchased it.
			Afterwards leaving a review for each item, and then saving the data.
 </p>
			<br>
			<div>
		<form method="POST">
			<div class="btn">
				<input class="button" type="submit" name ="survey_b_start" value="Start Survey">
			</div>
		</form>
		</div>

<?php } ?>

<?php
function formThanksDisplay(){
?>
<h1 style="text-align: center;"> Thank you for taking the survey! </h1>
			
<?php } ?>

		
		

			

