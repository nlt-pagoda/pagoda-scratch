function removeFileList(fileId)
{
	var fileObj = document.getElementById(fileId);
	fileObj.parentNode.removeChild(fileObj);
}
//JUST SETTING UP A TEST FOR UPLOAD FILE..FAILED MISERABLY
/*function getChkboxValidation(totalItems)
{
	var replaceConfirm = new Array();
	for(var i =0;i<totalItems;i++)
	{
		if($('#setReplace'+i).is(':checked'))
			replaceConfirm[i]= $('#setReplace'+i).val();
	}
	return replaceConfirm;
}
*/
$(document).ready(function(){
	var attacher= new Array();
	var fileCounter = 0;
	//Generates codes for input type file to be automatically added after Attach files link is clicked.
	$("#attacher").click(function(){
		var li = document.createElement('li');
		li.setAttribute('id','file'+fileCounter);
		li.innerHTML = '<input type="file" name="docs[]" id="docs'+fileCounter+'"/> <a href="#" onClick="removeFileList(\'file'+fileCounter+'\')">Remove</a>';
		document.getElementById('parentFilelist').appendChild(li);
		//$('#docs'+fileCounter).click();
		$('#docs'+fileCounter).trigger('click');
		fileCounter++;
	});
	
});
