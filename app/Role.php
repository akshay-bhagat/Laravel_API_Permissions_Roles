<?php

namespace App;
use App\Permission;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class)->wherePivot('active', 1);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->wherePivot('active', 1);
    }
}
