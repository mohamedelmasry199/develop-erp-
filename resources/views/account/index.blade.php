@extends('layouts.app')
@section('title', __('lang_v1.payment_accounts'))

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('lang_v1.payment_accounts')
            <small>@lang('account.manage_your_account')</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        @if (!empty($not_linked_payments))
            <div class="row">
                <div class="col-sm-12">
                    <div class="alert alert-danger">
                        <ul>
                            @if (!empty($not_linked_payments))
                                <li>{!! __('account.payments_not_linked_with_account', ['payments' => $not_linked_payments]) !!} <a
                                        href="{{ action('AccountReportsController@paymentAccountReport') }}">@lang('account.view_details')</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        @endif
        @can('account.access')
            <div class="row">
                <div class="col-sm-12">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#other_accounts" data-toggle="tab">
                                    <i class="fa fa-book"></i> <strong>@lang('account.accounts')</strong>
                                </a>
                            </li>
                            {{--
                    <li>
                        <a href="#capital_accounts" data-toggle="tab">
                            <i class="fa fa-book"></i> <strong>
                            @lang('account.capital_accounts') </strong>
                        </a>
                    </li>
                    --}}
                            <li>
                                <a href="#account_types" data-toggle="tab">
                                    <i class="fa fa-list"></i> <strong>
                                        @lang('lang_v1.account_types') </strong>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="other_accounts">
                                <div class="row">
                                    <div class="col-md-12">
                                        @component('components.widget')
                                            <div class="col-md-4">
                                                {!! Form::select(
                                                    'account_status',
                                                    ['active' => __('business.is_active'), 'closed' => __('account.closed')],
                                                    null,
                                                    ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'account_status'],
                                                ) !!}
                                            </div>
                                            <div class="col-md-8">
                                                <button type="button" class="btn btn-primary btn-modal pull-right"
                                                    data-container=".account_model"
                                                    data-href="{{ action('AccountController@create') }}">
                                                    <i class="fa fa-plus"></i> @lang('messages.add')</button>
                                            </div>
                                        @endcomponent
                                    </div>
                                    <div class="col-sm-12">
                                        <br>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped" id="other_account_table">
                                                <thead>
                                                    <tr>
                                                        <th>@lang('lang_v1.name')</th>
                                                        <th>@lang('lang_v1.account_type')</th>
                                                        <th>@lang('lang_v1.account_sub_type')</th>
                                                        <th>@lang('account.account_number')</th>
                                                        <th>@lang('brand.note')</th>
                                                        <th>@lang('lang_v1.balance')</th>
                                                        <th>@lang('lang_v1.account_details')</th>
                                                        <th>@lang('lang_v1.added_by')</th>
                                                        <th>@lang('messages.action')</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr class="bg-gray font-17 footer-total text-center">
                                                        <td colspan="5"><strong>@lang('sale.total'):</strong></td>
                                                        <td class="footer_total_balance"></td>
                                                        <td colspan="3"></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--
                    <div class="tab-pane" id="capital_accounts">
                        <table class="table table-bordered table-striped" id="capital_account_table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>@lang( 'lang_v1.name' )</th>
                                    <th>@lang('account.account_number')</th>
                                    <th>@lang( 'brand.note' )</th>
                                    <th>@lang('lang_v1.balance')</th>
                                    <th>@lang( 'messages.action' )</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    --}}
                            <style>
                                .toggle-button.closed i::before {
                                    content: "\f07b";
                                    /* Font Awesome closed folder icon */
                                }

                                .toggle-button.opened i::before {
                                    content: "\f07c";
                                    /* Font Awesome opened folder icon */
                                }
                            </style>
                            <div class="tab-pane" id="account_types">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-primary btn-modal pull-right"
                                            data-href="{{ action('AccountTypeController@create') }}"
                                            data-container="#account_type_modal">
                                            <i class="fa fa-plus"></i> @lang('messages.add')</button>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-striped table-bordered" id="account_types_table"
                                            style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>@lang('lang_v1.name')</th>
                                                    <th>@lang('messages.action')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
    function renderAccountTypes($account_types, $mainButtonAdded = array(), $level = 0, $encounteredNames = array())
{
    foreach ($account_types as $account_type) {
        ?>
                                                <div class="MuiTreeItem-root Mui-expanded">
                                                    <div class="MuiTreeItem-content">
                                                        <?php
                                                        if ($level > 0) {
                                                            echo str_repeat('&nbsp;&nbsp;&nbsp;', $level - 1);
                                                        
                                                            if ($account_type->sub_types) {
                                                                echo '|-- ';
                                                            }
                                                        }
                                                        ?>
                                                        <span class="toggle-button closed"
                                                            data-account-type="{{ $account_type->account_type }}">
                                                            @if ($account_type->account_type == 'main')
                                                                <a href="javascript:void(0);" class="toggle-main">
                                                                    <i class="fas fa-folder"></i>
                                                                </a>
                                                            @else
                                                                <i class="far fa-file"></i>
                                                            @endif
                                                            <?php
                                                            // Check if it is both a parent and a sub-type
                                                            if ($account_type->account_type == 'sub') {
                                                                $name = $account_type->name;
                                                                if (in_array($name, $encounteredNames)) {
                                                                    // Display a small arrow for operations
                                                                    echo '<i class="fas fa-arrow-right"></i>';
                                                                } else {
                                                                    // Display a link for editing
                                                                    echo '<a href="' . action('CostCenterController@show', ['parent_id' => $account_type->id]) . '">' . $name . '</a>';
                                                                    $encounteredNames[] = $name;
                                                                }
                                                            } else {
                                                                // Display the name for non-sub types
                                                                echo '<a href="javascript:void(0);" class="toggle-main">' . $account_type->name . '</a>';
                                                            }
                                                            ?>
                                                        </span>
                                                    </div>
                                                    <div class="MuiCollapse-container MuiTreeItem-group">
                                                        {!! Form::open(['url' => action('AccountTypeController@destroy', $account_type->id), 'method' => 'delete']) !!}
                                                        <button type="button" class="btn btn-primary btn-modal btn-xs"
                                                            data-href="{{ action('AccountTypeController@edit', ['parent_id' => $account_type->id]) }}"
                                                            data-container="#account_type_modal">
                                                            <i class="fa fa-edit"></i> Edit
                                                        </button>

                                                        <button type="submit"
                                                            class="btn btn-danger btn-xs delete_account_type">
                                                            <i class="fa fa-trash"></i> Delete
                                                        </button>


                                                        {{-- <button type="button" class="btn btn-danger btn-xs delete_account_type">
                                                            <i class="fa fa-trash"></i> Delete
                                                        </button> --}}

                                                        <?php
                    if ($account_type->account_type == 'main' && !isset($mainButtonAdded[$account_type->id])) {
                        // Add a button for creating sub-child for main rows
                        ?>
                                                        <button type="button" class="btn btn-success btn-xs create_sub_child"
                                                            data-parent-id="{{ $account_type->id }}">
                                                            <a
                                                                href="{{ action('AccountTypeController@createSub', ['parent_id' => $account_type->id]) }}">
                                                                <i class="fa fa-plus"></i> Create Sub-Child
                                                            </a>
                                                        </button>


                                                        <?php
                        $mainButtonAdded[$account_type->id] = true;
                    }
                    ?>
                                                        {!! Form::close() !!}

                                                        <?php
                                                        if (!empty($account_type->sub_types)) {
                                                            // Recursive call for sub-types with increased level
                                                            renderAccountTypes($account_type->sub_types, $mainButtonAdded, $level + 1);
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <?php
        }
    }
    ?>
                                               {{-- Call the recursive function with the top-level account types --}}
                                                @foreach ($account_types as $account_type)
                                                    <?php renderAccountTypes([$account_type]); ?>
                                                @endforeach

                                                <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

                                                <script>
                                                    $(document).ready(function() {
                                                        // Attach click event to toggle buttons
                                                        $('.MuiTreeItem-root .toggle-button').click(function() {
                                                            var toggleButton = $(this);
                                                            var container = toggleButton.closest('.MuiTreeItem-root').find('.MuiCollapse-container');

                                                            container.toggle();

                                                            // Toggle the class based on the current state
                                                            if (container.is(':visible')) {
                                                                toggleButton.removeClass('closed').addClass('opened');
                                                            } else {
                                                                toggleButton.removeClass('opened').addClass('closed');
                                                            }
                                                        });

                                                        // Function to initialize toggle button state recursively
                                                        function initializeToggleButtonState(element) {
                                                            var toggleButton = element.find('.toggle-button');
                                                            var container = element.find('.MuiCollapse-container');

                                                            if (container.find('.MuiTreeItem-root').length > 0) {
                                                                toggleButton.addClass('closed');
                                                                container.hide();
                                                            } else {
                                                                toggleButton.addClass('opened');
                                                            }

                                                            container.find('.MuiTreeItem-root').each(function() {
                                                                initializeToggleButtonState($(this));
                                                            });
                                                        }

                                                        // Initialize toggle button state for all folders
                                                        $('.MuiTreeItem-root .toggle-button').each(function() {
                                                            initializeToggleButtonState($(this).closest('.MuiTreeItem-root'));
                                                        });

                                                        // Adjust the click event to toggle the state of all children recursively
                                                        $('.MuiTreeItem-root .toggle-button').click(function(event) {
                                                            event
                                                                .stopPropagation(); // Prevent parent folders from toggling when clicking on child folders

                                                            var toggleButton = $(this);
                                                            var container = toggleButton.closest('.MuiTreeItem-root').find(
                                                                '.MuiTreeItem-root .toggle-button');

                                                            container.each(function() {
                                                                $(this).click(); // Trigger click event on each child toggle button
                                                            });
                                                        });
                                                    });
                                                </script>

                                                <script src="https://kit.fontawesome.com/YOUR_KIT_CODE.js" crossorigin="anonymous"></script>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>






                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            </div>
        @endcan

        <div class="modal fade account_model" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"
            id="account_type_modal">
        </div>
    </section>
    <!-- /.content -->

@endsection

@section('javascript')
    <script>
        $(document).ready(function() {

            $(document).on('click', 'button.close_account', function() {
                swal({
                    title: LANG.sure,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var url = $(this).data('url');

                        $.ajax({
                            method: "get",
                            url: url,
                            dataType: "json",
                            success: function(result) {
                                if (result.success == true) {
                                    toastr.success(result.msg);
                                    capital_account_table.ajax.reload();
                                    other_account_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }

                            }
                        });
                    }
                });
            });

            $(document).on('submit', 'form#edit_payment_account_form', function(e) {
                e.preventDefault();
                var data = $(this).serialize();
                $.ajax({
                    method: "POST",
                    url: $(this).attr("action"),
                    dataType: "json",
                    data: data,
                    success: function(result) {
                        if (result.success == true) {
                            $('div.account_model').modal('hide');
                            toastr.success(result.msg);
                            capital_account_table.ajax.reload();
                            other_account_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
            });

            $(document).on('submit', 'form#payment_account_form', function(e) {
                e.preventDefault();
                var data = $(this).serialize();
                $.ajax({
                    method: "post",
                    url: $(this).attr("action"),
                    dataType: "json",
                    data: data,
                    success: function(result) {
                        if (result.success == true) {
                            $('div.account_model').modal('hide');
                            toastr.success(result.msg);
                            capital_account_table.ajax.reload();
                            other_account_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
            });

            // capital_account_table
            capital_account_table = $('#capital_account_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/account/account?account_type=capital',
                columnDefs: [{
                    "targets": 5,
                    "orderable": false,
                    "searchable": false
                }],
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'account_number',
                        name: 'account_number'
                    },
                    {
                        data: 'note',
                        name: 'note'
                    },
                    {
                        data: 'balance',
                        name: 'balance',
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ],
                "fnDrawCallback": function(oSettings) {
                    __currency_convert_recursively($('#capital_account_table'));
                }
            });
            // capital_account_table
            other_account_table = $('#other_account_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/account/account?account_type=other',
                    data: function(d) {
                        d.account_status = $('#account_status').val();
                    }
                },
                columnDefs: [{
                    "targets": [6, 8],
                    "orderable": false,
                    "searchable": false
                }],
                columns: [{
                        data: 'name',
                        name: 'accounts.name'
                    },
                    {
                        data: 'parent_account_type_name',
                        name: 'pat.name'
                    },
                    {
                        data: 'account_type_name',
                        name: 'ats.name'
                    },
                    {
                        data: 'account_number',
                        name: 'accounts.account_number'
                    },
                    {
                        data: 'note',
                        name: 'accounts.note'
                    },
                    {
                        data: 'balance',
                        name: 'balance',
                        searchable: false
                    },
                    {
                        data: 'account_details',
                        name: 'account_details'
                    },
                    {
                        data: 'added_by',
                        name: 'u.first_name'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ],
                "fnDrawCallback": function(oSettings) {
                    __currency_convert_recursively($('#other_account_table'));
                },
                "footerCallback": function(row, data, start, end, display) {
                    var footer_total_balance = 0;
                    for (var r in data) {
                        footer_total_balance += $(data[r].balance).data('orig-value') ? parseFloat($(
                            data[r].balance).data('orig-value')) : 0;
                    }

                    $('.footer_total_balance').html(__currency_trans_from_en(footer_total_balance));
                }
            });

        });

        $('#account_status').change(function() {
            other_account_table.ajax.reload();
        });

        $(document).on('submit', 'form#deposit_form', function(e) {
            e.preventDefault();
            var data = $(this).serialize();

            $.ajax({
                method: "POST",
                url: $(this).attr("action"),
                dataType: "json",
                data: data,
                success: function(result) {
                    if (result.success == true) {
                        $('div.view_modal').modal('hide');
                        toastr.success(result.msg);
                        capital_account_table.ajax.reload();
                        other_account_table.ajax.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                }
            });
        });

        $('.account_model').on('shown.bs.modal', function(e) {
            $('.account_model .select2').select2({
                dropdownParent: $(this)
            })
        });

        $(document).on('click', 'button.delete_account_type', function() {
            swal({
                title: LANG.sure,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $(this).closest('form').submit();
                }
            });
        })

        $(document).on('click', 'button.activate_account', function() {
            swal({
                title: LANG.sure,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willActivate) => {
                if (willActivate) {
                    var url = $(this).data('url');
                    $.ajax({
                        method: "get",
                        url: url,
                        dataType: "json",
                        success: function(result) {
                            if (result.success == true) {
                                toastr.success(result.msg);
                                capital_account_table.ajax.reload();
                                other_account_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }

                        }
                    });
                }
            });
        });
    </script>
@endsection
