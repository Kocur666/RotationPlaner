<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absences extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'absences';
    public $timestamps = true;
    protected $fillable = ['person','date'];
}
