@extends('layouts.app')
@section('title', __( 'account.trial_balance' ))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang( 'account.trial_balance')
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row no-print">
        <div class="col-sm-12">
            @component('components.filters', ['title' => __('report.filters')])
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('trial_bal_location_id',  __('purchase.business_location') . ':') !!}
                    {!! Form::select('trial_bal_location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%']); !!}
                </div>
            </div>
            <div class="col-sm-3 col-xs-6">
                    <label for="end_date">@lang('messages.filter_by_date'):</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                        <input type="text" id="end_date" value="{{@format_date('now')}}" class="form-control" readonly>
                    </div>
            </div>
            @endcomponent
        </div>
    </div>
    <br>
    <div class="box box-solid">
        <div class="box-header print_section">
            <h3 class="box-title">{{session()->get('business.name')}} - @lang( 'account.trial_balance') - <span id="hidden_date">{{@format_date('now')}}</span></h3>
        </div>
        <div class="box-body">
            <table class="table table-border-center-col no-border table-pl-12" id="trial_balance_table">
                <thead>
                    <tr class="bg-gray">
                        <th>@lang('account.trial_balance')</th>
                        <th>@lang('account.debit')</th>
                        <th>@lang('account.credit')</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>@lang('account.supplier_due'):</th>
                        <td>&nbsp;</td>
                        <td>
                            <input type="hidden" id="hidden_supplier_due" class="debit">
                            <span class="remote-data" id="supplier_due">
                                <i class="fas fa-sync fa-spin fa-fw"></i>
                            </span>
                        </td>
                    </tr>
                                                            <tr>
                        <th>ضريبه المبيعات:</th>
                        <td>&nbsp;</td>
                        <td id="staxx"></td>
                    </tr>
                    <tr>
                        <th>@lang('account.customer_due'):</th>
                        <td>
                            <input type="hidden" id="hidden_customer_due" class="credit">
                            <span class="remote-data" id="customer_due">
                                <i class="fas fa-sync fa-spin fa-fw"></i>
                            </span>
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                                                            <tr>
                        <th>ضريبه المشتريات:</th>
                        <td id="phtaxx"></td>
                        <td>&nbsp;</td>
                    </tr>
                                        <tr>
                        <th>المخزون:</th>
                        <td id="stock"></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <th>@lang('account.account_balances'):</th>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                                        <tr>
                        <th>المبيعات:</th>
                        <td>&nbsp;</td>
                        <td id="sall"></td>
                    </tr>
                                                            <tr>
                        <th>تكلفه المشتريات:</th>
                        <td id="ph"></td>
                        <td>&nbsp;</td>
                    </tr>
                </tbody>
                <tbody id="account_balances_details">
                </tbody>
                {{--
                <tbody>
                    <tr>
                        <th>@lang('account.capital_accounts'):</th>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                </tbody>
                <tbody id="capital_account_balances_details"></tbody>
                --}}
                <tfoot>
                    <tr class="bg-gray">
                        <th>@lang('sale.total')</th>
                        <td>
                            <span class="remote-data" id="total_credit">
                                <i class="fas fa-sync fa-spin fa-fw"></i>
                            </span>
                        </td>
                        <td>
                            <span class="remote-data" id="total_debit">
                                <i class="fas fa-sync fa-spin fa-fw"></i>
                            </span>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="box-footer">
            <button type="button" class="btn btn-primary no-print pull-right"onclick="window.print()">
          <i class="fa fa-print"></i> @lang('messages.print')</button>
        </div>
    </div>

</section>
<!-- /.content -->
@stop
@section('javascript')

