@php
    $id = 'modifier_' . $instance_index . '_' . (isset($combo_product) ? $combo_product->variation_id . '_' : '') . time();
@endphp
{{--
<div>
    
    <span id="selected_modifiers_{{$id}}">
        <!-- Display selected modifiers here if necessary -->
    </span>&nbsp;  
    <i class="fa fa-external-link-alt cursor-pointer text-primary select-modifiers-btn" title="@lang('restaurant.modifiers_for_product')" data-toggle="modal" data-target="#{{$id}}"></i>
</div>--}}
<div>
  <span class="selected_modifiers" id="selected_modifiers_{{$id}}">
    @if(!empty($edit_modifiers) && !empty($product->modifiers) )
      @include('restaurant.product_modifier_set.add_selected_modifiers', array('index' => $row_count, 'modifiers' => $product->modifiers ) )
    @endif
  </span>&nbsp;  
  <i class="fa fa-external-link-alt cursor-pointer text-primary select-modifiers-btn" title="@lang('restaurant.modifiers_for_product')" data-toggle="modal" data-target="#{{$id}}"></i>
</div>

<div class="modal fade modifier_modal" id="{{$id}}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">@lang('restaurant.modifiers_for_product'): <span class="text-success">{{ $product->product_name }}</span></h4>
            </div>

            <div class="modal-body">
                @if(!empty($product->modifiers))
                    <div class="panel-group" id="accordion{{$id}}" role="tablist" aria-multiselectable="true">
                        @foreach($product->modifiers as $modifier_set)
                            @php
                                $collapse_id = 'collapse' . $modifier_set['id'] . $id;
                            @endphp
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion{{$id}}" href="#{{$collapse_id}}" aria-expanded="true" aria-controls="collapseOne">
                                            {{$modifier_set['name']}}
                                        </a>
                                    </h4>
                                </div>
                                <input type="hidden" class="modifiers_exist" value="true">
                                <input type="hidden" class="index" value="{{$row_count}}">
                                <input type="hidden" class="combo_index" value="{{$index}}">
                                <input type="hidden" class="instance_index" value="{{$instance_index}}">

                                <div id="{{$collapse_id}}" class="panel-collapse collapse @if($loop->index == 0) in @endif" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        <div class="btn-group" data-toggle="buttons">
                                            @foreach($modifier_set['variations'] as $modifier)
                                                <label class="btn btn-primary @if($modifier['is_selected']) active @endif">
                                                    <input type="checkbox" autocomplete="off" value="{{$modifier['id']}}" data-combo-id="{{$product->variation_id}}"> {{$modifier['name']}}
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>@lang('lang_v1.modifiers_not_available_product')</p>
                @endif
            </div>
            <div class="modal-footer">
                <button data-url="{{action('Restaurant\ProductModifierSetController@add_selected_modifiers')}}" type="button" class="btn btn-primary add_modifier" data-dismiss="modal">
                    @lang('messages.add')
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
if( typeof $ !== 'undefined'){
    $(document).ready(function(){
        $('div#{{$id}}').modal('show');
    });
}
</script>

<script>
$(document).ready(function() {
    $('.add_modifier').click(function() {
        var modal = $(this).closest('.modal');
        var row_count = modal.find('.index').val();
        var combo_index = modal.find('.combo_index').val();
        var instance_index = modal.find('.instance_index').val();
        
        var selected_modifiers = [];

        modal.find('input[type="checkbox"]:checked').each(function() {
            selected_modifiers.push($(this).val());
        });

        // Ensure to clear all previously selected modifiers for this combo product
        $('input.single_combo_modifier_ids_' + instance_index).val('');

        // Update the specific combo modifier input field with a comma-separated list without quotes
        $('input.single_combo_modifier_ids_' + instance_index).val(selected_modifiers.join(','));

        // Combine all single_combo_modifier_ids fields and update each combo_modifier_ids field
        combineSingleModifiers(row_count, combo_index);
    });

    function combineSingleModifiers(row_count, combo_index) {
        var combinedModifiers = [];

        $('input[class^="single_combo_modifier_ids_' + row_count + '_' + combo_index + '"]').each(function() {
            var val = $(this).val();
            if (val) {
                combinedModifiers.push(val);
            }
        });

        var combinedValue = combinedModifiers.join(',');

        $('input[class^="combo_modifier_ids_' + row_count + '_' + combo_index + '"]').each(function() {
            $(this).val(combinedValue);
        });
    }
});
</script>

