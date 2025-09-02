
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Onboarding Business</title>
    <link rel="stylesheet" href="{{asset('onbording/asset/css/style.css')}}">
    <!-- font awesome -->

    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>

    <div class="login-layout">

        <div class="auth-logo">
            @php
            $app_logo = $app_settings->app_logo ? json_decode($app_settings->app_logo, true) : [];
            $logo_light = $app_logo['light'] ?? null;
        @endphp
        
        @if($logo_light)
            <img src="{{ upload_asset('uploads/app_logos/' . $logo_light) }}" alt="logo">
        @else
            <div class="logo-text">
                {{ config('app.name', 'BardPOS') }}
            </div>
        @endif
        </div>

        <div class="form-content">

            <h3 class="auth-text-heading">Create your {{ env('APP_NAME') }} account</h3>

                <form action="{{route('business.OnboardBusiness')}}" method="POST">
                    @csrf
                <div class="input-wrapper">
                    <label for="name">Business Name</label>
                    <input type="text" type="text"  name="name" value="{{ old('name') }}" id="name">
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="input-wrapper">
                    <label for="country">Country</label>
                    {!! Form::select('country', $countries, 'Nigeria', ['id' => 'country_id', 'class' => 'form-control select2_register','placeholder' => __('business.country'), 'required']); !!}
                </div>

                <div class="input-wrapper">
                    <label for="password">State</label>
                    <select name="state" id="state_id">
                        <option value="" selected="selected">- Select State</option>-->
                            <option value="Abuja FCT">Abuja FCT</option>
                            <option value="Abia">Abia</option>
                            <option value="Adamawa">Adamawa</option>
                            <option value="Akwa Ibom">Akwa Ibom</option>
                            <option value="Anambra">Anambra</option>
                            <option value="Bauchi">Bauchi</option>
                            <option value="Bayelsa">Bayelsa</option>
                            <option value="Benue">Benue</option>
                            <option value="Borno">Borno</option>
                            <option value="Cross River">Cross River</option>
                            <option value="Delta">Delta</option>
                            <option value="Ebonyi">Ebonyi</option>
                            <option value="Edo">Edo</option>
                            <option value="Ekiti">Ekiti</option>
                            <option value="Enugu">Enugu</option>
                            <option value="Gombe">Gombe</option>
                            <option value="Imo">Imo</option>
                            <option value="Jigawa">Jigawa</option>
                            <option value="Kaduna">Kaduna</option>
                            <option value="Kano">Kano</option>
                            <option value="Katsina">Katsina</option>
                            <option value="Kebbi">Kebbi</option>
                            <option value="Kogi">Kogi</option>
                            <option value="Kwara">Kwara</option>
                            <option value="Lagos">Lagos</option>
                            <option value="Nassarawa">Nassarawa</option>
                            <option value="Niger">Niger</option>
                            <option value="Ogun">Ogun</option>
                            <option value="Ondo">Ondo</option>
                            <option value="Osun">Osun</option>
                            <option value="Oyo">Oyo</option>
                            <option value="Plateau">Plateau</option>
                            <option value="Rivers">Rivers</option>
                            <option value="Sokoto">Sokoto</option>
                            <option value="Taraba">Taraba</option>
                            <option value="Yobe">Yobe</option>
                            <option value="Zamfara">Zamfara</option>
                    </select>
                    
                    @if ($errors->has('state'))
                        <span class="help-block">
                            <strong>{{ $errors->first('state') }}</strong>
                        </span>
                    @endif
                </div>
                
                <div class="input-wrapper">
                    <label for="name">City</label>
                    <input type="text" type="text"  name="city" value="{{ old('city') }}" id="name">
                    @if ($errors->has('city'))
                        <span class="help-block">
                            <strong>{{ $errors->first('city') }}</strong>
                        </span>
                    @endif
                </div>
                
                <div class="input-wrapper">
                    <label for="name">Landmark</label>
                    <input type="text" type="text"  name="landmark" value="{{ old('landmark') }}" id="landmark">
                    @if ($errors->has('landmark'))
                        <span class="help-block">
                            <strong>{{ $errors->first('landmark') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="input-wrapper">
                    {!! Form::label('currency_id', __('business.currency') . ':*') !!}
                    {!! Form::select('currency_id', $currencies, 87, ['class' => 'form-control select2_register','placeholder' => __('business.currency_placeholder'), 'required']); !!}
                </div>

                <div class="button-wrapper">
                    <button>Create my Business</button>
                </div>
            </form>

          
            
        </div>
        
      

    </div>
    
    <script src="{{asset('onbording/asset/js/main.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        $(document).on('change', '#country_id', function() {
            get_states();
        });

        function get_states() {
            var country = $('#country_id').val();
            $.ajax({
                method: 'POST',
                url: '/business/get_states',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'html',
                data: { country_id: country },
                success: function(result) {
                    if (result) {
                        $('#state_id').html(result);
                    }
                },
            });
        }
    </script>
</body>
</html>