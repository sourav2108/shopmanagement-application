$(document).ready(function(){
    function loadcat() {
        $.ajax({
            url: 'admin/loadcat.php',
            type: 'POST',
            success: function (data) {
                $('#category').append(data);
            }
        });
    }
    loadcat();
});