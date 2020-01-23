<?php
/* -- Group Project Code
Ratings form that asks the user for
their rating information and saves it to
the current session -- */

function form_3(){ 
        $resp_satisfied = array();
        $resp_recommend = array();

        if (isset($_SESSION['purchases'])){
            foreach($_SESSION['purchases'] as $purchase){
                $resp_satisfied[] = $purchase['satisfaction'];
            }
           
        } else if (isset($_POST['purchases'])){
           foreach($_POST['purchases'] as $purchase){
                $resp_satisfied[] = $purchase['satisfaction'];
            }
        }

	if (isset($_SESSION['purchases'])){
            foreach($_SESSION['purchases'] as $purchase){
                $resp_recommend[] = $purchase['recommend'];
            }
           
        } else if (isset($_POST['purchases'])){
           foreach($_POST['purchases'] as $purchase){
                $resp_recommend[] = $purchase['recommend'];
            }
        }
?>
	<form class ="inputs" method="POST">
                
        <?php for ($i = 0; $i < count($_SESSION['purchases']); $i++){
                    echo"<p class='echoText'>". $_SESSION['purchases'][$i]['name'] . "</p>";
            ?>
        	
                <div class="labelsRating"><label for="satisfaction">How happy are you with this device on a scale from 1 (not satisfied) to 5 (very satisfied)?</label></div>
                <div class="input-tab ">

            <?php if ($resp_satisfied[$i] == "1"){ ?>
                        <input type="radio" name="satisfaction<?php echo($i); ?>" checked="checked" value="1">1</input><br>
             <?php } else { ?>
                        <input type="radio" name="satisfaction<?php echo($i); ?>" value="1">1</input><br>
            <?php } if ($resp_satisfied[$i] == "2"){ ?>
                        <input type="radio" name="satisfaction<?php echo($i); ?>" checked="checked" value="2">2</input><br>
            <?php } else { ?>
                        <input type="radio" name="satisfaction<?php echo($i); ?>" value="2">2</input><br>
            <?php } if ($resp_satisfied[$i] == "3"){ ?>
                    <input type="radio" name="satisfaction<?php echo($i); ?>" checked="checked" value="3">3</input><br>
            <?php } else { ?>
                    <input type="radio" name="satisfaction<?php echo($i); ?>" value="3">3</input><br>
            <?php } if ($resp_satisfied[$i] == "4"){ ?>      
                    <input type="radio" name="satisfaction<?php echo($i); ?>" checked="checked" value="4">4</input><br>
            <?php } else { ?>
                    <input type="radio" name="satisfaction<?php echo($i); ?>" value="4">4</input><br>
            <?php } if ($resp_satisfied[$i] == "5"){ ?>   
                    <input type="radio" name="satisfaction<?php echo($i); ?>" checked="checked" value="5">5</input><br>
            <?php } else { ?>
                    <input type="radio" name="satisfaction<?php echo($i); ?>" value="5">5</input><br>
            <?php } ?>
            <br>
            </div>
            <div class="labelsRating"><label for="recommendation">Would you recommend the purchase of this device to a friend?</label></div><div class="input-tab">

            <select class="dropdown" id="recommend" name="recommend<?php echo($i); ?>" size="1">
                <?php if ($resp_recommend[$i] == ""){ ?>
                        <option selected="selected" value="Choice"></option>
                <?php } else { ?>
                        <option  value="Choice"></option>
                <?php }
                      if ($resp_recommend[$i] == "Yes"){ ?>
                        <option selected="selected" value="Yes">Yes</option>
                <?php } else { ?>
                        <option  value="Yes">Yes</option>
                <?php }
                      if ($resp_recommend[$i] == "Maybe"){ ?>
                        <option selected="selected" value="Maybe">Maybe</option>
                <?php } else { ?>
                        <option value="Maybe">Maybe</option>
                <?php }
                      if ($resp_recommend[$i] == "No"){ ?>
                        <option selected="selected" value="No">No</option>
                <?php } else { ?>
                        <option value="No">No</option>
                <?php } ?>
                </select>
<br><br>
                </div>
        <?php } ?>
		
                <div class="btn">
                <input class="button" type="submit" name="survey_b_back" value="Back">
                <input  class="button" type="submit" name="survey_b_next" value="Next">
           </div>
	</form>
    
<?php } ?>

<?php 

function validateRatings(){
$err_msgs = array();
   
for($i = 0; $i < count($_SESSION['purchases']); $i++){
			// check that satisfaction is chosen 
			if (!isset($_POST['satisfaction'.$i])){
				$err_msgs[] = $_SESSION['purchases'][$i]['name']." - Please select level of satisfaction";
			} else if (isset($_POST['satisfaction'.$i])){
				$sat = $_POST['satisfaction'.$i];
				if(!is_numeric($sat) || $sat < 1 || $sat > 5){
					$err_msgs[] = $_SESSION['purchases'][$i]['name']." - A valid rating option must be selected!";
				}
			}
			// check that recommendation has been chosen
			if (!isset($_POST['recommend'.$i])){
				$err_msgs[] = $_SESSION['purchases'][$i]['name']." - Please choose recommendation option.";
			} else if (isset($_POST['recommend'.$i])){
				$rec = $_POST['recommend'.$i];
				if(!($rec == "Yes" || $rec == "Maybe" || $rec == "No")){
					$err_msgs[] = $_SESSION['purchases'][$i]['name']." - A valid recommendation type must be selected";
				}
			}
		}
return $err_msgs;
}
?>
<?php
    function ratingsPostToSession(){
          for($i = 0; $i < count($_SESSION['purchases']); $i++){
				$sat = $_POST['satisfaction'.$i];
				$rec = $_POST['recommend'.$i];
				$_SESSION['purchases'][$i]['satisfaction'] = $sat;
				$_SESSION['purchases'][$i]['recommend'] = $rec;
			}
			
    }
    ?>

