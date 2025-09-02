@php
  $link_class = $link_class ?? ''; 
@endphp


<a href="{{ action('SellController@getQuotations') }}" class="{{ $link_class }} {{ request()->segment(1) == 'sells' && request()->segment(2) == 'quotations' || request()->get('status') == 'quotation' ? 'active' : '' }}">@lang('lang_v1.quotations')</a>
