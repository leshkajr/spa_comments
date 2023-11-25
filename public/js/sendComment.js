$(document).ready(function(){
    $("#submit").click(function() {
        var username = $("#username").val();
        var email = $("#email").val();
        var homepage = $("#homepage").val();
        var captcha = $("#captcha").val();
        var attachmentFiles = $("#attachmentFiles").val();
        var comment = $("#comment").val();
        var token = $("#token").val();
        var url = "sendComment";
        console.log("click");
        $.ajax({
            type: "post",
            url: url,
            data: {
                username: username,
                email: email,
                homepage: homepage,
                captcha: captcha,
                comment: comment,
                _token: token
            },
            dataType: 'json or text',
            success: function(data){
                $('#success_message').fadeIn().html(data);
                console.log(data);
                refreshCaptcha();
            },
            error: function (err) {
                if (err.status == 422) {
                    console.log(err.responseJSON);
                    // you can loop through the errors object and show it to the user
                    console.warn(err.responseJSON.errors);
                    // display errors on each form field
                    // $.each(err.responseJSON.errors, function (i, error) {
                    //     var el = $(document).find('[name="'+i+'"]');
                    //     el.html(el.html() + '<span style="color: red; margin-top: 6px;">'+error[0]+'</span>');
                    //     // if(el.after)
                    //     //     el.after($('<span style="color: red; margin-top: 6px;">'+error[0]+'</span>'));
                    // });
                    $.each(err.responseJSON.errors, function (i, error) {
                        var el = $(document).find('[id="'+i+'Error"]');
                        var el2 = $(document).find('[name="'+i+'"]');
                        el2.addClass('is-invalid');
                        el.html('<span style="color: red; margin-top: 6px;">'+error[0]+'</span>');
                    });
                }
                else{
                    console.log(err);
                }
                refreshCaptcha();
            }
        });
    });
});

function refreshCaptcha(){
    $.ajax({
        url: "/refreshcaptcha",
        type: 'get',
        dataType: 'html',
        success: function(json) {
            $('#captcha-container').html(json);
        },
        error: function(data) {
            alert('Try Again.');
        }
    });
}
