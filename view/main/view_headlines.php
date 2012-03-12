<div id="headlines">
<h1>Announcements</h1>

<div id="headlinesList">
<?php
//displays 20 headlines

$headlinesLength = count($headlines);

if($headlinesLength < 20)
{
	for($i=0;$i<$headlinesLength;$i++)
	{
		if($i==0)
		{
			echo("<div id=\"latestHeadline\">&bull; <span id=\"latestHeadlineTitle\">".$headlines[$i]["Announcement"]["title"]."</span>"."<span id=\"latestHeadlineDate\"> ".$headlines[$i]["Announcement"]["date"]."</span>");
			echo("<div id=\"latestHeadlineText\">".$headlines[$i]["Announcement"]["text"]."</div></div>");
			echo("<h1></h1>");
		}
		else 
		{
			echo("<div id=\"headline\">&bull; <span id=\"headlineTitle\">".$headlines[$i]["Announcement"]["title"]."</span>"."<span id=\"headlineDate\"> ".$headlines[$i]["Announcement"]["date"]."</span>");
			echo("<div id=\"headlineText\">".$headlines[$i]["Announcement"]["text"]."</div></div>");
			echo("<h1></h1>");
		}
	}
}

else
{
	for($i=0;$i<=19;$i++)
	{
		if($i==0)
		{
			echo("<div id=\"latestHeadline\">&bull; <span id=\"latestHeadlineTitle\">".$headlines[$i]["Announcement"]["title"]."</span>"."<span id=\"latestHeadlineDate\"> ".$headlines[$i]["Announcement"]["date"]."</span>");
			echo("<div id=\"latestHeadlineText\">".$headlines[$i]["Announcement"]["text"]."</div></div>");
		}
		else 
		{
			echo("<div id=\"headline\">&bull; <span id=\"headlineTitle\">".$headlines[$i]["Announcement"]["title"]."</span>"."<span id=\"headlineDate\"> ".$headlines[$i]["Announcement"]["date"]."</span>");
			echo("<div id=\"headlineText\">".$headlines[$i]["Announcement"]["text"]."</div></div>");
		}
	}
}
	
?>
</div>