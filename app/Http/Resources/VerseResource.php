<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VerseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'testamentId' => $this->testament_id,
            'bookId' => $this->book_id,
            'version' => $this->version,
            'chapter' => $this->chapter,
            'verse' => $this->verse,
            'text' => $this->text,
            'book' => new BookResource($this->whenLoaded('book')),
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at
        ];
    }
}
