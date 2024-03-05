<div class="modal-dialog" role="document">
    {!! Form::open(['url' => action('AccountTypeController@storeSub'), 'method' => 'post', 'id' => 'account_type_form' ]) !!}
    <div class="modal-content">
      <div class="modal-header">
        {!! Form::label('account_type', __('lang_v1.account_type') . ':') !!}
        {!! Form::select('account_type', ['main' => __('lang_v1.main_account'), 'sub' => __('lang_v1.sub_account')], null, ['class' => 'form-control', 'placeholder' => __('messages.please_select')]); !!}
    </div>
    
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@lang( 'lang_v1.add_account_type' )</h4>
    </div>

    <div class="modal-body">
      	<div class="form-group">
        	{!! Form::label('name', __( 'lang_v1.name' ) . ':*') !!}
          	{!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'lang_v1.name' )]); !!}
      	</div>

      <div class="form-group">
        	{!! Form::label('parent_account_type_id', __( 'lang_v1.parent_account_type' ) . ':') !!}
          	{!! Form::select('parent_account_type_id', $account_types->pluck('name', 'id'), null, ['class' => 'form-control', 'placeholder' => __( 'messages.please_select' )]); !!}
      </div>
    </div>
    <div class="modal-body">
      {!! Form::label('the_type', __('lang_v1.the_type') . ':') !!}
      <br>
      {!! Form::label('debit', __('lang_v1.debit')) !!}
      {!! Form::radio('the_type', 'debit', true) !!} 
      {!! Form::label('credit', __('lang_v1.credit')) !!}
      {!! Form::radio('the_type', 'credit') !!} 
  </div>
  
  

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">@lang( 'messages.save' )</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
    </div>

    {!! Form::close() !!}

  	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->