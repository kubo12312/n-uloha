let table = null;

let loadTable = () => {
  if(table != null) {
    table.destroy();
  }
  $.ajax({
    url: "loadTable.php",
    type: "GET",
    success: function (data) {
      $("#users-table").html(data);
    },
    complete: function () {
      table = $("#users-table").DataTable({
        language: {
          url: "https://cdn.datatables.net/plug-ins/1.10.22/i18n/Slovak.json",
        },
        ordering: false
      });
    },
  });
};

export { loadTable };
