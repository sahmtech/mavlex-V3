<!-- <strong>{{ $contact->name }}</strong><br><br> -->
<div class="customer-name">
    <span>
        @if($contact->type == 'both')
            {{__('role.customer')}} & {{__('role.supplier')}}
        @elseif(($contact->type != 'lead'))
            {{__('role.'.$contact->type)}}
        @endif
    </span>

    <h3>{{ $contact->name }}</h3>
</div>

<div class="customer-address">
    <div class="item">
        <span>@lang('business.address')</span>
        <strong>{!! $contact->contact_address !!}</strong>
    </div>

    @if($contact->supplier_business_name)
        <div class="item">
            <span>@lang('business.business_name')</span>
            <strong>
                {{ $contact->supplier_business_name }}
            </strong>
        </div>
    @endif

    <div class="item">
        <span>@lang('contact.mobile')</span>
        <strong>{{ $contact->mobile }}</strong>
    </div>

    @if($contact->landline)
    <div class="item">
        <span>@lang('contact.landline')</span>
        <strong>
            {{ $contact->landline }}
        </strong>
    </div>
    @endif
    @if($contact->alternate_number)
        <div class="item">
            <span> @lang('contact.alternate_contact_number')</span>
            <strong>
                {{ $contact->alternate_number }}
            </strong>
        </div>
    @endif
    @if($contact->dob)
        <div class="item">
            <span> @lang('lang_v1.dob')</span>
            <strong>
                {{ @format_date($contact->dob) }}
            </strong>
        </div>
    @endif
</div>