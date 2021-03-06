$(document).ready(function () {
    let $btnSearch      = $("button#btn-search");
    let $btnClearSearch = $("btn-clear-search");

    let $inputSearchField = $("input[name = search_field]");
    let $inputSearchValue = $("input[name = search_value]");

    $("a.select-field").click(function (e) {
        e.preventDefault();

        let field       = $(this).data('field');
        let fieldName   = $(this).html();
        $("button.btn-active-field").html(fieldName + ' <span class="caret"></span>');
        $inputSearchField.val(field);
    })

    $btnSearch.click(function () {
        var pathname = window.location.pathname;

        let search_field = $inputSearchField.val();
        let search_value = $inputSearchValue.val();

        window.location.href = pathname + '?' + 'search_field=' + search_field + '&search_value=' + search_value;
    });
})
