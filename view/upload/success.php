<div id="content">
<?php if(isset($display)):
		if(isset($existingFiles)):
			if(count($existingFiles)>0):?>
				<form name='replaceBox' action='' method ='POST'>
				<?php
				$counter = 0;
				while($counter<count($existingFiles['name'])){
					echo "Replace {$existingFiles['name'][$counter]} of ".floor($existingFiles['oldFileSize'][$counter]/2048)." KB with ".floor($existingFiles['newFileSize'][$counter]/2048)." KB <input type='checkbox' name='setReplace[]' value='{$existingFiles['name'][$counter]}'/><br/>";
				    $counter++;	
				}
				?>
				<input type='submit' value='Overwrite' name='replace'/>
			<?php endif;
		elseif(isset($uploadedFiles)):?>
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
					<a href="<?php echo BASEPATH; ?>upload/">Upload more</a>
			</div>
		<?php
		endif;
		else:
		$this->RenderMsg("No files selected to perform upload.");
	endif; ?>
</div>

