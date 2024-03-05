<?php
namespace App\Http\Controllers;

use App\Account;
use App\CostCenter;
use Illuminate\Http\Request;
use App\JournalEntry;
use App\TaxRate;

class JournalEntriesController extends Controller
{
    public function index()
    {
        $accounts=Account::all();
        $costCenters=CostCenter::all();
        $taxRates= TaxRate::all();

        return view('journal_entries.index')->with(compact('accounts','costCenters','taxRates'));
    }

    public function show($id)
    {
        $entry = JournalEntry::findOrFail($id);
        return view('journal_entries.show', ['entry' => $entry]);
    }

    public function create()
    { 
       $accounts=Account::all();

        return view('journal_entries.create')->with(compact('accounts'));
        
    }

    public function store(Request $request)
    {
        // $input = $request->only(['entry_date',
        // 'costcenter_id',
        // 'account_id',
        // 'tax_rates_id',
        // 'description',
        // 'total_debit',
        // 'total_credit']);
        $validatedData = $request->validate([
            'entry_date' => 'date_format:Y-m-d', 
            'costcenter_id' => 'required|exists:cost_centers,id',
            'account_id' => 'required|exists:accounts,id',
            'tax_rates_id' => 'exists:tax_rates,id',
            'description' => 'string',
            'total_debit' => 'required|numeric|same:total_credit',
            'total_credit' => 'required|numeric|same:total_debit',

        ]);
JournalEntry::create($validatedData);
return redirect()->route('journal_entries.index')
                 ->with('success', 'Entry created successfully!')
                 ->withInput();        


    }

    public function edit($id)
    {
        $entry = JournalEntry::findOrFail($id);
        return view('journal_entries.edit', ['entry' => $entry]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $entry = JournalEntry::findOrFail($id);
        $entry->update($validatedData);

        return redirect('/journal_entries')->with('success', 'Journal entry updated successfully');
    }

    public function destroy($id)
    {
        $entry = JournalEntry::findOrFail($id);
        $entry->delete();

        return redirect('/journal_entries')->with('success', 'Journal entry deleted successfully');
    }
}


