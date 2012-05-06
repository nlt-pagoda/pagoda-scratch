//Alex Oulapour
//April 2012


	var columnNum; //index of clicked column
	var rowNum; //index of clicked row
	var numOfRows = document.getElementById('rowNum').innerHTML; //number of rows in table - this variable is not static
	var numOfColumns = document.getElementById('colNum').innerHTML; // number of columns in table - this variable is not static
	var columnArray = new Array(); 
	var rowArray = new Array();
	var scoreArray = new Array();
	
	var descriptionArray = new Array(numOfRows+1);
	for(x=0;x<=1;x++)
	{
		descriptionArray[x] = new Array(numOfColumns+1);
	}
	
	var deleteRowActive = false;
	var deleteColumnActive = false;

//////////////////////////////////////////////////////////////

//INITIAL FUNCTIONS AND EVENTS

	//sets columnNum to what column was just clicked
	$('#rubricTable tbody').delegate("td","click",function(e){
		  columnNum = this.cellIndex;

		//Deletes column when user clicks if user has clicked Remove Row button
		  if(deleteColumnActive)
		  { 
			  if(columnNum == 0)
			  {
				  alert("Can not remove Criteria column");
				  deleteColumnActive = false;
				  clearDeleteMessage();
			  }
			  else
			  {
				 removeColumn();
			 	 clearDeleteMessage();
			  }
		  }		  
		});

	//sets rowNum to what row was just clicked
	$('#rubricTable tbody').delegate("tr","click",function(e)
	{
		  rowNum =  this.rowIndex ;

		  //Deletes row when user clicks if user has clicked Remove Criteria button
		  if(deleteRowActive)
		  { 
			  if(rowNum == 0)
			  {
				  alert("Can not remove Score row");
				  deleteRowActive = false;
				  clearDeleteMessage();
			  }
			  else
			  {
				  removeRow();
				  clearDeleteMessage(); 
			  }			  
		  }		  	 
	});

	$(document).ready(function() {
		setEditable();
	});


	function renderDeleteMsg(string)
	{
		if (string == "Column") document.getElementById('deleteMessage').innerHTML = "Click column to delete";
		if (string == "Row") document.getElementById('deleteMessage').innerHTML = "Click row to delete";
	}
		
	function clearDeleteMessage()
	{
		document.getElementById('deleteMessage').innerHTML = "";
	}
	
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

/////////////////////////////////////////////////////////

