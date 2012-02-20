function createChart(typeChart, numCategory, chartId)
{
	var filename;
	switch(typeChart)
	{
		case "line":
			filename = "MSLine.swf";
			break;
		case "bar":
			filename = "MSBar2D.swf";
			break;
		case "column":
			filename = "MSColumn2D.swf";
			break;
		case "combi":
			filename = "ScrollCombiDY2D.swf";
			break;
		case "pie":	
			filename = "Pie2D.swf";
	}

	var width = 700;
	var height = 500;

	if(typeChart != "bar")
	{
		var width = numCategory * 40;

		if(width < 700)
		{
			width = 700;
		}
	}
	else
	{
		var height = numCategory * 40;

		if(height < 500)
		{
			height = 500;
		}
	}

	if(chartId == null)
	{
		chartId = "ChId";
	}

	var chartObject = getChartFromId(chartId);
	if(chartObject)
	{
		chartObject.dispose();
	}

	return new FusionCharts(baseURL + "/media/flashs/chart/" + filename, chartId, width, height, "0", "1");
}

function getFilter()
{
	var filters = new Array();
	for(var i = 0; i < curCondition; i++)
	{
		var conditionName = $("#filter_condition_" + (i+1)).val();
		if(conditionName == "")
		{
			conditionName = "Điều kiện " + (i+1);
		}
		filters.push(conditionName);
	}
	return filters;
}

function renderChart(renderId, typeChart, data, filters, chartId)
{
	var chart = createChart(typeChart, data["datasets"][0].length, chartId);

	if(typeChart == "line" || typeChart == "bar" || typeChart == "column" )
	{
		chart.setDataXML(getXMLString(data, filters));
	}
	else if(typeChart == "combi")
	{
		chart.setDataXML(getXMLString_2(data, filters));
	}
	else if(typeChart == "pie")
	{
		chart.setDataXML(getXMLString_Pie(data, filters));
	}
	
	chart.render(renderId);
}
function getXMLString_Pie(data, filters)
{
	var xml;
	xml = "<chart palette='4'>";
	var categories = data["categories"];
	var datasets = data["datasets"];
	for(var i = 0; i < categories.length; i++)
	{
		xml += "<set  label='" + categories[i] + "' value='" + datasets[0][i] + "' />";
	}
	xml += "</chart>";
	
	return xml;
}
function getXMLString(data, filters)
{
	var xml = "<chart plotGradientColor='' animation='0' exportEnabled='1' exportAtClient='0' exportAction='+Action+' exportFileName='+FileName+' exportHandler='+baseURL+/media/flashs/chart/exporter/FCExporter.php'>";
	xml = xml.replace("+baseURL+", baseURL);
	if(data["export"])
	{
		xml = xml.replace("+Action+", "save");
		xml = xml.replace("+FileName+", data["export"]);
	}
	else
	{
		xml = xml.replace("+Action+", "download");
		xml = xml.replace("+FileName+", "export");
	}

	// categories
	var categories = data["categories"];
	xml += "<categories font='Arial' fontSize='10' fontColor='000000'>";
	
	for(var i = 0; i < categories.length; i++)
	{
		xml += "<category label='" + categories[i] + "' />";
	}
	xml += "</categories>";

	// datasets
	var datasets = data["datasets"];
	var notes = data["notes"];
	var color = new Array("AFD8F8", "F6BD0F", "FF0000", "00FF00", "0000FF", "FFFF00", "FF00FF","EE7600","71C671","8E388E");
	for(var i = 0; i < datasets.length; i++)
	{
		xml += "<dataset seriesname='" + filters[i] + "'color='" + color[i] + "'>";

		for(var j = 0; j < datasets[i].length; j++)
		{
			var value = 0;
			if(datasets[i][j] != null)
			{
				value = datasets[i][j];
			}
			
			if(notes && notes[j] && notes[j]["note"] != " ")
			{
				xml += "<set tooltext='" + notes[j]["note"] + "' dashed='1' value='" + value + "' />";
			}
			else
			{
				xml += "<set value='" + value + "' />";
			}
		}

		xml += "</dataset>";
	}

	xml += "</chart>";

	return xml;
}

