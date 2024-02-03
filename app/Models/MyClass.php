<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Users;
use App\Models\Teacher;


class MyClass extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $fillable = [
        'name',
        'description'
       
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function users()
    {
        return $this->belongsToMany(Users::class);
    }
}
