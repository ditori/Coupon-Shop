function couponImagesCarouselBuilder (coupon_id)
{
    var xhr = new XMLHttpRequest();

    var cnt= 0;

	var url= 'http://yaniv.isa-geek.net/CouponShop/Image/getCouponImages.php';
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onreadystatechange = function()
	{
		if (xhr.readyState == 4 && xhr.status == 200)
		{
			var data = JSON.parse(xhr.responseText);
            var crsl_list= document.getElementById('crsl-list');
            var crsl_inner= document.getElementById('crsl-inner');

			data.forEach(function (ob)
            {
                // adding new ol element to the list
                var il= document.createElement("il");
                il.setAttribute("data-target", "#coupon-images-carousel");
                il.setAttribute("data-side-to", cnt);
                if (cnt==0)
                {
                    il.setAttribute("class", "active");
                }
                crsl_list.appendChild(il);

                // creating image div
                var item= document.createElement("div");
                if (cnt==0)
                {
                    item.setAttribute("class", "item active");
                }
                else
                {
                    item.setAttribute("class", "item");
                }

                var img= document.createElement("img");
                img.setAttribute("src", ob.source);
                img.setAttribute("class", "img-responsive center-block");
                item.appendChild(img);

                var container = document.createElement("div");
                container.setAttribute("class", "container");
                var caption = document.createElement("div");
                caption.setAttribute("class", "carousel-caption");
                var p = document.createElement("p");
                p.appendChild(document.createTextNode(ob.description));
                caption.appendChild(p);
                container.appendChild(caption);
                item.appendChild(container);
                crsl_inner.appendChild(item);
                cnt++;

            });
		}
	}
	xhr.send("coupon_id=" + coupon_id);
}
