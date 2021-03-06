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

    public function EmptyTransformer()
    {
        return [['message' => 'could no kloekecode found']];
    }

    public function InsertFailure()
    {
        return[['message' => 'Could not insert the data']];
    }

    public function InsertSuccess()
    {
        return [['message' => 'Data is inserted successfully.']];
    }

    public function destroySuccess()
    {
        return [['message' => 'Data successfully destroyed']];
    }

    public function destroyFailure()
    {
        return [['message' => 'Could not destroy the data']];
    }

}