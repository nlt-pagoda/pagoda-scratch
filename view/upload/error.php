<div id="content">
	<?php if(isset($errors)):?>
	<div id="errorBox">
		<div id="errorTitle">
			<b>Error Title</b>
		</div>
		<?php 
		foreach($errors as $error){
			echo "<div id=\"error\"> $error </div>";
		}
		else :
		$this->RenderMsg("No errors found");
		endif ?>
	</div>
</div>



