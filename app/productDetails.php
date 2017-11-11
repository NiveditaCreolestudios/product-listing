<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class productDetails extends Model
{
   	public static function getlist() {

        $products = DB::table('details')
        			->get();

        $returndata   = json_decode(json_encode($products));

        /*$result['products'] = DB::table('tbl_category')
        			->where('iParentID', '0')
        			->get();

    	$result['subcat'] = DB::table('tbl_category')
        			->where('iParentID','!=' ,'0')
        			->get();*/
        /*$product_array                  = json_decode(json_encode($result['products']), true);
        $subcat_array                   = json_decode(json_encode($result['subcat']), true);

        foreach ($product_array as $key => $value) 
        {
        	foreach ($subcat_array as $subkey => $subvalue) {
        		if($subvalue['iParentID'] == $value['iCategoryID'])
        		{
        			$product_array[$key]['subcat'][] = $subvalue;
        		}
        	}	
        }*/
        
        //$returndata = json_decode(json_encode($result));
        if (count($returndata) > 0) {
            return $returndata;
        } else {
            return false;
        }
    }


    public static function saveproducts($params) {

        if(isset($params) && count($params)>0){

            if(isset($params['edit_id']) && $params['edit_id'] != '')
            {
                $update_array = array(
                    'name'       => $params['name'], 
                    'detail'     => $params['details'],
                    'status'     => '1',
                    'created_at' => date('Y-m-d H:i:s')
                );
                
                $result_id = DB::table('details')->where('id', $params['edit_id'])->update($update_array);
            }
            else
            {
                $insert_array = array(
                    'name'       => $params['name'], 
                    'detail'     => $params['details'],
                    'status'     => '1',
                    'created_at' => date('Y-m-d H:i:s')
                );
                
                $result_id = DB::table('details')->insert($insert_array);
            }

            if ($result_id) {
            	$retundata['success'] = true;
            }
            else
            {
            	$retundata['success'] = false;
            }
            return $retundata;
		}
		
    }

    public static function deleteproduct($params) {

        if(isset($params) && count($params)>0){

            $id = $params['id'];
            $result_id = DB::table('details')->where('id', '=', $id)->delete();

            if ($result_id) {
                $retundata['success'] = true;
            }
            else
            {
                $retundata['success'] = false;
            }
            return $retundata;
        }
        
    }
}
