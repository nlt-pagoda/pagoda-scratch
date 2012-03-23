<?php if ($accessible): ?>

<?php if (isset($removed)):
header('Location:'.$courseID);
endif ?>

<h1>Instructor Control Panel</h1>

<h2><?php 
echo $course[0]["Course"]["name"];
?></h2>
<span>
	<h2 style="line-height:0">Announcements</h2>
		<a href="<?php echo BASEPATH; ?>instructor/add/announcement/<?php echo $course[0]["Course"]["CourseID"];?>">Add Announcement</a>
		<a href="<?php echo BASEPATH; ?>instructor/add/assignment/<?php echo $course[0]["Course"]["CourseID"];?>">Add Assignment</a>
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
			
			//remove button
			echo("<form action=\"\" method=\"POST\">");
			echo("<input type=\"hidden\" name=\"AnnouncementID\" value=\"".$announcements[$i]["Announcement"]["AnnouncementID"]."\" />");
			echo("<input type=\"submit\" name=\"remove\" value=\"Remove\"/>");	
			echo("</form>");
			echo("<h1></h1>");
		}
		else 
		{
			echo("<div id=\"headline\">&bull; <span id=\"headlineTitle\">".$announcements[$i]["Announcement"]["title"]."</span>"."<span id=\"headlineDate\"> ".$announcements[$i]["Announcement"]["date"]."</span>");
			echo("<div id=\"headlineText\">".$announcements[$i]["Announcement"]["text"]."</div></div>");
			
			//remove button
			echo("<form action=\"\" method=\"POST\">");
			echo("<input type=\"hidden\" name=\"AnnouncementID\" value=\"".$announcements[$i]["Announcement"]["AnnouncementID"]."\" />");
			echo("<input type=\"submit\" name=\"remove\" value=\"Remove\"/>");	
			echo("</form>");
			echo("<h1></h1>");
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
	echo "<td><strong>Students:  </strong></td><td>PLACEHOLDER</td><br/>";
	echo "</tr>";
	echo "</table>";
?>

<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif; ?>
