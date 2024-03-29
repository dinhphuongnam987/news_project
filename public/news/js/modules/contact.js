$('#btn-contact').click(function(e) {
    let url = $(this).data("url");
    let btn = $(this);
    let CSRF_TOKEN = $('#token').val();

    let data = {
        '_token': CSRF_TOKEN,
        'name': $("input[name='name']").val(),
        'phone':  $("input[name='phone']").val(),
        'email':  $("input[name='email']").val(),
        'message':  $("textarea[name='message']").val(),
    }

    $('.loader').css("display", "block");
    $('body').css("opacity", 0.3);
    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        dataType: 'JSON',
        success: function (response) { 
            if(response.status === 200) {
                btn.notify("Gửi thành công", {
                    position: "top center",
                    className: "success",
                });
                $("#errors").html('')
                $("textarea[name='message']").val('')
                localStorage.setItem('infoContact', JSON.stringify(response.data))
                $('.loader').css("display", "none")
                $('body').css("opacity", 1)
            }
        },
        error: function(response) {
            $.each(response.responseJSON.errors, function (key, item) {
                $("#errors").html('')
                $("#errors").append("<li class='alert alert-danger'>"+item+"</li>")
                $('.loader').css("display", "none")
                $('body').css("opacity", 1)
            });
        }
    });

    e.preventDefault();
})

if(localStorage.getItem('infoContact') !== null) {
    let info = JSON.parse(localStorage.getItem('infoContact'))
    $("#contact_name").val(info.name)
    $("#contact_phone").val(info.phone)
    $("#contact_email").val(info.email)
}

