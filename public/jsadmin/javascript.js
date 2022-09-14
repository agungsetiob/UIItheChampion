function konfirmasi_reset() {
    var konfirmasi = confirm('Are you sure want to reset?');
    if (konfirmasi == true) {
        return true;
    } else {
        return false;
    }
}

function konfirmasi_delete() {
    var konfirmasi_delete = confirm('Are you sure want to delete?');
    
    if (konfirmasi_delete == true) {
        return true;
    } else {
        return false;
    }
}

$(document).ready(function() {
    if (Notification.permission !== "granted")
    Notification.requestPermission();
});
             
function notifikasi() {
    if (!Notification) {
             alert('Your browser does not support notification'); 
             return;
    }
    if (Notification.permission !== "granted")
        Notification.requestPermission();    
    else {   
        var notifikasi = new Notification('New Competition', {
            icon: 'http://localhost:8000/logo.png'
        });
        notifikasi.onclick = function () {
            window.open("http://championia.esy.es");              
        };
        setTimeout(function(){
        notifikasi.close();        
        }, 15000);
    }
};
