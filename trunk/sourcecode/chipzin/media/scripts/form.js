function doPaging(e)
{
	if(e.keyCode == 13)
		document.formPaging.submit();
}

function goTo(page)
{
	$("#page").val(page);
	document.formPaging.submit();
}

function changeItems()
{
	$("#page").val(1);
	document.formPaging.submit();
}

function deleteItem(link, id)
{
	if(confirm("Bạn có muốn xóa mẩu tin này không?") == true)
	{
		$.ajax({
			type: "POST",
			url: link,
			data: "id=" + id,
			success: function(msg){
				if(msg != "")
				{					
					alert(msg);
				}
				else
				{
					alert("Xóa thành công");
					window.location = location.href;
				}
			}
		});
	}
}

function openWindow(filename, winname, width, height, feature)
{
	var feature, top, left;
	var reOpera = /opera/i;
	var winnameRequired = ((navigator.appName == "Netscape" && parseInt(navigator.appVersion) == 4) || reOpera.test(navigator.userAgent));
	
	left = (window.screen.width - width) /2;
	top = (window.screen.height - height) /2;
	
	if(feature == '')
		feature = "width=" + width + ",height=" + height + ",top=" + top + ",left=" + left + ",status=0,location=0";
	else
		feature = "width=" + width + ",height=" + height + ",top=" + top + ",left=" + left + "," + feature;
	
	if(!winnameRequired) winname = "";
	newwindow = window.open(filename, winname, feature);
	newwindow.focus();		
}

function checkAll(theform)
{
	if(theform.chkid==null) return;
	var state = theform.chkall.checked;
	var chkitems = theform.chkid.length;
	if(chkitems > 0)
	{
		for(var i = 0; i < chkitems; i++)
		{
			if(theform.chkid[i].disabled == false)
				theform.chkid[i].checked = state;
		}
	}
	else
	{
		if(theform.chkid.disabled == false)
			theform.chkid.checked = state;
	}	
}

function checkOneItem(theform)
{
	var state = true;
	var chkitems = theform.chkid.length;
	if(chkitems > 0)
	{
		for(var i = 0; i < chkitems; i++)
		{
			if(theform.chkid[i].checked == false)
			{
				state = false;
				break;
			}
		}
	}
	
	theform.chkall.checked = state;
}

