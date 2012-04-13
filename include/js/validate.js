//Current Status:- - Working on the validation based on the 'name' of the attribute instead of just class
//                 - Does not work with different styles, style is hardcoded now, possible solution. Use "class" in css and remove them from the validation.(This needs a group discussion)


//Name:- Validate.js   (for now)
//Version:- 0.001
//Author:- Yojan Shrestha
//Date:- 4-1-2012

//----------------------------------------------------------------------------------------------
//Validation is done based on the input value in the text
// Checks only textfield for empty value. DOES NOT PERFORM OTHER VALIDATION!!!
// ONLY WORKS ON TEXT, DOES NOT WORK FOR RADIOBUTTON, SELECTION, COMBOBOX OR CHECKBOXES.
//Usage:-
//	- Specify an id for the field that needs to be validated
//  - Pass that id to Validate.id(new Array(/idName/));
//    - Passing must be done as an Array.
//------------------------------------------------------------------------------------------------
try{
	var submit_btn = "submit";
	var total_parameters = 0;
	var validated_parameters = 0;
	var param = new Array();
	var button_flag = 0;
	$(document).ready(function(){
			console.log("VALIDATE WAS HERE");
			$("#"+submit_btn,this).attr('disabled',true);	
			$("#"+submit_btn).css("background","-moz-linear-gradient(19% 75% 90deg,#EEEEEE, #FFFFFF)");

			//$("input[type=submit]").hover(function(){this.css('width','50px')});	
			$("input").blur(function(){
				Validate.id(param);
				for(var x in param)
				{
					console.log(param[x]);
					console.log(total_parameters);
					console.log(validated_parameters);
					if(!(total_parameters - validated_parameters))
							button_flag = 1;
						else
							button_flag = 0;
				}
				if(button_flag===1)
				{
					$("#"+submit_btn).attr('disabled',false);
					$("#"+submit_btn).css("background","-moz-linear-gradient(19% 75% 90deg,#CDCDCD, #FFFFFF)");
					$("#"+submit_btn).hover(function(){$(this).css("background","-moz-linear-gradient(19% 75% 90deg,#CDCDCD, #CCCCCC)")});

				}
				else
					$("#"+submit_btn).attr('disabled',true);	
			});

	});




	var Validate = {
		id: function(names){
			  validated_parameters = 0;
			  total_parameters = 0;
			  param = new Array();
			  total_parameters+=names.length;
			  for(var i in names)
			 	{
			 		param.push(names[i]);
			 		if($("#"+names[i]).val() != "")
			 			validated_parameters+=1;
				}
		},
	
/*		name: function(ids){
			total_parameters+=ids.length;
			console.log("yo im id");
			for(var i in ids)
			{
				param.push(names[i]);
				if($("#"+names[i]).val() != null)
				{
					validated_parameters+=1;
				}
			}
		},
*/	
		button: function(buttonName){
			submit_btn = buttonName;
		}
	}
	
}
catch(e)
{
	console.log(e.message);
}