<script type="text/javascript">
    $(document).ready( function(){
        //Date picker
        $('#end_date').datepicker({
            autoclose: true,
            format: datepicker_date_format
        });
        update_trial_balance();

        $('#end_date').change( function() {
            update_trial_balance();
            $('#hidden_date').text($(this).val());
        });
        $('#trial_bal_location_id').change( function() {
            update_trial_balance();
        });
    });
      

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('-');
}

   async function update_trial_balance(){
                     var total_debit = 0;
                var total_credit = 0;
              var end_date = $('input#end_date').val();
              var mydate = formatDate(end_date);
console.log(formatDate(end_date));
        var location_id = $('#trial_bal_location_id').val()
            var myHeaders = new Headers();
myHeaders.append("Cookie", document.cookie);

var requestOptions = {
  method: 'GET',
  headers: myHeaders,
  redirect: 'follow'
};

  const res = await fetch("https://goldledgers.com/test/public/reports/get-stock-value?location_id="+ location_id +"&category_id=&sub_category_id=&brand_id=&unit_id=", requestOptions);
  const record = await res.json();
      document.getElementById("stock").innerHTML=__currency_trans_from_en(record.closing_stock_by_pp, true);
  
 const ress = await fetch("https://goldledgers.com/test/public/reports/tax-details?draw=1&columns%5B0%5D%5Bdata%5D=transaction_date&columns%5B0%5D%5Bname%5D=transaction_date&columns%5B0%5D%5Bsearchable%5D=true&columns%5B0%5D%5Borderable%5D=true&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=ref_no&columns%5B1%5D%5Bname%5D=ref_no&columns%5B1%5D%5Bsearchable%5D=true&columns%5B1%5D%5Borderable%5D=true&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=contact_name&columns%5B2%5D%5Bname%5D=c.name&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=true&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=tax_number&columns%5B3%5D%5Bname%5D=c.tax_number&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=true&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=total_before_tax&columns%5B4%5D%5Bname%5D=total_before_tax&columns%5B4%5D%5Bsearchable%5D=true&columns%5B4%5D%5Borderable%5D=true&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B5%5D%5Bdata%5D=payment_methods&columns%5B5%5D%5Bname%5D=&columns%5B5%5D%5Bsearchable%5D=false&columns%5B5%5D%5Borderable%5D=false&columns%5B5%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B5%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B6%5D%5Bdata%5D=discount_amount&columns%5B6%5D%5Bname%5D=discount_amount&columns%5B6%5D%5Bsearchable%5D=true&columns%5B6%5D%5Borderable%5D=true&columns%5B6%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B6%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B7%5D%5Bdata%5D=tax_2&columns%5B7%5D%5Bname%5D=&columns%5B7%5D%5Bsearchable%5D=false&columns%5B7%5D%5Borderable%5D=false&columns%5B7%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B7%5D%5Bsearch%5D%5Bregex%5D=false&order%5B0%5D%5Bcolumn%5D=0&order%5B0%5D%5Bdir%5D=asc&start=0&length=25&search%5Bvalue%5D=&search%5Bregex%5D=false&type=purchase&location_id="+ location_id +"&contact_id=&start_date=2022-01-01&end_date="+ mydate +"&_=1665591740244", {
  "headers": {
    "accept": "application/json, text/javascript, */*; q=0.01",
    "accept-language": "en-US,en;q=0.9",
    "sec-ch-ua-mobile": "?0",
    "sec-ch-ua-platform": "\"Linux\"",
    "sec-fetch-dest": "empty",
    "Cookie": document.cookie,
    "sec-fetch-mode": "cors",
    "sec-fetch-site": "same-origin",
    "x-requested-with": "XMLHttpRequest"
  },
  "referrer": "https://goldledgers.com/test/public/reports/tax-report",
  "referrerPolicy": "strict-origin-when-cross-origin",
  "body": null,
  "method": "GET",
  "mode": "cors",
  "credentials": "include"
});
    const recordd = await ress.json();
  var phtax=0;
  for (let i = 0; i < recordd.data.length; i++) {
  phtax += parseFloat(recordd.data[i].tax_amount);
    

}
      document.getElementById("phtaxx").innerHTML=__currency_trans_from_en(phtax, true);
const resss = await fetch("https://goldledgers.com/test/public/reports/tax-details?draw=1&columns%5B0%5D%5Bdata%5D=transaction_date&columns%5B0%5D%5Bname%5D=transaction_date&columns%5B0%5D%5Bsearchable%5D=true&columns%5B0%5D%5Borderable%5D=true&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=invoice_no&columns%5B1%5D%5Bname%5D=invoice_no&columns%5B1%5D%5Bsearchable%5D=true&columns%5B1%5D%5Borderable%5D=true&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=contact_name&columns%5B2%5D%5Bname%5D=c.name&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=true&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=tax_number&columns%5B3%5D%5Bname%5D=c.tax_number&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=true&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=total_before_tax&columns%5B4%5D%5Bname%5D=total_before_tax&columns%5B4%5D%5Bsearchable%5D=true&columns%5B4%5D%5Borderable%5D=true&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B5%5D%5Bdata%5D=payment_methods&columns%5B5%5D%5Bname%5D=&columns%5B5%5D%5Bsearchable%5D=false&columns%5B5%5D%5Borderable%5D=false&columns%5B5%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B5%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B6%5D%5Bdata%5D=discount_amount&columns%5B6%5D%5Bname%5D=discount_amount&columns%5B6%5D%5Bsearchable%5D=true&columns%5B6%5D%5Borderable%5D=true&columns%5B6%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B6%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B7%5D%5Bdata%5D=tax_2&columns%5B7%5D%5Bname%5D=&columns%5B7%5D%5Bsearchable%5D=false&columns%5B7%5D%5Borderable%5D=false&columns%5B7%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B7%5D%5Bsearch%5D%5Bregex%5D=false&order%5B0%5D%5Bcolumn%5D=0&order%5B0%5D%5Bdir%5D=desc&start=0&length=25&search%5Bvalue%5D=&search%5Bregex%5D=false&type=sell&location_id="+ location_id +"&contact_id=&start_date=2022-01-01&end_date="+ mydate +"&_=1665591740245", {
  "headers": {
    "accept": "application/json, text/javascript, */*; q=0.01",
    "accept-language": "en-US,en;q=0.9",
    "sec-ch-ua-mobile": "?0",
    "sec-ch-ua-platform": "\"Linux\"",
    "sec-fetch-dest": "empty",
    "Cookie": document.cookie,
    "sec-fetch-mode": "cors",
    "sec-fetch-site": "same-origin",
    "x-requested-with": "XMLHttpRequest"
  },
  "referrer": "https://goldledgers.com/test/public/reports/tax-report",
  "referrerPolicy": "strict-origin-when-cross-origin",
  "body": null,
  "method": "GET",
  "mode": "cors",
  "credentials": "include"
});
    const recordsd = await resss.json();
  var stax=0;
  for (let i = 0; i < recordsd.data.length; i++) {
  stax += parseFloat(recordsd.data[i].tax_amount);
    

}
      document.getElementById("staxx").innerHTML=__currency_trans_from_en(stax, true);
      const resssp = await fetch("https://goldledgers.com/test/public/reports/items-report?draw=1&columns%5B0%5D%5Bdata%5D=product_name&columns%5B0%5D%5Bname%5D=p.name&columns%5B0%5D%5Bsearchable%5D=true&columns%5B0%5D%5Borderable%5D=true&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=sku&columns%5B1%5D%5Bname%5D=v.sub_sku&columns%5B1%5D%5Bsearchable%5D=true&columns%5B1%5D%5Borderable%5D=true&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=sell_line_note&columns%5B2%5D%5Bname%5D=SL.sell_line_note&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=true&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=purchase_date&columns%5B3%5D%5Bname%5D=purchase.transaction_date&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=true&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=purchase_ref_no&columns%5B4%5D%5Bname%5D=purchase.ref_no&columns%5B4%5D%5Bsearchable%5D=true&columns%5B4%5D%5Borderable%5D=true&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B5%5D%5Bdata%5D=lot_number&columns%5B5%5D%5Bname%5D=PL.lot_number&columns%5B5%5D%5Bsearchable%5D=true&columns%5B5%5D%5Borderable%5D=true&columns%5B5%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B5%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B6%5D%5Bdata%5D=supplier&columns%5B6%5D%5Bname%5D=suppliers.name&columns%5B6%5D%5Bsearchable%5D=true&columns%5B6%5D%5Borderable%5D=true&columns%5B6%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B6%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B7%5D%5Bdata%5D=purchase_price&columns%5B7%5D%5Bname%5D=PL.purchase_price_inc_tax&columns%5B7%5D%5Bsearchable%5D=true&columns%5B7%5D%5Borderable%5D=true&columns%5B7%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B7%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B8%5D%5Bdata%5D=sell_date&columns%5B8%5D%5Bname%5D=&columns%5B8%5D%5Bsearchable%5D=false&columns%5B8%5D%5Borderable%5D=true&columns%5B8%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B8%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B9%5D%5Bdata%5D=sale_invoice_no&columns%5B9%5D%5Bname%5D=sale_invoice_no&columns%5B9%5D%5Bsearchable%5D=true&columns%5B9%5D%5Borderable%5D=true&columns%5B9%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B9%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B10%5D%5Bdata%5D=customer&columns%5B10%5D%5Bname%5D=&columns%5B10%5D%5Bsearchable%5D=false&columns%5B10%5D%5Borderable%5D=true&columns%5B10%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B10%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B11%5D%5Bdata%5D=location&columns%5B11%5D%5Bname%5D=bl.name&columns%5B11%5D%5Bsearchable%5D=true&columns%5B11%5D%5Borderable%5D=true&columns%5B11%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B11%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B12%5D%5Bdata%5D=quantity&columns%5B12%5D%5Bname%5D=&columns%5B12%5D%5Bsearchable%5D=false&columns%5B12%5D%5Borderable%5D=true&columns%5B12%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B12%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B13%5D%5Bdata%5D=selling_price&columns%5B13%5D%5Bname%5D=&columns%5B13%5D%5Bsearchable%5D=false&columns%5B13%5D%5Borderable%5D=true&columns%5B13%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B13%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B14%5D%5Bdata%5D=subtotal&columns%5B14%5D%5Bname%5D=&columns%5B14%5D%5Bsearchable%5D=false&columns%5B14%5D%5Borderable%5D=true&columns%5B14%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B14%5D%5Bsearch%5D%5Bregex%5D=false&order%5B0%5D%5Bcolumn%5D=0&order%5B0%5D%5Bdir%5D=asc&start=0&length=25&search%5Bvalue%5D=&search%5Bregex%5D=false&purchase_start=2022-01-01&purchase_end="+ mydate +"&sale_start=2022-01-01&sale_end="+ mydate +"&supplier_id=&customer_id=&location_id="+ location_id +"&only_mfg_products=0&_=1665601720016", {
  "headers": {
    "accept": "application/json, text/javascript, */*; q=0.01",
    "accept-language": "en-US,en;q=0.9",
    "sec-ch-ua-mobile": "?0",
    "sec-ch-ua-platform": "\"Linux\"",
    "sec-fetch-dest": "empty",
    "Cookie": document.cookie,
    "sec-fetch-mode": "cors",
    "sec-fetch-site": "same-origin",
    "x-requested-with": "XMLHttpRequest"
  },
  "referrer": "https://goldledgers.com/test/public/reports/tax-report",
  "referrerPolicy": "strict-origin-when-cross-origin",
  "body": null,
  "method": "GET",
  "mode": "cors",
  "credentials": "include"
});
    const recordsdp = await resssp.json();
    console.log(recordsdp.data);
  var sp=0;
  var n;
  var z;
  var y;
  for (let i = 0; i < recordsdp.data.length; i++) {
      if(recordsdp.data[i].sale_invoice_no!=null){
           n = recordsdp.data[i].quantity.replace( /(<([^>]+)>)/ig, '')
           n = n.replace( 'Pc(s)', '');
                 y = recordsdp.data[i].purchase_price.replace( /(<([^>]+)>)/ig, '')
     
            z= parseFloat(n) * parseFloat(y)

            //   console.log(y);

  sp += z;
                console.log(sp);

      }
    

}
      const repss = await fetch("https://goldledgers.com/test/public/reports/purchase-sell?start_date=2022-01-01&end_date="+ mydate +"&location_id="+ location_id , {
  "headers": {
    "accept": "application/json, text/javascript, */*; q=0.01",
    "accept-language": "en-US,en;q=0.9",
    "sec-ch-ua-mobile": "?0",
    "sec-ch-ua-platform": "\"Linux\"",
    "sec-fetch-dest": "empty",
    "Cookie": document.cookie,
    "sec-fetch-mode": "cors",
    "sec-fetch-site": "same-origin",
    "x-requested-with": "XMLHttpRequest"
  },
  "referrer": "https://goldledgers.com/test/public/reports/tax-report",
  "referrerPolicy": "strict-origin-when-cross-origin",
  "body": null,
  "method": "GET",
  "mode": "cors",
  "credentials": "include"
});
    const recordpd = await repss.json();
//   var stax=0;
//   for (let i = 0; i < recordsd.data.length; i++) {
//   stax += parseFloat(recordsd.data[i].tax_amount);
    

// }
      document.getElementById("sall").innerHTML=__currency_trans_from_en(recordpd.sell.total_sell_exc_tax, true);
      document.getElementById("ph").innerHTML= __currency_trans_from_en(sp, true) ;
        var loader = '<i class="fas fa-sync fa-spin fa-fw"></i>';
        $('span.remote-data').each( function() {
            $(this).html(loader);
        });

        $('table#trial_balance_table tbody#capital_account_balances_details').html('<tr><td colspan="3"><i class="fas fa-sync fa-spin fa-fw"></i></td></tr>');
        $('table#trial_balance_table tbody#account_balances_details').html('<tr><td colspan="3"><i class="fas fa-sync fa-spin fa-fw"></i></td></tr>');

 
        $.ajax({
            url: "{{action('AccountReportsController@trialBalance')}}?end_date=" + end_date + '&location_id=' + location_id,
            dataType: "json",
            success: function(result){
                $('span#supplier_due').text(__currency_trans_from_en(result.supplier_due, true));
                __write_number($('input#hidden_supplier_due'), result.supplier_due);

                $('span#customer_due').text(__currency_trans_from_en(result.customer_due, true));
                __write_number($('input#hidden_customer_due'), result.customer_due);

                var account_balances = result.account_balances;
                $('table#trial_balance_table tbody#account_balances_details').html('');
                for (var key in account_balances) {
                    var accnt_bal = __currency_trans_from_en(result.account_balances[key]);
                    var accnt_bal_with_sym = __currency_trans_from_en(result.account_balances[key], true);
                    var account_tr = '<tr><td class="pl-20-td">' + key + ':</td><td><input type="hidden" class="credit" value="' + accnt_bal + '">' + accnt_bal_with_sym + '</td><td>&nbsp;</td></tr>';
                    $('table#trial_balance_table tbody#account_balances_details').append(account_tr);
                }

                var capital_account_details = result.capital_account_details;
                $('table#trial_balance_table tbody#capital_account_balances_details').html('');
                for (var key in capital_account_details) {
                    var accnt_bal = __currency_trans_from_en(result.capital_account_details[key]);
                    var accnt_bal_with_sym = __currency_trans_from_en(result.capital_account_details[key], true);
                    var account_tr = '<tr><td class="pl-20-td">' + key + ':</td><td><input type="hidden" class="credit" value="' + accnt_bal + '">' + accnt_bal_with_sym + '</td><td>&nbsp;</td></tr>';
                    $('table#trial_balance_table tbody#capital_account_balances_details').append(account_tr);
                }

console.log(this);
                $('input.debit').each( function(){
                    total_debit += __read_number($(this));
                                        
                    // total_debit += parseFloat(recordpd.purchase.total_purchase_exc_tax);

                });
                $('input.credit').each( function(){
                    total_credit += __read_number($(this));
                                        console.log("1:"+total_credit);

                                                            console.log("2:"+total_credit);

                    
                    

                });
                    total_credit += phtax;
 total_credit += parseFloat(record.closing_stock_by_pp);
                    total_credit += sp;
                    total_debit += parseFloat(recordpd.sell.total_sell_exc_tax);
                    total_debit += stax;
                $('span#total_debit').text(__currency_trans_from_en(total_debit, true));
                $('span#total_credit').text(__currency_trans_from_en(total_credit, true));
            }
        });
    }


</script>

@endsection