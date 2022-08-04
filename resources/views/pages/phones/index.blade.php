@extends('layouts.default')

@section('content')
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
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="my-2">
                            <label for="phone">Telefon Numara</label>
                            <input type="tel" name="phone_number" id="phone_number" class="form-control" placeholder="Telefon Numara Giriniz" maxlength="12" required>
                            <small class="form-text text-muted">Telefon Numarayı Başına eklemeden giriniz örn: 5515524523 </small>
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

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered datatable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Telefon Numara</th>
                        <th width="150" class="text-center">İşlem</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>
    <!--end::Card-->
    <!--end::Kullanıcı Yönetimi-->
@endsection


@section('extra_script')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        $(document).ready(function() {
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
                ajax: '{{ route('phones.fetchAll') }}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'phone_number', name: 'phone_number'},
                    {data: 'Actions', name: 'Actions',orderable:false,serachable:false,sClass:'text-center'},
                ]
            });

            // Create phone Ajax request.
            $('#add_phone_btn').click(function(e) {
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('phones.store') }}",
                    method: 'post',
                    data: {
                        phone_number: $('#phone_number').val(),
                    },
                    success: function(result) {
                        if(result.errors) {
                            $('.alert-danger').html('');
                            $.each(result.errors, function(key, value) {
                                $('.alert-danger').show();
                                $('.alert-danger').append('<strong><li>'+value+'</li></strong>');
                            });
                        } else {
                            if (result.status == 200) {
                                Swal.fire(
                                    'İşlem Başarılı!',
                                    'Kullanıcı Başırayla Eklenmiştır!',
                                    'success'
                                )
                                $('.datatable').DataTable().ajax.reload();
                            }
                            $("#add_phone_btn").text('Kullanıcı Ekle');
                            $("#add_phone_form")[0].reset();
                            $("#addPhoneModal").modal('hide');
                            $(".modal-backdrop").toggle();
                        }

                    }
                });


            });

            // delete user ajax request
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
                                Swal.fire(
                                    'İşlem Başarılı!',
                                    'Kayıt Başarıyla Silinmiştir.',
                                    'success'
                                )
                                $('.datatable').DataTable().ajax.reload();
                            }
                        });
                    }
                })
            });

            let tele = document.querySelector('#phone_number');
            let count = 0;

            tele.addEventListener('keyup', function(e){
                if (event.key !== 'Backspace' && (tele.value.length === 3 || tele.value.length === 7)){
                    tele.value += '-';
                }
            });

        });
    </script>
@endsection


