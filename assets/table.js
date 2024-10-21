import './minia/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css'
import './minia/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css'
import './minia/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css'

import './minia/libs/datatables.net/js/jquery.dataTables.min.js'
import './minia/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js'
import './minia/libs/datatables.net-buttons/js/dataTables.buttons.min.js'
import './minia/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js'


$(document).ready(function(){$("#datatable").DataTable(),$("#datatable-buttons").DataTable({lengthChange:!1,buttons:["copy","excel","pdf","colvis"]}).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)"),$(".dataTables_length select").addClass("form-select form-select-sm")});