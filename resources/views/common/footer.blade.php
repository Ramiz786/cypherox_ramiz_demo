 <!-- end main content-->

 </div>
 <!-- END layout-wrapper -->

 <!-- Right Sidebar -->
 <div class="right-bar">
     <div data-simplebar class="h-100">
         <div class="rightbar-title d-flex align-items-center px-3 py-4">

             <h5 class="m-0 me-2">Settings</h5>

             <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                 <i class="mdi mdi-close noti-icon"></i>
             </a>
         </div>

         <!-- Settings -->
         <hr class="mt-0" />
         <h6 class="text-center mb-0">Choose Layouts</h6>

         <div class="p-4">
             <div class="mb-2">
                 <img src="{{asset('admin/images/layouts/layout-1.jpg')}}" class="img-thumbnail" alt="layout images">
             </div>

             <div class="form-check form-switch mb-3">
                 <input class="form-check-input theme-choice" type="checkbox" id="light-mode-switch" checked>
                 <label class="form-check-label" for="light-mode-switch">Light Mode</label>
             </div>

             <div class="mb-2">
                 <img src="{{asset('admin/images/layouts/layout-2.jpg')}}" class="img-thumbnail" alt="layout images">
             </div>
             <div class="form-check form-switch mb-3">
                 <input class="form-check-input theme-choice" type="checkbox" id="dark-mode-switch">
                 <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
             </div>

             <div class="mb-2">
                 <img src="{{asset('admin/images/layouts/layout-3.jpg')}}" class="img-thumbnail" alt="layout images">
             </div>
             <div class="form-check form-switch mb-3">
                 <input class="form-check-input theme-choice" type="checkbox" id="rtl-mode-switch">
                 <label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>
             </div>

             <div class="mb-2">
                 <img src="{{asset('admin/images/layouts/layout-4.jpg')}}" class="img-thumbnail" alt="layout images">
             </div>
             <div class="form-check form-switch mb-5">
                 <input class="form-check-input theme-choice" type="checkbox" id="dark-rtl-mode-switch">
                 <label class="form-check-label" for="dark-rtl-mode-switch">Dark RTL Mode</label>
             </div>


         </div>

     </div> <!-- end slimscroll-menu-->
 </div>
 <!-- /Right-bar -->

 <!-- Right bar overlay-->
 <div class="rightbar-overlay"></div>


 <!--Common Modal-->
 <div class="modal fade" id="commonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                 <button class="btn btn-secondary btnNo" type="button" data-dismiss="modal">
                     <span aria-hidden="true">×</span>
                 </button>
             </div>
             <div class="modal-body">Select "Delete" below if you are ready to delete multiple rows.</div>
             <div class="modal-footer">
                 <button class="btn btn-secondary btnNo" type="button" id="btnNo" data-dismiss="modal">Cancel</button>
                 <a class="btn btn-primary" href="javascript:;" id="btnYes"> Yes</a>

             </div>
         </div>
     </div>
 </div>


 <!-- JAVASCRIPT -->
 <script src="{{asset('admin/libs/jquery/jquery.min.js')}}"></script>
 <script src="{{asset('admin/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
 <script src="{{asset('admin/libs/metismenu/metisMenu.min.js')}}"></script>
 <script src="{{asset('admin/libs/simplebar/simplebar.min.js')}}"></script>
 <script src="{{asset('admin/libs/node-waves/waves.min.js')}}"></script>


 <!--Datatables-->
 <!-- Required datatable js -->
 <script src="{{asset('admin/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
 <script src="{{asset('admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
 <!-- Buttons examples -->
 <script src="{{asset('admin/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
 <script src="{{asset('admin/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
 <script src="{{asset('admin/libs/jszip/jszip.min.js')}}"></script>
 <script src="{{asset('admin/libs/pdfmake/build/pdfmake.min.js')}}"></script>
 <script src="{{asset('admin/libs/pdfmake/build/vfs_fonts.js')}}"></script>
 <script src="{{asset('admin/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
 <script src="{{asset('admin/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
 <script src="{{asset('admin/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>

 <!-- Responsive examples -->
 <script src="{{asset('admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
 <script src="{{asset('admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

 <!-- Datatable init js -->
 <script src="{{asset('admin/js/pages/datatables.init.js')}}"></script>

 <!--Select 2-->
 <script src="{{asset('admin/libs/select2/js/select2.min.js')}}"></script>

 <!-- apexcharts -->
 <script src="{{asset('admin/libs/apexcharts/apexcharts.min.js')}}"></script>

 <!-- dashboard init -->
 <script src="{{asset('admin/js/pages/dashboard.init.js')}}"></script>

 <!-- App js -->
 <script src="{{asset('admin/js/app.js')}}"></script>

 <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>

 <script src="/vendor/datatables/buttons.server-side.js"></script>


 <!--Date Range Picker-->
 <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
 <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

 <script>
     $(function() {
         // Multiple images preview with JavaScript
         var previewImages = function(input, imgPreviewPlaceholder) {
             if (input.files) {
                 var filesAmount = input.files.length;
                 for (i = 0; i < filesAmount; i++) {
                     var reader = new FileReader();
                     reader.onload = function(event) {
                         $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                     }
                     reader.readAsDataURL(input.files[i]);
                 }
             }
         };
         $('#images').on('change', function() {
             previewImages(this, 'div.images-preview-div');
         });
     });
     $(document).ready(function() {


         //open form add/edit
         $(document).on("click", ".open_my_form_form", function(event) {

             var data_id = $(this).attr('data-id');
             var controller = $(this).attr('data-control');
             var method = $(this).attr('data-method');
             if (method) {
                 var $url = method;

             } else {

                 var $url = 'add';
             }
             if (data_id > 0) {
                 $url = 'edit/' + data_id;
             }
             $.ajax({
                 type: 'POST',
                 url: method,
                 async: false,
                 data: {
                     "_token": "{{ csrf_token() }}"
                 },
                 dataType: 'json',
                 beforeSend: function() {
                     $('#add_edit_form').show();
                     $('#display_update_form').html('<div class="loader_wrapper"><div class="loader"></div></div>');
                 },
                 success: function(returnData) {
                     setTimeout(function() {
                         $('#display_update_form').html(returnData.html);
                         window.scrollTo(500, 0);
                         $('#display_update_form select').select2();
                     }, 500);

                     $('#display_update_form select').select2();

                     $('.load_hide').hide();

                 },
                 error: function(xhr, textStatus, errorThrown) {
                     $('#add_edit_form').slideUp(500, function() {
                         $('#display_update_form').html('');
                     });

                     toster_message('error', 'There was an unknown error that occurred. You will need to refresh the page to continue working.', 'error');
                 },
                 complete: function() {}
             });

             return false;

         });
         $(".select2").select2()
         if ($('.data-table').length > 0) {
             var $url = $('.data-table').attr('data-url');
             const $columns = $('.data-table').data('colmuns');
             var $order = $('.data-table').data('column-order');
             $order = (typeof $order != "undefined") ? $order : 'asc';
             var $order_column_no = $('.data-table').data('column-order-no');
             $order_column_no = (typeof $order_column_no != "undefined") ? $order_column_no : 1;
             var $org_columns = []
             var $art_id = $('.art_id').val()
             var $type = $('.type').val()
             var $start_date = $('.start_date').val()
             var $status_filter = $('.status_filter').val()

             var $end_date = $('.end_date').val()
             for (i = 0; i < $columns.length; i++) {
                 if ($columns[i] == 'action') {
                     $org_columns.push({
                         data: 'action',
                         name: 'action',
                         orderable: false,
                         searchable: false
                     })

                 } else {
                     if ($columns[i] == 'select_arts') {

                         $org_columns.push({
                             data: $columns[i],
                             name: $columns[i],
                             orderable: false,
                             searchable: false
                         })
                     } else if ($columns[i] == 'created_at') {
                         $org_columns.push({
                             data: $columns[i],
                             name: $columns[i],
                             bSortable: true,
                             render: {
                                 _: 'display',
                                 sort: 'timestamp'
                             }
                         })
                     } else {
                         $org_columns.push({
                             data: $columns[i],
                             name: $columns[i],
                             bSortable: true

                         })
                     }
                 }
             }

             var row_ids = '';


             ODataTable = $('.data-table').DataTable({
                 processing: true,
                 serverSide: true,
                 "bSortable": true,
                 order: [
                     [$order_column_no, $order]
                 ],

                 // ajax: $url,
                 ajax: {
                     url: $url,
                     type: 'POST',
                     //  data: {
                     //      "_token": "{{ csrf_token() }}",
                     //     "row_ids":row_ids
                     //  },
                     data: function(d) {
                         d._token = "{{ csrf_token() }}";
                         if ($("input[name='row_id[]']").length > 0) {
                             row_ids = $("input[name='row_id[]']").map(function() {
                                     return $(this).val();
                                 })
                                 .get()
                                 .join(",");

                         }
                         d.row_ids = row_ids;
                         d.art_id = $art_id
                         d.type = $type
                         d.start_date = $start_date
                         d.end_date = $end_date
                         d.status_filter=$status_filter

                     },

                 },

                 columns: $org_columns,
                 responsive: true,
                 lengthMenu: [
                     [10, 25, 50, -1],
                     [10, 25, 50, "All"]
                 ],

                 pageLength: 10,
                 "fnInitComplete": function() {
                     $('.search_mq').on('change', function() {
                         $start_date = $('.start_date').val()
                         $end_date = $('.end_date').val()
                         $status_filter = $('.status_filter').val()
                         ODataTable.draw();

                     });

                 },
                 "drawCallback": function(settings) {
                     $(".row_id_chk").unbind("change");
                     $(".row_id_chk").change(function() {
                         var id = $(this).val();
                         if ($(this).is(':checked')) {
                             var maxAllowed = 2;
                             var html = '<div id="row_id_' + id + '">' +
                                 '<input type="hidden" name="row_id[]" value="' + id + '">' +
                                 '</div>';
                             $("#bulk_div").append(html);

                             $("#rgp_" + id).parent().parent().css("background-color", '#d8dcde');
                         } else {
                             $('.merge_paper_div').addClass('hidden');
                             $("#row_id_" + id).remove();
                             $("#rgp_" + id).parent().parent().css("background-color", '');
                         }
                     });
                 }
                 // dom: 'Blfrtip',
                 // buttons: [
                 //     // 'excelHtml5',
                 //     {
                 //         extend: 'excel',
                 //         text: "<i class='bx bx-download'></i> Download Excel",
                 //         exportOptions: {
                 //             modifier: {
                 //                 page:'all',
                 //                 search: 'none',
                 //             },
                 //             columns: [0]
                 //         }
                 //     }

                 // ]
             });
         }

     });
 </script>

<?php
$custom_for_all = asset('admin/js/custom-for-all.js?no='.rand(111, 9999));
?>
 <script src="{{$custom_for_all}}"></script>

 <script src="{{asset('admin/toastr-master/toastr.js')}}"></script>



 </div>