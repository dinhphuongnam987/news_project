
$(document).ready(function () {
    // Add cart
    $('.add-cart').on('click', function (event) {
        let url = $(this).attr('data-url');
        let ele = $(this);
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function (response) {
                let data = JSON.parse(response.data);
                itemCount = Object.keys(data).length
                $('.shopping-cart').html(`<i class="fa fa-shopping-cart" aria-hidden="true"></i><span>(${itemCount})</span>`)
                ele.notify("Thêm thành công vào giỏ hàng", {
                    position: "top center",
                    className: 'success',
                });
            },
        });
    })

    // Update cart with change quantity
    let parseCurrencyToNumber = function(currency) {
        const myReg = /[\,đ]/g;
        return parseInt(currency.replace(myReg, ''));
    }

    let convertNumberToCurrency = function(number, prefix = null) {
        let currency = null;

        switch (prefix) {
            case 'đ':
                currency = number.toLocaleString('vi-VN', {style : 'currency', currency : 'VND'});
                break;
            case 'VND':
                currency = number.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
                break;
            case '$':
                currency = number.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
                break;
            default:
                // Custom
                currency = number.toLocaleString('en-US') + 'đ';  // return  100,000đ
                break;
        }

        return currency;
    };

    let eleTotal = $('#total');
    
    $('.pointer').each(function (index, value) {
        let eleQty = $(this).children('.qty');
        let eleSubTotal = $(this).children('.sub-total');
        let valPrice   = parseCurrencyToNumber($(this).children('.price').text());

        // Update quantity for the cart when the user changes input
        $(eleQty).change(function () {
            let ele = $(this).children('input');
            let valTotal = parseCurrencyToNumber(eleTotal.text());
            let valSubTotal  = parseCurrencyToNumber(eleSubTotal.text());
            let valQty = $(this).children('input').val();
            let subTotal = valQty * valPrice;
            let total = valTotal - valSubTotal + subTotal;

            let link = $(this).children('input').attr('data-url');
            url = link.replace('quantity', valQty)
            eleSubTotal.text(convertNumberToCurrency(subTotal));
            eleTotal.text(convertNumberToCurrency(total));
            $.ajax({
                type: "GET",
                url: url,
                dataType: "json",
                success: function (response) {
                    ele.notify("Cập nhật thành công", {
                        position: "top center",
                        className: 'success',
                    });
                },
            });
        })
    });

    $('#btn-order').click(function(e) {
        let url = $(this).data("url");
        let btn = $(this);
        let CSRF_TOKEN = $('#token').val();
    
        let data = {
            '_token': CSRF_TOKEN,
            'name': $("input[name='name']").val(),
            'phone':  $("input[name='phone']").val(),
            'email':  $("input[name='email']").val(),
        }
        
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            dataType: 'JSON',
            success: function (response) { 
                if(response.status === 200) {
                    btn.notify("Đặt hàng thành công", {
                        position: "top center",
                        className: "success",
                    });
                    $("#errors").html('')
                    localStorage.setItem('infoOrder', JSON.stringify(response.data))
                    window.location.href = $('#url_thank_you').val()
                }
            },
            error: function(response) {
                $.each(response.responseJSON.errors, function (key, item) {
                    $("#errors").html('')
                    $("#errors").append("<li class='alert alert-danger'>"+item+"</li>")
                });
            }
        });
    
        e.preventDefault();
    })
    
    if(localStorage.getItem('infoOrder') !== null) {
        let info = JSON.parse(localStorage.getItem('infoOrder'))
        $("input[name='name']").val(info.name)
        $("input[name='phone']").val(info.phone)
        $("input[name='email']").val(info.email)
    }
});