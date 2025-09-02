@extends('layouts.app')
@section('title', __('settings.menu'))

@section('content')
<style>
    .row-item {
        display: flex;
        align-items: center;
        gap: .5rem
    }

    .row-item .handle {
        order: 1
    }

    .row-item .toggle-children,
    .row-item .toggle-spacer {
        order: 2
    }

    .row-item .icon-preview {
        order: 3
    }

    .row-item .flex-grow-1 {
        order: 4;
        flex: 1 1 auto;
    }

    .row-item .settings-toggle {
        order: 5;
        margin-left: auto;
    }

    .child-list {
        margin-left: 40px !important;
        padding-right: 28px !important;
    }

    .list-group-item {
        background: none;
        border: 0;
        border-top: 0;
        padding: 0;
    }

    .list-group-item:first-child {
        border: 0;
    }

    .row-item {
        display: flex;
        align-items: center;
        gap: .5rem;
        min-height: 38px;
        padding: .5rem;
        border: 1px solid #ccc;
        border-radius: 16px;
        background: #fff;
        width: auto;
        margin-bottom: 11px;
    }

    @media (min-width: 992px) {
        .row-item {
            width: 60%;
        }

        .drag-placeholder {

            width: 60%;
        }
    }

    .row-item:hover {
        background: #f8f9fa;
    }

    .handle,
    .toggle-children,
    .toggle-spacer {
        width: 36px;
        display: flex;
        justify-content: center;
        color: #adb5bd;
        cursor: move;
    }

    .handle:hover {
        color: #495057;
    }

    .depth-dash {
        width: 12px;
        text-align: center;
        color: #ced4da;
    }

    .icon-preview {
        width: 24px;
        text-align: center;
    }

    .icon-preview svg,
    .icon-preview i {
        width: 14px;
        height: 14px;
    }

    .toggle-children {
        border: 0;
        background: none;
        cursor: pointer;
        color: #6c757d;
        line-height: 1;
    }

    .toggle-children i.fa-minus {
        color: #0d6efd;
        font-weight: 700;
    }

    .settings-form-wrapper {
        background: #f8f9fa;
        border-top: 1px solid #e9ecef;
    }

    .nestedSortable-placeholder {
        background: #ffd !important;
        border: 2px dashed #d0b100 !important;
        height: 38px !important;
    }

    .collapse {
        display: none;
    }

    .collapse.show {
        display: block;
    }

    .un-row {
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 15px;
    }

    .drag-placeholder {
        height: auto;
        margin: .25rem 0;
        border: 2px dashed #f0b429;
        background: #fffceb;
        border-radius: .5rem;
    }

    .ui-sortable-helper>.row-item {
        box-shadow: 0 0 0 2px #f0b429 inset;
    }

    .menu-editor {
        margin-top: 30px;
    }

    html.dark-mode .list-group-item {
        background: none;
    }

    html.dark-mode .row-item {
        background: #3f405b !important;
        border-color: #2E2F44 !important;
    }

    html.dark-mode .row-item:hover {
        background: #3f405b !important;
    }

    .filter {
        flex-wrap: nowrap;
    }
</style>

<div class="main-container no-print">
    <div class="horizontal-scroll">
        <div class="storys-container">
            @include('layouts.partials.sub_menu.app_settings', ['link_class' => 'sub-menu-item'])
        </div>
    </div>
    <div class="setting-card-wrapper">
        <div class="overview-filter">
            <div class="title">
                <h1>{{ __('settings.menus_heading') }}</h1>
                <p>{{ __('settings.menus_description') }}</p>
            </div>

            <div class="filter">
                <div class="new-user">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createMenuModal">
                        <i class="fa fa-plus"></i>
                        {{ __('settings.add_menu_item') }}
                    </button>
                </div>
                {!! Form::open(['route' => 'menus.rebuild', 'method' => 'post']) !!}
                <div class="new-user">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-sync"></i>
                        {{ __('settings.reset_menu') }}
                    </button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div class="content">
            {!! Form::open(['route' => 'menus.bulk_save', 'method' => 'post']) !!}
            <div class="menu-editor">
                <ol id="menu_tree" class="list-group list-group-flush">
                    {!! $htmlTree !!}
                </ol>
            </div>
            <input type="hidden" name="items" id="menu_items">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <button class="btn btn-primary btn-big save-btn" type="submit">
                        <i class="fa fa-save"></i> {{ __('settings.save_menu') }}
                    </button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    @include('menus.create', ['menu' => new \App\Models\Menu])
</div>
@endsection

@section('javascript')
<script src="{{ asset('js/nestedSortable/jquery.mjs.nestedSortable.min.js?v=' . $asset_v) }}"></script>
<script>
    $(function () {
    // Initialize nestedSortable
    $('#menu_tree').nestedSortable({
        listType: 'ol',
        handle: '.handle',
        items: 'li',
        helper: 'clone',
        placeholder: 'drag-placeholder',
        forcePlaceholderSize: true,
        toleranceElement: '> .row-item',
        maxLevels: 4,
        start: function (e, ui) {
            var $kids = ui.item.children('ol');
            if ($kids.length) {
                ui.item.data('detachedChildren', $kids);
                $kids.detach();
            }
        },
        stop: function (e, ui) {
            var $kids = ui.item.data('detachedChildren');
            if ($kids) ui.item.append($kids);
        }
    });

    $('#menu_tree').on('click', '.settings-toggle', function (e) {
        e.preventDefault(); e.stopPropagation();
        var $target = $($(this).data('bsTarget') || $(this).attr('data-bs-target'));
        toggleCollapse($target);
    });

    $('#menu_tree').on('click', '.toggle-children', function (e) {
        e.preventDefault(); e.stopPropagation();
        $(this).find('i').toggleClass('fa-plus fa-minus');
        var $target = $($(this).data('bsTarget'));
        toggleCollapse($target);
    });

   $(document).on('change', '.icon-type-select', function () {
    var uid = $(this).data('target');
    var type = $(this).val();

    $('[data-uid="' + uid + '"].icon-svg-group').toggleClass('hide', type !== 'svg');
    $('[data-uid="' + uid + '"].icon-fa-group').toggleClass('hide', type !== 'fa');
});


    window.toggleCollapse = function ($el) {
        if ($el.hasClass('show')) {
            $el.removeClass('show').slideUp(150);
        } else {
            $el.addClass('show').slideDown(150);
        }
    };

    $('form[action="{{ route('menus.bulk_save') }}"]').on('submit', function () {
        var items = collectItems();
        $('#menu_items').val(JSON.stringify(items));
        return true;
    });

    function collectItems() {
        var counters = {};
        var items = [];

        $('#menu_tree li').each(function () {
            var $li = $(this);
            var id = $li.data('id');
            if (!id) return;

            var pid = $li.parent().closest('li').data('id') ?? null;
            var ord = counters[pid] = (counters[pid] || 0) + 1;

            var data = {};
            $li.children('.settings-form-wrapper').find('[name]').each(function () {
                var $el = $(this);
                var n = $el.attr('name');
                if (n === '_token' || n === '_method') return;

                data[n] = $el.is(':checkbox') ? ($el.is(':checked') ? 1 : 0) : $el.val();
            });

            items.push({
                id: id,
                parent_id: pid,
                sort_order: ord,
                data: data
            });
        });

        return items;
    }

    $(document).on('click', '[data-toggle="modal"][data-target="#createMenuModal"]', function () {
        $('#createMenuModal').modal('show');
    });
});
</script>
@endsection