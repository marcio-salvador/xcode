<?php
session_start();
echo'<h3>Personal Details</h3>';
echo '<p>'.'&nbsp;'.'</p>';
	$errors = array();
	
	// Array to collect valid data
	$clean = array();
	
	if (isset($_POST['submit'])) {
	
		if (isset($_POST['firstname'])){
			
			$firstNameregex = '/^[a-z]+$/i';	
			if(preg_match($firstNameregex,$_POST['firstname'])){
			
				$clean['firstname'] = $_POST['firstname'];
						
			}else{
				$errors[] = htmlentities('Invalid name');
			
			}
		
		}else {
			$errors[] = htmlentities('1password was not submitted.');
		}
	
		if (isset($_POST['lastname'])){
			
			$last_Name_regex = '/^[a-z]+$/i';	
			if(preg_match($last_Name_regex,$_POST['lastname'])){
			
				$clean['lastname'] = $_POST['lastname'];
						
			}else{
				$errors[] = htmlentities('Invalid Surname');
			
			}
		
		}else {
			$errors[] = htmlentities('2password was not submitted.');
		}
		
		if (isset($_POST['age'])){
			
			$date_birth_regex = '/^[0-9]{1,2}$/';	
			if(preg_match($date_birth_regex,$_POST['age'])){
			
				$clean['age'] = $_POST['age'];
						
			}else{
				$errors[] = htmlentities('Invalid age, enter a number');
			
			}
		
		}else {
			$errors[] = htmlentities('3password was not submitted.');
		}
		
		if(isset($_POST['gender'])){
		
			if(($_POST['gender']) != ""){
			$clean['gender'] = $_POST['gender'];
			
		}else{
		$errors[] = htmlentities('Invalid gender, choose a gender');
		}
		
		}else{
			$errors[] = htmlentities('4password was not submitted.');
		}
	}
	
	/**
* IF FORM IS SUBMITTED AND THERE ARE NO ERRORS
*
**/
$output = '';

$num_errors = count($errors);

 if (isset($_POST['submit']) && isset($clean['firstname']) && isset($clean['lastname']) && isset($clean['age']) && isset($clean['gender']) && $num_errors == 0) {
	
	//$output .= '<p>'.htmlentities('You have entered valid data!').'</p>';
	
	$_SESSION['firstname'] = $clean['firstname'];	//storing session data
	$_SESSION['lastname'] = $clean['lastname'];	//storing session data
	$_SESSION['age'] = $clean['age'];	//storing session data
	$_SESSION['gender'] = $clean['gender']; //storing session data
	header("Location: /exercise/address.php" . SID); //redirecting and passing a session id
 } else {

 if ($num_errors > 0) {
        $output .= '<ul>';
        foreach ($errors as $reason) {
            $output .= '<li>'.htmlentities($reason).'</li>';
        }
        $output .= '</ul>';
    }
	
	//submits to the same page
     $output .= '<form action="'.htmlentities($_SERVER['PHP_SELF']).'"method="post">
            <fieldset>
			<legend>Register</legend> 
                <div>
                    <label for="fn">First Name</label></br>
                    <input type="text" name="firstname" id="fn" value="'.(isset($clean['firstname']) ? htmlentities($clean['firstname']) : '') .'" />
                </div>
				
                <div>            
                    <label for="ln">Last Name</label></br>
                    <input type="text" name="lastname" id="ln" value="'.(isset($clean['lastname']) ? htmlentities($clean['lastname']) : '') .'" />
                </div>
				
				<div>            
                    <label for="ag">Age</label></br>
                    <input type="text" name="age" id="ag" maxlength="2" size="2" value="'.(isset($clean['age']) ? htmlentities($clean['age']) : '') .'" />
                </div>
				
				<div>
				<label for="ge">Gender</label></br>
				<select name="gender">
					<option value=""></option>
					<option value="Male">Male</option>
					<option value="Female">Female</option>
				</select>
				</div>
				
                <div></br>            
                    <input type="submit" name="submit" value="Register"/>
					
                </div>
            </fieldset>
        </form>';   
 }
echo $output;  
?>