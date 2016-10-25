
/*	INPUT: array that holds the input we want to check, output element that points to icon
    OUTPUT(ish): this function change the icon to an error icon in case that the input data is that same as the data in the user database
*/
function checkUserDetails (arr, otpt)
{
    $.ajax({
        url: 'http://yaniv.isa-geek.net/CouponShop/User/checkUserDetails.php',
        type: 'POST',
        data: arr,
        success: function(data)
        {
            if (data==true)
            {
                setIconAttributes(false, otpt, "you entered your current data.");
            }
        }
    });
}

/*	INPUT: array that holds the input we want to update for the user
    OUTPUT: if the data was saved for the user in the database then the user gets a approval message,
            if not the user gets an error message.
*/
function updateUserDetails (arr)
{
    $.ajax({
        url: 'http://yaniv.isa-geek.net/CouponShop/User/updateUserDetails.php',
        type: 'POST',
        data: arr,
        success: function(data)
        {
            if (data==true)
            {
                alert("Your user details has been updated.");
                window.location= 'http://yaniv.isa-geek.net/CouponShop/User/User-Page.html';
            }
            else
            {
                alert("there is a problem to update your user details, please try again later.");
            }
        }
    });
}


/*	INPUT: filter object, value, link to an element and a massage
    OUTPUT: if filter test was positive then the element icon set to check icon and set positive massage,
                    else element icon set to error icon and set error massage.
*/
function changeElementStatus (filter, val, ele, msg)
{
    if (filter.test(val))
    {
        ele.setAttribute("class", "fa fa-check");
        ele.setAttribute("title", msg[1]);
    }
    else
    {
        ele.setAttribute("class", "fa fa-times-circle");
        ele.setAttribute("title", msg[0]);
    }
}
