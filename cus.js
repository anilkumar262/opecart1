$(document).ready(function(){
    setInterval(function(){
        $.ajax({
            url: 'custom/file.php'
        });
    },1000);
});