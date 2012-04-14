<?php if ($accessible): ?>

<?php if (isset($added)):
$this->RenderMsg("Assessment created!");
endif ?>

<div id=sidepanel>
	<h2>Controls</h2>
	<ul>
	<li><a href="<?php echo BASEPATH; ?>instructor/view/assessments/">View Assessments</a></li>
	<li><a href="<?php echo BASEPATH; ?>instructor/create/assessment/">Create Assessment</a></li>
	</ul>
</div>

<h1>Assessments</h1>

<form action="" method="POST">
	<table>
	<tr>
	<td><label for="name">Assessment Name:  </label></td><td><input type="text" name="name" /></td>
	</tr>
	<tr>
	<td></td>
	<td><input type="submit" name="submit" value="submit"/></td>
	</tr>
	</table>
	
	<br><br>
	<h2>Rubric:</h2>
	<input type="button" value="Add Score (Column)" onclick="addColumn()">
	<input type="button" value="Add Criteria (Row)" onclick="addTableRow($('#rubricTable'))">
	<table id="rubricTable" border="1">
	<tr><td></td><td>Score</td></tr>
	<tr><td>Criteria</td><td><textarea>Criteria description to achieve Score</textarea></td></tr>
	</table>
</form>
	
	<script>
	function addTableRow(jQtable){
	    jQtable.each(function(){
	        var $table = $(this);
	        // Number of td's in the last table row
	        var n = $('tr:last td', this).length;
	        var tds = '<tr><td>Criteria</td>';
	        for(var i = 0; i < n-1; i++){
	            tds += '<td><textarea>Criteria description to achieve Score</textarea></td>';
	        }
	        tds += '</tr>';
	        if($('tbody', this).length > 0){
	            $('tbody', this).append(tds);
	        }else {
	            $(this).append(tds);
	        }
	    });
	}

	function addColumn()
	{
		$("#rubricTable tr:first").append("<td>Score</td>");
		$("#rubricTable tr:gt(0)").append("<td><textarea>Criteria description to achieve Score</textarea></td>");

	}
	</script>



<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif; ?>
