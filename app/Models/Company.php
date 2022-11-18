<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
        protected  $guarded =[];

    public function Commpany()
    {
        return $this->HasMany(User::class, 'company_id');
    }

    public function StateCompany()
    {
        return $this->HasMany(ScanState::class, 'company_id');
    }
}
