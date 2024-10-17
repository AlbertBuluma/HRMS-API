<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StaffResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'staff_id' => (string)$this->id,
            'attributes' => [
                'surname' => $this->surname,
                'other_name' => $this->other_name,
                'date_of_birth' => $this->date_of_birth,
                'id_photo' => $this->id_photo,
                'file_path' => $this->file_path,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at
            ],
            'relationships' => [
                'created_by_user_id' => $this->user->id,
                'user_name' => $this->user->name,
                'user_email' => $this->user->email,
            ]
        ];
    }
}
