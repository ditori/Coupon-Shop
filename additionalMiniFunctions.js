function setAttributes(elem, attrs)
{
	for(var key in attrs)
	{
		elem.setAttribute(key, attrs[key]);
	}
}

function createNewLinkElement (text, func, url)
{
	var link= document.createElement('a');
	link.setAttribute("href", "#");

	if (text!=null)
	{
		link.appendChild(document.createTextNode(text));
	}
	if(func!=null)
	{
		link.addEventListener('click', func);
	}
	if(url!=null)
	{
		link.setAttribute("href", url);
	}


	return link;
}

function addToListElement (a, list)
{
	var li= document.createElement("li");
	li.appendChild(a);
	list.appendChild(li);
}

function addToTable(table, element)
{
    var td= document.createElement("td");
    td.appendChild(element);
    table.appendChild(td);
}

function clearElements(element)
{
	while (element.hasChildNodes())
	{
		element.removeChild(element.firstChild);
	}
}

function postToPHP(arr, url)
{
	var frm = document.getElementById("post-form");
	clearElements(frm);

	for (index in arr)
	{
		var inpt= document.createElement("input");
		inpt.setAttribute("name", index);
		inpt.setAttribute("value", arr[index]);
		inpt.setAttribute("type", "hidden");
		frm.appendChild(inpt);
	}

	frm.setAttribute("action", url);
	frm.setAttribute("method", "POST");
	frm.submit();
}

/*
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}
*/
