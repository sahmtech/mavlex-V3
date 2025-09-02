<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('name', __('zatca::lang.name') . ':') !!}
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-info"></i>
                </span>
                {!! Form::text('name', !empty($user->name) ? $user->name : null, ['class' => 'form-control', 'placeholder' => __('zatca::lang.name')]) !!}
                {!! Form::text('name', !empty($user->name) ? $user->name : null, ['class' => 'form-control', 'placeholder' => __('zatca::lang.name')]) !!}
            </div>
        </div>
    </div>
    
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('street_name', __('zatca::lang.street_name') . ':') !!}
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-info"></i>
                </span>
                {!! Form::text('street_name', !empty($street_name) ? $street_name : null, ['class' => 'form-control', 'placeholder' => __('zatca::lang.street_name')]) !!}
            </div>
        </div>
    </div>
    
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('building_number', __('zatca::lang.building_number') . ':') !!}
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-info"></i>
                </span>
                {!! Form::text('building_number', !empty($building_number) ? $building_number : null, ['class' => 'form-control', 'placeholder' => __('zatca::lang.building_number')]) !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('plot_identification', __('zatca::lang.plot_identification') . ':') !!}
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-info"></i>
                </span>
                {!! Form::text('plot_identification', !empty($plot_identification) ? $plot_identification : null, ['class' => 'form-control', 'placeholder' => __('zatca::lang.plot_identification')]) !!}
            </div>
        </div>
    </div>
    
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('city_subdivision_name', __('zatca::lang.city_subdivision') . ':') !!}
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-info"></i>
                </span>
                {!! Form::text('city_subdivision_name', !empty($city_subdivision_name) ? $city_subdivision_name : null, ['class' => 'form-control', 'placeholder' => __('zatca::lang.city_subdivision')]) !!}
            </div>
        </div>
    </div>
    
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('city', __('zatca::lang.city') . ':') !!}
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-info"></i>
                </span>
                {!! Form::text('city', !empty($city) ? $city : null, ['class' => 'form-control', 'placeholder' => __('zatca::lang.city')]) !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('country', __('zatca::lang.country') . ':') !!}
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-info"></i>
                </span>
                {!! Form::text('country', !empty($country) ? $country : null, ['class' => 'form-control', 'placeholder' => __('zatca::lang.country')]) !!}
            </div>
        </div>
    </div>
    
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('postal_number', __('zatca::lang.postal_number') . ':') !!}
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-info"></i>
                </span>
                {!! Form::text('postal_number', !empty($postal_number) ? $postal_number : null, ['class' => 'form-control', 'placeholder' => __('zatca::lang.postal_number')]) !!}
            </div>
        </div>
    </div>
    
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('tax_number', __('zatca::lang.tax_number') . ':') !!}
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-info"></i>
                </span>
                {!! Form::text('tax_number', !empty($tax_number) ? $tax_number : null, ['class' => 'form-control', 'placeholder' => __('zatca::lang.tax_number')]) !!}
            </div>
        </div>
    </div>
</div>


    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('registration_name', __('zatca::lang.registration_name') . ':') !!}
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-info"></i>
                </span>
                {!! Form::text('registration_name', !empty($registration_name) ? $registration_name : null, ['class' => 'form-control', 'placeholder' => __('zatca::lang.registration_name')]) !!}
            </div>
        </div>
    </div>
