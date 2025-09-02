<!-- Main Footer -->
@php
$dbVersion = DB::table('system')->where('key', 'db_version')->value('value');
$appVersion = config('author.app_version');
$is_superadmin = auth()->user()->can('superadmin');
@endphp
<footer class="main-footer no-print">
  <small>
    {{ config('app.name', 'BardPOS') }} - V{{ $appVersion }}
    @if($is_superadmin)
    @if (version_compare($appVersion, $dbVersion, '>'))
    <a href="../install/update" class="btn btn-success btn-xs" data-toggle="tooltip" title="{{ trans('lang_v1.update_app') }}">
      <i class="fa fa-arrow-up" style="font-size: 8px;"></i>
    </a>
    @endif
    @endif
    | @lang('lang_v1.copyright_text', ['year' => date('Y')])
  </small>
  {{--<div class="btn-group pull-right">
    <button type="button" class="btn btn-success btn-xs toggle-font-size" data-size="s"><i class="fa fa-font"></i> <i class="fa fa-minus"></i></button>
    <button type="button" class="btn btn-success btn-xs toggle-font-size" data-size="m"> <i class="fa fa-font"></i> </button>
    <button type="button" class="btn btn-success btn-xs toggle-font-size" data-size="l"><i class="fa fa-font"></i> <i class="fa fa-plus"></i></button>
    <button type="button" class="btn btn-success btn-xs toggle-font-size" data-size="xl"><i class="fa fa-font"></i> <i class="fa fa-plus"></i><i class="fa fa-plus"></i></button>

  </div>--}}
</footer>