function getXMLString_2(data, filters)
{
	var categories = data["categories"];
	var datasets = data["datasets"];
	var notes = data["notes"];

	//chart
	var xml = "<chart plotGradientColor='' animation='0' PYAxisName='Amount' SYAxisName='Quantity' exportEnabled='1' exportAtClient='0' exportAction='+Action+' exportFileName='+FileName+' exportHandler='+baseURL+/media/flashs/chart/exporter/FCExporter.php'>";
	xml = xml.replace("+baseURL+", baseURL);
	if(data["export"])
	{
		xml = xml.replace("+Action+", "save");
		xml = xml.replace("+FileName+", data["export"]);
	}
	else
	{
		xml = xml.replace("+Action+", "download");
		xml = xml.replace("+FileName+", "export");
	}

	//categories
	xml += "<categories font='Arial' fontSize='10' fontColor='000000'>";

	for(var i = 0; i < categories.length; i++)
	{
		xml += "<category label='" + categories[i] + "' />";
	}

	xml += "</categories>";

	//datasets
	var color = new Array("0000FF", "F6BD0F", "FF0000", "00FF00");
	for(var i = 0; i < datasets.length; i++)
	{
		switch(i)
		{
			case 0:
			case 1:
				xml += "<dataset seriesname='" + filters[i] + "'color='" + color[i] + "' parentYAxis='S' lineThickness='3'>";
				break;
			case 2:
			case 3:
				xml += "<dataset seriesname='" + filters[i] + "'color='" + color[i] + "' parentYAxis='P'>";
		}

		for(var j = 0; j < datasets[i].length; j++)
		{
			var value = 0;
			if(datasets[i][j] != null)
			{
				value = datasets[i][j];
			}

			if(!notes || notes[j]["note"] == " ")
			{
				xml += "<set value='" + value + "' />";
			}
			else
			{
				xml += "<set tooltext='" + notes[j]["note"] + "' dashed='1' value='" + value + "' />";
			}
		}

		xml += "</dataset>";
	}

	xml += "</chart>";

	return xml;
}

function renderBangSoLieu(data, filters)
{
	$("#header_bangsolieu").css("display", "");

	var content = "<tr class='datatable'><td>" + $("#key :selected").text() + "</td>";

	for(var i = 0; i < data["datasets"].length; i++)
	{
		content += "<td>" + filters[i] + "</td>";
	}

	if(data["notes"])
	{
		content += "<td>Note</td>";
	}

	content += "</tr>";

	var totals = new Array();
	for(var i = 0; i < data["datasets"].length; i++)
	{
		totals.push(0);
	}

	for(var i = 0; i < data["categories"].length; i++)
	{
		content += "<tr><td>" + data["categories"][i] + "</td>";

		for(var j = 0; j < data["datasets"].length; j++)
		{
			if(data["datasets"][j][i] == null)
			{
				data["datasets"][j][i] = 0;
			}
			content += "<td style='text-align: right;'>" + formatNumber(data["datasets"][j][i]) + "</td>";

			totals[j] += data["datasets"][j][i] * 1;
		}

		if(data["notes"])
		{
			if(data["notes"][i]["note"] != " ")
			{
				content += "<td>" + data["notes"][i]["note"] + "</td>";
			}
			else
			{
				content += "<td>&nbsp;</td>";
			}
		}

		content += "</tr>";
	}

	content += "<tr><td style='background-color: #FFFF80;'>Total</td>";
	for(var i = 0; i < totals.length; i++)
	{
		content += "<td style='text-align: right; background-color: #FFFF80;'>" + formatNumber(totals[i]) + "</td>";
	}
	if(data["notes"])
	{
		content += "<td style='background-color: #FFFF80;'>&nbsp;</td>";
	}
	content += "</tr>";

	$("#tableArea table").html(content);
}


