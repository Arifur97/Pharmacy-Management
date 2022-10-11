<?php

namespace App\Http\Controllers;
use App\ShelfLocation;
use App\Warehouse;
use App\Customer;
use App\CustomerGroup;
use Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShelfLocationController extends Controller
{
    public function index() {
        $lims_shelf_location_list = ShelfLocation::all();
        return view('shelf_location.index', compact('lims_shelf_location_list'));
    }

    public function create() {
        $lims_warehouse_list = Warehouse::all();
        $lims_customer_list = Customer::all();
        $lims_customer_group_all = CustomerGroup::where('is_active', true)->get();
        return view('shelf_location.create', compact('lims_warehouse_list', 'lims_customer_list', 'lims_customer_group_all'));
    }

    public function store(Request $request)
    {
        $data = $request->except('document');
        //return dd($data);
        $document = $request->document;
        if ($document) {
            $v = Validator::make(
                [
                    'extension' => strtolower($request->document->getClientOriginalExtension()),
                ],
                [
                    'extension' => 'in:jpg,jpeg,png,gif,pdf,csv,docx,xlsx,txt',
                ]
            );
            if ($v->fails())
                return redirect()->back()->withErrors($v->errors());

            $documentName = $document->getClientOriginalName();
            $document->move('public/documents/shelflocation', $documentName);
            $data['document'] = $documentName;
        }
        $data['status'] = 0;
        ShelfLocation::create($data);

        return redirect('shelf_location')->with('create_message', 'Shelf Location created successfully');
    }

    public function edit($id) {
        $lims_shelf_location_data = ShelfLocation::find($id);
        $lims_warehouse_list = Warehouse::all();
        $lims_customer_list = Customer::all();
        $lims_customer_group_all = CustomerGroup::where('is_active', true)->get();
        return view('shelf_location.edit', compact('lims_shelf_location_data', 'lims_warehouse_list', 'lims_customer_list', 'lims_customer_group_all'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->except('document');
        //return dd($data);
        $document = $request->document;
        if ($document) {
            $v = Validator::make(
                [
                    'extension' => strtolower($request->document->getClientOriginalExtension()),
                ],
                [
                    'extension' => 'in:jpg,jpeg,png,gif,pdf,csv,docx,xlsx,txt',
                ]
            );
            if ($v->fails())
                return redirect()->back()->withErrors($v->errors());

            $documentName = $document->getClientOriginalName();
            $document->move('public/documents/shelflocation', $documentName);
            $data['document'] = $documentName;
        }

        $lims_shelf_location_list = ShelfLocation::find($id);

        $lims_shelf_location_list->update($data);
        return redirect('shelf_location')->with('edit_message', 'Shelf Location updated successfully');
    }

    public function changeStatus($id) {
        try {
            $ShelfLocation= ShelfLocation::find($id);
            $ShelfLocation->status= !$ShelfLocation->status;
            $ShelfLocation->update();
            return redirect('shelf_location')->with('edit_message', 'Status changed successfully');
        } catch(\Exception $e) {
            return redirect('shelf_location')->with('not_permitted', 'Status change failed');
        }
    }

    public function destroy($id)
    {

        $lims_quotation_data = ShelfLocation::find($id);
        $lims_quotation_data->delete();
        return redirect('shelf_location')->with('not_permitted', 'Shelf Location deleted successfully');
    }

}
