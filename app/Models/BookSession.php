<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookSession extends Model
{
    protected $guarded=[];
    protected $dates=[
        'start_time',
        'end_time'
    ];

    // public function Student()
    // {
    //     return $this->hasOne(User::class,'id','student_id');
    // }

    // public function Teacher()
    // {
    //     return $this->hasOne(User::class,'id','teacher_id');
    // }
}
