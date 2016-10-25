
    // user name varification
    function userNameFilter (inpt, otpt)
    {
        var filter = /^[a-zA-Z0-9][a-zA-Z0-9._]{2,}[a-zA-Z0-9]$/;
        var val= inpt.value;
        if (filter.test(inpt.value))
        {
            $.ajax({
                url: 'http://yaniv.isa-geek.net/CouponShop/User/checkUserName.php',
                type: 'POST',
                data: {val},
                success: function(data)
                {
                    if (data!=true)
                    {
                        setIconAttributes(true, otpt, "your user name is valid");
                    }
                    else
                    {
                        setIconAttributes(false, otpt, "the enter user name is already in use, please try other one.");
                    }
                }
            });
        }
        else {
            setIconAttributes(false, otpt, "the username you enterd is not valid");
        }
    }

    // user's first name varification
    function firstNameFilter (inpt, otpt)
    {
        var filter = /^[a-zA-Z]{2,}[a-zA-z]$/;
        var msg= ["first name must contain only characters and be at least at size 2", 'your first name is valid'];
        changeElementStatus(filter, inpt.value, otpt, msg);
    }

    // user's last name varification
    function lastNameFilter (inpt, otpt)
    {
        var filter = /^[a-zA-Z]{2,}[a-zA-z]$/;
        var msg= ["last name must contain only characters and be at least at size 2", 'your last name is valid'];
        changeElementStatus(filter, inpt.value, otpt, msg);
    }

    // user's password varification
    function passwordFilter (inpt, conf, otpt)
    {
        var filter = /[A-Za-z0-9]{6,12}/;
        var msg= ["password must be at least 6 signs, characters or/and numbers.", 'your password is valid'];

        if (inpt.value == conf.value)
        {
            changeElementStatus(filter, inpt.value, otpt, msg);
        }
        else
        {
            setIconAttributes(false, otpt, "the passwords you entered is not equal, please enter your password into the fields again.");
        }
    }

    // user's email varification
    function emailFilter (inpt, conf, otpt)
    {
        var filter = /([\d\w]+[\.\w\d]*)\+?([\.\w\d]*)?@([\w\d]+[\.\w\d]*)/;
        var email= document.getElementById('email').value;
        var msg= ["this is not a valid email address.", 'your email is valid'];
        var val= inpt.value;

        if (inpt.value == conf.value)
        {
            if (filter.test(inpt.value))
            {
                $.ajax({
                    url: 'http://yaniv.isa-geek.net/CouponShop/User/checkUserEmail.php',
                    type: 'POST',
                    data: {val},
                    success: function(data)
                    {
                        if (data!=true)
                        {
                            setIconAttributes(true, otpt, "your email is valid");
                        }
                        else if (data=="Invalid")
                        {
                            setIconAttributes(false, otpt, "the enter email is not a valid email.");
                        }
                        else
                        {
                            setIconAttributes(false, otpt, "the enter email is already in use, please try other one.");
                        }
                    }
                });
            }
            else
            {
                setIconAttributes(false, otpt, "the enter email is not a valid email.");
            }
        }
        else
        {
            setIconAttributes(false, otpt, "the email addresses you entered is not equal, please enter your email into the fields again.");
        }
        changeElementStatus(filter["email"], input.value, otpt, msg);
    }
