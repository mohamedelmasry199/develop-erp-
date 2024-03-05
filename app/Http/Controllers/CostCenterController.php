<?php
namespace App\Http\Controllers;

use App\Account;
use App\CostCenter as AppCostCenter;
use Illuminate\Http\Request;
use App\CostCenter;

class CostCenterController extends Controller
{
    // Index - Read all cost centers
    public function index()
    {
        $costCenters = CostCenter::whereNull('main_center_id')
        ->with(['subCenters'])
        ->get();
        return view('cost_center.index')->with(compact('costCenters'));

    }

    // Show - Read a specific cost center
    public function show($id)
    {
        $costCenter = CostCenter::find($id);
        return view('cost_center.show', compact('costCenter'));
    }

    // Create - Show the form to create a new cost center
    public function create()
    {
        
            if (!auth()->user()->can('account.access')) {
                abort(403, 'Unauthorized action.');
            }
    
    
            $costCenters = CostCenter::whereNull('main_center_id')->where('cost_center_type','main')
                                         ->get();
            $accounts=Account::get();

            return view('cost_center.create')
                    ->with(compact('costCenters','accounts'));
            
    }

    // Store - Save a new cost center to the database
    public function store(Request $request)
    {
        if (!auth()->user()->can('account.access')) {
            abort(403, 'Unauthorized action.');
        }

        // try {
            $input = $request->only(['cost_center_type','name', 'main_center_id','code','center_level','active','description','account_id']);
            CostCenter::create($input);
            $output = ['success' => true,
                            'msg' => __("lang_v1.added_success")
                        ];
        // } catch (\Exception $e) {
        //     \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
        //     $output = ['success' => false,
        //                     'msg' => __("messages.something_went_wrong")
        //                 ];
        // }

        return redirect()->back()->with('status', $output);
    }

    public function createSub($main_center_id)
    {
        
            if (!auth()->user()->can('account.access')) {
                abort(403, 'Unauthorized action.');
            }
    
    
            $costCenters = CostCenter::where('id', $main_center_id)

                                         ->get();
            $accounts=Account::get();

            return view('cost_center.createSub')
                    ->with(compact('costCenters','accounts'));
            
        
    }

    public function storeSub(Request $request)
    {
        if (!auth()->user()->can('account.access')) {
            abort(403, 'Unauthorized action.');
        }

        // try {
            $input = $request->only(['cost_center_type','name', 'main_center_id','code','center_level','active','description','account_id']);
            CostCenter::create($input);
            $output = ['success' => true,
                            'msg' => __("lang_v1.added_success")
                        ];
        // } catch (\Exception $e) {
        //     \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
        //     $output = ['success' => false,
        //                     'msg' => __("messages.something_went_wrong")
        //                 ];
        // }

        return redirect()->back()->with('status', $output);
    }



    public function edit($id)
    {
        if (!auth()->user()->can('account.access')) {
            abort(403, 'Unauthorized action.');
        }
    

    $costCenters = CostCenter::where('id', $id)
        ->get();
    $accounts=Account::get();

    return view('cost_center.edit')
       ->with(compact('costCenters','accounts'));

    }


    public function update(Request $request, $id)
    {
        if (!auth()->user()->can('account.access')) {
            abort(403, 'Unauthorized action.');
        }

        try {
            $input = $request->only(['cost_center_type','name', 'main_center_id','active','description','account_id']);
            $costCenter = CostCenter::findOrFail($id);

            if (empty($costCenter->main_center_id) && !empty($input['main_center_id'])) {
                CostCenter::where('main_center_id', $costCenter->id)
                        ->update(['main_center_id' => $input['main_center_id']]);
            }

            $costCenter->update($input);
                                    
            $output = ['success' => true,
                            'msg' => __("lang_v1.updated_success")
                        ];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = ['success' => false,
                            'msg' => __("messages.something_went_wrong")
                        ];
        }

        return redirect()->back()->with('status', $output);
    }

   
    // Destroy - Delete a specific cost center from the database
    public function destroy($id)
    {
        if (!auth()->user()->can('account.access')) {
            abort(403, 'Unauthorized action.');
        }


        $costCenter = CostCenter::find($id);

        // Check if the cost center has child records
        if ($costCenter->subCenters->isNotEmpty()) {
            // Update main_center_id to null for child records
            $costCenter->subCenters()->update(['main_center_id' => null]);
        }
    
        // Delete the cost center record
        $costCenter->delete();
    

        $output = ['success' => true,
                            'msg' => __("lang_v1.deleted_success")
                        ];

        return redirect()->back()->with('status', $output);
    }
}
