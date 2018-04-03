$(document).ready(function () {
    $('#reg').click(function (e) {
        if ($('#TOS').not(':checked').length) {
            e.preventDefault();
            alert('Vous devez accepter nos conditions générales');
        }

    })
});
