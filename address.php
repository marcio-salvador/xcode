<?php
session_start();
echo'<h3>Address</h3>';
echo '<p>'.'&nbsp;'.'</p>';

$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
$age = $_SESSION['age'];
$gender = $_SESSION['gender'];
echo"$firstname<br/>";
echo"$lastname<br/>";
echo"$age<br/>";
echo"$gender<br/>";

	$errors = array();
	
	// Array to collect valid data
	$clean = array();
	
	if (isset($_POST['submit'])) {
	
		if (isset($_POST['streetaddress'])){
			
			$streetAddressregex = '/^([a-zA-Z0-9-\.\\s])+$/';	
			if(preg_match($streetAddressregex,$_POST['streetaddress'])){
			
				$clean['streetaddress'] = $_POST['streetaddress'];
						
			}else{
				$errors[] = htmlentities('Invalid address');
			
			}
		
		}else {
			$errors[] = htmlentities('1password was not submitted.');
		}
	
		
		if (isset($_POST['city'])){
			
			$city_regex = '/^([a-zA-Z0-9-\.\\s]{3,20})$/';	
			if(preg_match($city_regex,$_POST['city'])){
			
				$clean['city'] = $_POST['city'];
						
			}else{
				$errors[] = htmlentities('Invalid city');
			
			}
		
		}else {
			$errors[] = htmlentities('3password was not submitted.');
		}
		
		if (isset($_POST['county'])){
			
			$county_regex = '/^([a-zA-Z0-9-\.\\s]{3,20})$/';	
			if(preg_match($county_regex,$_POST['county'])){
			
				$clean['county'] = $_POST['county'];
						
			}else{
				$errors[] = htmlentities('Invalid county');
			
			}
		
		}else {
			$errors[] = htmlentities('4password was not submitted.');
		}
	
	if (isset($_POST['postcode'])){
			
			$postcode_regex = '/^([a-zA-Z0-9-\s]([\\s]?))+$/';	
			if(preg_match($postcode_regex,$_POST['postcode'])){
			
				$clean['postcode'] = $_POST['postcode'];
						
			}else{
				$errors[] = htmlentities('Invalid postcode');
			
			}
		
		}else {
			$errors[] = htmlentities('5password was not submitted.');
		}
	
	}


	/**
* IF FORM IS SUBMITTED AND THERE ARE NO ERRORS
*
**/
$output = '';

$num_errors = count($errors);

 if (isset($_POST['submit']) && isset($clean['streetaddress']) && isset($clean['city']) && isset($clean['county'])&& isset($clean['postcode']) && $num_errors == 0) {
	
	$output .= '<p>'.htmlentities('You have entered valid data!').'</p>';
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>
	<body>
	<a href="display.php?<?php echo SID; ?>">Next</a>
	</body>
	</html>
	<?php
	$_SESSION['streetaddress'] = $clean['streetaddress'];	//storing session data
	$_SESSION['city'] = $clean['city'];	//storing session data
	$_SESSION['county'] = $clean['county'];	//storing session data
	$_SESSION['postcode'] = $clean['postcode'];	//storing session data
	
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
			<legend>Address</legend> 
                <div>
                    <label for="sa">Street Address</label></br>
                    <input type="text" name="streetaddress" id="sa" value="'.(isset($clean['streetaddress']) ? htmlentities($clean['streetaddress']) : '') .'" />
                </div>
							
				<div>            
                    <label for="city">City</label></br>
                    <input type="text" name="city" id="city" value="'.(isset($clean['city']) ? htmlentities($clean['city']) : '') .'" />
                </div>
				
				<div>            
                    <label for="county">County or Town</label></br>
                    <input type="text" name="county" id="county" value="'.(isset($clean['county']) ? htmlentities($clean['county']) : '') .'" />
                </div>
				
				<div>            
                    <label for="pc">Post Code</label></br>
                    <input type="text" name="postcode" id="pc" value="'.(isset($clean['postcode']) ? htmlentities($clean['postcode']) : '') .'" />
                </div>
                <div></br>            
                    <input type="submit" name="submit" value="Register" />
					
                </div>
            </fieldset>
        </form>';
        
 }
echo $output;  
?>