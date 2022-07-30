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
                        <input type="text" class="form-control form-control-solid" id="beginDate" name="date" placeholder="MM/DD/YYY">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <!--begin::Label-->
                        <label class="fs-6 fw-bold mb-2 required">Event End Date</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" class="form-control form-control-solid" id="endDate" name="date" placeholder="MM/DD/YYY">
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!--begin::datepicker-->
    <script>
        $(document).ready(function(){
            var date_input=$('input[name="date"]'); //our date input has the name "date"
            var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
            var options={
                format: 'mm/dd/yyyy',
                container: container,
                todayHighlight: true,
                autoclose: true,
            };
            date_input.datepicker(options);
        })
    </script>
    <!--end::datepicker-->


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


@endsection
