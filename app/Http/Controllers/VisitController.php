<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitController extends Controller
{

    public function addVisit(Request $request)
    {
        $coming = str_replace('T'," ", $request->coming);
        $coming = str_replace('Z'," ", $request->coming);
        $leaving = str_replace('T'," ", $request->leaving);
        $leaving = str_replace('Z'," ", $request->leaving);
        DB::table('visits')->insert([
            'coming' => $coming,
            'leaving' => $leaving,
            'employee_id' => $request->id
        ]);
        return Employee::where('id',$request->id)->with('visits')->first();
    }

}
