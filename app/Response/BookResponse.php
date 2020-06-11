<?php


namespace App\Response;


class BookResponse
{
    public $status;
    public $status_code;
    public $data;

    public function __construct( $status_code = 0, $status, $data)
    {
        $this->status = $status;
        $this->status_code = $status_code;
        $this->data = $data;

    }

    public function send()
    {
        return $this->consolidate();
    }

    public function consolidate()
    {
        return [
            'status_code' => $this->status_code,
            'status' => $this->status,
            'data' => $this->data
        ];
    }
}
