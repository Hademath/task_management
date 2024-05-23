<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
     protected $fillable = ['collection_id', 'title', 'description'];

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }
}
