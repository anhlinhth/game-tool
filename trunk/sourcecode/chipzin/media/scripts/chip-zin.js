function enable(item){
	if($(item).hasClass('disabled')){
		$(item).removeClass("disabled");
	}
}

function disable(item){
	if(!$(item).hasClass('disabled')){
		$(item).addClass("disabled");
	}
}

function validateInput(e)
{	
	var err_msg = "";	
	var input=e.find('input');
	var select=e.find('select');
	input.each(function(index){
		var element = $(this);		
		if( element.is(':disabled')==true){		
			//code here			
		}else{
			element.css({ background: "transparent" });
			if(element.hasClass('require')){
				if(element.val()==''){
					err_msg += "Null</br>";						
					element.css({ background: "red" }).focus();						
				}
			};
			if(element.hasClass('number')){
				var val = element.val();				
				if(isNaN(val)){
					err_msg += "Not a Number</br>";						
					element.css({ background: "red" }).focus();						
				}
			};
		}
		 
	});	
	select.each(function(index){		
		if($(this).hasClass('require')){
			if($(this).val()==""){
				$(this).css({ background: "red" }).focus();
				err_msg += "NULL</br>";	
			}else{
				$(this).css({ background: "transparent"});
			}	
		}
		
	});	
	return err_msg;	
}

