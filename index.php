<?php 
/* -- Group Project Code
A multi part session application that saves data
from the user and into the database
Colby Deics - 0785356
Naomi Dowell - 0836402
Nayef Chams - 0632720
Nicholas Brousseau - 0714552
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
	</head>
	<body>

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
			echo "<h1> Survey </h1>\n";
			$_SESSION['nav_part'] = 1;
			form_1();
			break;
		case 1:
			echo "<h1> Survey </h1>\n";
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
			echo "<h1> Survey </h1>\n";
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
			echo "<h1> Survey </h1>\n";
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
				echo "<h1> Add New Contact </h1>\n";
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
	</body>
</html>
<?php
function formSurveyDisplay(){
?>

<h1> Survey </h1>
			<p style="margin:0% 20% 0% 20%;">Hello, Welcome to the best survey ever.
			Please follow the directions at every step
			In the following survey you will answer questions about your current student status,
			what you purchased,and how you purchased it.
			Afterwards leaving a review for each item, and then saving the data.
 </p>
			<br>
			<div>
		<form method="POST">
			<table>
			
			<tr>
				<td><input type="submit" name ="survey_b_start" value="Start Survey"></td>
			</tr>
			</table>
		</form>
		</div>

<?php } ?>

<?php
function formThanksDisplay(){
?>
<h1> Thank you for taking the survey! </h1>
			
<?php } ?>

		
		

			

