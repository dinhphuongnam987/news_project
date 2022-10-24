$(document).ready(function () {
    let $btnSearch = $("button#btn-search");
    let $btnClearSearch = $("button#btn-clear-search");

    let $inputSearchField = $("input[name  = search_field]");
    let $inputSearchValue = $("input[name  = search_value]");
    let $selectChangeAttr = $("select[name = select_change_attr]");
    let $inputLinkMenu    = $("#link_menu");
    let $selectTypeMenu   = $("#type_menu");
    let $selectChangeOrdering = $(".ordering");

    $("a.select-field").click(function (e) {
        e.preventDefault();

        let field = $(this).data("field");
        let fieldName = $(this).html();
        $("button.btn-active-field").html(
            fieldName + ' <span class="caret"></span>'
        );
        $inputSearchField.val(field);
    });

    $btnSearch.click(function () {
        var pathname = window.location.pathname;
        let params = ["filter_status"];
        let searchParams = new URLSearchParams(window.location.search); // ?filter_status=active

        let link = "";
        $.each(params, function (key, param) {
            // filter_status
            if (searchParams.has(param)) {
                link += param + "=" + searchParams.get(param) + "&"; // filter_status=active
            }
        });

        let search_field = $inputSearchField.val();
        let search_value = $inputSearchValue.val();

        if (search_value.replace(/\s/g, "") == "") {
            alert("Nhập vào giá trị cần tìm !!");
        } else {
            window.location.href =
                pathname +
                "?" +
                link +
                "search_field=" +
                search_field +
                "&search_value=" +
                search_value;
        }
    });

    $btnClearSearch.click(function () {
        var pathname = window.location.pathname;
        let searchParams = new URLSearchParams(window.location.search);

        params = ["filter_status"];

        let link = "";
        $.each(params, function (key, param) {
            if (searchParams.has(param)) {
                link += param + "=" + searchParams.get(param) + "&";
            }
        });

        window.location.href = pathname + "?" + link.slice(0, -1);
    });

    $(".btn-delete").on("click", function () {
        if (!confirm("Bạn có chắc muốn xóa phần tử?")) return false;
    });

    let $inputLinkMenuValue = $inputLinkMenu.val();
    $inputLinkMenu.on("input", function () {
        $inputLinkMenuValue = $(this).val()
    })
    
    if(($selectTypeMenu.val() !== 'link' && $selectTypeMenu.val() !== 'default')) {
        $inputLinkMenu.val("#");
        $inputLinkMenu.parents('.form-group').css('opacity', 0.6);
    }

    $selectTypeMenu.on("change", function () {
        $typeMenuValue = $(this).val();
        
        if($typeMenuValue !== 'link' && $typeMenuValue !== 'default') {
            $inputLinkMenu.val("#");
            $inputLinkMenu.parents('.form-group').css('opacity', 0.6);
        } else {
            $inputLinkMenu.val($inputLinkMenuValue);
            $inputLinkMenu.parents('.form-group').css('opacity', 1);
        }
    })

    function changeStateAdmin(elementSelector, event) {
        switch (event) {
            case 'change':
                elementSelector.on('change', function() {
                    let ele = $(this)
                    let url = $(this).attr("data-url");
                    let selectValue = $(this).val();
                    url = url.replace('value_new', selectValue);
                    $.ajax({
                        type: "GET",
                        url: url,
                        dataType: "json",
                        success: function (response) {
                            ele.notify("Cập nhật thành công", {
                                position: "top center",
                                className: "success",
                            });
                        },
                    });
                })
                break;
            case 'click':
                elementSelector.on("click", function () {
                    let url = $(this).data("url");
                    let btn = $(this);
                    let currentClass = btn.data("class");
                    $.ajax({
                        type: "GET",
                        url: url,
                        dataType: "json",
                        success: function (response) {
                            if(response.link.includes('change-status')) attrObj = response.statusObj
                            if(response.link.includes('change-is-home')) attrObj = response.isHomeObj
                            btn.removeClass(currentClass);
                            btn.addClass(attrObj.class);
                            btn.html(attrObj.name);
                            btn.data("url", response.link);
                            btn.data("class", attrObj.class);
                            btn.notify("Cập nhật thành công", {
                                position: "top center",
                                className: "success",
                            });
                        },
                    });
                });
                break; 
        }

    }

    changeStateAdmin($selectChangeAttr, 'change');
    changeStateAdmin($selectChangeOrdering, 'change');
    changeStateAdmin($(".is-home-ajax"), 'click');
    changeStateAdmin($(".status-ajax"), 'click');
});
