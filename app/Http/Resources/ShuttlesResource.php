<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShuttlesResource extends JsonResource
{
    public $status;
    public $msg;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

     public function __construct($status,$msg,$resource)
     {
        parent::__construct($resource);
        $this->status = $status;
        $this->msg = $msg;
     }
    public function toArray(Request $request)
    {
        return [
            'success' => $this->status,
            'messages' => $this->msg,
            'data' => $this->resource
        ];
    }
}
