<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staff';
    protected $fillable = [
        'user_id', 'surname', 'other_name', 'date_of_birth', 'id_photo', 'file_path'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
