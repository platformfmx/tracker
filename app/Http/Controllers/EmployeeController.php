<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Support\Collection
     */
    public function index(Request $request)
    {
        if($request->filter) {
            if($request->date) {
                $employees = Employee::whereHas(
                    'visits', function($q) {
                    global $request;
                    $unixDate = strtotime($request->date);
                    $year = date('Y',$unixDate);
                    $month = date('m',$unixDate);
                    $day = date('d',$unixDate);
                    $q->whereYear('coming',$year);
                    $q->whereMonth('coming',$month);
                    $q->whereDay('coming',$day);
                }
                )->get();
                return $employees;
            }
            if($request->personal_number) {
                $employees = Employee::where('personal_number','like',"%{$request->personal_number}%")->get();
                return $employees;
            }
        } else {
            return Employee::all();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $employee = new Employee();
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->middle_name = $request->middle_name;
        $employee->personal_number = $request->personal_number;
        $employee->phone = $request->phone;
        $employee->save();
        return redirect()->route('detail-employee',[
            'id' => $employee->id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::where('id',$id)->with('visits')->first();
        return $employee ? : null;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        return view('edit',[
            'employee' => $id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        $employee->first_name = $request->first_name;
        $employee->middle_name = $request->middle_name;
        $employee->last_name = $request->last_name;
        $employee->personal_number = $request->personal_number;
        $employee->phone = $request->phone;
        $employee->save();
        return redirect()->route('detail-employee',[
            'id' => $employee->id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Visit::where('employee_id',$id)->delete();
        Employee::where('id',$id)->delete();
        return redirect()->route('home');
    }
}
