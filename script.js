$(document).ready(function(){
  $('#addForm').submit(function(e){
    e.preventDefault();
    var form = $(this);
    var serializedData = form.serialize();
    var request = $.ajax({
      url: 'add.php',
      type: 'post',
      data: serializedData,
      success: function(response){
        console.log(response);
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
});
