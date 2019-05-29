server = "http://localhost/";
nameApp = "smart_e-ping-3";

$( document ).ready(function() {
    $.ajax({
        type: "GET",
        url: server + nameApp + "/public/CRUD/createJSONFile",
        dataType: "json",
        success: function (data) {
            if(data){
                console.log("Create file JSON");
            }else{
                console.log("Falha");
            }

        }
    });
});
