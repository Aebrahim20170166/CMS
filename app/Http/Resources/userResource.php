<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class userResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'api_token' => 'Bearer '.$this->api_token,
            'role_id' => $this->role_id,
            'role_name' => $this->role->name,
            'created_at' => $this->created_at,
        ];
    }
}
