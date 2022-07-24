@extends('layouts.default')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Row-->
            <div class="row gx-5 gx-xl-10">
                <!--begin::tank 1-->
                <!--begin::Col-->
                <div class="col-xxl-4 mb-5 mb-xl-10">
                    <!--begin::Chart widget 27-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header py-7">
                            <!--begin::Statistics-->
                            <div class="m-0">
                                <!--begin::Heading-->
                                <div class="d-flex align-items-center mb-2">
                                    <!--begin::Title-->
                                    <span class="fs-2hx fw-bolder text-gray-800 me-2 lh-1 ls-n2">Tank 1</span>
                                    <!--end::Title-->

                                </div>
                                <!--end::Heading-->
                                <!--begin::Description-->
                                <span class="fs-6 fw-bold text-gray-400">some info</span>
                                <!--end::Description-->
                            </div>
                            <!--end::Statistics-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-0 pb-1">

                            <div id="kt_charts_widget_27" class="min-h-auto">
                                <div style='border:0px solid green;'>
                                    <div id='chart-container'></div>
                                </div>
                            </div>



                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Chart widget 27-->
                </div>
                <!--end::Col-->
                <!--end::tank 1-->

                <!--begin::tank 2-->
                <!--begin::Col-->
                <div class="col-xxl-4 mb-5 mb-xl-10">
                    <!--begin::Chart widget 27-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header py-7">
                            <!--begin::Statistics-->
                            <div class="m-0">
                                <!--begin::Heading-->
                                <div class="d-flex align-items-center mb-2">
                                    <!--begin::Title-->
                                    <span class="fs-2hx fw-bolder text-gray-800 me-2 lh-1 ls-n2">Tank 2</span>
                                    <!--end::Title-->

                                </div>
                                <!--end::Heading-->
                                <!--begin::Description-->
                                <span class="fs-6 fw-bold text-gray-400">some info</span>
                                <!--end::Description-->
                            </div>
                            <!--end::Statistics-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-0 pb-1">
                            <div id="kt_charts_widget_27" class="min-h-auto">
                                <div style='border:0px solid green;'>
                                    <div id='chart-container-2'></div>
                                </div>
                            </div>


                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Chart widget 27-->
                </div>
                <!--end::Col-->
                <!--end::tank 2-->

                <!--begin::start_stop switch-->
                <!--begin::Col-->

                <div class="col-xxl-4 mb-5 mb-xl-10 mt-10">
                    <div class="row">
                        <!--begin::Mixed Widget 14-->
                        <div class="card card-xxl-stretch mb-5 mb-xl-8" style="background-color: #408ca8; color: #fff">
                            <!--begin::Body-->
                            <div class="card-body d-flex flex-column">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column mb-0">
                                    <div class="pt-5">
                                        <p class="text-center fs-6 pb-5">
                                            <span class="badge badge-light-danger fs-8">Not:</span>&#160; Buradan metreyi başlatabilirsiniz
                                            <a href="#" class="btn btn-light-primary w-100 py-3 mt-4">Başlat</a>
                                    </div>
                                </div>
                                <!--end::Wrapper-->
                            </div>
                        </div>
                        <!--end::Mixed Widget 14-->
                    </div>
                    <div class="row">
                        <!--begin::Mixed Widget 14-->
                        <div class="card card-xxl-stretch mb-5 mb-xl-8" style="background-color: #db8888; color: #fff">
                            <!--begin::Body-->
                            <div class="card-body d-flex flex-column">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column mb-0">
                                    <div class="pt-5">
                                        <p class="text-center fs-6 pb-5">
                                            <span class="badge badge-light-danger fs-8">Not:</span>&#160; Buradan metreyi durdurabilirsiniz
                                            <a href="#" class="btn btn-light-danger w-100 py-3 mt-4">Durdur</a>
                                    </div>
                                </div>
                                <!--end::Wrapper-->
                            </div>
                        </div>
                        <!--end::Mixed Widget 14-->
                    </div>
                </div>

            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
@endsection

@section('extra_script')
    <script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
    <script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>

    <script type="text/javascript" src="{{asset('assets/js/custom/tank_animation.js')}}"></script>
{{--    <script type="text/javascript" src="{{asset('assets/js/custom/tank_2_animation.js')}}"></script>--}}

@endsection
