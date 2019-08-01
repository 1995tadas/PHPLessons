$(document).ready(function()
{
    $('.edit-wrapper').submit(function(e){
        e.preventDefault();
        var url = $('.edit-wrapper').attr('action');
        $.ajax({
            type: "POST",
            url: url,
            data: $(this).serialize(),
            success: function(response)
            {
                console.log(response);
                var obj = JSON.parse(response);
                console.log(obj.code);
                if(obj.code===200){
                    $('.msg').show().text(obj.msg);
                }
            }
        });
    });

    $('.password2').change(function () {
        var pass1 = $('.password').val();
        var pass2 = $('.password2').val();
        if(pass1 !== pass2) {
            $('.password').addClass('red').removeClass('green');
            $('.password2 ').addClass('red').removeClass('green');
            $('.msg-registration').show().text('Password do not match !!!').addClass('warning').removeClass('success');
        } else {
            $('.password').removeClass('red').addClass('green');
            $('.password2').removeClass('red').addClass('green');
            $('.msg-registration').show().text('Passwords match').removeClass('warning').addClass('success');
        }
    });

$('.registration-wrapper .email').change(function () {

    var url = "http://141.136.44.119/mvc/index.php/account/emailverification";

    $.ajax({
        type: "POST",
        url: url,
        data: {email_ajax:$(this).val()},
        success: function(response)
        {

            var obj = JSON.parse(response);
            console.log(obj.code);
                if(obj.code===500)
            {
                $('.msg-registration').text('Email is free to use').removeClass('warning').addClass('success');
            } else {
                $('.msg-registration').text('Email already exist').addClass('warning').removeClass('success');
            }
        }
        })
    });
var i = 0;
    $('#search').keyup(function () {
        i++;
        if(i>3){
            var url = $('.search-form').attr('action');
            $.ajax({
                type: "GET",
                url: url,
                data: {keyword:$(this).val()},
                success: function(response)
                {
                    //var obj = JSON.parse(response);
                    $('.page-wrapper').html(response);
                }
            });
            i=0;
        }

    });
    $('.search-form').submit(function(e){
        e.preventDefault();
    });

});
