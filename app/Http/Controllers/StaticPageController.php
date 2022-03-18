<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class StaticPageController extends Controller
{
    public function index($slug)
    {
        return view('static-pages.' . $slug);
    }

    public function home()
    {
		$plans         = session('planData') ?: $this->requestConnection('plans');
		$voicePlans    = $plans->filter(function($item) {
            if (($item['type'] == 1) && ($item['show']==1)) {
                return $item;
            }
        });
        return view('home',compact('voicePlans'));
    }			
	public function mobile_features()    
	{        
		return view('mobile_features');    
	}
	public function product_details()    
	{        
		return view('product_details');    
	}
	public function feature()    
	{        
		return view('feature');    
	}
	public function coverage()    
	{        
		return view('coverage');    
	}
	public function compatible(Request $request)    
	{      
	error_reporting(0);
	Session::flush();
	if($request->isMethod('GET')){
		
		$modelid = $request->input('phone_modelan');
		$imeinumber = $request->input('imei');
		if(!empty($modelid) || !empty($imeinumber)){
			
			if(!empty($modelid))
			{
				$sendvalue = $modelid;
			}else
			{
				$sendvalue = $imeinumber;
			}
		$ch = curl_init();                    // Initiate cURL
		
		  $checkurl = "https://teltik-utils.azurewebsites.net/api/GetDeviceData?code=jEEPtvYXSOWVR9FpfL2vIRb6eJnc38SWI8a8rREE8Oi7I%2FaI3%2FhsbA%3D%3D&deviceId=".$sendvalue; // Where you want to post data
		
		 $json_data = file_get_contents($checkurl);
			$response_data = json_decode($json_data);
		if(!empty($response_data)){
			
			$devicename = $response_data->device->name;
			if($response_data->device->compatibility == 'COMPATIBLE')
			{
				Session::flash('message_compatibility', 'COMPATIBLE'); 
				Session::flash('message_devicename', $devicename); 
			}else
			{
				Session::flash('message_NOTCOMPATIBLE', 'NOTCOMPATIBLE'); 
				Session::flash('message_devicename', $devicename); 
			}
			//if($response_data)
		}else{
			Session::flash('message_imeiwrong', 'Please Enter Valid IMEI Information.'); 
		}
		}
		
	}
		$api_url = 'https://teltik-utils.azurewebsites.net/api/GetDevices?code=jEEPtvYXSOWVR9FpfL2vIRb6eJnc38SWI8a8rREE8Oi7I%2FaI3%2FhsbA%3D%3D';
		$json_data = file_get_contents($api_url);
		$response_data = json_decode($json_data);
		$data_brands = $response_data->brands;
		
		return view('compatible', compact('data_brands')); 
		
	}
	public function model_value()
	{
		$brand_name = $_GET['brand'];
		
		$api_url = 'https://teltik-utils.azurewebsites.net/api/GetDevices?code=jEEPtvYXSOWVR9FpfL2vIRb6eJnc38SWI8a8rREE8Oi7I%2FaI3%2FhsbA%3D%3D';
		$json_data = file_get_contents($api_url);
		$response_data = json_decode($json_data);
		$data_brands = $response_data->brands;
		foreach($data_brands as $key=> $data_brand)
		{
			if($data_brand->name == $brand_name)
			{
				$allmodels = $data_brand->models;
			}
		}
		/*echo '<pre>';
			print_r($allmodels);
		echo '</pre>';*/
		
		foreach($allmodels as $key => $allmodel)
		{
			$allmodel_values[] = '<option value="'.$allmodel->tac.'" >'.$allmodel->name.'</option>';
		}
		
		
		return $allmodel_values;
	}
	public function neworexisting()    
	{        
		return view('neworexisting');    
	}

    public function clearSession()
    {
        session()->flush();
        return view('home');
    }

}
