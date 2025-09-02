@extends('layouts.auth')
@section('title', __('superadmin::lang.pricing'))

@section('content')
<style>
    @media (max-width: 767px) {
  .col-xs-12 {
    flex: 0 0 100%;
    max-width: 100%;
  }
}
@media (min-width: 768px) {
  .col-sm-4 {
    flex: 0 0 33.333333%;
    max-width: 33.333333%;
  }
}
/* Custom column size for larger cards */
.col-lg-custom {
  flex: 0 0 33.333333%;
  max-width: 33.333333%;
}

/* Ensure that the cards are of equal height and width within their container */
.card-equal-height {
  display: flex;
  flex-direction: column;
  height: 100%; /* This will make sure that the card stretches to the full height */
}

/* Set a minimum height for the cards to make them larger */
.card {
  min-height: 450px; /* Adjust this value based on your needs */
}

/* Optional: Increase padding inside the card for larger content area */
.card .box-body {
  padding: 20px;
}

/* Ensure the footer is at the bottom of the card */
.card .box-footer {
  margin-top: auto;
}

/* Make sure the row wraps */

.box {
  flex: 1; /* Allows the card to expand */
  display: flex;
  flex-direction: column; /* Ensure the content of the card stacks vertically */
}

.box-body {
  flex-grow: 1; /* Allows the body to expand and push the footer down */
}

.box-footer {
  margin-top: auto; /* Pushes the footer to the bottom of the card */
}


    </style>
<div class="main-container no-print">
@include('superadmin::layouts.partials.currency')
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center">@lang('superadmin::lang.packages')</h3>
        </div>

            <div class="box-body">
                @include('superadmin::subscription.partials.packages', ['action_type' => 'register'])
            </div>
        </div>
    </div>
</div>


@stop

@section('javascript')
<script type="text/javascript">
    $(document).ready(function(){
        $('#change_lang').change( function(){
            window.location = "{{ route('pricing') }}?lang=" + $(this).val();
        });
    })
</script>
@endsection
