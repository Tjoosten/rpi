<?php namespace App\Http\Transformers;

class KloekecodeTransformer {

    public function KloekecodeTransformer()
    {
        return function($data)
        {
            return [
                'Kloekecode' => (string) $data['Kloekecode'],
                'Plaats'     => (string) $data['Plaats'],
                'Gemeente'   => (string) $data['Gemeente'],
                'Provincie'  => (string) $data['Provincie'],
            ];
        };
    }

}