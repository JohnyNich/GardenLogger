$(document).ready(function(){

  // Add form stuff
  $('#addForm').submit(function(e){
    e.preventDefault();
    var form = $(this);
    var serializedData = form.serialize();
    var request = $.ajax({
      url: 'add.php',
      type: 'post',
      data: serializedData,
      success: function(response) {
        console.log(response);
        if (response == "duplicate") {
          $("#alert-duplicate").modal("show");
        }
      }
    });

    request.done(function(response, textStatus, jqXHR){
      console.log("AJAX post successful");
    });

    request.fail(function(jqXHR, textStatus, errorThrown){
      // Print the error in the console
      console.error("The following error has occured: " + textStatus, errorThrown);
    });
  });

  // Replace stuff (from modal)
  $("#replace").click(function() {
    // This is essentially just the same code from above, for adding to the table, except it sends the data to replace.php
    var form = $("#addForm");
    var serializedData = form.serialize();
    var request = $.ajax({
      url: 'replace.php',
      type: 'post',
      data: serializedData,
      success: function(response) {
        console.log(response);
      }
    })
  });
});
