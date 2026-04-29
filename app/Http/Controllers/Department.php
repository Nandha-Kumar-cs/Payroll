<?php

namespace App\Http\Controllers;

use App\Models\Department as DepartmentModel;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;

class Department extends Controller
{
    public function index()
    {
        return view('department.index');
    }

    public function getDepartmentData()
    {
        $departments = DepartmentModel::query()
            ->orderBy('name')
            ->get();

        $data = $departments->map(function ($department) {
            return [
                $department->id,
                e($department->name),
                '<a type="button" onclick="editDepartment(' . $department->id . ', ' . json_encode($department->name) . ')"><i class="fa fa-edit fa-icon"></i></a>
                <a href="'.route('department.delete' , $department->id).'"><i class="fa-solid fa-trash fa-icon text-black"></i></a>',
            ];
        });

        return DataTables::of($data)
            ->rawColumns([2])
            ->make(true);
    }

    public function addDepartment(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:departments,name'],
        ]);

        DepartmentModel::query()->create([
            'name' => $data['name'],
        ]);

        return redirect()
            ->route('department.index')
            ->with('success', 'Department added successfully.');
    }

    public function editDepartment(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'edit_id' => ['required', 'exists:departments,id'],
            'name' => ['required', 'string', 'max:255', 'unique:departments,name,' . $request->input('edit_id')],
        ]);

        DepartmentModel::query()
            ->findOrFail($data['edit_id'])
            ->update([
                'name' => $data['name'],
            ]);

        return redirect()
            ->route('department.index')
            ->with('success', 'Department updated successfully.');
    }

    public function getDesignationData()
    {
        $designations = Designation::query()
            ->orderBy('title')
            ->get();

        $data = $designations->map(function ($designation) {
            return [
                $designation->id,
                e($designation->title),
                '<a type="button"  onclick=\'editDesignation(' . json_encode([
                    'id' => $designation->id,
                    'title' => $designation->title,
                    'grade' => $designation->grade,
                    'level' => $designation->level,
                    'is_managerial' => (bool) $designation->is_managerial,
                ]) . ')\'><i class="fa fa-edit fa-icon"></i></a>',
            ];
        });

        return DataTables::of($data)
            ->rawColumns([2])
            ->make(true);
    }

    public function addDesignation(Request $request): RedirectResponse
    {
        $data = $this->validateDesignation($request);

        Designation::query()->create($data);

        return redirect()
            ->route('department.index')
            ->with('success', 'Designation added successfully.');
    }

    public function editDesignation(Request $request): RedirectResponse
    {
        $request->validate([
            'edit_id' => ['required', 'exists:designations,id'],
        ]);

        $data = $this->validateDesignation($request);

        Designation::query()
            ->findOrFail($request->input('edit_id'))
            ->update($data);

        return redirect()
            ->route('department.index')
            ->with('success', 'Designation updated successfully.');
    }

    protected function validateDesignation(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'grade' => ['nullable', 'string', 'max:100'],
            'level' => ['nullable', 'integer', 'min:0'],
            'is_managerial' => ['nullable', 'boolean'],
        ]);

        $data['is_managerial'] = $request->boolean('is_managerial');

        return $data;
    }


    public function deleteDepartment($id) {
        DepartmentModel::find($id)->delete() ;
        return back()->with(['success' => 'Department Deleted SuccessFully !']);
    }
}
