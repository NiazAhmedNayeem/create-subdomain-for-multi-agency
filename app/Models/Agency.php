<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agency extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'subdomain'];

    public function admins()
    {
        return $this->hasMany(User::class)->where('role', 'agency_admin');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
