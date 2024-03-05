<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.0/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/js/bootstrap-select.min.js"></script>


    <!-- Include jQuery UI library -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


    <style>
        body {
            font-family: "Roboto", "Segoe UI", Tahoma, Helvetica, "Open Sans", arial,
                serif !important;
            background-color: #e4ebf2 !important;
        }

        .main-border-color {
            border-color: #e9ecef;
            border-style: solid;
            border-width: 1px;
        }

        .font-weight-bold {
            font-weight: 700;
        }

        .pointer {
            cursor: pointer;
        }

        #journal-table-new {
            margin: 25px 0;
            width: 100%;
        }

        .journal-table-main-cell {
            padding: 20px 10px;
            text-align: right;
            background-color: #f6f9fc;
            color: #75799d;
        }

        .angel-table-icon {
            color: #b5b7c9;
            cursor: pointer;
            transition: all 0.3 ease-in-out;
        }

        .angel-table-icon:hover {
            box-shadow: 0 0 0 1px #28a745 inset;
        }

        .journal-table-yellow-cell {
            border-right: 1px solid #e9ecef;
            background-color: #fff9db;
        }

        tr:hover .angel-table-icon {
            color: #28a745 !important;
        }

        #journal-table-new tr {
            border-bottom: 1px solid #e9ecef;
        }

        .font-size-sm {
            font-size: 12px;
        }

        #journal-table-new .item-name-td {
            width: 300px;
            min-width: 300px !important;
            max-width: 300px;
        }

        #journal-table-new .cost-center-cell {
            min-width: 200px !important;
        }

        #journal-table-new .item-taxes-td {
            width: 150px;
            min-width: 150px !important;
            max-width: 150px;
        }

        table>tbody>tr>td.td_editable>div>span>input[type="number"]:active,
        table>tbody>tr>td.td_editable>div>span>input[type="number"]:focus,
        table>tbody>tr>td.td_editable>div>span>input[type="number"]:hover,
        table>tbody>tr>td.td_editable>div>span>input[type="text"]:active,
        table>tbody>tr>td.td_editable>div>span>input[type="text"]:focus,
        table>tbody>tr>td.td_editable>div>span>input[type="text"]:hover,
        table>tbody>tr>td.td_editable>div>span>select:active,
        table>tbody>tr>td.td_editable>div>span>select:focus,
        table>tbody>tr>td.td_editable>div>span>select:hover,
        table>tbody>tr>td.td_editable>div>span>textarea.editable-area:active,
        table>tbody>tr>td.td_editable>div>span>textarea.editable-area:focus,
        table>tbody>tr>td.td_editable>div>span>textarea.editable-area:hover,
        table>tbody>tr>td.td_editable>div>span>textarea:active,
        table>tbody>tr>td.td_editable>div>span>textarea:focus,
        table>tbody>tr>td.td_editable>div>span>textarea:hover,
        table>tbody>tr>td.td_editable>input[type="number"]:active,
        table>tbody>tr>td.td_editable>input[type="number"]:focus,
        table>tbody>tr>td.td_editable>input[type="number"]:hover,
        table>tbody>tr>td.td_editable>input[type="text"]:active,
        table>tbody>tr>td.td_editable>input[type="text"]:focus,
        table>tbody>tr>td.td_editable>input[type="text"]:hover,
        table>tbody>tr>td.td_editable>select:active,
        table>tbody>tr>td.td_editable>select:focus,
        table>tbody>tr>td.td_editable>select:hover,
        table>tbody>tr>td.td_editable>textarea:active,
        table>tbody>tr>td.td_editable>textarea:focus,
        table>tbody>tr>td.td_editable>textarea:hover {
            box-shadow: 0 0 0 1px #00b0ef inset;
            outline: 0;
        }

        #journal-table-new tbody>tr>td.td_editable>textarea {
            min-width: 100px;
            min-height: 100%;
            margin: 0 !important;
            display: block;
            background-color: transparent;
            padding: 6px 12px;
            min-width: 55px;
            padding: 0 4px;
            overflow: hidden;
            line-height: 17px;
            height: 45px;
            resize: none;
            background: 0 0;
            margin: 0;
            font-size: 12px;
            border: 0;
            padding: 10px;
            color: rgb(65, 65, 65);
        }

        .delete-cell {
            padding: 0px 10px !important;
            cursor: pointer;
        }

        table>tbody>tr>td.delete-cell:hover {
            box-shadow: 0 0 0 1px #fc5f7d inset;
        }

        tbody>tr>td.td_editable>input {
            height: 65px;
            margin: 0;
            display: block;
            width: 100%;
            background-color: transparent;
            border: 0;
            padding: 6px 12px;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }

        .item-name {
            width: 100%;
            zoom: 1;
            display: block;
            height: 100%;
            position: relative;
        }

        .item-wrap {
            position: relative;
            zoom: 1;
            display: block;
            height: 100%;
            height: 100%;
            position: relative;
        }

        table>tbody>tr>td.td_editable .item-wrap select {
            height: 65px;
            margin: 0;
            display: block;
            width: 100%;
            background-color: transparent !important;
            border: 0;
            padding: 6px 12px;
        }

        .dropdown-toggle {
            border: 0 !important;
        }

        .selectpicker,
        .bootstrap-select,
        .dropdown-toggle {
            background-color: transparent !important;
        }

        .bootstrap-select {
            box-shadow: none !important;
        }

        .bootstrap-select .dropdown-toggle:focus {
            outline: none !important;
            box-shadow: none !important;
        }

        table .bootstrap-select {
            border-radius: 0;
        }

        table .bootstrap-select:hover {
            box-shadow: 0 0 0 1px #00b0ef inset !important;
        }

        .bootstrap-select {
            height: 65px;
            width: 100% !important;
        }

        .dropdown-toggle {
            height: 100%;
        }

        .dropdown-toggle .filter-option {
            display: flex;
            align-items: center;
        }

        .bootstrap-select .dropdown-toggle .caret {
            right: 90%;
        }

        .dropdown-toggle::after {
            display: none;
        }

        .bootstrap-select .dropdown-menu {
            text-align: right;
        }

        .bootstrap-select .dropdown-item {
            padding-block: 10px;
            font-weight: 600;
        }

        #AddItem {
            padding: 18px 45px !important;
            width: 75%;
            font-size: 18px;
            background-color: transparent;
            border: none;
            border-left: 1px solid #e9ecef;
        }

        #AddItem:hover {
            color: #313451 !important;
            background-color: #d9e6f2;
        }

        .table-controller .bootstrap-select {
            width: 25% !important;
        }

        .table-controller .bootstrap-select .dropdown-toggle .caret {
            right: 50%;
            transform: translateX(50%);
        }

        .table-controller .filter-option-inner {
            display: none;
        }

        .dropup .dropdown-toggle::after {
            display: none;
        }

        .tblHdr .bootstrap-select .dropdown-toggle .filter-option {
            display: flex;
            justify-content: start;
            align-items: center;
        }

        .description_journal {
            background: #fff;
            padding: 15px 15px 5px 15px;
            border: 1px solid #ddd;
        }

        .tblHdr .journal-table-main-cell {
            background-color: #fff;
        }

        /* ====================UPLOAD======================= */

        .uploadOuter {
            text-align: center;
            padding: 20px;
        }

        .uploadOuter strong {
            padding: 0 10px;
        }

        .dragBox {
            width: 100%;
            height: 100%;
            margin: 0 auto;
            position: relative;
            text-align: center;
            font-weight: bold;
            line-height: 95px;
            color: #999;
            border: 2px dashed #ccc;
            display: inline-block;
            transition: transform 0.3s;
        }

        .dragBox input[type="file"] {
            position: absolute;
            height: 100%;
            width: 100%;
            opacity: 0;
            top: 0;
            left: 0;
        }

        .draging {
            transform: scale(1.1);
        }

        #preview {
            text-align: center;
        }

        #preview img {
            max-width: 100%;
        }
    </style>
