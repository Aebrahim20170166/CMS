<?php

namespace Cms\Course\Models;

use Cms\Course\Models\Course;
use Cms\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
    ];

}
