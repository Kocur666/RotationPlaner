<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarUsers extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'calendar_users';
    public $timestamps = true;
    protected $fillable = ['person'];
}
