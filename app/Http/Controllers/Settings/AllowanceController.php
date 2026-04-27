<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Validator;
use App\Models\settings\Allowance;
use Yajra\DataTables\Facades\DataTables;

class AllowanceController extends Controller
{
    public function index()
    {
        return view('pages.allowance.index');
    }
    public function edit(Request $request)
    {
        $id = $request->input('edit_id');
        $allowance = Allowance::find($id);
        $allowance->update([
            'value' => $request->input('new_value') , 
            'type' => $request->input('type') , 
        ]);
        return redirect()->back()->with('success', 'Allowance Updated SuccessFully !');
    }
    public function getData()
    {
        $allowance = Allowance::all();
        $data = $allowance->map(function ($row) {
            return [
                $row->id,
                $row->type,
                $row->value,
                '
                <a onclick="editAllowance('.$row->id.' , `'.$row->type.'`, `'.$row->value.'`)"><i class="fa fa-edit fa-icon"></i></a>
                <a onclick=deleteAllowance(' . $row->id . ')><i class="fa fa-trash fa-icon"></i></a>
                '
            ];
        });
        return DataTables::of($data)
            ->rawColumns([3])
            ->make(true);
    }

    public function delete($id)
    {
        Allowance::find($id)->delete();
        return response()->json([
            'success' => true,
        ]);
    }
}
