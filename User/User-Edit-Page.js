$(document).ready(function()
{
    document.getElementById("first-name").addEventListener("keyup", function ()
    {
        var arr = {"first_name" : document.getElementById("first-name").value};
        checkUserDetails(arr, document.getElementById("first-name-varific"));
        firstNameFilter(document.getElementById("first-name"), document.getElementById("first-name-varific"));
    });

    document.getElementById("last-name").addEventListener("keyup", function ()
    {
        var arr = {"last_name" : document.getElementById("last-name").value};
        checkUserDetails(arr, document.getElementById("last-name-varific"));
        lastNameFilter(document.getElementById("last-name"), document.getElementById("last-name-varific"));
    });

    document.getElementById("old-password").addEventListener("keyup", function ()
    {
        var old_pass = document.getElementById("old-password").value;

        // sending old password input to the server in order to check if it is the user current password
        $.ajax({
            url: 'http://yaniv.isa-geek.net/CouponShop/User/checkUserDetails.php',
            type: 'POST',
            data: {"password" : old_pass},
            success: function(data)
            {
                if (data==true) // it is the user current password
                {
                    setIconAttributes(true, document.getElementById("old-password-varific"), "this is your current password.");
                }
                else // it is not the user current password
                {
                    setIconAttributes(false, document.getElementById("old-password-varific"), "this is not your current password.");
                }
            }
        });
    });

    document.getElementById("password").addEventListener("keyup", function ()
    {
        // making sure the passwords match before sending the password  to the server to check if it is not the current password
        if (document.getElementById("password").value == document.getElementById("password-comfirm").value)
        {
            checkUserDetails({"password" : document.getElementById("password").value}, document.getElementById("password-varific"));
        }
        passwordFilter(document.getElementById("password"), document.getElementById("password-confirm"), document.getElementById("password-varific"));
    });

    document.getElementById("password-confirm").addEventListener("keyup", function ()
    {
        // making sure the passwords match before sending the password  to the server to check if it is not the current password
        if (document.getElementById("password").value == document.getElementById("password-comfirm").value)
        {
            checkUserDetails({"password" : document.getElementById("password").value}, document.getElementById("password-varific"));
        }
        passwordFilter(document.getElementById("password"), document.getElementById("password-confirm"), document.getElementById("password-varific"));
    });

    document.getElementById("email").addEventListener("keyup", function ()
    {
        // making sure the email addresses match before sending the email address to the server to check if it is not the current email
        if (document.getElementById("email").value == document.getElementById("email-comfirm").value)
        {
            checkUserDetails({"email" : document.getElementById("email").value}, document.getElementById("email-varific"));
        }
        emailFilter(document.getElementById("email"), document.getElementById("email-confirm"), document.getElementById("email-varific"));
    });

    document.getElementById("email-confirm").addEventListener("keyup", function ()
    {
        // making sure the email addresses match before sending the email address to the server to check if it is not the current email
        if (document.getElementById("email").value == document.getElementById("email-comfirm").value)
        {
            checkUserDetails({"email" : document.getElementById("email").value}, document.getElementById("email-varific"));
        }
        emailFilter(document.getElementById("email"), document.getElementById("email-confirm"), document.getElementById("email-varific"));
    });
});

// this function checks if the input for the name field is fine, and if so it calls the update function.
function nameFieldUpdate ()
{
    var first = document.getElementById('first-name');
    var last = document.getElementById('last-name');
    var first_varific = document.getElementById('first-name-varific');
    var last_varific = document.getElementById('last-name-varific');

    if (first_varific.classList == "fa fa-check" && last_varific.classList == "fa fa-check") // in case the input is fine
    {
        updateUserDetails({"first_name" : first.value, "last_name" : last.value});
    }
    else
    {
        alert("please check you entered data before submiting.");
    }
}

// this function checks if the input for the password field is fine, and if so it calls the update function.
function passwordFieldUpdate ()
{
    var pass = document.getElementById('password');
    var pass_varific = document.getElementById('password-varific');
    var old_pass = document.getElementById('old-password-varific');

    if (pass_varific.classList == "fa fa-check" && old_pass.classList == "fa fa-check") // in case the input is fine
    {
        updateUserDetails({"password" : pass.value});
    }
    else
    {
        alert("please check you entered data before submiting.");
    }
}

// this function checks if the input for the email field is fine, and if so it calls the update function.
function emailFieldUpdate ()
{
    var email = document.getElementById('email');
    var email_varific = document.getElementById('email-varific');

    if (email_varific.classList == "fa fa-check") // in case the input is fine
    {
        updateUserDetails({"email" : email.value});
    }
    else
    {
        alert("please check you entered data before submiting.");
    }
}