function renderBangSoLieuDacBiet(data, filters)
{
	$("#header_bangsolieu").css("display", "");

	var content = "<tr class='datatable'><td>" + $("#key :selected").text() + "</td>";

	for(var i = 0; i < data["datasets"].length; i++)
	{
		content += "<td>" + filters[i] + "</td>";
	}

	if(data["notes"])
	{
		content += "<td>Note</td>";
	}

	content += "</tr>";

	var totals = new Array();
	for(var i = 0; i < data["datasets"].length; i++)
	{
		totals.push(0);
	}

	for(var i = 0; i < data["categories"].length; i++)
	{
		content += "<tr><td>" + data["categories"][i] + "</td>";

		for(var j = 0; j < data["datasets"].length; j++)
		{
			if(data["datasets"][j][i] == null)
			{
				data["datasets"][j][i] = 0;
			}
			content += "<td style='text-align: right;'>" + data["datasets"][j][i] + "</td>";

			totals[j] += data["datasets"][j][i] * 1;
		}

		if(data["notes"])
		{
			if(data["notes"][i]["note"] != " ")
			{
				content += "<td>" + data["notes"][i]["note"] + "</td>";
			}
			else
			{
				content += "<td>&nbsp;</td>";
			}
		}

		content += "</tr>";
	}

	content += "<tr><td style='background-color: #FFFF80;'>Total</td>";
	for(var i = 0; i < totals.length; i++)
	{
		content += "<td style='text-align: right; background-color: #FFFF80;'>" + formatNumber(totals[i]) + "</td>";
	}
	if(data["notes"])
	{
		content += "<td style='background-color: #FFFF80;'>&nbsp;</td>";
	}
	content += "</tr>";

	$("#tableArea table").html(content);
}
function clearReport()
{
	$("#header_bieudo").css("display", "none");
	$("#header_bangsolieu").css("display", "none");

	$("#tableArea table").html("");
	$("#chartArea").html("");
}

function startLoading()
{
	$("#loading").css("display", "");
}

function stopLoading()
{
	$("#loading").css("display", "none");
}

function setDefaultDatePicker(fromDate, toDate)
{
	var now = new Date();
	$(toDate).datepicker("setDate", now);

	var sevenDayAgo = new Date();
	sevenDayAgo.setDate(now.getDate() - 7);
	$(fromDate).datepicker("setDate", sevenDayAgo);
}

function disableButtons(x)
{
	if(x == true)
	{
		$("#xembieubo").attr("disabled", true);
		$("#xembangsolieu").attr("disabled", true);
		$("#xemcahai").attr("disabled", true);
		$("#xuatexcel").attr("disabled", true);
	}
	else
	{
		$("#xembieubo").removeAttr("disabled");
		$("#xembangsolieu").removeAttr("disabled");
		$("#xemcahai").removeAttr("disabled");
		$("#xuatexcel").removeAttr("disabled");
	}
}

