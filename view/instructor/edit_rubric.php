<?php if ($accessible): ?>

<?php if (isset($missing)):
$this->RenderMsg("You did not complete the required credentials.");
endif ?>

<?php if (isset($edited)):
$this->RenderMsg("Rubric edited!");
endif ?>

<?php if (isset($removed)):
header("Location: ".BASEPATH."/instructor/edit/rubrics/");
endif ?>


<div id=sidepanel>
<?php $this->rubricSidePanel(); ?>
</div>

<h1>Edit Rubric</h1>

<h2><?php 
echo $rubric[0]["Rubric"]["name"];
?></h2>

<?php 
$rowSize = $tablesize[0]["Rubric"]["rowSize"];
$columnSize = $tablesize[0]["Rubric"]["columnSize"];
?>
<form action="" method="POST">
	<table>
	<tr>
	<td></td>
	<td><input style="float:left;" type="submit" name="submit" value="Submit" onclick = "setHTML()" />
	
			<?php if ($accessible)
			{
				echo("<form action=\"\" method=\"POST\">");
				echo("<input id=\"removeButton\" onclick=\"if(confirm('Are you sure you want to delete this rubric? There is no undo.')) return true; return false;\" style=\"margin-left:15px;\" type=\"submit\" name=\"remove\" value=\"Delete Rubric\"/>");
				echo("</form>");
			}?>
			</td>
	</tr>
	<tr>
	<td><label for="name">Rubric Name:  </label></td><td><input type="text" name="rubricName" value="<?php echo $rubric[0]["Rubric"]["name"];?>" /></td>
	</tr>
	</table>
	
	<h2>Rubric:</h2>
	<input type="button" value="Add Score (Column)" onclick="addColumn()" />
	<input type="button" value="Add Criteria (Row)" onclick="addTableRow($('#rubricTable'))" />
	<br>
	<input id="removeButton" type="button" value="Remove Score (Column)" onclick="activateRemoveColumn()" />
	<input id="removeButton" type="button" value="Remove Criteria (Row)" onclick="activateRemoveRow()" />
	<span id="rvalues">Rows: <span id="rowNum"><?php echo $rowSize;?></span></span>
	<span id="cvalues">Columns: <span id="colNum"><?php echo $columnSize;?></span></span>
	<br>
	<span id="deleteMessage" style="background:red;color:white;"></span>
	<br>
	<br>
<?php 
$currentCol = 0;
$j=0;
$scoreIterate = 1;
$rowIterate = 1;
?>
Double click to edit.
<?php 
echo ("<table id=\"rubricTable\" border=\"1\">");

//first row. Score headers
echo ("<tr><td></td>");
foreach($scores as $score)
{
	echo ("<td><span class=\"editablecol".$scoreIterate."\">".$score["Score"]["title"]."</span><span class=\"editablescore".$scoreIterate."\">(".$score["Score"]["score"].")</td>");
	$scoreIterate++;
}
echo ("</tr><tr>");

//each row after that. Includes criteria headers

foreach ($criterias as $criteria )
{
	echo ("<td><span class=\"editablerow".$rowIterate."\">".$criteria["Criteria"]["title"]."</span></td>");
	//last column
	if(($currentCol%$columnSize) == $columnSize-1)
	{
		for($i = ($currentCol + 1); $j < ($columnSize); $i++)
		{
			echo ("<td><span class=\"editable".$rowIterate.($j+1)."\">".$descriptions[$i]["Criteria_Description"]["description"]."</span></td>");
			$currentCol = $i;
			$j++;
		}
		$rowIterate++;
		$j=0;
		echo ("</tr>");
		
	}
	//all columns but the last
	else
	{
		for($i = 0; $i < $columnSize;$i++)
		{
			echo ("<td><span class=\"editable".$rowIterate.($i+1)."\">".$descriptions[$i]["Criteria_Description"]["description"]."</span></td>");
			$currentCol = $i;
		}
		$rowIterate++;
		echo ("</tr>");
	}
}

echo ("</table>");

			
?>	
	
	<div id="tableHTML" style="display:none"></div>

</form>

<script src="<?php echo BASEPATH; ?>include/js/rubricEditor.js" type="text/javascript"></script>


<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif; ?>
