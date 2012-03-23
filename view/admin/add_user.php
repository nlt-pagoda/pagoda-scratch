<?php if ($accessible): ?>

<?php if (isset($missing)):
$this->RenderMsg("You did not complete the required credentials.");
endif ?>
<?php if (isset($added)):
$this->RenderMsg("User added!");
endif ?>

<h1>Admin Control Panel</h1>

<h2>Add User</h2>




<form action="" method="POST">
	<table>
	<tr>
	<td><label for="username">Username:  </label></td><td><input type="text" name="username" /></td>
	</tr>
	<tr>
	<td><label for="username">Password:  </label></td><td><input type="password" name="password" value=""/></td>
	</tr>
	<tr>
	<td><label for="firstname">First Name:  </label></td><td><input type="text" name="firstname" /></td>
	<td><label for="lastname">Last Name:  </label></td><td><input type="text" name="lastname" /></td>
	</tr>
	<tr>
	<td><label for="bannerID">Banner ID:  </label></td><td><input type="text" name="bannerID" /></td>
	</tr>
	<tr>
	<td>
	<label for="role">Role:  </label>
	<td>
	<select name="role">
	<?php
	foreach($roles as $role)
		echo "<option value=\"".$role["Role"]["RolesID"]."\">".$role["Role"]["role"]."</option>";
	?>
	</select>
	</td>
	</tr>
	<tr>
	<td><label for="email">Email:  </label></td><td><input type="text" name="email" /></td>
	</tr>
	<tr>
	<td></td>
	<td><input type="submit" name="submit" value="submit"/></td>
	</tr>
	</table>
	
	<br />
</form>
	
	
	
<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif ?>