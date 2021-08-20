import { loadTable } from "./script.js";

$("#addUser").on("click", function () {
  let $email = $("#inputEmail").val(),
    $password = $("#inputPassword").val(),
    $date = $("#reg-date").val();

  if ($email && $password && $date) {
    $.ajax({
      url: "addUserController.php",
      method: "POST",
      cache: false,
      data: {
        email: $email,
        password: $password,
        date: $date,
      },
      success: function (result) {
        if (result == 0) {
          $("#addUserModal .alert-success").show();
          setTimeout(function () {
            $("#addUserModal .alert-success").fadeOut(function () {
              $("#addUserModal").modal("hide");
              loadTable();
            });
          }, 1000);
        } else {
          $("#addUserModal .alert-error").show();
          setTimeout(function () {
            $("#addUserModal .alert-error").fadeOut(function () {
              $("#addUserModal").modal("hide");
            });
          }, 1000);
        }
      },
      error: function () {
        $("#addUserModal .alert-error").show();
        setTimeout(function () {
          $("#addUserModal .alert-error").fadeOut(function () {
            $("#addUserModal").modal("hide");
          });
        }, 1000);
      },
    });
  }
});
