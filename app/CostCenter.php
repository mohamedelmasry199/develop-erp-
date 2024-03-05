<?php

// app/Models/CostCenter.php

namespace App;

use App\Account;
use Illuminate\Database\Eloquent\Model;

class CostCenter extends Model
{
    protected $table = 'cost_centers';
    protected $fillable = [
        'code',
        'main_center_id',
        'name',
        'branch_ID',
        'center_level',
        'active',
        'description',
        'account_id',
        'cost_center_type'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function mainCenter()
    {
        return $this->belongsTo(CostCenter::class, 'main_center_id');
    }

    public function subCenters()
    {
        return $this->hasMany(CostCenter::class, 'main_center_id', 'id')->with('subCenters');
    }
    public function journalEntries()
    {
        return $this->hasMany(JournalEntry::class, 'costcenter_id');
    }
}
