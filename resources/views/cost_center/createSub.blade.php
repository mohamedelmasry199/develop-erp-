<div class="modal-dialog" role="document">
    <div class="modal-content">
  
      {!! Form::open(['url' => action('CostCenterController@storeSub'), 'method' => 'post', 'id' => 'cost_centers_form' ]) !!}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">@lang( 'lang_v1.add_cost_centers' )</h4>
      </div>
      <div class="modal-header">
        {!! Form::label('cost_center_type', __('lang_v1.cost_center_type') . ':') !!}
        {!! Form::select('cost_center_type', ['main' => __('lang_v1.main_account'), 'sub' => __('lang_v1.sub_account')], null, ['class' => 'form-control', 'placeholder' => __('messages.please_select')]); !!}
    </div>
      <div class="modal-body">
        <div class="form-group">
          {!! Form::label('name', __( 'lang_v1.name' ) . ':*') !!}
          {!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'lang_v1.name' )]); !!}
        </div>
  
        <div class="form-group">
          {!! Form::label('main_center_id', __( 'lang_v1.main_center_id' ) . ':') !!}
          {!! Form::select('main_center_id', $costCenters->pluck('name', 'id'), null, ['class' => 'form-control', 'placeholder' => __( 'messages.please_select' )]); !!}
        </div>

        <div class="form-group">
            {!! Form::label('code', __( 'lang_v1.code' ) . ':') !!}
            {!! Form::text('code', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'lang_v1.code' )]); !!}
        </div>

          <div class="form-group">
            {!! Form::label('center_level', __( 'lang_v1.center_level' ) . ':') !!}
            {!! Form::text('center_level', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'lang_v1.center_level' )]); !!}
          </div>

          <div class="form-group">
            {!! Form::label('active', __( 'lang_v1.active' ) . ':') !!}
            {!! Form::text('active', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'lang_v1.active' )]); !!}
          </div>

          <div class="form-group">
            {!! Form::label('description', __( 'lang_v1.description' ) . ':') !!}
            {!! Form::text('description', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'lang_v1.description' )]); !!}
          </div>

          <div class="form-group">
            {!! Form::label('account_id', __( 'lang_v1.account_id' ) . ':') !!}
            {!! Form::select('account_id', $accounts->pluck('name', 'id'), null, ['class' => 'form-control', 'placeholder' => __( 'messages.please_select' )]); !!}
          </div>
  
  
       
  
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">@lang( 'messages.save' )</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
      </div>
  
      {!! Form::close() !!}
  
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
  