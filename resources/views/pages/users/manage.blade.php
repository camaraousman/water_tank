<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD App Laravel 8 & Ajax</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css' />
    <link rel='stylesheet'
          href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" />

</head>

{{-- add new employee modal start --}}
<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="POST" id="add_employee_form">
                @csrf
                <div class="modal-body p-4 bg-light">
                    <div class="row">
                        <div class="col-lg">
                            <label for="fname">Full name</label>
                            <input type="text" name="name" class="form-control" placeholder="First Name" required>
                        </div>
                        <div class="col-lg">
                            <label for="lname">password</label>
                            <input type="password" name="password" class="form-control" placeholder="Last Name" required>
                        </div>
                    </div>
                    <div class="my-2">
                        <label for="email">user id</label>
                        <input type="text" name="user_id" class="form-control" placeholder="user id">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="add_employee_btn" class="btn btn-primary">Add Employee</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- add new employee modal end --}}

{{-- edit employee modal start --}}
<div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="POST" id="edit_employee_form">
                @csrf
                <div class="modal-body p-4 bg-light">
                    <div class="row">
                        <div class="col-lg">
                            <label for="name">Full name</label>
                            <input type="text" name="name" class="form-control" placeholder="First Name" required>
                        </div>
                        <div class="col-lg">
                            <label for="password">password</label>
                            <input type="password" name="password" class="form-control" placeholder="Last Name" required>
                        </div>
                    </div>
                    <div class="my-2">
                        <label for="email">user id</label>
                        <input type="text" name="user_id" class="form-control" placeholder="user id">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="edit_employee_btn" class="btn btn-primary">Update Employee</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- edit employee modal end --}}

<body class="bg-light">
<div class="container">
    <div class="row my-5">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header bg-danger d-flex justify-content-between align-items-center">
                    <h3 class="text-light">Manage Employees</h3>
                    <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addEmployeeModal"><i
                            class="bi-plus-circle me-2"></i>Add New Employee</button>
                </div>
                <div class="card-body" id="show_all_employees">
                    <h1 class="text-center text-secondary my-5">Loading...</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    //begin get all users
    getAllUsers();

    function getAllUsers(){
        $.ajax({
            url: '{{route('users.get_all')}}',
            method: 'get',
            success: function (res){
                $('#show_all_employees').html(res);

                //initialize datatable
                $('table').DataTable({
                    order: [0, 'desc']
                })
                //end datatable initialization
            }
        })
    }
    //end get all users

    //begin edit users
    $(document).on('click', '.editIcon', function (e){
        e.preventDefault();
        let id = $(this).attr('id');

        $.ajax({
            url: '{{route('users.edit')}}',
            method: 'get',
            data: {
                id: id,
                _token: '{{csrf_token()}}'
            },
            success: function(res){
                // $("#user_id").val(res.user_id);
                // $("#name").val(res.name);
                // $("#password").val(res.password);
                console.log(res);
            }
        });
    });
    //end edit users


    //begin add new user
    $("#add_employee_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#add_employee_btn").text('Adding...');
        $.ajax({
            url: '{{ route('users.store') }}',
            method: 'post',
            data: fd,
            cache: false,
            contentType: false,
            processData: false,
            success: function (res){
                if(res.status == 200){
                    Swal.fire(
                        'Added',
                        'User Added Successfuly',
                        'success'
                    )
                    //fetch new added user in real time
                    getAllUsers();
                }

                $("#add_employee_btn").text("Add User");
                $("#add_employee_form")[0].reset();
                $("#addEmployeeModal").modal('hide');
            }
        });
    });
    //end add new user
</script>

</body>

</html>
