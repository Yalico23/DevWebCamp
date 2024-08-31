(function () {
  const datatables = document.querySelector("#myTable");
  if (datatables) {
    $(document).ready(function () {
      $("#myTable").DataTable();
    });

    $("#myTable").DataTable({
      paging: true,
      responsive: true,
      language: {
        url: "https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json",
      },
      stateSave: true,
    });
  }
})();
