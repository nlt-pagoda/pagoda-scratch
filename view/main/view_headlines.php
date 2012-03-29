<?php if (isset($removed)):
header('Location:removed');
endif ?>

<div id="headlines">
<h1>Announcements</h1>

<div id="headlinesList">
<?php
//displays 20 headlines

$headlinesLength = count($headlines);

	for($i=0;$i<$headlinesLength;$i++)
	{
		if($i==0)
		{
			echo("<div id=\"latestHeadline\">&bull; <span id=\"latestHeadlineTitle\">".$headlines[$i]["Announcement"]["title"]."</span>"."<span id=\"latestHeadlineDate\"> ".$headlines[$i]["Announcement"]["date"]."</span>");
			echo("<div id=\"latestHeadlineText\">".$headlines[$i]["Announcement"]["text"]."</div></div>");
			if ($accessible)
			{
				
				echo("<div id=\"announcementButtons\"><form action=\"\" method=\"POST\">");
				echo("<input type=\"hidden\" name=\"AnnouncementID\" value=\"".$headlines[$i]["Announcement"]["AnnouncementID"]."\" />");
				echo("<input type=\"submit\" name=\"remove\" value=\"Remove\"/>");	
				echo("</form></div>");
				
				echo("<div id=\"announcementButtons\"><form action=\"\" method=\"POST\">");
				echo("<input type=\"hidden\" name=\"AnnouncementID\" value=\"".$headlines[$i]["Announcement"]["AnnouncementID"]."\" />");
				echo("<input type=\"submit\" name=\"edit\" value=\"Edit\"/>");	
				echo("</form></div>");
			}
			echo("<h1></h1>");
		}
		else 
		{
			echo("<div id=\"headline\">&bull; <span id=\"headlineTitle\">".$headlines[$i]["Announcement"]["title"]."</span>"."<span id=\"headlineDate\"> ".$headlines[$i]["Announcement"]["date"]."</span>");
			echo("<div id=\"headlineText\">".$headlines[$i]["Announcement"]["text"]."</div></div>");
			if ($accessible)
			{
				echo("<div id=\"announcementButtons\"><form action=\"\" method=\"POST\">");
				echo("<input type=\"hidden\" name=\"AnnouncementID\" value=\"".$headlines[$i]["Announcement"]["AnnouncementID"]."\" />");
				echo("<input type=\"submit\" name=\"remove\" value=\"Remove\"/>");
				echo("</form></div>");
				
				echo("<div id=\"announcementButtons\"><form action=\"\" method=\"POST\">");
				echo("<input type=\"hidden\" name=\"AnnouncementID\" value=\"".$headlines[$i]["Announcement"]["AnnouncementID"]."\" />");
				echo("<input type=\"submit\" name=\"edit\" value=\"Edit\"/>");	
				echo("</form></div>");
			}
			echo("<h1></h1>");
		}
	}


	
?>
</div>

	

	

	
</form>