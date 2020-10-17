<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use DB;
use App\Jobs\ImportExcel;

class ImportController extends Controller
{
    public function import(){
    	dispatch(new ImportExcel());
    }
}
