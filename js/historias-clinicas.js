$(document).ready(function () {
    $('#usuario').click(function () {
        $.ajax({
            url: 'logout.php',
            success: function (data) {
                document.location = 'index.php';
            }
        });
    });
})