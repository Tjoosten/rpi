<?php namespace App\Http\Transformers;

class UserTransformer {

    public function TransformerAll()
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

    public function TransformerSpecific()
    {
        return function($data) {
            return [
                [
                    "firstname" => (string) $data['firstname'],
                    "lastname"  => (string) $data['lastname'],
                    "email"     => (string) $data['email'],
                ]
            ];
        };
    }

    public function UserNotFound()
    {
        return [["message" => "API doesn't find any user"]];
    }

    public function DeleteSuccess()
    {
        return [["message" => (string) "User successfully deleted."]];
    }

    public function DeleteError()
    {
        return [["message" => (string) "Could not delete the user"]];
    }

    public function insertSuccess()
    {
        return [["message" => (string) "Insert successfull"]];
    }

    public function errorUpdate()
    {
        return [["message" => (string) "Could not update the resource"]];
    }

    public function UpdateSuccess()
    {
        return [["message" => (string) "User successfully updated"]];
    }
}