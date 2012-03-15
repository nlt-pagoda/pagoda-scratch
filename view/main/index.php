<div id="headlines">
<h1>Announcements</h1>

<div id="headlinesList">
<?php
$headlinesLength = count($headlines);

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
?>
</div>
<a href="<?php echo BASEPATH."main/view/headlines/"; ?>">View more announcements</a></br></br>
</div>
<script type="text/javascript">
	$(document).ready(function(){
	
		$("#click").click(function(){
			$(".result").hide();
			$.ajax({
				url: <?php echo BASEPATH; ?>+"admin/edit/user/1",
				success: function(data) {
					$(".result").html(data);
					$(".result").slideDown();
				}
			});
		});

	
	});
</script>

	<div class="result"><a id="click" href="javascript:void(0);">CLICK HERE TO START YOUR JOURNEY</a></div>
