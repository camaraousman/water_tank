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
                    <button type="button" name="filter" id="filter" class="btn btn-info btn-sm">
                        Filtrele</button>
                    <button type="button" name="refresh" id="refresh" class="btn btn-warning btn-sm">Temizle</button>
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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                    alert('Both Date is required');
                }
            });


                function fetch_data(from_date, to_date){
                    // init datatable
                    var dataTable = $('.datatable').DataTable({
                        processing: true,
                        serverSide: true,
                        autoWidth: false,
                        pageLength: 5,
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
                            url: '{{ route('metercontrollogs.fetchAll') }}',
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






