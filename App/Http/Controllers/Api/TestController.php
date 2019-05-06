<?php

namespace App\Http\Controllers\Api;

//use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TestStoreRequest;

class TestController extends Controller
{
    
    /**
     * Get data List from CSV.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    Public function getList()
    {

         // Set CSV File
         $file = public_path('transactions.csv');

         // return cvs array data
		 $customerArr = $this->csvToArray($file);

		 return $customerArr;

    }

   /**
     * Save data token array structure.
     *
     * @param  name, email
     *
     * @return \Illuminate\Http\JsonResponse
     */
    
    public function saveData(TestStoreRequest $request)
    {

         
         
         // return $request->all();

         $validated = $request->validated();

         if (isset($request->validator) && $request->validator->fails()) {
            
             return response()->json($request->validator->messages(), 400);
    		
    		}


         return  $validated;
    }


    // Read CSV File and convert into array

    function csvToArray($filename = '', $delimiter = ',')
	{
	    if (!file_exists($filename) || !is_readable($filename))
	        return false;

	    $header = null;
	    $data = array();
	    if (($handle = fopen($filename, 'r')) !== false)
	    {
	        while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
	        {
	            if (!$header)
	                $header = $row;
	            else
	                $data[] = array_combine($header, $row);
	        }
	        fclose($handle);
	    }

	    return $data;
	}


}
