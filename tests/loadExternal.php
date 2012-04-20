<html>
<script type="text/javascript" src = "https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#attach").click(function(){
		$("#window").load("http://localhost/pagoda-scratch/view/upload/",function(){
			console.log("FUCK I'M LOADED")});
		});
	});
</script>
<a href="#" id = "attach">Attach</a>
<div id="window"></div>
</html>
