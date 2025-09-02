<!--Purchase related settings -->
<div class="pos-tab-content">
    <div class="row">
    
    <div class="col-sm-4">
        <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('es_unit_price', 1, $business->es_unit_price , 
                [ 'class' => 'input-icheck']); !!} {{ __( 'lang_v1.es_unit_price' ) }}
              </label>
              @show_tooltip(__('lang_v1.es_unit_price_tooltip'))
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="checkbox">
                <label>
                {!! Form::checkbox('es_sub_total', 1, $business->es_sub_total , [ 'class' => 'input-icheck', 'id' => 'es_sub_total']); !!} {{ __( 'lang_v1.es_sub_total' ) }}
                </label>
              @show_tooltip(__('lang_v1.es_sub_total_tooltip'))
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="checkbox">
                <label>
                {!! Form::checkbox('es_net_total_amount', 1, $business->es_net_total_amount , [ 'class' => 'input-icheck', 'id' => 'es_net_total_amount']); !!} {{ __( 'lang_v1.es_net_total_amount' ) }}
                </label>
              @show_tooltip(__('lang_v1.es_net_total_amount_tooltip'))
            </div>
        </div>
    </div>
<div class="clearfix"></div>
    <div class="col-sm-5">
        <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('es_additional_shipping_charges', 1, $business->es_additional_shipping_charges , 
                [ 'class' => 'input-icheck']); !!} {{ __( 'lang_v1.es_additional_shipping_charges' ) }}
              </label>
              @show_tooltip(__('lang_v1.es_additional_shipping_charges_tooltip'))
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('es_purchase_total', 1, $business->es_purchase_total , 
                [ 'class' => 'input-icheck']); !!} {{ __( 'lang_v1.es_purchase_total' ) }}
              </label>
              @show_tooltip(__('lang_v1.es_purchase_total_tooltip'))
            </div>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="form-group">
            <div class="checkbox">
                <label>
                {!! Form::checkbox('es_approved_by', 1, $business->es_approved_by , [ 'class' => 'input-icheck', 'id' => 'es_approved_by']); !!} {{ __( 'lang_v1.es_approved_by' ) }}
                </label>
              @show_tooltip(__('lang_v1.es_approved_by_tooltip'))
            </div>
        </div>
    </div>

    </div>
</div>