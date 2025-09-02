

<div class="storys-container">
  <a class="navbar-brand" href="{{action([\Modules\Crm\Http\Controllers\CrmDashboardController::class, 'index'])}}"><i class="fas fa fa-broadcast-tower"></i> {{__('crm::lang.crm')}}</a>
          

@can('crm.access_all_leads', 'crm.access_own_leads')
<a href="{{ action('\Modules\Crm\Http\Controllers\LeadController@index') . '?lead_view=list_view' }}" class="sub-menu-item {{ request()->segment(2) == 'leads' ? 'active' : '' }}">@lang('crm::lang.leads')</a>
@endcan

@can('crm.access_all_schedule', 'crm.access_own_schedule')
<a href="{{ action([\Modules\Crm\Http\Controllers\ScheduleController::class, 'index']) }}" class="sub-menu-item {{ request()->segment(2) == 'follow-ups' ? 'active' : '' }}">@lang('crm::lang.follow_ups')</a>
@endcan

@can('crm.access_all_campaigns', 'crm.access_own_campaigns')
<a href="{{ action([\Modules\Crm\Http\Controllers\CampaignController::class, 'index']) }}" class="sub-menu-item {{ request()->segment(2) == 'campaigns' ? 'active' : '' }}">@lang('crm::lang.campaigns')</a>
@endcan

@can('crm.access_contact_login')
<a  href="{{ action([\Modules\Crm\Http\Controllers\ContactLoginController::class, 'commissions']) }}"  class="sub-menu-item {{ request()->segment(2) == 'commissions' ? 'active' : '' }}">@lang('crm::lang.commissions') </a>
<a  href="{{ action([\Modules\Crm\Http\Controllers\ContactLoginController::class, 'allContactsLoginList']) }}"  class="sub-menu-item {{ request()->segment(2) == 'all-contacts-login' ? 'active' : '' }}">@lang('crm::lang.contacts_login')</a>
@endcan
@if(config('constants.enable_crm_call_log'))
@can('crm.view_all_call_log', 'crm.view_own_call_log')
<a href="{{ action([\Modules\Crm\Http\Controllers\CallLogController::class, 'index']) }}" class="sub-menu-item {{ request()->segment(2) == 'call-log' ? 'active' : '' }}">@lang('crm::lang.call_log')</a>
@endcan
@endif
@can('crm.view_reports')
<a href="{{ action([\Modules\Crm\Http\Controllers\ReportController::class, 'index']) }}" class="sub-menu-item {{ request()->segment(2) == 'reports' ? 'active' : '' }}">@lang('report.reports')</a>
@endcan

<a href="{{ action([\Modules\Crm\Http\Controllers\ProposalTemplateController::class, 'index']) }}" class="sub-menu-item {{ request()->segment(2) == 'proposal-template' ? 'active' : '' }}">@lang('crm::lang.proposal_template')</a>

<a href="{{ action([\Modules\Crm\Http\Controllers\ProposalController::class, 'index']) }}" class="sub-menu-item {{ request()->segment(2) == 'proposals' ? 'active' : '' }}">@lang('crm::lang.proposals')</a>
@if(config('constants.enable_b2b_marketplace'))
@can('crm.access_b2b_marketplace')
<a href="{{ action([\Modules\Crm\Http\Controllers\CrmMarketplaceController::class, 'index']) }}" class="sub-menu-item {{ request()->segment(2) == 'b2b-marketplace' ? 'active' : '' }}">@lang('crm::lang.b2b_marketplace')</a>
@endcan
@endif

@can('crm.access_sources')
<a href="{{ action([\App\Http\Controllers\TaxonomyController::class, 'index']) . '?type=source' }}" class="sub-menu-item {{ request()->get('type') == 'source' ? 'active' : '' }}">@lang('crm::lang.sources')</a>
@endcan

@can('crm.access_life_stage')
<a href="{{ action([\App\Http\Controllers\TaxonomyController::class, 'index']) . '?type=life_stage' }}" class="sub-menu-item {{ request()->get('type') == 'life_stage' ? 'active' : '' }}">@lang('crm::lang.life_stage')</a>
<a href="{{ action([\App\Http\Controllers\TaxonomyController::class, 'index']) . '?type=followup_category' }}" class="sub-menu-item {{ request()->get('type') == 'followup_category' ? 'active' : '' }}">@lang('crm::lang.followup_category')</a>
@endcan

<a href="{{ action([\Modules\Crm\Http\Controllers\CrmSettingsController::class, 'index']) }}" class="sub-menu-item {{ request()->segment(2) == 'settings'  ? 'active' : '' }}">@lang('business.settings')</a>
</div>
