<?php namespace App\Http\Transformers;

class InvalidTransformer {

    public function invalidHttpHead()
    {
        return [
            "error"   => (string) "400",
            "message" => (string) 'Invalid Content-Type header.'
        ];
    }
}