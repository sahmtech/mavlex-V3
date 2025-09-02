<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">


  @php

    if(isset($update_action)) {
        $url = $update_action;
        $customer_groups = [];
        $opening_balance = 0;
        $lead_users = $contact->leadUsers->pluck('id');
    } else {
      $url = action([\App\Http\Controllers\ContactController::class, 'update'], [$contact->id]);
      $sources = [];
      $life_stages = [];
      $lead_users = [];
      $assigned_to_users = $contact->userHavingAccess->pluck('id');
    }
  @endphp

    {!! Form::open(['url' => $url, 'method' => 'PUT', 'id' => 'contact_edit_form']) !!}

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@lang('contact.edit_contact')</h4>
      <p>@lang('contact.contacts')</p>

      <div class="row">
          <div class="col-md-6">
            <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                  <label class="radio-inline">
                      <input type="radio" checked name="contact_type_radio" @if($contact->contact_type == 'individual') checked @endif id="inlineRadio1" value="individual">
                      @lang('lang_v1.individual')
                  </label>
                  <label class="radio-inline">
                      <input type="radio" name="contact_type_radio" @if($contact->contact_type == 'business') checked @endif  id="inlineRadio2" value="business">
                      @lang('business.business')
                  </label>
            </div>
          </div>
          
          <div class="col-md-6 customer_fields">
            <div class="form-group">
                {!! Form::label('customer_group_id', __('lang_v1.customer_group') . ':') !!}
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-users"></i>
                    </span>
                    {!! Form::select('customer_group_id', $customer_groups, $contact->customer_group_id, ['class' => 'form-control']); !!}
                </div>
            </div>
          </div>
        </div>
    </div>

    <div class="modal-body">

      <div class="row">

        <div class="col-md-12">
          <div class="form-group">
              {!! Form::label('type', __('contact.contact_type') . ':*' ) !!}
              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="fa fa-user"></i>
                  </span>
                  {!! Form::select('type', $types, $contact->type, ['class' => 'form-control', 'id' => 'contact_type','placeholder' => __('messages.please_select'), 'required']); !!}
              </div>
          </div>
          {!! Form::hidden('contact_id', $contact->contact_id); !!}
        </div>
        
        
        
        <div class="clearfix customer_fields"></div>
        <div class="col-md-6 business">
          <div class="form-group">
              {!! Form::label('supplier_business_name', __('business.business_name') . ':') !!}
              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="fa fa-briefcase"></i>
                  </span>
                  {!! Form::text('supplier_business_name', 
                  $contact->supplier_business_name, ['class' => 'form-control', 'placeholder' => __('business.business_name')]); !!}
              </div>
          </div>
        </div>
        <div class="clearfix"></div>
            <div class="col-md-6 individual">
                <div class="form-group">
                    {!! Form::label('first_name', __( 'business.first_name' ) . ':*') !!}
                    {!! Form::text('first_name', $contact->first_name, ['class' => 'form-control', 'required', 'placeholder' => __( 'business.first_name' ) ]); !!}
                </div>
            </div>
            
            <div class="col-md-6 individual">
                <div class="form-group">
                    {!! Form::label('last_name', __( 'business.last_name' ) . ':') !!}
                    {!! Form::text('last_name', $contact->last_name, ['class' => 'form-control', 'placeholder' => __( 'business.last_name' ) ]); !!}
                </div>
            </div>
            <div class="clearfix"></div>

      <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('mobile', __('contact.mobile') . ':*') !!}
            {!! Form::text('mobile', $contact->mobile, ['class' => 'form-control', 'required', 'placeholder' => __('contact.mobile')]); !!}
        </div>
      </div>
     
      <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('email', __('business.email') . ':') !!}
                {!! Form::email('email', $contact->email, ['class' => 'form-control','placeholder' => __('business.email')]); !!}
            </div>
        </div>
        @if($is_zatca)
        <div class="clearfix"></div>
        <div id="zatca_b2b">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('address_line_1', __('zatca::lang.street_name') . ':') !!}
                    {!! Form::text('address_line_1', $contact->address_line_1, ['class' => 'form-control','id' => 'address_line_1', 'placeholder' => __('zatca::lang.street_name'), 'rows' => 3, ]); !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                  {!! Form::label('tax_number', __('zatca::lang.tax_id') . ':') !!}
                {!! Form::text('tax_number', $contact->tax_number, ['class' => 'form-control','id' => 'tax_number', 'placeholder' => __('zatca::lang.tax_id')]); !!}
                </div>
            </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('address_line_2', __('zatca::lang.building_number') . ':') !!}
                {!! Form::text('address_line_2', $contact->address_line_2, ['class' => 'form-control','id' => 'address_line_2', 'placeholder' => __('zatca::lang.building_number'), 'rows' => 3,'pattern'=> '\d{4}','maxlength' => 4,'title' => __('zatca::lang.min_req', ['min' => 4])]); !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('city', __('business.city') . ':') !!}
                {!! Form::text('city', $contact->city, ['class' => 'form-control','id' => 'city', 'placeholder' => __('business.city')]); !!}
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('zip_code', __('zatca::lang.postal_number') . ':') !!}
                {!! Form::text('zip_code', $contact->zip_code, ['class' => 'form-control' ,'id' => 'zip_code',
                    'placeholder' => __('zatca::lang.postal_number'), 'pattern' => '\d{5}','maxlength' => 5,'title' => __('zatca::lang.min_req',
                            ['min' => 5]) ]); !!}
            </div>
          </div>
          
        </div>
        @endif

        <div class="col-sm-4">
            <div class="form-group individual">
                {!! Form::label('dob', __('lang_v1.dob') . ':') !!}
                {!! Form::text('dob', !empty($contact->dob) ? @format_date($contact->dob) : null, ['class' => 'form-control dob-date-picker','placeholder' => __('lang_v1.dob'), 'readonly']); !!}
            </div>
        </div>
        
        <!-- lead additional field -->
        <div class="col-md-4 lead_additional_div">
          <div class="form-group">
              {!! Form::label('crm_source', __('lang_v1.source') . ':' ) !!}
              {!! Form::select('crm_source', $sources, $contact->crm_source , ['class' => 'form-control', 'id' => 'crm_source','placeholder' => __('messages.please_select')]); !!}
          </div>
        </div>
        <div class="col-md-4 lead_additional_div">
          <div class="form-group">
              {!! Form::label('crm_life_stage', __('lang_v1.life_stage') . ':' ) !!}
              {!! Form::select('crm_life_stage', $life_stages, $contact->crm_life_stage , ['class' => 'form-control', 'id' => 'crm_life_stage','placeholder' => __('messages.please_select')]); !!}
          </div>
        </div>
        <div class="col-md-6 lead_additional_div">
          <div class="form-group">
              {!! Form::label('user_id', __('lang_v1.assigned_to') . ':*' ) !!}
              {!! Form::select('user_id[]', $users, $lead_users , ['class' => 'form-control select2', 'id' => 'user_id', 'multiple', 'required', 'style' => 'width: 100%;']); !!}
          </div>
        </div>
        @if(config('constants.enable_contact_assign') && $contact->type !== 'lead')
          <!-- User in create customer & supplier -->
          <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('assigned_to_users', __('lang_v1.assigned_to') . ':' ) !!}
                        {!! Form::select('assigned_to_users[]', $users, $assigned_to_users ?? [] , ['class' => 'form-control select2', 'id' => 'assigned_to_users', 'multiple', 'style' => 'width: 100%;']); !!}
                </div>
          </div>
        @endif


        <div class="col-md-12">
            <button type="button" class="btn bg-yellow center-block more_btn" data-target="#more_div">@lang('lang_v1.more_info') <i class="fa fa-chevron-down"></i></button>
        </div>
        
        <div id="more_div" class="hide">

            <div class="col-md-12"><hr/></div>
            @if(!$is_zatca)
        <div class="col-md-4">
          <div class="form-group">
              {!! Form::label('tax_number', __('contact.tax_no') . ':') !!}
              {!! Form::text('tax_number', $contact->tax_number, ['class' => 'form-control', 'placeholder' => __('contact.tax_no')]); !!}
          </div>
        </div>
        @endif

        
        <div class="col-md-4 opening_balance">
          <div class="form-group">
              {!! Form::label('opening_balance', __('lang_v1.opening_balance') . ':') !!}
              {!! Form::text('opening_balance', $opening_balance, ['class' => 'form-control input_number']); !!}
          </div>
        </div>

        <div class="col-md-4 pay_term">
          <div class="form-group">
            <div class="multi-input">
              {!! Form::label('pay_term_number', __('contact.pay_term') . ':') !!} <!-- @show_tooltip(__('tooltip.pay_term')) -->
              <br/>
              {!! Form::number('pay_term_number', $contact->pay_term_number, ['class' => 'form-control width-40 pull-left', 'placeholder' => __('contact.pay_term')]); !!}

              {!! Form::select('pay_term_type', ['months' => __('lang_v1.months'), 'days' => __('lang_v1.days')], $contact->pay_term_type, ['class' => 'form-control width-60 pull-left','placeholder' => __('messages.please_select')]); !!}
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
        
        <div class="col-md-4 customer_fields">
          <div class="form-group">
              {!! Form::label('credit_limit', __('lang_v1.credit_limit') . ':') !!}
              {!! Form::text('credit_limit', $contact->credit_limit != null ? @num_format($contact->credit_limit) : null, ['class' => 'form-control input_number']); !!}
              <p class="help-block">@lang('lang_v1.credit_limit_help')</p>
          </div>
        </div>
          
      <div class="col-md-12">
        <hr/>
      </div>
      @if(!$is_zatca)
      <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('address_line_1', __('lang_v1.address_line_1') . ':') !!}
            {!! Form::text('address_line_1', $contact->address_line_1, ['class' => 'form-control', 'placeholder' => __('lang_v1.address_line_1'), 'rows' => 3]); !!}
        </div>
      </div>
      @endif
      <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('shipping_address', __('lang_v1.shipping_address') . ':') !!}
            {!! Form::text('shipping_address', $contact->shipping_address, ['class' => 'form-control', 
                'placeholder' => __('lang_v1.search_address'), 'id' => 'shipping_address']); !!}
        </div>
      </div>
     
      @if(!$is_zatca)
      <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('city', __('business.city') . ':') !!}
            {!! Form::text('city', $contact->city, ['class' => 'form-control', 'placeholder' => __('business.city')]); !!}
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('state', __('business.state') . ':') !!}
            {!! Form::text('state', $contact->state, ['class' => 'form-control', 'placeholder' => __('business.state')]); !!}
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('country', __('business.country') . ':') !!}
            {!! Form::text('country', $contact->country, ['class' => 'form-control', 'placeholder' => __('business.country')]); !!}
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('zip_code', __('business.zip_code') . ':') !!}
            {!! Form::text('zip_code', $contact->zip_code, ['class' => 'form-control', 
                'placeholder' => __('business.zip_code_placeholder')]); !!}
        </div>
      </div>
      @endif
      <div class="clearfix"></div>
      
      @php
        $custom_labels = json_decode(session('business.custom_labels'), true);
        $contact_custom_field1 = !empty($custom_labels['contact']['custom_field_1']) ? $custom_labels['contact']['custom_field_1'] : __('lang_v1.contact_custom_field1');
        $contact_custom_field2 = !empty($custom_labels['contact']['custom_field_2']) ? $custom_labels['contact']['custom_field_2'] : __('lang_v1.contact_custom_field2');
        $contact_custom_field3 = !empty($custom_labels['contact']['custom_field_3']) ? $custom_labels['contact']['custom_field_3'] : __('lang_v1.contact_custom_field3');
        $contact_custom_field4 = !empty($custom_labels['contact']['custom_field_4']) ? $custom_labels['contact']['custom_field_4'] : __('lang_v1.contact_custom_field4');
        $contact_custom_field5 = !empty($custom_labels['contact']['custom_field_5']) ? $custom_labels['contact']['custom_field_5'] : __('lang_v1.custom_field', ['number' => 5]);
        $contact_custom_field6 = !empty($custom_labels['contact']['custom_field_6']) ? $custom_labels['contact']['custom_field_6'] : __('lang_v1.custom_field', ['number' => 6]);
        $contact_custom_field7 = !empty($custom_labels['contact']['custom_field_7']) ? $custom_labels['contact']['custom_field_7'] : __('lang_v1.custom_field', ['number' => 7]);
        $contact_custom_field8 = !empty($custom_labels['contact']['custom_field_8']) ? $custom_labels['contact']['custom_field_8'] : __('lang_v1.custom_field', ['number' => 8]);
        $contact_custom_field9 = !empty($custom_labels['contact']['custom_field_9']) ? $custom_labels['contact']['custom_field_9'] : __('lang_v1.custom_field', ['number' => 9]);
        $contact_custom_field10 = !empty($custom_labels['contact']['custom_field_10']) ? $custom_labels['contact']['custom_field_10'] : __('lang_v1.custom_field', ['number' => 10]);
      @endphp
      <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('custom_field1', $contact_custom_field1 . ':') !!}
            {!! Form::text('custom_field1', $contact->custom_field1, ['class' => 'form-control', 
                'placeholder' => $contact_custom_field1]); !!}
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('custom_field2', $contact_custom_field2 . ':') !!}
            {!! Form::text('custom_field2', $contact->custom_field2, ['class' => 'form-control', 
                'placeholder' => $contact_custom_field2]); !!}
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('custom_field3', $contact_custom_field3 . ':') !!}
            {!! Form::text('custom_field3', $contact->custom_field3, ['class' => 'form-control', 
                'placeholder' => $contact_custom_field3]); !!}
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('custom_field4', $contact_custom_field4 . ':') !!}
            {!! Form::text('custom_field4', $contact->custom_field4, ['class' => 'form-control', 
                'placeholder' => $contact_custom_field4]); !!}
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('custom_field5', $contact_custom_field5 . ':') !!}
            {!! Form::text('custom_field5', $contact->custom_field5, ['class' => 'form-control', 
                'placeholder' => $contact_custom_field5]); !!}
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('custom_field6', $contact_custom_field6 . ':') !!}
            {!! Form::text('custom_field6', $contact->custom_field6, ['class' => 'form-control', 
                'placeholder' => $contact_custom_field6]); !!}
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('custom_field7', $contact_custom_field7 . ':') !!}
            {!! Form::text('custom_field7', $contact->custom_field7, ['class' => 'form-control', 
                'placeholder' => $contact_custom_field7]); !!}
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('custom_field8', $contact_custom_field8 . ':') !!}
            {!! Form::text('custom_field8', $contact->custom_field8, ['class' => 'form-control', 
                'placeholder' => $contact_custom_field8]); !!}
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('custom_field9', $contact_custom_field9 . ':') !!}
            {!! Form::text('custom_field9', $contact->custom_field9, ['class' => 'form-control', 
                'placeholder' => $contact_custom_field9]); !!}
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('custom_field10', $contact_custom_field10 . ':') !!}
            {!! Form::text('custom_field10', $contact->custom_field10, ['class' => 'form-control', 
                'placeholder' => $contact_custom_field10]); !!}
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="col-md-12 shipping_addr_div"><hr></div>
      <div class="col-md-8 col-md-offset-2 shipping_addr_div mb-10" >
          
        <div class="mb-10" id="map"></div>
      </div>
      {!! Form::hidden('position', $contact->position, ['id' => 'position']); !!}
        @php
            $shipping_custom_label_1 = !empty($custom_labels['shipping']['custom_field_1']) ? $custom_labels['shipping']['custom_field_1'] : '';

            $shipping_custom_label_2 = !empty($custom_labels['shipping']['custom_field_2']) ? $custom_labels['shipping']['custom_field_2'] : '';

            $shipping_custom_label_3 = !empty($custom_labels['shipping']['custom_field_3']) ? $custom_labels['shipping']['custom_field_3'] : '';

            $shipping_custom_label_4 = !empty($custom_labels['shipping']['custom_field_4']) ? $custom_labels['shipping']['custom_field_4'] : '';

            $shipping_custom_label_5 = !empty($custom_labels['shipping']['custom_field_5']) ? $custom_labels['shipping']['custom_field_5'] : '';
        @endphp

        @if(!empty($custom_labels['shipping']['is_custom_field_1_contact_default']) && !empty($shipping_custom_label_1))
            @php
                $label_1 = $shipping_custom_label_1 . ':';
            @endphp

            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('shipping_custom_field_1', $label_1 ) !!}
                    {!! Form::text('shipping_custom_field_details[shipping_custom_field_1]', !empty($contact->shipping_custom_field_details['shipping_custom_field_1']) ? $contact->shipping_custom_field_details['shipping_custom_field_1'] : null, ['class' => 'form-control','placeholder' => $shipping_custom_label_1]); !!}
                </div>
            </div>
        @endif
        @if(!empty($custom_labels['shipping']['is_custom_field_2_contact_default']) && !empty($shipping_custom_label_2))
            @php
                $label_2 = $shipping_custom_label_2 . ':';
            @endphp

            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('shipping_custom_field_2', $label_2 ) !!}
                    {!! Form::text('shipping_custom_field_details[shipping_custom_field_2]', !empty($contact->shipping_custom_field_details['shipping_custom_field_2']) ? $contact->shipping_custom_field_details['shipping_custom_field_2'] : null, ['class' => 'form-control','placeholder' => $shipping_custom_label_2]); !!}
                </div>
            </div>
        @endif
        @if(!empty($custom_labels['shipping']['is_custom_field_3_contact_default']) && !empty($shipping_custom_label_3))
            @php
                $label_3 = $shipping_custom_label_3 . ':';
            @endphp

            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('shipping_custom_field_3', $label_3 ) !!}
                    {!! Form::text('shipping_custom_field_details[shipping_custom_field_3]', !empty($contact->shipping_custom_field_details['shipping_custom_field_3']) ? $contact->shipping_custom_field_details['shipping_custom_field_3'] : null, ['class' => 'form-control','placeholder' => $shipping_custom_label_3]); !!}
                </div>
            </div>
        @endif
        @if(!empty($custom_labels['shipping']['is_custom_field_4_contact_default']) && !empty($shipping_custom_label_4))
            @php
                $label_4 = $shipping_custom_label_4 . ':';
            @endphp

            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('shipping_custom_field_4', $label_4 ) !!}
                    {!! Form::text('shipping_custom_field_details[shipping_custom_field_4]', !empty($contact->shipping_custom_field_details['shipping_custom_field_4']) ? $contact->shipping_custom_field_details['shipping_custom_field_4'] : null, ['class' => 'form-control','placeholder' => $shipping_custom_label_4]); !!}
                </div>
            </div>
        @endif
        @if(!empty($custom_labels['shipping']['is_custom_field_5_contact_default']) && !empty($shipping_custom_label_5))
            @php
                $label_5 = $shipping_custom_label_5 . ':';
            @endphp

            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('shipping_custom_field_5', $label_5 ) !!}
                    {!! Form::text('shipping_custom_field_details[shipping_custom_field_5]', !empty($contact->shipping_custom_field_details['shipping_custom_field_5']) ? $contact->shipping_custom_field_details['shipping_custom_field_5'] : null, ['class' => 'form-control','placeholder' => $shipping_custom_label_5]); !!}
                </div>
            </div>
        @endif
        @php
          $common_settings = session()->get('business.common_settings');
        @endphp
        @if(!empty($common_settings['is_enabled_export']))
            <div class="col-md-12 mb-12">
                <div class="form-check">
                    <input type="checkbox" name="is_export" class="form-check-input" id="is_customer_export" @if(!empty($contact->is_export)) checked @endif>
                    <label class="form-check-label" for="is_customer_export">@lang('lang_v1.is_export')</label>
                </div>
            </div>
            @php
                $i = 1;
            @endphp
            @for($i; $i <= 6 ; $i++)
                <div class="col-md-4 export_div" style="display: none;">
                    <div class="form-group">
                        {!! Form::label('export_custom_field_'.$i, __('lang_v1.export_custom_field'.$i).':' ) !!}
                        {!! Form::text('export_custom_field_'.$i, !empty($contact['export_custom_field_'.$i]) ? $contact['export_custom_field_'.$i] : null, ['class' => 'form-control','placeholder' => __('lang_v1.export_custom_field'.$i)]); !!}
                    </div>
                </div>
            @endfor
        @endif
    </div>
</div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">@lang( 'messages.update' )</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
    </div>

    {!! Form::close() !!}

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
@if($is_zatca)
<script>
    function B2B_required(isBusiness) {
      var fields = ['tax_number', 'zip_code', 'address_line_1', 'address_line_2', 'city', 'business_name'];
      fields.forEach(function(fieldId) {
        var element = document.getElementById(fieldId);
        if (element) {
          if (isBusiness) {
            element.setAttribute('required', 'required');
          } else {
            element.removeAttribute('required');
          }
        }
      });
    }
    document.addEventListener('change', function(event) {
      if (event.target && event.target.matches('input[name="contact_type_radio"]')) {
        if (event.target.value === 'business') {
          B2B_required(true);
        } else {
          B2B_required(false);
        }
      }
    });
  </script>
@endif
