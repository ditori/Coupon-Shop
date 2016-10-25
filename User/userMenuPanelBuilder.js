
function getLogin()
{
	var user_menu= document.getElementById('user-menu');
	var user_name= document.getElementById('user-name');
	var forms= document.getElementById('forms');
	var cart= document.getElementById('my-cart');

	var usr_id= docCookies.getItem("yaniv-isa-geek-userid"); // getting cookie id
	var usr_name= docCookies.getItem("yaniv-isa-geek-username"); // getting cookie name

	if (usr_id!=null && usr_name!=null) // if the cookie is not empty
	{
		// linking to user cart
		cart.addEventListener("click", function(){	postToPHP([], "http://yaniv.isa-geek.net/CouponShop/Cart/Cart-Page.php");	});

		// editing user menu headline
		user_name.appendChild(document.createTextNode("Welcome " + usr_name));

		// adding Account Details option to the user menu
		var link= createNewLinkElement('Account Details', function (){	postToPHP([], "http://yaniv.isa-geek.net/CouponShop/User/User-Page.html");	}, null);
		addToListElement(link, user_menu);

		// adding Orders page option to the user menu
		var link= createNewLinkElement('My Orders', null, "http://yaniv.isa-geek.net/CouponShop/Order/Orders-Page.php");
		addToListElement(link, user_menu);

		// adding Logout page option to the user menu
		var url= '/CouponShop/coupons-home.html';
		var link= createNewLinkElement('Logout', function(){	logoutUser()	}, "http://yaniv.isa-geek.net/CouponShop/home.html");
		addToListElement(link, user_menu);
	}
	else // if the cookie is empty
	{
		cart.addEventListener("click", function()
			{
				alert("In order to see your cart you need to login to your Account!");
			});
		// editing guest user menu headline
		var url= "/CouponShop/User/login-page.html";
		user_name.setAttribute("src", url);
		user_name.appendChild(document.createTextNode("Welcome Strenger"));

		// adding Logout page option to the user menu
		var link= createNewLinkElement('Login', null, "http://yaniv.isa-geek.net/CouponShop/User/login-page.html");
		addToListElement(link, user_menu);

		// adding Logout page option to the user menu
		var link= createNewLinkElement('Singup', null, "http://yaniv.isa-geek.net/CouponShop/User/signup-page.html");
		addToListElement(link, user_menu);
	}
}

function logoutUser ()
{
	var cookies = document.cookie.split(";");
	var forms= document.getElementById("forms");

	for (var i = 0; i < cookies.length; i++)
	{
		document.cookie = cookies[i].split("=")[0] + "=" + ";expires=Thu, 01 Jan 1970 00:00:01 GMT" + "; path=/";
	}

	clearElements(forms);
}