</head>

<body>


    <div class="container-fluid my-5">
        
        <div class="row m-0">
            <div class="col-lg-6" dir="rtl">
                <div class="description_journal">
                    <div class="form-group">
                        {!! Form::open(['url' => action('JournalEntriesController@store'), 'method' => 'post', 'id' => 'journal_entries_form' ]) !!}
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">@lang( 'messages.save' )</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
                        </div>
                        <label for="JournalHdrDescription">الوصف</label>
                        <textarea class="form-control journalDescription" id="JournalHdrDescription"  rows="2" style="height: 99px;"></textarea>
                    </div>
                  
                    <div class="form-group">
                        <label for="JournalHdrDescription">المرفقات</label>
                        <div class="uploadOuter">
                            <span class="dragBox">
                                <div class="d-flex justify-content-between">
                                    <span class="me-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="33.002" height="44.003"
                                            viewBox="0 0 33.002 44.003">
                                            <path
                                                d="M33-47.27a2.369,2.369,0,0,0-.6-1.459L23.98-57.146a2.37,2.37,0,0,0-1.459-.6H22v11H33ZM21.314-44a2.069,2.069,0,0,1-2.063-2.063V-57.75H2.063A2.063,2.063,0,0,0,0-55.687V-15.81a2.063,2.063,0,0,0,2.063,2.063H30.939A2.063,2.063,0,0,0,33-15.81V-44ZM9.672-42.624A4.125,4.125,0,0,1,13.8-38.5a4.125,4.125,0,0,1-4.125,4.125A4.125,4.125,0,0,1,5.547-38.5,4.125,4.125,0,0,1,9.672-42.624ZM27.548-22h-22l.042-4.167,3.4-3.4a.983.983,0,0,1,1.417.042l3.4,3.4,8.9-8.9a1.031,1.031,0,0,1,1.459,0l3.4,3.4Z"
                                                transform="translate(0 57.75)" fill="#e4ebf2"></path>
                                        </svg>
                                    </span>
                                    <span class="d-flex justify-content-center align-items-center">
                                        <span class="mx-2"><i
                                                class="fa-solid fa-cloud-arrow-up text-primary fa-2x"></i></span>
                                        <p>
                                            <span>&nbsp;افلت الملف هنا او&nbsp;</span>
                                            <span class="text-primary">اختر من جهازك</span>
                                        </p>
                                    </span>
                                    <span></span>
                                </div>
                                <input type="file" onChange="dragNdrop(event)" ondragover="drag()" ondrop="drop()"
                                    id="uploadFile" class="pointer" />
                            </span>
                        </div>
                        <div id="preview"></div>

                    </div>
                </div>
            </div>

            <div class="col-lg-6 tblHdr">
                <table class="w-100" dir="rtl">
                    <tbody>
                        <tr class="border main-border-color">
                            <td class="journal-table-main-cell text-center font-weight-bold" width="20%">
                                التاريخ
                            </td>
                            <td class="journal-table-main-cell td_editable border main-border-color p-0">
                                <label for="entry_date">entry_date</label>
                                <input name="entry_date" id="entry_date" type="text" autocomplete="entry_date" >                            </td>
                        </tr>
                        <tr class="border main-border-color">
                            <td class="journal-table-main-cell text-center font-weight-bold" width="20%">
                                العملة
                            </td>
                            <td class="journal-table-main-cell border main-border-color p-0">
                                <select class="selectpicker form-control" title="من فضلك أختر" data-live-search="true">
                                    <option>جنية مصري</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="border main-border-color">
                            <td class="journal-table-main-cell text-center font-weight-bold" width="20%">
                                رقم
                            </td>
                            <td class="journal-table-main-cell td_editable border main-border-color p-0">
                                <input type="number">
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="col-12">
                <table dir="rtl" id="journal-table-new">
                    <thead>
                        <th class="journal-table-main-cell"></th>
                        <th class="journal-table-main-cell pe-3 item-name-td" width="35%">
                            اسم الحساب <span class="text-danger">*</span>
                        </th>
                        <th class="journal-table-main-cell pe-3" width="35%">
                            الوصف
                        </th>
                        <th class="journal-table-main-cell pe-3 cost-center-cell" width="15%">
                            مركز التكلفة
                        </th>
                        <th class="journal-table-main-cell pe-3 item-taxes-td" width="15%">
                            الضرائب
                        </th>
                        <th class="journal-table-main-cell pe-3" width="10%">
                            مدين <span class="text-danger">*</span>
                        </th>
                        <th class="journal-table-main-cell pe-3" width="10%">
                            دائن <span class="text-danger">*</span>
                        </th>
                        <th class="journal-table-main-cell"></th>
                    </thead>
                    <tbody id="journal-table-dtl">

                        <tr>
                            <td class="journal-table-main-cell text-center font-size-sm angel-table-icon">
                                <i class="fa-solid fa-angles-down"></i>
                            </td>
                            <td class="journal-table-yellow-cell td_editable">
                                <select name="account_id" class="selectpicker form-control" title="من فضلك أختر"
                                    data-live-search="true">
                                    <optgroup label="Currently Selected">
                                        <option selected>من فضلك أختر</option>
                                    </optgroup>
                                    <option data-divider="true"></option>
                                    <option disabled>Start typing a search query</option>

                                    @foreach ($accounts as $account)
                                        <option value="{{ $account->id }}">{{ $account->name }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <   <td class="journal-table-yellow-cell td_editable" width="35%">
                                <textarea name="description" rows="2" style="overflow: hidden; height: 65px;width: 100%;"></textarea>
                            </td>
                            <td class="journal-table-yellow-cell td_editable" width="15%">
                                <select name="costcenter_id" class="selectpicker cost-center-select form-control" style="font-weight: 700;" title="لا شئ" data-icon-base="fa-solid">

                                        @foreach ($costCenters as $costCenter)
                                            <option value="{{ $costCenter->id }}">{{ $costCenter->name }}</option>
                                        @endforeach
                                        <option value="0" style="background-color: #00b0ef;color:#fff"
                                            data-icon="fa-code-branch">
                                            متعدد</option>
                                    </select>
                                </td>

                                <td class="journal-table-yellow-cell td_editable">
                                    <select name="tax_rates_id" class="selectpicker form-control" title="-">
                                        @foreach ($taxRates as $taxRate)
                                            <option value="{{ $taxRate->id }}">{{ $taxRate->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="journal-table-yellow-cell td_editable">
                                    <input name="total_debit" type="number">
                                </td>
                                <td class="journal-table-yellow-cell td_editable">
                                    <input name="total_credit" type="number">
                                </td>
                                <td class="journal-table-main-cell p-0 text-center delete-cell">
                                    <a class="text-reset px-3">
                                        <i class="fa-solid fa-circle-minus text-danger"></i>
                                    </a>
                                </td>
                        </tr>
                        
                        {!! Form::close() !!}
                    </tbody>

                    <tbody>
                        <tr>
                            <td class="journal-table-main-cell td_editable p-0" colspan="2">
                                <div class="d-flex table-controller">
                                    <button id="AddItem"
                                        class="add-row py-0 py-lg-3 d-flex align-items-center px-5 my-0 fs-14 btn-s2020 btn-light-s2020 text-dark-blue s2020 font-weight-bold add-new-btng">
                                        <i class="fa-solid fa-circle-plus text-primary mx-4"></i>
                                        إضافة
                                    </button>
                                    <select class="selectpicker form-control" title=".">
                                        <option title=".">نسخ من جدول البيانات</option>
                                    </select>
                                </div>
                            </td>
                            <td>
                            </td>
                            <td>
                            </td>
                            <td class="journal-table-main-cell">
                                <strong>الإجمالي</strong>
                            </td>
                            <td class="journal-table-main-cell" style="border-right: 1px solid #e9ecef;">
                                0
                            </td>
                            <td class="journal-table-main-cell" style="border-right: 1px solid #e9ecef;">
                                0
                            </td>
                            <td class="journal-table-main-cell" style="border-right: 1px solid #e9ecef;">

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    

    <script>
        $(function() {
            $('select').selectpicker();
            $("#datepicker").datepicker({
                dateFormat: "yy-mm-dd",
                showOtherMonths: true,
                selectOtherMonths: true,
                changeMonth: true,
                changeYear: true
            });

            $("#AddItem").click(function() {
                $("#journal-table-dtl").append(getJournalTableDtlRow())
                $('select').selectpicker();
            });

            function getJournalTableDtlRow() {
                return `
              <tr>
                          <td class="journal-table-main-cell text-center font-size-sm angel-table-icon">
                              <i class="fa-solid fa-angles-down"></i>
                          </td>
                          <td colspan="7">
                              <table class="w-100">
                                  <tbody>
                                      <tr>
                                          <td class="journal-table-yellow-cell td_editable" width="15%">
                                              <select name="account_id" class="selectpicker form-control" title="من فضلك أختر"
                                                  data-live-search="true">
                                                  <optgroup label="Currently Selected">
                                                      <option selected>من فضلك أختر</option>
                                                      @foreach ($accounts as $account)
                                      <option value="{{ $account->id }}">{{ $account->name }}</option>
                                  @endforeach
                                                  </optgroup>
                                                  <option data-divider="true"></option>
                                                  <option disabled>Start typing a search query</option>
                                              </select>
                                          </td>
                                          <td class="journal-table-yellow-cell td_editable" width="35%">
                                              <textarea rows="2"
                                                  style="overflow: hidden; height: 65px;width: 100%;"></textarea>
                                          </td>
                                          <td class="journal-table-yellow-cell td_editable" width="15%">
                                              <select class="selectpicker cost-center-select form-control"
                                                  style="font-weight: 700;" title="لا شئ" data-icon-base="fa-solid">
                                                  @foreach ($costCenters as $costCenter)
          <option value="{{ $costCenter->id }}">{{ $costCenter->name }}</option>
      @endforeach
                                                  <option value="0" style="background-color: #00b0ef;color:#fff"
                                                      data-icon="fa-code-branch">
                                                      متعدد</option>
                                              </select>
                                          </td>
                                          <td class="journal-table-yellow-cell td_editable" width="15%">
    <select class="selectpicker form-control" title="-">
        @foreach ($taxRates as $taxRate)
            <option value="{{ $taxRate->id }}">{{ $taxRate->name }}</option>
        @endforeach
    </select>
</td>

                                          <td class="journal-table-yellow-cell td_editable" width="10%">
                                              <input type="number">
                                          </td>
                                          <td class="journal-table-yellow-cell td_editable" width="10%">
                                              <input type="number">
                                          </td>
                                          <td class="journal-table-main-cell p-0 text-center delete-cell" onclick="deleteJournalTableDtlRow(this)">
                                              <a class="text-reset px-3">
                                                  <i class="fa-solid fa-circle-minus text-danger"></i>
                                              </a>
                                          </td>
                                      </tr>
                                  </tbody>
                              </table>
                          </td>
                      </tr>
              `
            }

            function getMultipleCostCenter() {
                return `
              <table>
                                  <thead>
                                      <tr>
                                          <th class="journal-table-main-cell pe-3 item-name-td py-4" width="15%">
                                              مركز التكلفة
                                          </th>
                                          <th class="journal-table-main-cell pe-3 py-4" width="15%">
                                              نسبة مئوية
                                          </th>
                                          <th class="journal-table-main-cell pe-3 cost-center-cell py-4" width="15%">
                                              المبلغ
                                          </th>
                                          <td class="journal-table-main-cell p-0 text-center pointer"
                                              onclick="deleteCostCenterTable(this)" style="background-color: #fc5f7d"
                                              width="3%">
                                              <a class="text-reset px-3">
                                                  <i class="fa-regular fa-circle-xmark text-white"></i>
                                              </a>
                                          </td>
                                          <th width="50%">

                                          </th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr class="multiple-cost-center-row">
                                          <td class="journal-table-white-cell td_editable" width="15%">
                                              <select class="selectpicker form-control" title="من فضلك أختر"
                                                  data-live-search="true">
                                                  <optgroup label="Currently Selected">
                                                      <option selected>من فضلك أختر</option>
                                                      @foreach ($costCenters as $costCenter)
          <option value="{{ $costCenter->id }}">{{ $costCenter->name }}</option>
      @endforeach
                                                  </optgroup>
                                                  <option data-divider="true"></option>
                                                  <option disabled>Start typing a search query</option>
                                              </select>
                                          </td>
                                          <td class="journal-table-white-cell td_editable d-flex justify-content-between align-items-center w-100"
                                              width="15%">
                                              <input type="number">
                                              <span class="px-3 text-muted">%</span>
                                          </td>
                                          <td class="journal-table-white-cell td_editable" width="15%">
                                              <input type="number">
                                          </td>
                                          <td class="journal-table-main-cell p-0 text-center delete-cell" width="3%"
                                              onclick="deleteCostCenterRow(this)">
                                              <a class="text-reset px-3">
                                                  <i class="fa-solid fa-circle-minus text-danger"></i>
                                              </a>
                                          </td>
                                          <td width="50%">
                                          </td>
                                      </tr>
                                  </tbody>
                                  <tbody>
                                      <tr class="multiple-cost-center-row CostCenterFooter">
                                          <td class="journal-table-main-cell td_editable p-0 CostCenterFooterBtn">
                                              <div class="d-flex table-controller justify-content-between px-3">
                                                  <button class="d-flex align-items-center px-5 my-0 AddNewCostCenter"
                                                      onclick="addNewCostCenterRow(this)">
                                                      <i class="fa-solid fa-circle-plus text-success mx-4"></i>
                                                      أضافة مركز تكلفة
                                                  </button>
                                                  <h6 style="font-weight: bold"> الإجمالي </h6>
                                              </div>
                                          </td>
                                          <td class="journal-table-main-cell td_editable py-3" width="15%">
                                              0
                                          </td>
                                          <td class="journal-table-main-cell td_editable py-3"
                                              style="border-right: 1px solid #e9ecef;" width="15%">
                                              0
                                          </td>
                                          <td class="journal-table-main-cell p-0 text-center">

                                          </td>
                                          <td width="50%">
                                          </td>
                                      </tr>

                                  </tbody>
                              </table>
              `
            }

            $(document).on('change', 'select.cost-center-select', function(e) {
                if (e.target.value == 0) {
                    $(e.target).attr({
                        'disabled': true
                    })
                    $('.selectpicker').selectpicker('refresh');
                    $($(e.target).closest('table')).after(getMultipleCostCenter())
                    $('select').selectpicker();
                }
            });

        });

        function getCostCenterRow() {
            return `
              <tr class="multiple-cost-center-row">
                                          <td class="journal-table-white-cell td_editable" width="15%">
                                              <select class="selectpicker form-control" title="من فضلك أختر"
                                                  data-live-search="true">
                                                  <optgroup label="Currently Selected">
                                                      <option selected>من فضلك أختر</option>
                                                  </optgroup>
                                                  <option data-divider="true"></option>
                                                  <option disabled>Start typing a search query</option>
                                              </select>
                                          </td>
                                          <td class="journal-table-white-cell td_editable d-flex justify-content-between align-items-center w-100"
                                              width="15%">
                                              <input type="number">
                                              <span class="px-3 text-muted">%</span>
                                          </td>
                                          <td class="journal-table-white-cell td_editable" width="15%">
                                              <input type="number">
                                          </td>
                                          <td class="journal-table-main-cell p-0 text-center delete-cell" width="3%"
                                              onclick="deleteCostCenterRow(this)">
                                              <a class="text-reset px-3">
                                                  <i class="fa-solid fa-circle-minus text-danger"></i>
                                              </a>
                                          </td>
                                          <td width="50%">
                                          </td>
                                      </tr>
              `
        }


        function deleteJournalTableDtlRow(row) {
            $($(row).closest('table')).closest('tr').remove();
        }

        function deleteCostCenterTable(row) {
            const selectElement = $(row).closest('table').prev().find('.cost-center-select');
            $(selectElement[0]).removeClass("disabled");
            $(selectElement[1]).removeAttr("disabled");
            $(row).closest('table').remove();
            $('.selectpicker').selectpicker('refresh');
        }

        function deleteCostCenterRow(row) {
            $(row).closest('tr').remove();
        }

        function addNewCostCenterRow(e) {
            const lastRow = $(e).closest('tbody').prev().find("tr:last")
            if (lastRow.length) {
                $(lastRow).after(getCostCenterRow())
            } else {
                $(e).closest('tbody').prev().append(getCostCenterRow())
            }
            $('select').selectpicker();
        }
    </script>

    <script>
        function dragNdrop(event) {
            var fileName = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("preview");


            if (event.target.files[0].type.startsWith('image/')) {
                var previewImg = document.createElement("img");
                previewImg.style.width = "250px";
                previewImg.setAttribute("src", fileName);
                preview.innerHTML = "";
                preview.appendChild(previewImg);
            } else {
                var fileLink = document.createElement("a");
                fileLink.setAttribute("href", fileName);
                fileLink.setAttribute("target", "_blank");
                fileLink.textContent = "View File: " + event.target.files[0].name;
                preview.innerHTML = "";
                preview.appendChild(fileLink);
            }
        }

        function drag() {
            document.getElementById('uploadFile').parentNode.className = 'draging dragBox';
        }

        function drop() {
            document.getElementById('uploadFile').parentNode.className = 'dragBox';
        }
    </script>
</body>

</html>
