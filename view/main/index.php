<div id="headlines">
<h1>Headlines</h1>

<div id="headlinesList">
<?php
foreach ($headlines as $headline)
{
	echo("<div id=\"headline\">&bull; <span id=\"headlineTitle\">".$headline["Announcement"]["title"]."</span>"."<span id=\"headlineDate\"> ".$headline["Announcement"]["date"]."</span>");
	echo("<div id=\"headlineText\">".$headline["Announcement"]["text"]."</div></div>");
}
	
?>
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

	<h1>Lorem Ipsum</h1>
	
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi in nisl sed risus semper tristique id vel nisl. In mi diam, fermentum eget bibendum quis, commodo ut ante. Vivamus sit amet felis massa. Quisque ultrices laoreet nulla et rutrum. Aliquam lorem felis, vestibulum sed condimentum et, feugiat et mauris. Donec tellus erat, gravida vitae pulvinar et, cursus vel est. Duis ut neque non risus placerat convallis quis at odio. Praesent eleifend augue non metus ultricies sit amet facilisis ipsum ullamcorper. Praesent ut orci a est pretium hendrerit eget ac massa. Duis id est orci.</p>

<p>Praesent eget tortor nec sem pulvinar consequat. Nullam lectus diam, commodo eget aliquam hendrerit, porta at augue. Phasellus quis adipiscing nisi. Duis risus augue, pellentesque at eleifend at, molestie nec eros. Phasellus id ante eget neque fringilla tempus. Sed ac bibendum risus. Vestibulum velit metus, iaculis tristique mollis commodo, malesuada sed nisl.</p>
