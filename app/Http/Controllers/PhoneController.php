<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PhoneController extends Controller
{
    // set index page view
    public function index() {
        return view('pages.phones.index');
    }

    // handle fetch all phone ajax request
    public function fetchAll(Request $request, Phone $phone) {
        $data = $phone->getData();
        return DataTables::of($data)
            ->addColumn('Actions', function($data) {
                return '<td class="text-end">
                <a href="#" id="' . $data->id . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm text-hover-primary deleteIcon">
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
                </td>';
            })
            ->rawColumns(['Actions'])
            ->make(true);
    }

    // handle insert a new phone ajax request
    public function store(Request $request) {
        $messages = [
            'required' => 'The :attribute field is a must.',
        ];

        $validator = \Validator::make($request->all(), [
            'phone_number' => 'required|regex:/^(\+\d{1,2}\s?)?1?\-?\.?\s?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/u',
        ], $messages);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        Phone::create([
            'phone_number'      => str_replace([' ','-'], '', $request->phone_number)
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
