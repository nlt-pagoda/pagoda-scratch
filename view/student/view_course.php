<?php if ($accessible): ?>

<h2><?php 
echo $course[0]["Course"]["name"];
?></h2>

<span>
	<h2 style="line-height:0">Announcements</h2>
</span>

<div id="headlinesList">
<?php
$announcementsLength = count($announcements);

	for($i=0;$i<$announcementsLength;$i++)
	{
		if($i==0)
		{
			echo("<div id=\"latestHeadline\">&bull; <span id=\"latestHeadlineTitle\">".$announcements[$i]["Announcement"]["title"]."</span>"."<span id=\"latestHeadlineDate\"> ".$announcements[$i]["Announcement"]["date"]."</span>");
			echo("<div id=\"latestHeadlineText\">".$announcements[$i]["Announcement"]["text"]."</div></div>");
		}
		else 
		{
			echo("<div id=\"headline\">&bull; <span id=\"headlineTitle\">".$announcements[$i]["Announcement"]["title"]."</span>"."<span id=\"headlineDate\"> ".$announcements[$i]["Announcement"]["date"]."</span>");
			echo("<div id=\"headlineText\">".$announcements[$i]["Announcement"]["text"]."</div></div>");
		}
	}
?>
</div>

<?php
	echo "<table>";
	echo "<tr>";
	echo "<td><strong>Department:  </strong></td><td>".$course[0]["Department"]["name"]."(".$course[0]["Department"]["abbreviation"].")</td><br/>";
	echo "</tr>";
	echo "<tr>";
	echo "<td><strong>Number:  </strong></td><td>".$course[0]["Course"]["number"]."</td><br/>";
	echo "</tr>";
	echo "<tr>";
	echo "<td><strong>Section:  </strong></td><td>".$course[0]["Course"]["section"]."</td><br/>";
	echo "</tr>";
	echo "<tr>";
	echo "<td><strong>CRN:  </strong></td><td>".$course[0]["Course"]["CRN"]."</td><br/>";
	echo "</tr>";
	echo "<tr>";
	echo "<td><strong>Class Size:  </strong></td><td>".$studentCount[0][""]["COUNT(StudentID)"]."</td><br/>";
	echo "</tr>";
	echo "<tr>";
	echo "<td><strong>Instructor:  </strong></td><td>".$instructorName[0]["Profile"]["firstname"]." ".$instructorName[0]["Profile"]["lastname"]."</td><br/>";
	echo "</tr>";
	echo "</table>";
?>

<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif; ?>