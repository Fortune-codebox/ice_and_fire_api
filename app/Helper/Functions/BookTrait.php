<?php

namespace App\Helper\Functions;

use App\Response\BookResponse;
use App\Response\BookResponseMessage;
use App\Service\ApiHandler;

trait BookTrait {

    protected function apiResponse($status_code = 0, $status, $data){
        if( !isset($data) || !isset($status)){
            return false;
        }
        if($status_code != 0)
            $res = new BookResponse($status_code, $status, $data);
        else
            $res = new BookResponse($status_code, $status, $data);
       return $res->send();
    }

    protected function apiResponseWithMessage($status_code = 0, $status, $message, $data){
        if( !isset($data) || !isset($status)){
            return false;
        }
        if($status_code != 0)
            $res = new BookResponseMessage($status_code, $status, $message, $data);
        else
            $res = new BookResponseMessage($status_code, $status, $message, $data);
       return $res->sendWithMessage();
    }

    protected function formatted($data) {
        $key = [];
            foreach($data as $value) {
                $key['id'] = $data['id'];
                $key['name'] =  $data['name'];
                $key['isbn'] = $data['isbn'];
                $key['authors'] = [ 
                    $data['authors'] 
                ];
                $key['number_of_pages'] = $data['number_of_pages'];
                $key['publisher'] = $data['publisher'];
                $key['country'] = $data['country'];
                $key['release_date'] = $data['release_date'];
            }
            return (object) $key;
    }

    protected function formattedExternal($data) {
        if(empty($data)) {
            return [];
        }
        $value = [];
        $filtered = array_map(
            function ($key){
                $value['name']=  $key['name'];
                $value['isbn'] = $key['isbn'];
                $value['authors'] =  $key['authors'];
                $value['number_of_pages'] = $key['numberOfPages'];
                $value['publisher'] = $key['publisher'];
                $value['country'] = $key['country'];
                $value['release_date'] = date("Y-m-d", strtotime($key['released']));
                return (object)$value;
            }, $data);

            return $filtered;
    }

    protected function getErrorMessages(\Illuminate\Contracts\Validation\Validator $validator){
        $messages =  $validator->errors()->getMessages();
        $replaced = str_replace(['[',']', '"', '.','id'], '', json_encode(array_values($messages)));
        return explode(',',$replaced);
    }


}
