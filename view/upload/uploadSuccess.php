<div id="content">

	<?php if(isset($existingFiles) && isset($uploadedFiles)):
			if(count($existingFiles)>0):?>
				<form name='replaceBox' action='' method ='POST'>"
				<?php
				$counter = 0;
				while($counter<count($existingFiles['name'])){
					echo "{$existingFiles['name'][$counter]} of ".floor($existingFiles['oldFileSize'][$counter]/2048)." KB with ".floor($existingFiles['newFileSize'][$counter]/2048)." KB <input type='checkbox' name='setReplace[]' value='{$existingFiles['name'][$counter]}'/><br/>";
				    $counter++;	
				}
				?>
				<div id='successBox'>
						<div id='successTitle'>
							Successfully Uploaded :
						</div>
						<?php
						print_r($uploadedFiles);
						//print_r($existingFiles);
						foreach($uploadedFiles as $uploads){
							echo $uploads;
						}
				?>
				</div>
				<input type='submit' value='Replace' name='replace'/>"
			<?php
			else:?>
				<div id='successBox'>
						<div id='successTitle'>
							Successfully Uploaded :
						</div>
						<?php
						print_r($uploadedFiles);
						//print_r($existingFiles);
						foreach($uploadedFiles as $uploads){
							echo $uploads;
						}
						?>
				</div>
			<?php
				endif;
		else:
			$this->RenderMsg("No files selected to perform upload.");
			?>
		<?php endif ?>
</div>
