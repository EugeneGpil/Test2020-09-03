<?php

namespace App\Models;

use App\Models\Traits\TimeDateFormatTrait;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use TimeDateFormatTrait;

    protected $fillable = [
        'title', 'body', 'published'
    ];

    public function toResponseArray()
    {
        return [
            'document' => [
                'id' => $this->id,
                'status' => $this->published ? 'published' : 'draft',
                'payload' => json_decode($this->body, true),
                'created_at' => $this->getFormattedCreatedAt(),
                'updated_at' => $this->getFormattedUpdatedAt()
            ]
        ];
    }
}
