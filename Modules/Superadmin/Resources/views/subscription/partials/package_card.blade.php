<style>
.package-container {
    display: grid;
    grid-template-columns: repeat(4, 1fr); /* 4 equal columns */
    gap: 20px; /* Space between cards */
    padding: 20px; /* Padding around the grid */
}

.pricing-card {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
    padding: 20px;
    border-radius: 10px;
    background-color: #fff; 
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    box-sizing: border-box;
    margin-bottom: 20px;
}
.text-primary{
    color:var(--primary-color)!important;
}

.pricing-card .heading {
    text-align: center;
    margin-bottom: 20px;
}

.pricing-card:hover {
    transform: translateY(-5px);
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
}

.feature-list {
    flex-grow: 1;
}

.list-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 10px;
    text-align: left;
}

.list-item i {
    margin-right: 10px;
    align-self: flex-start;
}

.list-item p {
    margin: 0;
    flex-grow: 1;
}

.amount {
    margin-top: auto;
    text-align: center;
}
.btn-primary {
    display: block;
    margin: 0 auto;
    text-align: center;
    max-width: 200px; 
    padding-top: 10px; 
    padding-bottom: 10px;
    color: #fff;
}

.btn-primary span {
    margin-top: 10px; 
    display: inline-block; 
}
.price-container {
    position: relative;
    text-align: center;
    margin-bottom: 30px;
}

.interval {
    position: absolute;
    top: 0;
    right: 0;
    font-size: 0.8rem;
    color: #666;
}

.free-container {
    text-align: center;
}

.free-container span {
    display: block;
    margin-top: 10px;
    font-size: 0.9rem;
    color: #666;
}
.heading-container {
    position: relative;
    text-align: center;
    margin-bottom: 20px;
}

.heading {
    text-align: center;
    width: 100%;
}

.badge-container {
    position: absolute;
    top: -10px;
    left: -10px;
}

@media (max-width: 1200px) {
    .package-container {
        grid-template-columns: repeat(3, 1fr); 
    }
}

@media (max-width: 992px) {
    .package-container {
        grid-template-columns: repeat(2, 1fr); 
    }
}

@media (max-width: 768px) {
    .package-container {
        grid-template-columns: 1fr; 
    }
}

</style>
<div class="pricing-card">
<div class="heading-container">
    <div class="heading">
        <h4>{{ $package->name }}</h4>
    </div>
    @if($package->mark_package_as_popular == 1)
        <div class="badge-container">
            <span class="badge bg-green">@lang('superadmin::lang.popular')</span>
        </div>
    @endif
   
</div>

    <div class="amount text-center">
        @php
            $interval_type = !empty($intervals[$package->interval]) ? $intervals[$package->interval] : __('lang_v1.' . $package->interval);
        @endphp
       @if($package->price != 0)
    <div class="price-container">
        
        <h1 class="display_currency" data-currency_symbol="true">
            {{ $package->price }}
        </h1>
        <span class="">{{ $package->description }}</span>
        <span class="interval">{{ $package->interval_count }} {{ $interval_type }}</span>
    </div>
@else
<div class="price-container">
        <h1 style="font-size: 2rem; color: var(--secondary-color);">FREE</h1>
        <span class="">{{ $package->description }}</span>
        <span class="interval">{{ $package->interval_count }} {{ $interval_type }}</span>
        
    </div>
@endif

    </div>

    <div class="feature-list">
        <div class="list-item">
            <i class="fa fa-check text-primary"></i>
            <p>
                @if($package->location_count == 0)
                    @lang('superadmin::lang.unlimited') 
                @else 
                    {{ $package->location_count }} 
                @endif
                @lang('business.business_locations')
            </p>
        </div>

        <div class="list-item">
            <i class="fa fa-check text-primary"></i>
            <p>
                @if($package->user_count == 0)
                    @lang('superadmin::lang.unlimited')
                @else
                    {{ $package->user_count }}
                @endif
                @lang('superadmin::lang.users')
            </p>
        </div>

        <div class="list-item">
            <i class="fa fa-check text-primary"></i>
            <p>
                @if($package->product_count == 0)
                    @lang('superadmin::lang.unlimited')
                @else
                    {{ $package->product_count }}
                @endif
                @lang('superadmin::lang.products')
            </p>
        </div>

        <div class="list-item">
            <i class="fa fa-check text-primary"></i>
            <p>
                @if($package->invoice_count == 0)
                    @lang('superadmin::lang.unlimited')
                @else
                    {{ $package->invoice_count }}
                @endif
                @lang('superadmin::lang.invoices')
            </p>
        </div>

        @if(!empty($package->custom_permissions))
            @foreach($package->custom_permissions as $permission => $value)
                @isset($permission_formatted[$permission])
                    <div class="list-item">
                        <i class="fa fa-check text-primary"></i>
                        <p>{{ $permission_formatted[$permission] }}</p>
                    </div>
                @endisset
            @endforeach
        @endif

        @if($package->trial_days != 0)
            <div class="list-item">
                <i class="fa fa-check text-primary"></i>
                <p>{{ $package->trial_days }} @lang('superadmin::lang.trial_days')</p>
            </div>
        @endif
    </div>

    <div class="amount text-center">
        @if($package->enable_custom_link == 1)
            <a href="{{ $package->custom_link }}" class="btn btn-primary">{{ $package->custom_link_text }}</a>
        @else
            @if(isset($action_type) && $action_type == 'register')
                <a href="{{ route('business.getRegister') }}?package={{ $package->id }}" class="btn btn-primary">
                    @if($package->price != 0)
                        @lang('superadmin::lang.register_subscribe')
                    @else
                        @lang('superadmin::lang.register_free')
                    @endif
                </a>
            @else
                <a href="{{ action([\Modules\Superadmin\Http\Controllers\SubscriptionController::class, 'pay'], [$package->id]) }}" class="btn btn-primary">
                    @if($package->price != 0)
                        @lang('superadmin::lang.pay_and_subscribe')
                    @else
                        @lang('superadmin::lang.subscribe')
                    @endif
                </a>
            @endif
        @endif
    </div>
</div>
