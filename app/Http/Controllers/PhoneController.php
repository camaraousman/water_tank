<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    // set index page view
    public function index() {
        return view('pages.phones.manage');
    }

    // handle fetch all eamployees ajax request
    public function fetchAll() {
        $phones = Phone::all();
        $output = '';
        if ($phones->count() > 0) {
            $output .= '<div class="table-responsive"><table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
            <thead>
              <tr class="fw-bolder text-muted">
                <th class="min-w-120px">Phone Number</th>
                <th class="min-w-100px text-end">Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($phones as $phone) {
                $output .= '<tr>
                <td class="text-dark fw-bolder  fs-6">' . $phone->phone_number . '</td>
                <td class="text-end">
                <a href="#" id="' . $phone->id . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm text-hover-primary deleteIcon">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                    <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor" />
                            <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor" />
                            <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </a>

                </td>
              </tr>';
            }
            $output .= '</tbody></table></div>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    // handle insert a new phone ajax request
    public function store(Request $request) {

        Phone::create([
            'phone_number'      => $request->phone_number
        ]);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle delete an phone ajax request
    public function delete(Request $request)
    {
        Phone::where('id', '=', $request->id)->delete();
    }
}
