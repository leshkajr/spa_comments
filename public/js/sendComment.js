$(document).ready(function(){
    $("#submit").click(function() {
        var username = $("#username").val();
        var inputIsMain = $("#inputIsMain").val();
        var inputIdMain = $("#inputIdMain").val();
        var inputIdPreviewComment = $("#inputIdPreviewComment").val();
        var email = $("#email").val();
        var homepage = $("#homepage").val();
        var captcha = $("#captcha").val();
        var attachmentFiles = document.getElementById('attachmentFiles').files[0];
        console.log(attachmentFiles);
        console.log(document.getElementById('attachmentFiles'));
        var comment = $("#comment").val();
        // var token = $("#token").val();
        var url = "../sendComment";

        console.log("click");
        document.getElementById('captchaError').innerHTML = '';
        document.getElementById('captcha').classList.remove('is-invalid');

        let fd = new FormData();
        fd.append('username',username);
        fd.append('inputIsMain',inputIsMain);
        fd.append('inputIdMain',inputIdMain);
        fd.append('inputIdPreviewComment',inputIdPreviewComment);
        fd.append('email',email);
        fd.append('homepage',homepage);
        fd.append('captcha',captcha);
        fd.append('comment',comment);
        fd.append('attachmentFiles',attachmentFiles);
        console.log(fd);
        $.ajax({
            type: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            data: fd,
            dataType: 'json',
            contentType: false,
            processData: false,
            async: true,
            success: function(data){
                $('#success_message').fadeIn().html(data);
                console.log(data);
                location.reload();
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
                else if(err.status === 4){
                    location.reload();
                }
                else{
                    console.log(err);
                    $('#success_message').fadeIn().html(err.responseText);
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
