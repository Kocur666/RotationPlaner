<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'events';
    public $timestamps = true;
    protected $fillable = ['title','person','date'];
}
