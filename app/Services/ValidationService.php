<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;

class ValidationService
{
    public static function validateFields(array $data, array $rules, array $messages)
    {
        $validator = Validator::make($data, $rules, $messages);

        //validação detectou algum erro
        if ($validator->fails()) {
            return $validator->errors();
        }

        return true;
    }
}
