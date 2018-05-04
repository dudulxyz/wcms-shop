 $(document).ready(function() {
    var json_object = {"data": "products"};

    $.ajax({
        url: "../save.php",
        data: json_object,
        dataType: 'json',
        type: 'POST',
        success: function(json_object) {
            console.log(json_object);
            $("#saved").text("Data has been saved.");
        },
        error: function(json_object) {
            console.log(json_object);
            $("#saved").text("Failed to save data !");
        }
    });
});

