@extends('layouts.default')

@section('content')
                        {{-- add new user modal start --}}
                        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                             data-bs-backdrop="static" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Yeni Kullanıcı Ekle</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="#" method="POST" id="add_user_form" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body p-4 bg-light">
                                            <div class="row">
                                                <div class="my-2">
                                                    <label for="name">Ad Soyadı</label>
                                                    <input type="text" name="name" class="form-control" placeholder="Adı Giriniz" required>
                                                </div>
                                                <div class="col-lg">
                                                    <label for="password">Şifre</label>
                                                    <input type="password" name="password" class="form-control" placeholder="Şifre Giriniz" required>
                                                </div>
                                                <div class="col-lg">
                                                    <label for="password">Şifre Tekrar</label>
                                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Şifreyi Tekrar Giriniz" required>
                                                </div>
                                            </div>
                                            <div class="my-2">
                                                <label for="user_id">Kullanıcı Kodu</label>
                                                <input type="text" name="user_id" class="form-control" required>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">İptal</button>
                                            <button type="submit" id="add_user_btn" class="btn btn-primary">Kullanıcı Ekle</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- add new user modal end --}}

                        {{-- edit user modal start --}}
                        <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                             data-bs-backdrop="static" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Kullanıcı Güncelle</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="#" method="POST" id="edit_user_form">
                                        @csrf

                                        <div class="modal-body p-4 bg-light">
                                            <div class="row">
                                                <div class="col-lg">
                                                    <label for="name">Ad Soyadı</label>
                                                    <input type="text" name="name" id="name" class="form-control" placeholder="Ad Soyadı Giriniz" required>
                                                </div>
                                                <div class="col-lg">
                                                    <label for="name">Password</label>
                                                    <input type="password" name="password" id="password" class="form-control" placeholder="Yeni Şifre Girebilirsiniz">
                                                </div>
                                            </div>
                                            <div class="my-2">
                                                <label for="user_id">Kullanıcı Kodu</label>
                                                <input type="text" name="user_id" id="user_id" class="form-control" placeholder="User ID" required>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">İptal</button>
                                            <button type="submit" id="edit_user_btn" class="btn btn-success">Kullanıcı Güncelle</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- edit user modal end --}}

            <!--begin::Kullanıcı Yönetimi-->
            <!--begin::Card-->
            <div class="card card-custom">
                <!--begin::Header-->
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">Kullanıcı Yönetimi
                            <span class="d-block text-muted pt-2 font-size-sm">Sisteme kayıtlı kullanıcıları kolayca yönetebilirsiniz.</span></h3>
                    </div>
                    <div class="card-toolbar">

                <!--begin::Button-->
                <a href="#" class="btn btn-light-primary font-weight-bolder" data-bs-toggle="modal" data-bs-target="#addUserModal">
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
            </span>Yeni Kullanıcı Ekle</a>
                <!--end::Button-->

        </div>
    </div>
        <!--end::Header-->

        <div class="card-body" id="show_all_users">
            <h1 class="text-center text-secondary my-5">Yükleniyor...</h1>
        </div>
    </div>
        <!--end::Card-->
        <!--end::Kullanıcı Yönetimi-->
@endsection


@section('extra_script')
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(function() {

        // add new user ajax request
        $("#add_user_form").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $("#add_user_btn").text('Ekleniyor...');
            $.ajax({
                url: '{{ route('users.store') }}',
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
                        fetchAllUsers();
                    }
                    $("#add_user_btn").text('Kullanıcı Ekle');
                    $("#add_user_form")[0].reset();
                    $("#addUserModal").modal('hide');
                    $(".modal-backdrop").toggle();
                }
            });
        });

        // edit users ajax request
        $(document).on('click', '.editIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            $.ajax({
                url: '{{ route('users.edit') }}',
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $("#name").val(response.name);
                    $("#password").val(response.password);
                    $("#user_id").val(response.user_id);
                }
            });
        });

        // update users ajax request
        $("#edit_user_form").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $("#edit_user_btn").text('Güncelleniyor...');
            $.ajax({
                url: '{{ route('users.update') }}',
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
                            'Kullanıcı Başarıyla Güncellenmiştir!',
                            'success'
                        )
                        fetchAllUsers();
                    }
                    $("#edit_user_btn").text('Kullanıcı Güncelle');
                    $("#edit_user_form")[0].reset();
                    $("#editUserModal").modal('hide');
                    $(".modal-backdrop").toggle();
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
                        url: '{{ route('users.delete') }}',
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
                            fetchAllUsers();
                        }
                    });
                }
            })
        });

        // fetch all users ajax request
        fetchAllUsers();

        function fetchAllUsers() {
            $.ajax({
                url: '{{ route('users.fetchAll') }}',
                method: 'get',
                success: function(response) {
                    $("#show_all_users").html(response);
                    $("table").DataTable({
                        order: [0, 'desc']
                    });
                }
            });
        }
    });
</script>
@endsection

