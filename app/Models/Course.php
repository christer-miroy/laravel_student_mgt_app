<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'syllabus',
        'duration',
        'teacher_id'
    ];

    // add months to duration
    public function duration() {
        if ($this->duration == 1) {
            return $this->duration." Month";
        } else {
            return $this->duration." Months";
        }
    }

    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }
}
