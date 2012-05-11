<?php if ($accessible): ?>

<?php if (isset($removed)):
header('Location:'.$courseID);
endif ?>

<div id=sidepanel>
	<h2>Controls</h2>
	<ul>
	<li><a href="<?php echo BASEPATH; ?>instructor/add/announcement/<?php echo $courseID[0]["Assignment"]["CourseID"];?>">Add Announcement</a></li>
	<li><a href="<?php echo BASEPATH; ?>instructor/add/assignment/<?php echo $courseID[0]["Assignment"]["CourseID"];?>">Add Assignment</a></li>
	<li><a href="<?php echo BASEPATH; ?>instructor/view/assignments/<?php echo $courseID[0]["Assignment"]["CourseID"];?>">View Assignments</a></li>
	</ul>
</div>



<h1>Instructor Control Panel</h1>

<h2>Assignment - <?php echo $assignment[0]["Assignment"]["title"];?></h2>

<table>
<tr><td><b>Due Date:  </b></td><td><?php echo $assignment[0]["Assignment"]["dueDate"];?></td></tr>
<tr><td><b>Attachments:  </b></td><td>
<?php 
foreach($documents as $document)
{
	echo("<a href=\"".BASEPATH.$document["Document"]["URL"]."\">".basename($document["Document"]["URL"])."</a></br>");
}
	?>	
</td></tr>
<tr><td></td><td></td></tr>
<tr><td><b>Description:  </b></td><td><?php echo $assignment[0]["Assignment"]["description"];?></td></tr>
<tr><td><b>Rubric:  </b></td><td><?php echo $rubric[0]["Rubric"]["name"];?></td></tr>
</table>


<?php 
$rowSize = $tablesize[0]["Rubric"]["rowSize"];
$columnSize = $tablesize[0]["Rubric"]["columnSize"];
$currentCol = 0;
$j=0;

echo ("<table id=\"rubricTable\" border=1>");

//first row. Score headers
echo ("<tr><td></td>");
foreach($scores as $score)
{
	echo ("<td>".$score["Score"]["title"]."(".$score["Score"]["score"].")</td>");
}
echo ("</tr><tr>");

//each row after that. Includes criteria headers

foreach ($criterias as $criteria )
{
	echo ("<td>".$criteria["Criteria"]["title"]."</td>");
	//last column
	if(($currentCol%$columnSize) == $columnSize-1)
	{
		for($i = ($currentCol + 1); $j < ($columnSize); $i++)
		{
			echo ("<td>".$descriptions[$i]["Criteria_Description"]["description"]."</td>");
			$currentCol = $i;
			$j++;
		}
		$j=0;
		echo ("</tr>");
		
	}
	//all columns but the last
	else
	{
		for($i = 0; $i < $columnSize;$i++)
		{
			echo ("<td>".$descriptions[$i]["Criteria_Description"]["description"]."</td>");
			$currentCol = $i;
		}
		echo ("</tr>");

	}

}

echo ("</table>");
?>


<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif; ?>
