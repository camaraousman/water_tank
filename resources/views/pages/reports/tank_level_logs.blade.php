@extends('layouts.default')

@section('extra_css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
@endsection

@section('content')
    <!--begin::Card-->
    <div class="card card-custom card-sticky" >
        <!--begin::Header-->
        <div class="card-header flex-wrap pt-6 pb-6 row ">
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
                            <th>tank_id </th>
                            <th>water_level</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <!--end::Header-->

        <div id="kt_content_container" class="container-xxl ">
            <!--begin::Row-->
            <div class="row gx-5 gx-xl-10">
                <canvas id="myChart"></canvas>
            </div>

        </div>

    </div>
    <!--end::Card-->


@endsection


@section('extra_script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!--begin::chart-->
    <script>
        const labels = ['January', 'February', 'March', 'April', 'May', 'July', 'August', 'September', 'October', 'November', 'December'];

        const data = {
            labels: labels,
            datasets: [
                {
                label: 'Tank 1',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: [0, 10, 5, 2, 20, 30, 45, 30, 55, 25, 30, 44],
                },
                {
                    label: 'Tank 2',
                    backgroundColor: 'rgb(52, 140, 235)',
                    borderColor: 'rgb(52, 140, 235)',
                    data: [10, 15, 14, 12, 15, 20, 30, 35, 45, 40, 35, 30],
                }
                ]
        };

        const config = {
            type: 'line',
            data: data,
            options: {}
        };

        <!--render::chart-->
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
    <!--end::chart-->

    <!--begin::Datatable-->
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
                        url: '{{ route('tanklevellogs.fetchAll') }}',
                        type: "POST",
                        data: {
                            from_date:from_date,
                            to_date:to_date,
                        },
                        dataType:"json",

                    },
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'tank_id', name: 'tank_id'},
                        {data: 'water_level', name: 'water_level'},
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
    <!--end::Datatable-->


@endsection
