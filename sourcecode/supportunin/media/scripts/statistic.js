var key;
var datefrom;
var dateto;
var typeChart;

$("document").ready(function(){
	$("#datefrom, #dateto").datepicker({dateFormat: "yy-mm-dd"});
	setDefaultDatePicker("#datefrom", "#dateto");
});

function xemBieuDo()
{
	key = $("#key").val();
	datefrom = $("#datefrom").val();
	dateto = $("#dateto").val();
	typeChart = $("#typechart").val();
    reason = $("#reason").val();
	
	if(datefrom > dateto)
	{
		alert("Ngày bắt đầu phải <= ngày kết thúc");
		return;
	}
	
	clearReport();
	
	disableButtons(true);
	
	startLoading();
	
	$.post(baseURL + "/compensation/getstatistic", {key: key, datefrom: datefrom, dateto: dateto, reason: reason}, function(receive)
	{
		stopLoading();
		
		disableButtons(false);
		
		var data = JSON.parse(receive);
		
		var filters = getFilters();
		renderChart("chartArea", typeChart, data, filters);
	});
}

function xemBangSoLieu()
{
	key = $("#key").val();
	datefrom = $("#datefrom").val();
	dateto = $("#dateto").val();
    reason = $("#reason").val();
	
	if(datefrom > dateto)
	{
		alert("Ngày bắt đầu phải <= ngày kết thúc");
		return;
	}
	
	clearReport();
	
	disableButtons(true);
	
	startLoading();
	
	$.post(baseURL + "/compensation/getstatistic", {key: key, datefrom: datefrom, dateto: dateto, reason: reason}, function(receive)
	{
		stopLoading();
		
		disableButtons(false);
		
		var data = JSON.parse(receive);
		
		var filters = getFilters();
		renderBangSoLieu(data, filters);
	});
}

function xemCaHai()
{
	key = $("#key").val();
	if(key == '')
	{
		key = -1;
	}
	datefrom = $("#datefrom").val();
	dateto = $("#dateto").val();
	reason = $("#reason").val();
	
	typeChart = $("#typechart").val();
	
	if(datefrom > dateto)
	{
		alert("Ngày bắt đầu phải <= ngày kết thúc");
		return;
	}
	
	clearReport();
	
	disableButtons(true);
	
	startLoading();
	
	$.post(baseURL + "/compensation/getstatistic", {key: key, datefrom: datefrom, dateto: dateto, reason: reason}, function(receive)
	{
		stopLoading();
		
		disableButtons(false);
		
		var data = JSON.parse(receive);
		
		var filters = getFilters();
		renderChart("chartArea", typeChart, data, filters);
		
		renderBangSoLieu(data, filters);
	});
}

function xuatExcel()
{
	key = $("#key").val();
	datefrom = $("#datefrom").val();
	dateto = $("#dateto").val();
	reason = $("#reason").val();
	
	if(datefrom > dateto)
	{
		alert("Ngày bắt đầu phải <= ngày kết thúc");
		return;
	}
	
	var filters = getFilters();	
	param = "?p=datefrom=" + datefrom + ";dateto=" + dateto   + ";name=" + filters.join(",") + ";key=" + key + ";reason=" + reason;
	
	window.location = baseURL +  "/compensation/export" + param;
}

function getFilters()
{
	if(key == "0")
	{
		return new Array("Đền bù","Vận hành","Khác");
	}
	else if(key == "1")
	{
		return new Array("Pig", "Item", "GroupItem", "Xu", "Gold", "Exp", "Kiss");
	}
	
}