<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reach extends Model
{
    protected $table = "ip_lookup";
    public $primaryKey = "ip_address";
}
