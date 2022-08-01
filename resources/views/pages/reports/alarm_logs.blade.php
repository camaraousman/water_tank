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

        <div class="flex-wrap m-5">
            <div class="table-responsive">
                <table id="kt_datatable_example_1" class="table table-row-bordered gy-5 m-5">
                    <thead>
                    <tr>
                        <th>Slug</th>
                        <th>Desc</th>
                        <th>Requested at</th>
                        <th>Action at</th>
                        <th>Status</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                {{ csrf_field() }}
            </div>
        </div>
    </div>
@endsection

@section('extra_script')
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>

    <script>
        //begin datepicker
        $(document).ready(function(){

            var date = new Date();

            $('.input-daterange').datepicker({
                todayBtn: 'linked',
                format: 'yyyy-mm-dd',
                autoclose: true
            });

            var _token = $('input[name="_token"]').val();

            fetch_data();

            function fetch_data(from_date = '', to_date = '')
            {
                $.ajax({
                    url:"{{ route('alarmlogs.fetchAll') }}",
                    method:"POST",
                    data:{from_date:from_date, to_date:to_date, _token:_token},
                    dataType:"json",
                    success:function(data)
                    {
                        var output = '';
                        $('#total_records').text(data.length);
                        for(var count = 0; count < data.length; count++)
                        {
                            output += '<tr>';
                            output += '<td>' + data[count].slug + '</td>';
                            output += '<td>' + data[count].desc + '</td>';
                            output += '<td>' + data[count].requested_at + '</td>';
                            output += '<td>' + data[count].action_at + '</td>';
                            output += '<td>' + data[count].status + '</td>';
                            output += '<td>' + data[count].created_at + '</td>';
                            output += '<td>' + data[count].updated_at + '</td></tr>';
                        }
                        $('tbody').html(output);
                    }
                })
            }

            $('#filter').click(function(){
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                if(from_date != '' &&  to_date != '')
                {
                    fetch_data(from_date, to_date);
                }
                else
                {
                    alert('Both Date is required');
                }
            });

            $('#refresh').click(function(){
                $('#from_date').val('');
                $('#to_date').val('');
                fetch_data();
            });


        });
        //end datepicker
    </script>
@endsection



