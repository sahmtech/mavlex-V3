
    <div class="card-wrapper">
    
<div class="overview-filter">
    <div class="title">
        <h2>@lang('lang_v1.documents_and_notes')</h2>
    </div>
    <div class="filter">
        @if(in_array('create', $permissions))
            <div class="new-user">
                <a href="#" 
                   data-href="{{ action('DocumentAndNoteController@create', ['notable_id' => $notable_id, 'notable_type' => $notable_type]) }}" 
                   class="btn btn-sm btn-primary docs_and_notes_btn pull-right">
                    <i class="fa fa-plus"></i> @lang('messages.add')
                </a>
            </div>
        @endif
    </div>
</div>
<div class="content">
    <div class="table-responsive">
        <table class="table general-table" style="width: 100%;" id="documents_and_notes_table">
            <thead>
                <tr>
                    <th>@lang('messages.action')</th>
                    <th>@lang('lang_v1.heading')</th>
                    <th>@lang('lang_v1.added_by')</th>
                    <th>@lang('lang_v1.created_at')</th>
                    <th>@lang('lang_v1.updated_at')</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
    </div>
<!-- Modal Container -->
<div class="modal fade docus_note_modal" tabindex="-1" role="dialog" aria-labelledby="docusNoteModalLabel"></div>
