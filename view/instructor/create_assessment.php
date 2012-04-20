<?php if ($accessible): ?>

<?php if (isset($missing)):
$this->RenderMsg("You did not complete the required credentials.");
endif ?>

<?php if (isset($added)):
$this->RenderMsg("Assessment created!");
endif ?>

<div id=sidepanel>
<?php $this->assessmentSidePanel(); ?>
</div>

<h1>Assessments</h1>

<form action="" method="POST">
	<table>
	<tr>
	<td><label for="name">Assessment Name:  </label></td><td><input type="text" name="assessmentName" /></td>
	</tr>
	<tr>
	<td></td>
	<td><input type="submit" name="submit" value="submit" onclick = "setHTML()" /></td>
	</tr>
	<tr>
	<td><label for="name">Rubric Name:  </label></td><td><input type="text" name="rubricName" /></td>
	</tr>
	</table>
	
	<h2>Rubric:</h2>
	<input type="button" value="Add Score (Column)" onclick="addColumn()" />
	<input type="button" value="Add Criteria (Row)" onclick="addTableRow($('#rubricTable'))" />
	<span id="rvalues">Rows: 1</span>
	<span id="cvalues">Columns: 1</span>
	<table id="rubricTable" border="1">
	<tbody>
	<tr><td></td><td><span class="editable1">Score</span></td></tr>
	<tr><td><span class="editable1">Criteria</span></td><td><span class="editable1">Click to edit</span></td></tr>
	</tbody>
	</table>
	<div id="tableHTML" style="display:none"></div>

</form>
	
	<script>
	function addTableRow(jQtable){
	    jQtable.each(function(){
			var numRows = $("#rubricTable").find('tr').length;
		    
	        var $table = $(this);
	        // Number of td's in the last table row
	        var n = $('tr:last td', this).length;
	        var tds = '<tr><td><span class="editablerow' + numRows + '">Criteria</span></td>';
	        for(var i = 0; i < n-1; i++){
	            tds += '<td><span class="editablerow' + numRows + '">Click to edit</span></td>';
	        }
	        tds += '</tr>';
	        if($('tbody', this).length > 0){
	            $('tbody', this).append(tds);
	        }else {
	            $(this).append(tds);
	        }
	        rvalues(numRows);
	  	  setEditableRows(numRows);
	    });


	}

	function addColumn()
	{
		//count columns
		var numCols = $("#rubricTable").find('tr')[0].cells.length;

		var scoreHeader = '<td><span class="editablecol' + numCols + '">Score</span></td>';
		$("#rubricTable tr:first").append(scoreHeader);
		$("#rubricTable tr:gt(0)").append('<td><span class="editablecol' + numCols + '">Click to edit</span></td>');
		cvalues(numCols);

		var html = $('#rubricTable')[0].outerHTML;

		setEditableCols(numCols);

	}

	function cvalues(num)
	{
		document.getElementById('cvalues').innerHTML ='Columns: ' + num;

	}
	function rvalues(num)
	{
		document.getElementById('rvalues').innerHTML ='Rows: ' + num;
	}

	function setHTML()
	{
		var html = $('#rubricTable')[0].outerHTML;
		document.getElementById('tableHTML').innerHTML ='<textarea name="tableHTML">' + html + '</textarea>';
	}


	setEditable();
			
	function setEditable()
	{
		$(function(){
			$('.editable1').editable();
			});

	}
	

	function setEditableRows(num)
	{
		$(function(){
			$('.editablerow' + num).editable();
			});

	}

	
	function setEditableCols(num)
	{
		$(function(){
			$('.editablecol' + num).editable();
			});

	}
	</script>



<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif; ?>
