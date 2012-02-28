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