function setNumbericOnly(selector)
{
	$(selector).keypress(function (e)
	{
		if(e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
		{
			return false;
		}
	});
}

function checkData()
{
	var errorStr = "";

	var isError = false;
	for(var i = 0; i < datefrom.length; i++)
	{
		if(datefrom[i] > dateto[i])
		{
			isError = true;
		}
	}
	if(isError)
	{
		errorStr += "Ngày bắt đầu phải <= ngày kết thúc";
	}

	isError = false;
	for(var i = 0; i < levelfrom.length; i++)
	{
		if(levelfrom[i]*1 > levelto[i]*1)
		{
			isError = true;
		}
	}
	if(isError)
	{
		errorStr += "\nLevel bắt đầu phải <= level kết thúc";
	}

	return errorStr;
}

function fillTable(id, keys, data, headers, aligns)
{
	$(id).html("");

	var content = "<tr class='datatable'><td>STT</td>";

	for(var i = 0; i < headers.length; i++)
	{
		content += "<td>" + headers[i] + "</td>";
	}

	content += "</tr>\n";

	for(var i = 0; i < data.length; i++)
	{
		content += "<tr><td style='text-align: center;'>" + (i+1) + "</td>";

		for(var j = 0; j < keys.length; j++)
		{
			if(!isNaN(data[i][keys[j]]))
			{
				data[i][keys[j]] = formatNumber(data[i][keys[j]]);
			}
			if(data[i][keys[j]] == null)
			{
				data[i][keys[j]] = 0;
			}
			content += "<td style='text-align: " + aligns[j] + ";'>" + data[i][keys[j]] + "</td>";
		}

		content += "</tr>\n";
	}

	$(id).html(content);
}

function luuDieuKien()
{
	$("#conditionname, #conditionsaving").show();
}

function loadCondition(params)
{
	params[0] *= 1;
	while(curCondition < params[0])
	{
		themDieuKien();
	}

	var controls = $("#key_area input, #key_area select, #condition input, #condition select");
	for(var i = 0; i < controls.length; i++)
	{
		var control = controls.eq(i);

		if(control.attr("type") != "checkbox")
		{
			control.val(params[i+1]);
		}
		else
		{
			control.attr("checked", params[i+1] * 1);
		}

		control.trigger("change");
	}
}

function saveCondition(controller, action)
{
	$("#conditionname, #conditionsaving").hide();
	var pname = $("#conditionname").val();
	var params = curCondition + ",";

	var controls = $("#key_area input, #key_area select, #condition input, #condition select");
	for(var i = 0; i < controls.length; i++)
	{
		var control = controls.eq(i);

		if(control.attr("type") != "checkbox")
		{
			params += control.val();
		}
		else
		{
			params += control.is(":checked");
		}

		if(i < controls.length - 1)
		{
			params += ",";
		}
	}

	var link = "/" + controller + "/" + action + "?p=" + params;

	$.post(baseURL + "/condition/save", {pname: pname, link: link}, function(data)
	{
		data = JSON.parse(data);

		var content = "<li><a href='link'>pname</a></li>";
		content = content.replace("pname", data["name"]);
		content = content.replace("link", data["link"]);
		$("#menu_condition").append(content);
	});
}

function updateKeyLevel()
{
	if($("#hidden_level input:first").is(":checked") == true)
	{
		$("#hidden_level select:first").attr("disabled", true);
		$("#hidden_level input:eq(1)").removeAttr("disabled");
		$("#hidden_level input:eq(2)").removeAttr("disabled");
	}
	else
	{
		$("#hidden_level select:first").removeAttr("disabled");
		$("#hidden_level input:eq(1)").attr("disabled", true);
		$("#hidden_level input:eq(2)").attr("disabled", true);
	}
}

function updateFilterLevel(num)
{
	if($("#filter_levelcheckbox_" + num).is(":disabled") == true)
	{
		return;
	}

	if($("#filter_levelcheckbox_" + num).is(":checked") == true)
	{
		$("#filter_level_" + num).attr("disabled", true);
		$("#filter_fromlevel_" + num).removeAttr("disabled");
		$("#filter_tolevel_" + num).removeAttr("disabled");
	}
	else
	{
		$("#filter_level_" + num).removeAttr("disabled");
		$("#filter_fromlevel_" + num).attr("disabled", true);
		$("#filter_tolevel_" + num).attr("disabled", true);
	}
}

function formatNumber(x) {
  if(x == null) {return 0;}
  
  if('string' == typeof(x)) {x *= 1;};
  
  var format;
  if(x % 1 == 0) // int
  {
	  format = "0,000";
  }
  else // float
  {
	  format = "0,000.00";
  }

  var that = x;
  
  var hasComma = -1 != format.indexOf(','),
  psplit = format.replace(/[^-\d\.]/g, '').split('.'),
  that,
  formatted_num = that + '',
  part_whole, part_decimal, temp;

  // compute precision
  if (1 < psplit.length) {
	// fix number precision
	  formatted_num = that.toFixed(psplit[1].length);
  }
  // error: too many periods
  else if (2 < psplit.length) {
	throw('NumberFormatException: invalid format, formats should have no more than 1 period: ' + format);
  }
  // remove precision
  else {
	  formatted_num = that.toFixed(0);
  }

  // format has comma, then compute commas
  if (hasComma) {
	// remove precision for computation
	psplit = formatted_num.split('.');
    part_whole = psplit[0];
    part_decimal = psplit[1] || '';

    do {
      temp = part_whole;
      part_whole = part_whole.replace(/^(-?\d+)(\d{3})+/g, '$1,$2');
    }
    while (temp != part_whole);

	// add the precision back in
    formatted_num = part_whole + (part_decimal ? '.' + part_decimal : part_decimal);
  }

  // replace the number portion of the format with formatted_num
  return formatted_num;
};