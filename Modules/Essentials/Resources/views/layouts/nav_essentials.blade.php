<div class="storys-container">
<div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{action([\Modules\Essentials\Http\Controllers\ToDoController::class, 'index'])}}"><i class="fas fa-check-circle"></i> {{__('essentials::lang.essentials')}}</a>
            </div>
    <a href="{{action('\Modules\Essentials\Http\Controllers\ToDoController@index')}}" class="sub-menu-item {{ request()->segment(2) == 'todo' ? 'active' : '' }}">@lang('essentials::lang.todo')</a>

    <a href="{{action('\Modules\Essentials\Http\Controllers\DocumentController@index')}}" class="sub-menu-item {{ request()->segment(2) == 'document' && request()->get('type') != 'memos' ? 'active' : '' }}">@lang('essentials::lang.document')</a> 

    <a href="{{action('\Modules\Essentials\Http\Controllers\DocumentController@index') .'?type=memos'}}" class="sub-menu-item {{ request()->segment(2) == 'document' && request()->get('type') == 'memos' ? 'active' : '' }}">@lang('essentials::lang.memos')</a>

  <a href="{{action('\Modules\Essentials\Http\Controllers\ReminderController@index')}}" class="sub-menu-item {{ request()->segment(2) == 'reminder' ? 'active' : '' }}">@lang('essentials::lang.reminders')</a>

    @if (auth()->user()->can('essentials.view_message') || auth()->user()->can('essentials.create_message'))
        <a href="{{action('\Modules\Essentials\Http\Controllers\EssentialsMessageController@index')}}" class="sub-menu-item {{ request()->segment(2) == 'messages' ? 'active' : '' }}">@lang('essentials::lang.messages')</a>
    @endif
    <a href="{{action('\Modules\Essentials\Http\Controllers\KnowledgeBaseController@index')}}" class="sub-menu-item {{ request()->segment(2) == 'knowledge-base' ? 'active' : '' }}">@lang('essentials::lang.knowledge_base')</a>
    @if (auth()->user()->can('edit_essentials_settings'))
        <a href="{{action('\Modules\Essentials\Http\Controllers\EssentialsSettingsController@edit')}}" class="sub-menu-item {{ request()->segment(2) == 'hrm' && request()->segment(2) == 'settings' ? 'active' : '' }}">@lang('business.settings')</a>
    @endif 
</div>