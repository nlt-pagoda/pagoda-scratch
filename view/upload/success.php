<div id="content">

<?php
	$go = 1;
	if(isset($display)):
		if(isset($existingFiles) || isset($uploadedFiles)):

/*			if(count($uploadedFiles)>0):?>
			<div id='successBox'>
					<div id='successTitle'>
						Successfully Uploaded :
					</div>
					<?php
					//print_r($existingFiles);
					foreach($uploadedFiles as $uploads){
						echo $uploads."<br/>";
					}
					?>
			</div>
			<?php
			endif;
*/
			//if(count($existingFiles)>1): //NO IDEA why php counts empty string as 1
			$go = 0;
			?> 
				<form name='replaceBox' action='' method ='POST'>
				<input type='hidden' name='courseId' value='<?php echo $cId;?>'/>
				<?php
				$counter = 0;
				while($counter<count($existingFiles['name'])){
					echo "Replace {$existingFiles['name'][$counter]} of ".floor($existingFiles['oldFileSize'][$counter]/2048)." KB with ".floor($existingFiles['newFileSize'][$counter]/2048)." KB <input type='checkbox' name='setReplace[]' value='{$existingFiles['name'][$counter]}'/><br/>";
				    $counter++;	
				}
				?>
				<input type='submit' value='Overwrite' name='replace'/>
			<?php
		endif;
	else:
	$this->RenderMsg("No files selected to perform upload.");
	endif; 
	if($go):
		?>
		<meta http-equiv='refresh' content='=5;<?php 
			echo BASEPATH;
			if(isset($cId))
				echo "upload/".$cId;
			else
				echo "upload";
			?>'/>
		<div id="info">Your browser should redirect in 5 seconds</div>
	<?php
	endif;
	?>
</div>

