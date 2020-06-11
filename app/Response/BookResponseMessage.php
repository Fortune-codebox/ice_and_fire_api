<?php


namespace App\Response;


class BookResponseMessage extends BookResponse
{
    public $message;

    public function __construct( $status_code = 0, $status, $message, $data)
    {
        $this->status = $status;
        $this->status_code = $status_code;
        $this->data = $data;
        $this->message = $message;

    }
    public function sendWithMessage() {
        return $this->consolidateMessage();
    }

    public function consolidateMessage() {
        return [
            'status_code' => $this->status_code,
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->data
        ];
    }
}
