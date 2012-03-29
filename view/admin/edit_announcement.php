<?php if ($accessible): ?>

<?php if (isset($missing)):
$this->RenderMsg("You did not complete the required credentials.");
endif ?>
<?php if (isset($edited)):
$this->RenderMsg("Announcement edited");
endif ?>

<h1>Admin Control Panel</h1>

<h2>Edit Announcement</h2>




<form action="" method="POST">
	<table>
	<tr>
	<td>
	<label for="title">Title: </label>
	</td>
	<td>
	<input type="text" name="title" value="<?php echo $headlineData[0]["Announcement"]["title"]?>">
	</td>
	</tr>
	
	<tr>
	<td>
	<label for="announcement">Announcement:  </label>
	</td>
	<td>
	<textarea id="nicEdittextarea" rows="25" cols="90" name="text"><?php echo $headlineData[0]["Announcement"]["text"]?></textarea>
	<tr>
	<td>
	<td>
	<input type="submit" name="submit" value="Submit"/>
	</td>
	</td>
	</tr>
	</table>
	
</form>
	
	
	
<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif ?>

