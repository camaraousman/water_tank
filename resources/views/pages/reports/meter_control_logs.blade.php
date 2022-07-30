@extends('layouts.default')

@section('extra_css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
@endsection

@section('content')
    <!--begin::Card-->
    <div class="card card-custom card-sticky" >
        <!--begin::Header-->
        <div class="card-header flex-wrap pt-6 pb-6 row ">

            <div class="row">
                <div class="col-md-4">
                    <!--begin::Label-->
                    <label class="fs-6 fw-bold mb-2 required">Event Start Date</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" class="form-control form-control-solid" id="beginDate" name="date" placeholder="dd/mm/yyyy">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>

                <div class="col-md-4">
                    <!--begin::Label-->
                    <label class="fs-6 fw-bold mb-2 required">Event End Date</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" class="form-control form-control-solid" id="endDate" name="date" placeholder="dd/mm/yyyy">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>

                <div class="col-md-4 text-left mt-7">
                    <button onclick="draw_datatable();" type="button" class="btn btn-light-primary font-weight-bolder btn-block text-uppercase px-5"><i class="far fa-list-alt"></i>  Listele</button>
                </div>
            </div>

        </div>
        <!--end::Header-->


        <canvas id="myChart"></canvas>

    </div>
    <!--end::Card-->


@endsection


@section('extra_script')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>

    <script>
        $(document).ready(function(){
            var date_input=$('input[name="date"]'); //our date input has the name "date"
            var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
            var options={
                format: 'dd/mm/yyyy',
                container: container,
                todayHighlight: true,
                autoclose: true,
            };
            date_input.datepicker(options);
        })
    </script>



    <!--begin::chartjs-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script>
        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'Speed',
                    data: [],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    xAxes: [],
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
        var updateChart = function() {
            $.ajax({
                url: "{{ route('metercontrollogs.fetchAll') }}",
                type: 'GET',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    myChart.data.labels = data.labels;
                    myChart.data.datasets[0].data = data.data;
                    myChart.update();
                    console.log(data);
                },
                error: function(data){
                    console.log(data);
                }
            });
        }

        updateChart();
        setInterval(() => {
            updateChart();
        }, 5000);
    </script>
    <!--end::chartjs-->

@endsection
