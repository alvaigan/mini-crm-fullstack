<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    protected $table = "contacts";

    public function role() {
        return $this->hasOne(Roles::class, 'id', 'role_id');
    }
}
