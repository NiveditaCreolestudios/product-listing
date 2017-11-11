<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\productDetails;

class ListController extends Controller
{
    public function index()
    {
    	$data['listing'] = productDetails::getlist();
        $data['edit_listing'] = '';
        
        if($data['listing'] != '')
        {
            $listing_arr = json_decode(json_encode($data['listing']),true);
            foreach ($listing_arr as $key => $value) {
                $data['edit_listing'][$value['id']] = $value;    
            }
            return view('list',$data);
        }
        else
            return view('list',$data);
    }

    public function postSavenewproducts(Request $request){

    	
    	if($request->ajax())
    	{
            
            $params          = $request->all();
            
	        $result          = productDetails::saveproducts($params);

	        $listing = productDetails::getlist();
	        return $listing;
    	}
    }

    public function postDeleteproducts(Request $request){

        
        if($request->ajax())
        {
            $params          = $request->all();

            $result          = productDetails::deleteproduct($params);
            
            $listing = productDetails::getlist();
            return $listing;
        }
    }
}
