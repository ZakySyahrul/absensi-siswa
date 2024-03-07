// Call the dataTables jQuery plugin
  new DataTable('#dataTable',{
    responsive: true,
  }
  
  );

  new DataTable('#example',{
    responsive: true,
    paging: false,
    lengthChange: true, // Tampilkan opsi "Show"

    
  }
    );
   
    $(document).ready(function() {
      var table = $('#example').DataTable( {
          dom: 'Bfrtip',
          searching: false,
          info: false,
          paging: true,
          ordering: false,
          buttons: [
              {
                  extend: 'excelHtml5',
                  className: 'btn-success mr-1 mb-4',
                  title: 'Laporan Absensi Siswa'
              },
              {
                  extend: 'pdfHtml5',
                  className: 'btn-danger mb-4',
                  title: 'Laporan Absensi Siswa'
              },
          ]
      } );
  
      table.buttons().container()
          .appendTo( '#example_wrapper .col-md-6:eq(0)' );
  } );
  