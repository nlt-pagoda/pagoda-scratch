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
	<td><input type="submit" name="submit" value="submit" onclick = "setHTML()" /><input type=button value="Show html" onclick=showHTML() /></td>
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
	<span id="cvalues">Columns: <span id="colNum">1</span></span>
	<table id="rubricTable" border="1">
	<tbody>
	<tr><td></td><td><span class="editablecol1">Score</span></td></tr>
	<tr><td><span class="editablerow1">Criteria</span></td><td><span class="editable11">Click to edit</span></td></tr>
	</tbody>
	</table>
	<div id="tableHTML" style="display:none"></div>

</form>
	
	<script>
	var columnNum;
	var rowNum;
	var numOfRows = 1;
	var numOfColumns = 1;
	var columnArray = new Array();
	var rowArray = new Array();
	var deleteRowActive = false;
	var deleteColumnActive = false;

//////////////////////////////////////////////////////////////

//INITIAL FUNCTIONS AND EVENTS

	//sets columnNum to what column was just clicked
	$('#rubricTable tbody').delegate("td","click",function(e){
		  columnNum = (this.cellIndex) ;

		//Deletes column when user clicks if user has clicked Remove Row button
		  if(deleteColumnActive) removeColumn();
		  
		});

	//sets rowNum to what row was just clicked
	$('#rubricTable tbody').delegate("tr","click",function(e){
		  rowNum =  (this.rowIndex) ;

		  //Deletes row when user clicks if user has clicked Remove Criteria button
		  if(deleteRowActive) removeRow();
		  
		});

	$(document).ready(function() {
		setEditable();
	});

/////////////////////////////////////////////////////////
	
//SET EDITABLES

	function setEditable()
	{
		$(function(){
			$('.editable11').editable();
			});

			setEditableCols(1);
			setEditableRows(1);
	}

	
	function setEditableRows(num)
	{
		initializeRowInArray(num);
		
		$(function(){
			$('.editablerow' + num).editable({onSubmit:addToRowArray});
			});
	}

	
	function setEditableCols(num)
	{
		initializeColumnInArray(num);

		$(function(){
			$('.editablecol' + num).editable({onSubmit:addToColumnArray});
			});
	}

///////////////////////////////////////////////////////////////////////////////
	
//SUBMIT BUTTON

	function setHTML()
	{
		setColumnValues();
		setRowValues();
	}


/////////////////////////////////////////////////

//COLUMN FUNCTIONS

	function addColumn()
	{
		//count columns
		var numCols = $("#rubricTable").find('tr')[0].cells.length;

		var scoreHeader = '<td><span class="editablecol' + numCols + '">Score</span></td>';
		$("#rubricTable tr:first").append(scoreHeader);
		$("#rubricTable tr:gt(0)").append('<td><span class="editablecol' + numCols + '">Click to edit</span></td>');

		var html = $('#rubricTable')[0].outerHTML;

		printColumnTotal(numCols);
		setEditableCols(numCols);		
	}
	
	function initializeColumnInArray(num)
	{
		columnArray[num] = "Score";
	}
	
	function addToColumnArray(content)
	{	
		columnArray[columnNum] = content.current;
	}

	function setColumnValues()
	{
		for(var i=1;i<columnArray.length;i++)
		{
			$("#rubricTable").append('<input type="hidden" name="scorePosition' + i + '" value="' + columnArray[i] + '" />')
		}

		$("#rubricTable").append('<input type="hidden" name="scoreLength" value="' + numOfColumns + '" />')	
	}

	function removeColumn()
	{
		for(var i = 0;i <= numOfRows;i++)
		{
		  var row = document.getElementById("rubricTable").rows[i];
		  row.deleteCell(columnNum)
		 if(i == 0) removeFromColumnArray(columnNum);
		  deleteColumnActive = false;
		}
	}

	function removeFromColumnArray(index)
	{
		columnArray.splice(index,1);
	}

	function activateRemoveColumn()
	{
		deleteColumnActive = true;
	}


/////////////////////////////////////////////////
	
//ROW FUNCTIONS

	function addTableRow(jQtable)
	{
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

	        printRowTotal(numRows);
	  	  	setEditableRows(numRows);
	    });
	}

	function removeRow()
	{
		  var table = document.getElementById('rubricTable')
		  table.deleteRow(rowNum);
		  removeFromRowArray(rowNum);
		  deleteRowActive = false;
	}
	
	function initializeRowInArray(num)
	{
		rowArray[num] = "Criteria";
	}
	
	function addToRowArray(content)
	{
		rowArray[rowNum] = content.current;
	}

	function removeFromRowArray(index)
	{
		rowArray.splice(index,1);
	}

	function setRowValues(numRows)
	{
		for(var i=1;i<rowArray.length;i++)
		{
			$("#rubricTable").append('<input type="hidden" name="criteriaPosition' + i + '" value="' + rowArray[i] + '" />')
		}

		$("#rubricTable").append('<input type="hidden" name="criteriaLength" value="' + numOfRows + '" />')
	}

	function activateRemoveRow()
	{
		deleteRowActive = true;
	}
	

//////////////////////////////////////////////////////////////////////

//DEBUG

	/*function showHTML()
	{
		//$("#rubricTable").append('<input type="hidden" name="criteriaPosition1" value="" />')
		//$("#rubricTable").append('<input type="hidden" name="scorePosition1" value="" />')
		
		setColumnValues();
		setRowValues();
		
		var html = $('#rubricTable')[0].outerHTML;
		document.getElementById('tableHTML').innerHTML ='<textarea name="tableHTML">' + html + '</textarea>';

		alert(html);
	}*/

	function printRowTotal(num)
	{
		numOfRows = num;
		document.getElementById('rowNum').innerHTML = num;
	}

	function printColumnTotal(num)
	{
		numOfColumns = num;
		document.getElementById('colNum').innerHTML = num;
	}
	</script>



<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif; ?>
