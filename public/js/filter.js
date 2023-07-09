$(document).ready(() => {
    $('input[type=radio][id=category]').change((e) => {
        $('#categoriesForm').submit();
    });
});