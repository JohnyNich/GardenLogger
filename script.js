function replaceAJAX(formID) {
  // This is essentially just the same code from the addding through AJAX, for adding to the table, except it sends the data to replace.php
  var form = $(formID);
  var serializedData = form.serialize();
  var request = $.ajax({
    url: 'replace.php',
    type: 'post',
    data: serializedData,
    success: function(response) {
      console.log(response);
      if (response == "entry does not exist") {
        $("#alert-non-existent-entry").modal("show");
      }
    }
  })
}

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

  // If replace button is pressed (from modal)
  $("#replace").click(function() {
    replaceAJAX("#addForm");
  });

  $("#changeForm").submit(function(e){
    e.preventDefault();
    replaceAJAX($(this));
  })
});
