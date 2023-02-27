<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'location' => $this->location,
            'jobTitle' => $this->job_title,
            'hourlyRate' => $this->hourly_rate,
            'currency' => $this->currency,
            'bio' => $this->bio,
        ];
    }
}
