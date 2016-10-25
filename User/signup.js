function signUp()
{
    var filter = true;

    // making sure the data is valid!
    document.getElementsByTagName("span").forEach(function (ele)
    {
        if (ele.classList != "fa fa-check")
        {
            filter= false;
        }
    });

    if (filter)
    {

        var parm= 'username=' + document.getElementById('username').value;
        parm= parm + '&fname=' + document.getElementById('fname').value;
        parm= parm + '&lname=' + document.getElementById('lname').value;
        parm= parm + '&pass=' + document.getElementById('pass').value;
        parm= parm + '&email=' + document.getElementById('email').value;

        var xhr = new XMLHttpRequest();
        var url= 'http://yaniv.isa-geek.net/CouponShop/User/add-User.php';
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function()
        {
            if (xhr.readyState == 4 && xhr.status == 200)
            {
                var data = JSON.parse(xhr.responseText);

                if (data== null)
                {
                    alert("user was not created! please check the entered details or try later.");
                }
                else
                {
                    docCookies.setItem('yaniv-isa-geek-userid', data.user_id, '6048e2', '/');
                    docCookies.setItem('yaniv-isa-geek-username', data.username, '6048e2', '/');
                    window.location.href="http://yaniv.isa-geek.net/CouponShop/home.html";
                }
            }
        }
        xhr.send(parm);
    }
    else
    {
        alert("Some data you entered is not valid, please check your data.");
    }
}
