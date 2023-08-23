<?php

namespace App\Models\Text;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class TextModel extends Model
{
    use HasFactory;

    protected $table = 'texts';
    protected  $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
