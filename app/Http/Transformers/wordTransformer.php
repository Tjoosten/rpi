<?php

namespace App\Http\Transformers;

class wordTransformer {

    public function TransformerSpecific()
    {
        return function ($data) {
            return [
                [
                    "dialect" => (string) $data['dialect'],
                ]
            ];
        };
    }
    
    public function EmptyTransformer()
    {
        return [["message" => "API doesn't find any word"]];
    }
}