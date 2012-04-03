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
				//alert($(this).attr('id'));
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
					$(this).css({ border: "none" });				
				}
		}
			
	});
	select.each(function(index){
		if($(this).hasClass('require')){
			if($(this).val()=="")
			$(this).css({ border: "1px solid red" }).focus();
			else
				{
					$(this).css({ border: "none" });
					
				}
		}
		
	});		
}

function validateInput(e)
{
	
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
						flag=true;
					}
			}
		return flag;
	});
	//alert(flag);
}