<?php
/* -- Group Project Code
Purchases form that asks the user for
their purchase information and saves it to
the current session -- */

function form_2(){ 
$resp_how_purchased="";
$resp_product = array();


	if (isset($_SESSION['howPurchased'])){
            $resp_how_purchased = $_SESSION['howPurchased'];
        } else if (isset($_POST['howPurchased'])){
            $resp_how_purchased = $_POST['howPurchased'];
        }
        if (isset($_SESSION['purchases'])){
            foreach($_SESSION['purchases'] as $purchase){
                $resp_product[] = $purchase['name'];
            }
           
        } else if (isset($_POST['purchases'])){
           foreach($_POST['purchases'] as $purchase){
                $resp_product[] = $purchase['name'];
            }
        }

 ?>

<form class="inputs" method="POST">
<div class="labels">
		<label for="name">How did you complete your purchase?</label></div>
		<div class="input-tab">
		<?php if ($resp_how_purchased == "1"){ ?>
				<input type="radio" name="howPurchased" checked="checked" value="1">Online</input><br>
		<?php } else { ?>
			<input type="radio" name="howPurchased"  value="1">Online</input><br>


		<?php }if ($resp_how_purchased == "2"){ ?>
			<input type="radio" name="howPurchased" checked="checked" value="2">By Phone</input><br>
		<?php } else { ?>
			<input type="radio" name="howPurchased"  value="2">By Phone</input><br>

		<?php }if ($resp_how_purchased == "3"){ ?>
				<input type="radio" name="howPurchased" checked="checked" value="3">Mobile App</input><br>
		<?php } else { ?>
			<input type="radio" name="howPurchased" value="3">Mobile App</input><br>

		<?php }if ($resp_how_purchased == "4"){ ?>
				<input type="radio" name="howPurchased" checked="checked" value="4">In Store</input><br>
		<?php } else { ?>
				<input type="radio" name="howPurchased" value="4">In Store</input><br>

		</div>


				

		<?php } ?>
		<div class="labels"><label for="student">At least one option must be selected</label>
		</div>
		<div  class="input-tab">
		<?php if (in_array("Home Phone",$resp_product)){ ?>
				<input id="student" type="checkbox" name="purchases[]" checked="checked" value="Home Phone">Home Phone</input><br>
		<?php } else  { ?> 
			<input type="checkbox" name="purchases[]" value="Home Phone">Home Phone</input><br>
			  
		<?php }if (in_array("Mobile Phone",$resp_product)){ ?>
				<input type="checkbox" name="purchases[]" checked="checked" value="Mobile Phone">Mobile Phone</input><br>
		<?php } else { ?>
				<input type="checkbox" name="purchases[]"  value="Mobile Phone">Mobile Phone</input><br>

		<?php }if (in_array("Smart TV",$resp_product)){ ?>	
				<input type="checkbox" name="purchases[]" checked="checked" value="Smart TV">Smart TV</input><br>
		<?php } else { ?>
				<input type="checkbox" name="purchases[]"  value="Smart TV">Smart TV</input><br>

		<?php }if (in_array("Laptop",$resp_product)){ ?>
				<input type="checkbox" name="purchases[]" checked="checked" value="Laptop">Laptop</input><br>
		<?php } else { ?>
				<input type="checkbox" name="purchases[]"  value="Laptop">Laptop</input><br>

		<?php }if (in_array("Desktop Computer",$resp_product)){ ?>	
				<input type="checkbox" name="purchases[]" checked="checked" value="Desktop Computer">Desktop Computer</input><br>
		<?php } else { ?>
			<input type="checkbox" name="purchases[]"  value="Desktop Computer">Desktop Computer</input><br>

		<?php }if (in_array("Tablet",$resp_product)){ ?>
				<input type="checkbox" name="purchases[]" checked="checked" value="Tablet">Tablet</input><br>
		<?php } else { ?>
			<input type="checkbox" name="purchases[]"  value="Tablet">Tablet</input><br>

		<?php }if (in_array("Home Theatre",$resp_product)){ ?>
				<input type="checkbox" name="purchases[]" checked="checked" value="Home Theatre">Home Theatre</input><br>
		<?php } else { ?>
			<input type="checkbox" name="purchases[]" value="Home Theatre">Home Theatre</input><br>
		<?php } ?>
		
		</div>

		<div class="btn">
                    <input class="button" type="submit" name="survey_b_back" value="Back">
                    <input class="button" type="submit" name="survey_b_next" value="Next">
					</div>
               
</form>
<?php } ?>
<?php
function validatePurchases(){

	$err_msgs = array();
	if (!isset($_POST['howPurchased'])){
		$err_msgs[] = "How you purchased your item must be selected";
	} else if (isset($_POST['howPurchased'])){
		$resp_how_purchased = trim($_POST['howPurchased']);
		if (!(($resp_how_purchased == "1") || ($resp_how_purchased== "2") || ($resp_how_purchased == "3") || ($resp_how_purchased=="4"))){
			$err_msgs[] = "A valid purchase option must be selected";

		}
	}
	

if (!isset($_POST['purchases'])){
	$err_msgs[] = "Item selection can not be left empty";
} else if (isset($_POST['purchases'])){
foreach ($_POST['purchases'] AS $resp_product)
{
	if (!(($resp_product == "Home Phone") || ($resp_product== "Mobile Phone") || ($resp_product == "Smart TV") || ($resp_product=="Laptop")||($resp_product=="Desktop Computer")||($resp_product=="Tablet")||($resp_product=="Home Theatre"))){
		$err_msgs[] = "A valid item option must be selected".$resp_product;
}
	}
}


	return $err_msgs;
}
?>

<?php
function purchasesPostToSession(){
	$_SESSION['howPurchased'] = $_POST['howPurchased'];
	
    
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        if (!empty($_POST['purchases'])){
            $_SESSION['purchases'] = array();
            
            foreach($_POST['purchases'] as $purchase){
                $_SESSION['purchases'][] = array (
                    'name' => $purchase,
                    'satisfaction' => '',
                    'recommend' => '',
                );
            }
        }
    
    }
}
?>
