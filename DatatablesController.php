<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use Auth;

use App\Http\Requests\DatatablesFormRequest;
use Validator;

// use Datatables;
use yajra\Datatables\Datatables;
use App\Helpers\DatatablesEditor;


class DatatablesController extends Controller {

    public function index() {
        return view('datatable-editor');
    }

     /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData() {
        $dtRes = Datatables::of(User::select('*'))
            ->make(true);
        return $dtRes;

    }

    /**[dataResponse2 description]
     * 
     * @param  Request $req 
     * @return JSON       JSON response
     */
    public function dataResponse(Request $req) {

        $input = $req->input();
        $action = $input['action'];
        $rowIdArray = array_keys($input['data']);

        foreach($rowIdArray as $rowId) {
           $dataArray[] = $input['data'][$rowId];
        }

        // do form validation
        $validator = Validator::make($input['data'][$rowIdArray[0]], [
            'first_name' => 'required|max:5',
            'last_name' => 'required|max:30'
        ]);

        $validator->setCustomMessages([
            'first_name.required' => 'Please provide your first name.',
            'first_name.max' => 'Please shorten your first name.',
            'last_name.required' => 'Please provide your last name.',
            'last_name.max' => 'Please shorten your last name.',
        ]);

        $returnArray =  DatatablesEditor::process($req,  $validator,   /* 'App\Models\User' */  /* User::all() */  User::where ('id',   '<=', 50) );

        // This was used to create static json responses for testing purposes
        // $returnArray =  DatatablesEditor::processStaticTest($req,  $validator, 'App\Models\User');

        return $returnArray;
    }

}


