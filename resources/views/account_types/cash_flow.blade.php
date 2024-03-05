@extends('layouts.app')
@section('title', __('lang_v1.cash_flow'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang('lang_v1.cash_flow')
    </h1>
</section>


    <div class="row">
        <div class="col-sm-12">
        	<div class="box">
                <div class="box-body">
                    @can('account.access')
                        <div class="table-responsive">
                    	<table class="table table-bordered table-striped" id="cash_flow_table">
                    		<thead>
                    			<tr>
                                    <th>@lang( 'messages.date' )</th>
                                    <th>@lang( 'account.account' )</th>
                                    <th>@lang( 'lang_v1.description' )</th>
                                    <th>@lang( 'lang_v1.payment_method' )</th>
                                    <th>@lang( 'lang_v1.payment_details' )</th>
                                    <th>@lang('account.debit')</th>
                    				<th>@lang('account.credit')</th>
                    				<th>@lang( 'lang_v1.account_balance' ) @show_tooltip(__('lang_v1.account_balance_tooltip'))</th>
                                    <th>@lang( 'lang_v1.total_balance' ) @show_tooltip(__('lang_v1.total_balance_tooltip'))</th>
                    			</tr>
                    		</thead>
                            <tfoot>
                                <tr class="bg-gray font-17 footer-total text-center">
                                    <td colspan="5"><strong>@lang('sale.total'):</strong></td>
                                    <td class="footer_total_debit"></td>
                                    <td class="footer_total_credit"></td>
                                    <td colspan="2"></td>
                                </tr>
                            </tfoot>
                    	</table>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    

    <div class="modal fade account_model" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->

@endsection

@section('javascript')
<script>
    $(document).ready(function(){

        // dateRangeSettings.autoUpdateInput = false
        $('#transaction_date_range').daterangepicker(
            dateRangeSettings,
            function (start, end) {
                $('#transaction_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                cash_flow_table.ajax.reload();
            }
        );
        
        // Cash Flow Table
        cash_flow_table = $('#cash_flow_table').DataTable({
            processing: true,
            serverSide: true,
            "ajax": {
                    "url": "{{action("AccountController@cashFlow")}}",
                    "data": function ( d ) {
                        var start = '';
                        var end = '';
                        if($('#transaction_date_range').val() != ''){
                            start = $('#transaction_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                            end = $('#transaction_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                        }
                        
                        d.account_id = $('#account_id').val();
                        d.type = $('#transaction_type').val();
                        d.start_date = start,
                        d.end_date = end
                        d.location_id = $('#cash_flow_location_id').val();

                    }
                },
            "ordering": false,
            columns: [
                {data: 'operation_date', name: 'operation_date'},
                {data: 'account_name', name: 'A.name'},
                {data: 'sub_type', name: 'sub_type', searchable: false},
                {data: 'method', name: 'TP.method'},
                {data: 'payment_details', name: 'TP.payment_ref_no'},
                {data: 'debit', name: 'amount', searchable: false},
                {data: 'credit', name: 'amount', searchable: false},
                {data: 'balance', name: 'balance', searchable: false},
                {data: 'total_balance', name: 'total_balance', searchable: false},
            ],
            "fnDrawCallback": function (oSettings) {
                __currency_convert_recursively($('#cash_flow_table'));
            },
            "footerCallback": function ( row, data, start, end, display ) {
                var footer_total_debit = 0;
                var footer_total_credit = 0;

                for (var r in data){
                    footer_total_debit += $(data[r].debit).data('orig-value') ? parseFloat($(data[r].debit).data('orig-value')) : 0;
                    footer_total_credit += $(data[r].credit).data('orig-value') ? parseFloat($(data[r].credit).data('orig-value')) : 0;
                }

                $('.footer_total_debit').html(__currency_trans_from_en(footer_total_debit));
                $('.footer_total_credit').html(__currency_trans_from_en(footer_total_credit));
            }
        });
        $('#transaction_type, #account_id, #cash_flow_location_id').change( function(){
            cash_flow_table.ajax.reload();
        });
        $('#transaction_date_range').on('cancel.daterangepicker', function(ev, picker) {
            $('#transaction_date_range').val('').change();
            cash_flow_table.ajax.reload();
        });

    });
</script>
@endsection