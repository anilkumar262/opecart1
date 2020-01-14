// /* Add here all your JS customizations */
// function alert(msg){
    // alert(msg);
    // swal({
    //     title: msg,
    //     text: "You clicked the button!",
    //     icon: "success",
    //     button: "Aww yiss!",
    // });
    // return 1;
// }

function getrequest(url,params,reload){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
            // window.location=reload;
            // console.log(this.responseText);
        }
    };
    xhttp.open("POST", url, true);
    xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');    
    xhttp.send(params);
    
}



