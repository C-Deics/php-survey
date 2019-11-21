<?php
/* -- Group Project Code
Basics form that asks the user for
their information and saves it to
the current session -- */

function form_1(){
	$part_fullname = "";
	$part_age = "";
    $part_student = ""; 
        if (isset($_SESSION['fullName'])){
            $part_fullname = $_SESSION['fullName'];
        } else if (isset($_POST['fullName'])){
            $part_fullname = $_POST['fullName'];
        }
        if (isset($_SESSION['age'])){
            $part_age = $_SESSION['age'];
        } else if (isset($_POST['age'])){
            $part_age = $_POST['age'];
        }
        if (isset($_SESSION['studentType'])){
            $part_student = $_SESSION['studentType'];
        } else if (isset($_POST['studentType'])){
            $part_student1 = $_POST['studentType'];
            if (($part_student1== "fullTime") ||  ($part_student1 == "partTime")
                || ($part_student1 == "No")){
                $part_student = $_POST['studentType'];
            } 
        }
?>
	<form method="POST">
		<label for="name">Full Name</label>
		<input type="text" size="50" maxlength="25" id ="fullName" name="fullName" value="<?php echo $part_fullname; ?>"></input><br>
		<br><br>
		<label for="email">Your Age</label>
		<input type="text" size="3" maxlength="125" id ="age" name="age" value="<?php echo $part_age; ?>"></input><br>
		<br><br>
		<label for="studentType">Are you a student?</label>

		<select id="studentType" name="studentType" size="1">

            <?php if ((strlen($part_student) == 0) ){ ?>
                            <option selected="selected" value="Choice"></option>
            <?php } else { ?>
                            <option  value="Choice"></option>
            <?php }
                  if ($part_student == "f"){ ?>
                            <option selected="selected" value="f">Yes, Full Time</option>
            <?php } else { ?>
                            <option  value="f">Yes, Full Time</option>
            <?php }
                  if ($part_student == "p"){ ?>
                            <option selected="selected" value="p">Yes, Part Time</option>
            <?php } else { ?>
                            <option value="p">Yes, Part Time</option>
            <?php }
                  if ($part_student == "n"){ ?>
                            <option selected="selected" value="n">No</option>
            <?php } else { ?>
                            <option value="n">No</option>
            <?php } ?>
			</select>
		<br><br>
            <table>
                <tr>
                   <tr><td><input type="submit" disabled="disabled" name="survey_b_back" value="Back"></td>
                    <td><input type="submit" name="survey_b_next" value="Next"></td>
                </tr>
            </table>
	</form>
<?php } ?>

<?php
function validateBasicInfo(){
	$err_msgs = array();
    	if (!isset($_POST['fullName'])){
		$err_msgs[] = "Full Name field not defined";
	} else {
		$part_fullname = trim($_POST['fullName']);
		if (strlen($part_fullname) == 0){
			$err_msgs[] = "The full name line must not be empty";
		} else if (strlen($part_fullname) > 128){
			$err_msgs[] = "The full name line is too long";
		}
	}
    
    	if (!isset($_POST['age'])){
		$err_msgs[] = "Age field not defined";
	}   else {
		$part_age = trim($_POST['age']);
		if (strlen($part_age) == 0){
			$err_msgs[] = "The age line must not be empty";
		} else if (strlen($part_age) > 11){
			$err_msgs[] = "The age line is too long";
		}
	}

    	if (!isset($_POST['studentType'])){
		$err_msgs[] = "A Student type must be selected";
	} else if (isset($_POST['studentType'])){
		$part_student = trim($_POST['studentType']);
		if (!(($part_student == "f") || ($part_student == "p") || ($part_student == "n"))){
			$err_msgs[] = "A valid student type must be selected";
		}
	}

	
	return $err_msgs;
}
?>

<?php
function basicInfoPostToSession(){
	$_SESSION['fullName'] = $_POST['fullName'];
	$_SESSION['age'] = $_POST['age'];
	$_SESSION['studentType'] = $_POST['studentType'];
}
?>


