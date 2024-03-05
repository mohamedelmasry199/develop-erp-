<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalEntry extends Model
{

    protected $table = 'journal_entries';

    protected $fillable = [
        'entry_date',
        'costcenter_id',
        'account_id',
        'entry_type',
        'tax_rates_id',
        'description',
        'total_debit',
        'total_credit',
    ];


    public function costCenter()
    {
        return $this->belongsTo(CostCenter::class, 'costcenter_id');
    }

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function taxRate()
    {
        return $this->belongsTo(TaxRate::class, 'tax_rates_id');
    }
}
