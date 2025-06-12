<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'testamentId' => $this->testament_id,
            'name' => $this->name,
            'abbrev' => $this->abbrev,
            'testament' => new TestamentResource($this->whenLoaded('testament')),
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at
        ];
    }
}
