var addFlash = function (type, message) {
$(".flash_messages").html(
    '<div class="alert alert-'+type+'"> ' + message + '</div>')
}