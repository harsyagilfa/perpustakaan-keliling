<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    protected $fillable = ['title','author','publish_year','status'];
    use HasFactory;
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
