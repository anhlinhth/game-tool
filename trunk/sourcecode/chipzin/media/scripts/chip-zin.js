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
	/*input.each(function(index){
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
			
	});*/
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
{	flag=true;
	var input=e.find('input');
	input.each(function(index)
	{
		
		if($(this).hasClass('require'))
			{
				if($(this).val()=='')
					{
						$(this).css({ border: "1px solid red" }).focus();
						flag=false;
					}
				else if($(this).val()!='')
					{
						$(this).css({ border: "none" });						
					}
			}
	});
	return flag;
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