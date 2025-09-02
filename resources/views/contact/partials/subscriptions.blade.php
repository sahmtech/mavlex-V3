<div class="tab-pane 
    @if(!empty($view_type) &&  $view_type == 'subscriptions')
        active
    @else
        ''
    @endif"
id="subscriptions_tab">
<div class="card-wrapper" style="margin-bottom:30px;">
<div class="overview-filter">  
            <div class="title">
                <h2> @lang( 'lang_v1.subscription')</h2>
            </div>
            <div class="filter">
                    
                    <a class="filter-modal-btn" data-toggle="collapse" data-parent="#accordion" href="#collapseFilter2">
                    <img src="{{ asset('img/icons/filter.svg') }}" alt="">
                   
                </a>
                </div>
</div>
    <div class="row">
        <div id="collapseFilter2" class="collapse">
        
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('subscriptions_filter_date_range', __('report.date_range') . ':') !!}
                        {!! Form::text('subscriptions_filter_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); !!}
                    </div>
                </div>
           
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @include('sale_pos.partials.subscriptions_table')
        </div>
    </div>
</div>
</div>