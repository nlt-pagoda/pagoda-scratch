<?php if ($accessible): ?>

<div id=sidepanel>
<?php $this->rubricSidePanel(); ?>
</div>

<h1>View Rubrics</h1>

<h2><?php 
echo $rubric[0]["Rubric"]["name"];
?></h2>

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
