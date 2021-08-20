import { loadTable } from "./script.js";

$("#addSubs").on("click", function () {
  let $type = $("#typeSelect").val(),
    $subsStart = $("#subs-start").val(),
    $subsEnd = $("#subs-end").val(),
    $user = $("#userSelect").val();
  if ($type && $subsStart && $subsEnd && $user) {
    $.ajax({
      url: "addSubsController.php",
      method: "POST",
      cache: false,
      data: {
        type: $type,
        user: $user,
        subsStart: $subsStart,
        subsEnd: $subsEnd,
      },
      success: function (result) {
        if (result == 0) {
          $("#addSubsModal .alert-success").show();
          setTimeout(function () {
            $("#addSubsModal .alert-success").fadeOut(function () {
              $("#addSubsModal").modal("hide");
              loadTable();
            });
          }, 1000);
        } else {
          $("#addSubsModal .alert-error").show();
          setTimeout(function () {
            $("#addSubsModal .alert-error").fadeOut(function () {
              $("#addSubsModal").modal("hide");
            });
          }, 1000);
        }
      },
      error: function () {
        $("#addSubsModal .alert-error").show();
        setTimeout(function () {
          $("#addSubsModal .alert-error").fadeOut(function () {
            $("#addSubsModal").modal("hide");
          });
        }, 1000);
      },
    });
  }
});
