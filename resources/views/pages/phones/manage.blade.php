@include('partials.head')

@section('extra_css')

@endsection

<body id="kt_body" class="@if(!isset($minimize)) header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading @else header-fixed header-mobile-fixed aside-enabled aside-fixed aside-minimize aside-minimize-hoverable @endif">

<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="d-flex flex-row flex-column-fluid page">
        @include('partials.aside')
        <!--begin::Wrapper-->
        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
            @include('partials.header')
            <!--begin::Content-->
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                <!--begin::Entry-->
                <div class="d-flex flex-column-fluid">
                    <!--begin::Container-->
                    <div class="container">
                        {{-- add new phone number modal start --}}
                        <div class="modal fade" id="addPhoneModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                             data-bs-backdrop="static" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Yeni Telefon Numara Ekle</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="#" method="POST" id="add_phone_form">
                                        @csrf
                                        <div class="modal-body p-4 bg-light">

                                                <div class="my-2">
                                                    <label for="phone">Telefon Numara</label>
                                                    <input type="text" name="phone_number" class="form-control" placeholder="Telefon Numara Giriniz" required>
                                                </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">İptal</button>
                                            <button type="submit" id="add_phone_btn" class="btn btn-primary">Numarayı Kaydet</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- add new phone modal end --}}

                        <!--begin::Kullanıcı Yönetimi-->
                        <!--begin::Card-->
                        <div class="card card-custom">
                            <!--begin::Header-->
                            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                <div class="card-title">
                                    <h3 class="card-label">Telefon Numaralar Yönetimi
                                        <span class="d-block text-muted pt-2 font-size-sm">Sisteme kayıtlı telefon numaraları kolayca yönetebilirsiniz.</span></h3>
                                </div>
                                <div class="card-toolbar">

                                    <!--begin::Button-->
                                    <a href="#" class="btn btn-light-primary font-weight-bolder" data-bs-toggle="modal" data-bs-target="#addPhoneModal">
            <span class="svg-icon svg-icon-md">
                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24" />
                        <circle fill="#000000" cx="9" cy="15" r="6" />
                        <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                    </g>
                </svg>
                <!--end::Svg Icon-->
            </span>Yeni Telefon Numara Ekle</a>
                                    <!--end::Button-->

                                </div>
                            </div>
                            <!--end::Header-->

                            <div class="card-body" id="show_all_phones">
                                <h1 class="text-center text-secondary my-5">Yükleniyor...</h1>
                            </div>
                        </div>
                        <!--end::Card-->
                        <!--end::Kullanıcı Yönetimi-->

                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Entry-->
            </div>
            <!--end::Content-->
            @include('partials.footer')
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::Main-->
@include('partials.footer_script')
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(function() {

        // add new phone ajax request
        $("#add_phone_form").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $("#add_phone_btn").text('Ekleniyor...');
            $.ajax({
                url: '{{ route('phones.store') }}',
                method: 'post',
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 200) {
                        Swal.fire(
                            'İşlem Başarılı!',
                            'Kullanıcı Başırayla Eklenmiştır!',
                            'success'
                        )
                        fetchAllPhones();
                    }
                    $("#add_phone_btn").text('Kullanıcı Ekle');
                    $("#add_phone_form")[0].reset();
                    $("#addPhoneModal").modal('hide');
                }
            });
        });


        // delete phone ajax request
        $(document).on('click', '.deleteIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            let csrf = '{{ csrf_token() }}';
            Swal.fire({
                title: 'Onaylıyor Musunuz?',
                text: "Kaydı Geri Alamazsınız!",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'İptal',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Evet, Sil!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('phones.delete') }}',
                        method: 'delete',
                        data: {
                            id: id,
                            _token: csrf
                        },
                        success: function(response) {
                            console.log(response);
                            Swal.fire(
                                'İşlem Başarılı!',
                                'Kayıt Başarıyla Silinmiştir.',
                                'success'
                            )
                            fetchAllPhones();
                        }
                    });
                }
            })
        });

        // fetch all users ajax request
        fetchAllPhones();

        function fetchAllPhones() {
            $.ajax({
                url: '{{ route('phones.fetchAll') }}',
                method: 'get',
                success: function(response) {
                    $("#show_all_phones").html(response);
                    $("table").DataTable({
                        scrollY: '250px',
                        order: [0, 'desc']
                    });
                }
            });
        }
    });
</script>
</body>


