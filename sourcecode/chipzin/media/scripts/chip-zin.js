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
		if($(this).attr('id')=='Layout'){
			if($(this).val()=="")
				$(this).css({ border: "1px solid red" }).focus();
			else
				{
					$(this).css({ border: "1px solid #EFEFEF" });
					
				}
		}
		
	});		
}

function validateInput(e)
{	
	var rs = "";	
	var input=e.find('input');
	var select=e.find('select');
	input.each(function(index)
	{	
		$(this).css({ border: " 1px solid #EFEFEF" });
		if( $(this).is(':disabled')==true){							
		}
		else if($(this).hasClass('number'))
				{
					if($(this).val()=='')
					{
						rs += " ";						
						$(this).css({ border: "1px solid red" }).focus();						
					}
					else if(isNaN($(this).val()))
						{
							rs += " ";						
							$(this).css({ border: "1px solid red" }).focus();
						}
					else if(Number($(this).val())<0 ||Number($(this).val())>100 )
						{
							rs += " ";
							$(this).css({ border: "1px solid red" }).focus();							
						}
					
		}		
		 
	});
	select.each(function(index){
		$(this).css({ border: " 1px solid #ADD8E6" });
		
		 if($(this).hasClass('layout'))
				{
					if($(this).val()=='')
					{
						rs += 'Layout không được bỏ trống<br>';	
						$(this).css({ border: "1px solid red" }).focus();						
					}					
				}
	});
		
	
	return rs;
	
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