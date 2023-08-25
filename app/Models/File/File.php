<?php

namespace App\Models\File;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class File extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'files';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
