<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    // set index page view
    public function index() {
        return view('pages.users.testUser');
    }

    // handle fetch all eamployees ajax request
    public function fetchAll() {
        $emps = User::all();
        $output = '';
        if ($emps->count() > 0) {
            $output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $emp->user_id . '</td>
                <td>' . $emp->name . '</td>
                <td>
                  <a href="#" id="' . $emp->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editEmployeeModal"><i class="bi-pencil-square h4"></i></a>

                  <a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    // handle insert a new employee ajax request
    public function store(Request $request) {

        $empData = ['name' => $request->name, 'password' => $request->password, 'user_id' => $request->user_id];
        User::create($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle edit an employee ajax request
    public function edit(Request $request) {
        $id = $request->id;
        $emp = User::find($id);
        return response()->json($emp);
    }

    // handle update an employee ajax request
    public function update(Request $request) {
        $id = $request->user_id;
        $user = User::where('user_id', '=', $id)->get()->first();

        if($request->password == ''){
            $password = $user->password;
        }else{
            $password = $request->password;
        }


        $user->update([
            'name'      =>  $request->name,
            'password'  =>  bcrypt($password),
            'user_id'   =>  $request->user_id
        ]);

        return response()->json([
            'status' => 200,
        ]);
    }

    // handle delete an employee ajax request
    public function delete(Request $request)
    {
//        $id = $request->id;
//        $emp = User::find($id);

        $user = User::where('id', '=', $request->id)->delete();
    }


//    public function fetchAll(){
//        $emps = User::all();
//
//        $output = '';
//        if ($emps->count() > 0) {
//            $output .= '<div class="table-responsive"><table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
//            <thead>
//              <tr class="fw-bolder text-muted">
//                <th class="min-w-120px">UserID</th>
//                <th class="min-w-150px">Name</th>
//                <th class="min-w-120px">Created at</th>
//                <th class="min-w-100px text-end">Action</th>
//              </tr>
//            </thead>
//            <tbody>';
//            foreach ($emps as $emp) {
//                $output .= '<tr>
//                <td class="text-dark fw-bolder  fs-6">' . $emp->user_id . '</td>
//                <td class="text-dark fw-bolder  fs-6">' . $emp->name . '</td>
//                <td class="text-dark fw-bolder  fs-6">' . $emp->created_at . '</td>
//                <td class="text-dark fw-bolder  fs-6 text-end">
//                  <a href="#" id="' . $emp->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editEmployeeModal"><i class="bi-pencil-square h4"></i></a>
//
//                  <a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
//                </td>
//              </tr>';
//            }
//            $output .= '</tbody></table></div>';
//            echo $output;
//        } else {
//            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
//        }
//    }
}
