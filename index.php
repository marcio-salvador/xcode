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
		$errors[] = htmlentities('Invalid gender');
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
	
	$output .= '<p>'.htmlentities('You have entered valid data!').'</p>';
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>
	<body>
	<a href="address.php?<?php echo SID; ?>">Next</a>
	</body>
	</html>
	<?php
	$_SESSION['firstname'] = $clean['firstname'];	//storing session data
	$_SESSION['lastname'] = $clean['lastname'];	//storing session data
	$_SESSION['age'] = $clean['age'];	//storing session data
	$_SESSION['gender'] = $clean['gender']; //storing session data
	$handle = fopen('valid_data.log', 'a');	//open file to append data mode 'a' - to file 'valid_data.log'
	//file permissions
	
	foreach($clean as $registration){	//array of data written to file
	
	fwrite($handle,"$registration ");
	 
	}
	
	fclose($handle);	//close file after data is appended
	
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
                    <input type="submit" name="submit" value="Register" />
					
                </div>
            </fieldset>
        </form>';   
 }
echo $output;  
?>