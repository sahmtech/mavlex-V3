@if($__is_essentials_enabled && $is_employee_allowed)
    <a href="javascript:void(0);" 
       class="sub-menu-link clock_in_btn
       @if(!empty($clock_in)) hide @endif"
       data-type="clock_in" >
        <i class="fas fa-arrow-circle-down"></i>
        <span>@lang('essentials::lang.clock_in')</span>
    </a>
    <a href="javascript:void(0);" 
       class="sub-menu-link clock_out_btn
       @if(empty($clock_in)) hide @endif"
       data-type="clock_out" 
       data-html="true">
        <i class="fas fa-hourglass-half fa-spin"></i>
        <span>@lang('essentials::lang.clock_out')</span>
    </a>
@endif
