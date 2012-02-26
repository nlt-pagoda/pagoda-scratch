<div id="content">
<?php if ($accessible): ?>

<?php if (isset($missing)):
$this->RenderMsg("You did not complete the required credentials.");
endif ?>
<?php if (isset($edited)):
$this->RenderMsg("User edited.");
endif ?>

<h1>Admin Control Panel</h1>

<h2>Edit User Profile</h2>
	<form action="" method="POST">
		<label for="username">Username:</label>
			
		<select name="userID">
		<?php

		foreach($roles as $role)
		echo "<option value=\"".$role["Role"]["RolesID"]."\">".$role["Role"]["role"]."</option>";
	
		
			foreach($users as $user)
			{
				echo "<option value=\"".$user["User"]["UserID"]."\">".$user["User"]["username"]."</option>";
			}
		?>
		</select>
				<h3>Profile:</h3>
		<label for="fullname">Full Name:</label><input type="text" name="fullname" /><br />
		<label for="email">Email:</label><input type="text" name="email" /><br />
		<label for="address">Address:</label><input type="text" name="address" size="60"/>
		<br /><input type="submit" name="submit" value="submit"/>
		</form>
	
	
	
<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif ?>

</div>