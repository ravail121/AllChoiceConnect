<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Api\ApiResponse;
use Illuminate\Support\Facades\File;
class SampleImageController extends Controller
{
	public function index()
    {
    	
        return view('verify-bussiness.testingimageupload');
    }

    public function fileUpload(Request $request)
    {
    	$fileName = $request->file('file');
        $imageUrl = 'sample-image';
        $origanalName = $fileName->getClientOriginalName();

        /*$data = [ 'image',
                    'contents'       => File::get($fileName),
                    'filename'       => $fileName->getClientOriginalName(),
                ];
*/
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => env('API_BASE_URL').'/'."sample-image",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array('file' => new \CurlFile($fileName)),
            CURLOPT_HTTPHEADER => array(
                // Set here requred headers
                "accept: */*",
                "accept-language: en-US,en;q=0.8",
                /*"content-type: application/json",*/
            ),
        ));

        return $response = curl_exec($curl);


        //return $response = $this->requestConnection($imageUrl, 'postWithFile' ,$data);
    }
}
