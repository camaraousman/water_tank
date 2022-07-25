@extends('layouts.default')

@section('content')
    <!--begin::Card-->
    <div class="card card-custom card-sticky" id="kt_page_sticky_card">
        <!--begin::Header-->
        <div class="card-header flex-wrap pt-6 pb-6 row">
            <div class="col-md-4" data-kt-calendar="datepicker">
                <div class="fv-row mb-9">
                    <!--begin::Label-->
                    <label class="fs-6 fw-bold mb-2 required">Event Start Date</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input class="form-control form-control-solid" name="calendar_event_start_date" placeholder="Pick a start date" id="kt_calendar_datepicker_start_date" />
                    <!--end::Input-->
                </div>
            </div>
            <div class="col-md-4" data-kt-calendar="datepicker">
                <div class="fv-row mb-9">
                    <!--begin::Label-->
                    <label class="fs-6 fw-bold mb-2 required">Event End Date</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input class="form-control form-control-solid" name="calendar_event_end_date" placeholder="Pick a end date" id="kt_calendar_datepicker_end_date" />
                    <!--end::Input-->
                </div>
            </div>
            <div class="col-md-3 text-left mt-7">
                <button onclick="draw_datatable();" type="button" class="btn btn-light-primary font-weight-bolder btn-block text-uppercase px-5"><i class="far fa-list-alt"></i>  Listele</button>
            </div>
        </div>
        <!--end::Header-->
    </div>
    <!--end::Card-->
@endsection


@section('extra_script')
    <!--begin::Page Vendors Javascript(used by this page)-->
    <script src="assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
    <!--end::Page Vendors Javascript-->
    <script src="assets/js/custom/apps/calendar/calendar.js"></script>
@endsection
