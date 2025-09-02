 @if($is_crm_enabled)
      @if((auth()->user()->can('crm.access_all_campaigns') || auth()->user()->can('crm.access_own_campaigns')))
      <li><a href="{{ action('\Modules\Crm\Http\Controllers\CampaignController@index') }}"
          class="{{ request()->segment(1) == 'crm' && request()->segment(2) == 'campaigns' ? 'active' : '' }}">
          <img src="{{ asset('img/icons/Broadcast.svg?v=' . $asset_v) }}" alt="">
          <h3>@lang('crm::lang.campaigns')</h3>
        </a></li>
      @endif

      @if((auth()->user()->can('crm.access_all_campaigns') || auth()->user()->can('crm.access_own_campaigns')))
      <li><a href="{{ action('\Modules\Crm\Http\Controllers\CrmDashboardController@index') }}"
          class="{{ request()->segment(1) == 'crm' && request()->segment(2) == 'dashboard' || request()->get('type') == 'life_stage' || request()->get('type') == 'source' ? 'active' : '' }}">
          <img src="{{ asset('img/icons/crm.svg?v=' . $asset_v) }}" alt="">
          <h3>@lang('crm::lang.overview')</h3>
        </a></li>
      @endif
      @endif