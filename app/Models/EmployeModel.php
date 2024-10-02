<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class EmployeModel extends Authenticatable
{
    use Notifiable;
    
    protected $table='employe';
       protected $guard = "employe";
}
