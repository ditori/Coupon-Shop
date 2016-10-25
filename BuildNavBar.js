
function buildNavBar()
{
	var str= '<nav class="navbar navbar-inverse navbar-fixed-top"> \
			 <div class="container-fluid"> \
				 <div class="navbar-header"> \
					 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavBar">\
						 <span class="icon-bar"></span>\
						 <span class="icon-bar"></span>\
						 <span class="icon-bar"></span>\
					 </button>\
					 <a class = "navbar-brand" href="http://yaniv.isa-geek.net/CouponShop/home.html">home</a> \
				 </div> \
				 <div id="myNavBar" class="collapse navbar-collapse"> \
					 <ul class="nav navbar-nav"> \
						<li class="dropdown" role="menu"> \
						 	<a href="#" class="dropdown-toggle" data-toggle="dropdown"> \
							 Categorys <span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span></a> \
							 <ul id="categorys" class="dropdown-menu" role="menu"> \
							 </ul> \
						 </li> \
						<li class="dropdown"> \
						 	<a href="#" class="dropdown-toggle" data-toggle="dropdown"> \
							 Bussiness <span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span></a> \
							 <ul id="bussiness" class="dropdown-menu" role="menu"> \
							 </ul> \
						 </li> \
					 </ul> \
					 <div class="nav navbar-nav navbar-right">\
						 <ul class="nav navbar-nav"> \
							<li class="dropdown" role="menu"> \
							 	<a href="#" id="my-cart">My Cart</a> \
							 </li> \
							<li class="dropdown"> \
							 	<a href="#" class="dropdown-toggle" data-toggle="dropdown"> \
								 <span id="user-name"></span><span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span></a> \
								 <ul id="user-menu" class="dropdown-menu" role="menu"> \
								 </ul> \
							 </li> \
						 </ul> \
					</div>\
				 </div> \
				 <form id="post-form" method="POST" action="" hidden>\
				 </form> \
			</div>\
		</nav>';

	document.getElementById('navbar').innerHTML= str;
	getLogin();
	printCategoryList();
	printBussinessList();

}
