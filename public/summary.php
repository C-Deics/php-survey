<?php 
/* -- Group Project Code
Summary page which outputs all of
the user's selected information
from the previous forms -- */

function summary(){ ?>
    <h1>Summary of your answers</h1>
    <table>
        <tr>
            <td>Full Name</td><td><?php echo($_SESSION['fullName']); ?></td>
        </tr>
        <tr>
            <td>Age</td><td><?php echo($_SESSION['age']); ?></td>
        </tr>
        <tr>
            <td>Student Type</td><td><?php if($_SESSION['studentType'] =='p'){echo"Part-Time";}
		else if($_SESSION['studentType'] =='f'){ echo"Full-Time";}
		else if($_SESSION['studentType'] =='n'){ echo"Not a student";}  ?></td>
        </tr>
        <tr>
            <td>How you Purchased</td><td><?php if($_SESSION['howPurchased'] == 1){echo"Online";} 
		else if($_SESSION['howPurchased'] == 2){echo"By Phone";}
		else if($_SESSION['howPurchased'] == 3){echo"Mobile App";}
		else if($_SESSION['howPurchased'] == 4){echo"In-Store";}
?></td>
        </tr>
        <tr>
            <?php foreach($_SESSION['purchases'] as $purchase){ ?>
                <td><?php echo("Product:  ");echo($purchase['name']); ?></td>
                <td><?php echo("	Rating:  "); echo($purchase['satisfaction']); ?></td>
                <td><?php echo("	Would you Recommend:  ");echo($purchase['recommend']); ?></td>
            <?php } ?>
        </tr>
<form method="POST">
        <tr>
            <td><input type="submit" name="survey_b_back" value="Back"></td>
            <td><input type="submit" name="survey_b_save" value="Save"></td>
        </tr>
</form>
<?php } ?>
