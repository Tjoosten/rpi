<?php namespace App\Http\Transformers;

class UserTransformer {

    public function Transformer()
    {
        return function ($data) {
            return [
                [
                    "firstname" => (string) $data['firstname'],
                    "lastname"  => (string) $data['lastname'],
                    "email"     => (string) $data['email'],
                ]
            ];
        };
    }

    public function DeleteSuccess()
    {
        return [
            [
                "message" => (string) "User successfully deleted.",
            ]
        ];
    }

    public function DeleteError()
    {
        return [
            [
                "message" => "ereor"
            ]
        ];
    }
}