//SET EDITABLES

	function setEditable()
	{
		for(var i = 1;i <= numOfRows;i++)
		{
			for(var j = 1;j <= numOfColumns;j++)
			{
				setEditableDescription(i,j);
			}
		}
		
		for(j=1;j<=numOfColumns;j++)
		{
			setEditableCols(j);
			setEditableScore(j);
		}

		for(i=1;i<=numOfRows;i++)
		{
			setEditableRows(i);
		}
	}


	function setEditableDescription(r,c)
	{
		initializeDescriptionInArray(r,c);
		
		$(function(){
			$('.editable' + r + c).editable({
											type:'textarea',
											onSubmit:addToDescriptionArray
											});
			});
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
	
	function setEditableScore(num)
	{
		initializeScoreInArray(num);

		$(function(){
			$('.editablescore' + num).editable({onSubmit:addToScoreArray});
			});
	}

///////////////////////////////////////////////////////////////////////////////
	
//SUBMIT BUTTON

	function setHTML()
	{
		setColumnValues();
		setScoreValues();
		setRowValues();
		setDescriptionValues();
	}
/////////////////////////////////////////////////
	
//SCORE FUNTIONS
	
	function initializeScoreInArray(num)
	{
		scoreArray[num] = $('.editablescore' + num)[0].innerText;
	}
	
	function addToScoreArray(content)
	{	
		resetPointsIfBlank(content);
		checkIfPointsInt(content);
		scoreArray[columnNum] = content.current;
	}
	
	function resetPointsIfBlank(content)
	{
		var string = ".editablescore" + columnNum;
		if ($(string)[0].innerText == '')
		{
			content.current = content.previous;
			$(string)[0].innerText = content.previous;
		}
	}
	
	function checkIfPointsInt(content)
	{
		if(isNaN(content.current))
		{
			var element = ".editablescore" + columnNum;
			var string = $(element)[0].innerText;
			content.current = content.previous;
			$(element)[0].innerText = content.previous;
		}
		else
		{
			addParenthesesAroundPoints(content);
		}
	}
	
	function addParenthesesAroundPoints(content)
	{
		var element = ".editablescore" + columnNum;
		$(element)[0].innerText = "(" + content.current + ")";
	}
	
	function setScoreValues()
	{
		for(var i=1;i<scoreArray.length;i++)
		{
			$("#rubricTable").append('<input type="hidden" name="pointsPosition' + i + '" value="' + scoreArray[i] + '" />');
		}
	}
	
	function removeFromScoreArray(index)
	{
		scoreArray.splice(index,1);
	}

/////////////////////////////////////////////////

//COLUMN FUNCTIONS

	function addColumn()
	{
		//count columns
		var numCols = $("#rubricTable").find('tr')[0].cells.length;
		printColumnTotal(numCols);

		var scoreHeader = '<td><span class="editablecol' + numCols + '">Score</span><span class="editablescore' + numCols + '">(Points)</span></td>';
		$("#rubricTable tr:first").append(scoreHeader);
		for(i = 1;i <=numOfRows; i++)
		{
			$("#rubricTable tr").eq(i).append('<td><span class="editable' + i + numOfColumns + '">Click to edit</span></td>');
			setEditableDescription(i,numOfColumns);
		}
		var html = $('#rubricTable')[0].outerHTML;

		setEditableScore(numCols);
		setEditableCols(numCols);
			
	}
	
	function initializeColumnInArray(num)
	{
		columnArray[num] = $('.editablecol' + num)[0].innerText;
	}
	
	function addToColumnArray(content)
	{	
		resetScoreIfBlank(content);
		columnArray[columnNum] = content.current;
	}

	function resetScoreIfBlank(content)
	{
		var string = ".editablecol" + columnNum;
		if ($(string)[0].innerText == '')
		{
			content.current = content.previous;
			$(string)[0].innerText = content.previous;
		}
	}

	function setColumnValues()
	{
		for(var i=1;i<columnArray.length;i++)
		{
			$("#rubricTable").append('<input type="hidden" name="scorePosition' + i + '" value="' + columnArray[i] + '" />');
		}

		$("#rubricTable").append('<input type="hidden" name="scoreLength" value="' + numOfColumns + '" />');
	}

	function removeColumn()
	{
		for(var i = 0;i <= numOfRows;i++)
		{
		  var row = document.getElementById("rubricTable").rows[i];
		  row.deleteCell(columnNum);
		  if(i == 0)
			  {
			  	removeFromColumnArray(columnNum);
			  	removeFromScoreArray(columnNum);
			  }
		  deleteColumnActive = false;
		}

		removeFromDescriptionArray("column");
		printColumnTotal(numOfColumns - 1);
	}

	function removeFromColumnArray(index)
	{
		columnArray.splice(index,1);
	}

	function activateRemoveColumn()
	{
		  if(numOfColumns == 2)
		  {
			  alert("Must have at least 2 Scores");
			  clearDeleteMessage();
		  }
		  else
		  {
			  renderDeleteMsg("Column");
			  deleteColumnActive = true;
		  }
	}




/////////////////////////////////////////////////
	
//ROW FUNCTIONS

	function addTableRow(jQtable)
	{
	    jQtable.each(function(){
			var numRows = $("#rubricTable").find('tr').length;
	    	printRowTotal(numRows);
	        var $table = $(this);
	        // Number of td's in the last table row
	        var n = $('tr:last td', this).length;
	        var tds = '<tr><td><span class="editablerow' + numRows + '">Criteria</span></td>';
	        for(var i = 0; i < n-1; i++)
		    {
	            tds += '<td><span class="editable' + numOfRows + (i+1) + '">Click to edit</span></td>';
	        }
	        tds += '</tr>';
	        if($('tbody', this).length > 0){
	            $('tbody', this).append(tds);
	        }else {
	            $(this).append(tds);
	        }

	        for(i = 1; i <= numOfColumns; i++)
	        {
	       	 setEditableDescription(numOfRows,i);
	        }
	  	  	setEditableRows(numRows);  	 	
	    });
	}

	function removeRow()
	{
		  var table = document.getElementById('rubricTable');
		  table.deleteRow(rowNum);
		  removeFromRowArray(rowNum);
		  removeFromDescriptionArray("row");
		  deleteRowActive = false;
		  printRowTotal(numOfRows - 1);
	}
	
	function initializeRowInArray(num)
	{
		rowArray[num] = $('.editablerow' + num)[0].innerText;
	}
	
	function addToRowArray(content)
	{
		resetCriteriaIfBlank(content);
		rowArray[rowNum] = content.current;
	}

	function resetCriteriaIfBlank(content)
	{
		var string = ".editablerow" + rowNum;
		if ($(string)[0].innerText == '')
		{
			content.current = content.previous;
			$(string)[0].innerText = content.previous;
		}
	}
	
	function removeFromRowArray(index)
	{
		rowArray.splice(index,1);
	}

	function setRowValues(numRows)
	{
		for(var i=1;i<rowArray.length;i++)
		{
			$("#rubricTable").append('<input type="hidden" name="criteriaPosition' + i + '" value="' + rowArray[i] + '" />');
		}

		$("#rubricTable").append('<input type="hidden" name="criteriaLength" value="' + numOfRows + '" />');
	}

	function activateRemoveRow()
	{
		if(numOfRows == 1)
		  {
			  alert("Must have at least 1 Criteria");
			  clearDeleteMessage();
		  }
		else
			{
			renderDeleteMsg("Row");
			deleteRowActive = true;
			}
	}

//////////////////////////////////////////////////////////////////////

//DESCRIPTION FUNCTIONS

	function initializeDescriptionInArray(r,c)
	{
		if(descriptionArray[r] == null)
		{
			num = 1;
			descriptionArray[r] = new Array(c);
			descriptionArray[r][1] = $('.editable' + r + num)[0].innerText;
		}
		if(descriptionArray[r][c] == null)
		{
			descriptionArray[r][c] = $('.editable' + r + c)[0].innerText;
		}
		descriptionArray[r][c] = $('.editable' + r + c)[0].innerText;
	}

	function addToDescriptionArray(content)
	{
		resetDescriptionIfBlank(content);
		descriptionArray[rowNum][columnNum] = content.current;
	}

	function resetDescriptionIfBlank(content)
	{
		var string = ".editable" + rowNum + columnNum;
		if ($(string)[0].innerText == '')
		{
			content.current = content.previous;
			$(string)[0].innerText = content.previous;
		}
	}

	function removeFromDescriptionArray(sender)
	{
		if (sender == "row")
		{
			descriptionArray.splice(rowNum,1);
		}

		if (sender == "column")
		{
			for(i=1;i<=numOfRows;i++)
			{
				descriptionArray[i].splice(columnNum,1);
			}
		}
	}

	function setDescriptionValues()
	{
		for(var i=1;i<=numOfRows;i++)
		{
			for(var j=1;j<=numOfColumns;j++)
			{
				$("#rubricTable").append('<input type="hidden" name="descriptionPosition' + i + j +'" value="' + descriptionArray[i][j] + '" />');
			}
		}
	}

//////////////////////////////////////////////////////////////////////

//DEBUG

	function showHTML()
	{		
		setColumnValues();
		setScoreValues();
		setRowValues();
		setDescriptionValues();
		
		var html = $('#rubricTable')[0].outerHTML;
		document.getElementById('tableHTML').innerHTML ='<textarea name="tableHTML">' + html + '</textarea>';

		alert(html);
	}