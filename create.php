<?php

/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */


if (isset($_POST['submit']))
{
	require "../config.php";
    require "../common.php";
		$uname = $_POST['firstname'];
	if(empty($uname))
	{
		$error = "enter your first name ";
		
	}
	$lname = $_POST['lastname'];
	if(empty($lname))
	{
		$error = "enter your last name ";
		
	}
	$email = $_POST['email'];
	if(empty($email))
	{
		$error = "enter your email ";
		
	}
	$age = $_POST['age'];
	if(empty($age))
	{
		$error = "enter your age ";
		
	}
	$location = $_POST['location'];
	if(empty($age))
	{
		$error = "enter your location ";
		
	}
	
	
	if(($uname!="") and ($lname!="")and ($email!="") and ($age!="")and ($location!=""))
	{
			try  {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $new_user = array(
            "firstname" => $_POST['firstname'],
            "lastname"  => $_POST['lastname'],
            "email"     => $_POST['email'],
            "age"       => $_POST['age'],
            "location"  => $_POST['location']
        );

        $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "users",
                implode(", ", array_keys($new_user)),
                ":" . implode(", :", array_keys($new_user))
        );
        
        $statement = $connection->prepare($sql);
        $statement->execute($new_user);
    } catch(PDOException $error) 
	{
        echo $sql . "<br>" . $error->getMessage();
    }
	}
	else
	{ $error1=" error";
	}
}
?>




<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
    <blockquote><?php echo $_POST['firstname']; ?> successfully added.</blockquote>
<?php } ?>



<h2>Add a user</h2>

<script>
function validate()
{
	var fname=document.forms["create"]["firstname"].value;
	
	if(fname=="")
	{
		alert("enter first name");
		document.forms["create"]["firstname"].focus();
		return false;
	}
	
	var lname=document.forms["create"]["lastname"].value;
	if(lname=="")
	{
		alert("enter last name");
		document.forms["create"]["lastname"].focus();
		return false;
	}
	var email=document.forms["create"]["email"].value;
	if(email=="")
	{
		alert("enter email");
		document.forms["create"]["email"].focus();
		return false;
	}
	var atpos=email.indexOf("@");
	var dotpos=email.lastIndexOf(".");
	if(atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length)
	{
		alert("enter a valid email");
		document.forms["create"]["email"].focus();
		return false;
		
	}
	
	var age=document.forms["create"]["age"].value;
	if(age=="")
	{
		alert("enter age");
		document.forms["create"]["age"].focus();
		return false;
	}
	if(isNaN(age))
	{
		alert("enter a valid age");
		document.forms["create"]["age"].focus();
		return false;
	}
	var loc=document.forms["create"]["location"].value;
	if(loc=="")
	{
		alert("enter location");
		document.forms["create"]["location"].focus();
		return false;
	}
	
	
}


</script>




<form method="post" name="create" >
<?php
if(isset($error))
{
 ?>
 
    <id="error" style="color:black; "><?php echo $error.$error1; 
    
}
?>

    <label for="firstname">First Name</label>
    <input type="text" name="firstname" id="firstname" value="<?php if(isset($uname)){echo $uname;}?>">
    <label for="lastname">Last Name</label>
    <input type="text" name="lastname" id="lastname" value="<?php if(isset($lname)){echo $lname;}?>">
    <label for="email">Email Address</label>
    <input type="text" name="email" id="email" value="<?php if(isset($email)){echo $email;}?>">
    <label for="age">Age</label>
    <input type="text" name="age" id="age" value="<?php if(isset($age)){echo $age;}?>">
    <label for="location">Location</label>
    <input type="text" name="location" id="location" value="<?php if(isset($location)){echo $location;}?>">
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>
