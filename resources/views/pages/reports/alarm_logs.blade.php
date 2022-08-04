@extends('layouts.default')

@section('extra_css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
@endsection

@section('content')
    <div class="card card-custom card-sticky">
        <div class="card-header flex-wrap pt-6 pb-6 row ">
            <div class="row">
                <div class="col-md-4">
                    <!--begin::Label-->
                    <label class="fs-6 fw-bold mb-2 required">Başlangıç Tarihi</label>
                    <!--end::Label-->
                    <div class="input-group input-daterange">
                        <input type="text" name="from_date" id="from_date" readonly class="form-control form-control-solid" placeholder="YYYY-MM-DD"/>
                    </div>


                </div>
                <div class="col-md-4">
                    <!--begin::Label-->
                    <label class="fs-6 fw-bold mb-2 required">Son Tarihi</label>
                    <!--end::Label-->
                    <div class="input-group input-daterange">
                        <input type="text"  name="to_date" id="to_date" readonly class="form-control form-control-solid" placeholder="YYYY-MM-DD" />
                    </div>
                </div>
                <div class="col-md-4 text-left mt-9">
                    <button type="button" name="filter" id="filter" class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder btn-sm">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                        <span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="currentColor" />
                            </svg>
                        </span>
                        Filtrele</button>
                    <button type="button" name="refresh" id="refresh" class="btn btn-warning btn-sm">Temizle</button>

                    <!-- Exportables-->
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle btn-sm " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >Veri Aktar</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" id="print" href="#">Yazdır</a>
                            <a class="dropdown-item" id="excel" href="#">Excel'e Aktar</a>
                            <a class="dropdown-item" id="pdf" href="#">PDF dosyası İndir</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered datatable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Slug</th>
                        <th>Desc</th>
                        <th>Requested at</th>
                        <th>Action at</th>
                        <th>Status</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('extra_script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
    <!-- DataTable -->
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js" type="text/javascript"></script>

    <script>
        //begin datepicker
        $(document).ready(function(){

            fetch_data();

            var date = new Date();

            $('.input-daterange').datepicker({
                todayBtn: 'linked',
                format: 'yyyy-mm-dd',
                autoclose: true
            });

            $('#filter').click(function(){
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                if(from_date != '' &&  to_date != '')
                {
                    $('.datatable').DataTable().clear().destroy();
                    fetch_data(from_date, to_date);
                }
                else
                {
                    alert('lütfen 2 tarih aralığı seçin');
                }
            });


            function fetch_data(from_date, to_date){
                // init datatable
                var dataTable = $('.datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    pageLength: 5,
                    buttons: [
                        {
                            text: 'excel',
                            extend: 'excelHtml5',
                        },
                        {
                            text: 'pdf',
                            extend: 'pdfHtml5',
                        },
                        {
                            text: 'print',
                            extend: 'print',
                        },
                    ],
                    language: {
                        "lengthMenu": "_MENU_ Sayfa boyutunu seçin",
                        "emptyTable":     "Tabloda veri yok",
                        "zeroRecords": "kayıt bulunamadı",
                        "info": "Toplam _PAGES_ sayfanın _PAGE_. sayfası gösteriyor",
                        "infoEmpty": "kayıt bulunamadı",
                        "infoFiltered": "(toplam _MAX_ kayıttan filtrelendi)",
                        "loadingRecords": "Yükleniyor...",
                        "processing": "Lütfen bekleyin...",
                        "search":         "Ara:",
                        "paginate": {
                            "first":      "İlk",
                            "last":       "Son",
                            "next":       "Sonraki",
                            "previous":   "Önceki"
                        },
                    },

                    // scrollX: true,
                    "order": [[ 0, "desc" ]],
                    ajax: {
                        url: '{{ route('alarmlogs.fetchAll') }}',
                        type: "POST",
                        data: {
                            from_date:from_date,
                            to_date:to_date,
                        },
                        dataType:"json",

                    },
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'slug', name: 'slug'},
                        {data: 'desc', name: 'desc'},
                        {data: 'requested_at', name: 'requested_at'},
                        {data: 'action_at', name: 'action_at'},
                        {data: 'status', name: 'status'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'updated_at', name: 'updated_at'},
                    ]
                });
            }

            //exportables
            $('#print').click(function(e){
                e.preventDefault();
                var table =  $('.datatable').DataTable();
                table.button('.buttons-print').trigger();
            });$('#excel').click(function(e){
                e.preventDefault();
                var table =  $('.datatable').DataTable();
                table.button('.buttons-excel').trigger();
            });$('#pdf').click(function(e){
                e.preventDefault();
                var table =  $('.datatable').DataTable();
                table.button('.buttons-pdf').trigger();
            });

            //remove filter and clear page
            $('#refresh').click(function(){
                $('#from_date').val('');
                $('#to_date').val('');
                $('.datatable').DataTable().clear().destroy();
                fetch_data();
            });
        });
        //end datepicker
    </script>
@endsection



