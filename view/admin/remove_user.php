<?php if ($accessible): ?>

<?php if (isset($missing)):
$this->RenderMsg("You did not complete the required credentials.");
endif ?>
<?php if (isset($removed)):
$this->RenderMsg("User removed.");
endif ?>

<h1>Admin Control Panel</h1>

<h2>Remove User</h2>
	<form action="" method="POST">
		<label for="username">Username:</label>
			
		<select name="userID">
		<?php
			foreach($users as $user)
			{
				echo "<option value=\"".$user["User"]["UserID"]."\">".$user["User"]["username"]."</option>";
			}
		?>
		</select>
		<input type="submit" onclick="if(confirm('Are you sure you want to delete this user?\nThere is no undo.')) return true; return false;" name="submit" value="submit"/>
	</form>
	
	
	
<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif ?>