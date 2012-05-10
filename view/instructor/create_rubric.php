<?php if ($accessible): ?>

<?php if (isset($missing)):
$this->RenderMsg("You did not complete the required credentials.");
endif ?>

<?php if (isset($added)):
$this->RenderMsg("Rubric created!");
endif ?>

<div id=sidepanel>
<?php $this->rubricSidePanel(); ?>
</div>

<h1>Create Rubric</h1>

<form action="" method="POST">
	<table>
	<tr>
	<td></td>
	<td><input type="submit" name="submit" value="submit" onclick = "setHTML()" />
	
	</td>
	</tr>
	<tr>
	<td><label for="name">Rubric Name:  </label></td><td><input type="text" name="rubricName" /></td>
	</tr>
	</table>
	
	<h2>Rubric:</h2>
	<input type="button" value="Add Score (Column)" onclick="addColumn()" />
	<input type="button" value="Add Criteria (Row)" onclick="addTableRow($('#rubricTable'))" />
	<br>
	<input type="button" style="background:red;color:white;" value="Remove Score (Column)" onclick="activateRemoveColumn()" />
	<input type="button" style="background:red;color:white;" value="Remove Criteria (Row)" onclick="activateRemoveRow()" />
	<span id="rvalues">Rows: <span id="rowNum">1</span></span>
	<span id="cvalues">Columns: <span id="colNum">2</span></span>
	<br>
	<span id="deleteMessage" style="background:red;color:white;"></span>
	<br>
	<br>
	Double click to edit.
	<table id="rubricTable" border="1">
	<tbody>
	<tr><td></td><td><span class="editablecol1">Score</span><span class="editablescore1">(Points)</span></td><td><span class="editablecol2">Score</span><span class="editablescore2">(Points)</span></td></tr>
	<tr><td><span class="editablerow1">Criteria</span></td><td><span class="editable11">Click to edit</span></td><td><span class="editable12">Click to edit</span></td></tr>
	</tbody>
	</table>
	<div id="tableHTML" style="display:none"></div>

</form>

<script src="<?php echo BASEPATH; ?>include/js/rubricEditor.js" type="text/javascript"></script>


<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif; ?>
