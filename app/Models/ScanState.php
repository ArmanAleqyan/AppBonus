<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScanState extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function ScanSender()
    {
        return $this->Belongsto(User::class, 'user_id');
    }

    public function ScanReceiver()
    {
        return $this->Belongsto(User::class, 'receiver_id');
    }

    public function StateCompany()
    {
        return $this->Belongsto(Company::class, 'company_id');
    }

}
