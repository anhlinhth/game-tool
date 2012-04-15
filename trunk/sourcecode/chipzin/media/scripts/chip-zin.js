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
function validateForm(e){
	//alert("");
	var input = e.find("input");
	var select=e.find("select");
	input.each(function(index){
		if($(this).hasClass('require')){
			if($(this).val()=="")
				{					
					$(this).css({ border: "1px solid red" }).focus();
				}
			else if(isNaN($(this).val()))
				{
					$(this).css({ border: "1px solid red" }).focus();
				}
			else if( (Number($(this).val()>100) || Number($(this).val()<0)) && $(this).attr('id')!='Value' && $(this).attr('id')!='BattleID' )
				{
					$(this).css({ border: "1px solid red" }).focus();
				}	
			else 
				{
					$(this).css({ border: "1px solid #EFEFEF" });				
				}
		}
			
	});
	select.each(function(index){
		if($(this).hasClass('require')){
			if($(this).val()=="")
				$(this).css({ border: "1px solid red" }).focus();
			else
				$(this).css({ border: "1px solid #EFEFEF" });			
		}
		
	});		
}

function validateInput(e)
{		
	var err_msg = "";	
	var input=e.find('input');
	var select=e.find('select');
	input.each(function(index){
		var element = $(this);
		element.css({ border: " 1px solid #EFEFEF" });
		if( element.is(':disabled')==true){		
			//code here			
		}else{			
			if(element.hasClass('require')){
				if(element.val()==''){
					err_msg += "Null</br>";						
					element.css({ border: "1px solid red" }).focus();						
				}
			};
			if(element.hasClass('number')){
				var val = element.val();				
				if(isNaN(val)){
					err_msg += "Not a Number</br>";						
					element.css({ border: "1px solid red" }).focus();						
				}
			};
		}
		 
	});	
	select.each(function(index){
		if($(this).hasClass('require')){
			alert("");
			if($(this).val()==""){
				$(this).css({ border: "1px solid red" }).focus();
				err_msg += "NULL</br>";	
			}else{
				$(this).css({ border: "1px solid #EFEFEF" });
			}	
		}
		
	});	
	return err_msg;	
}

function validateInput2(e)
{	
	flag=true;
	var input=e.find('input');
	input.each(function(index){		
		if($(this).hasClass('require'))	{
				if($(this).val()=='')
					{
						$(this).css({ border: "1px solid red" }).focus();						
						flag=false;
					}
				else 
					{
						$(this).css({ border: "none" });						
					}
			}
	});
	if(flag==true){
		e.addClass("ok");		
	}
	else {
		e.removeClass("ok");
	}	
	return flag;
}