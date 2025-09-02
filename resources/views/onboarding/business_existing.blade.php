<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Onboarding Business Scale</title>
    <link rel="stylesheet" href="{{asset('onbording/asset/css/style.css')}}">
    <!-- font awesome -->
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
        
        <form action="{{route('business.set_business_type')}}"  method="POST">
                    @csrf
                    <input type="text" hidden name="business_type" id="business_type">

                    <div class="form-content">

                    <h3 class="auth-text-heading">One last step</h3>
        
                    <div class="business-scale-list">
                        <label class="business-slale-list-item" onclick="settype('Small Business')">
                            <input type="checkbox">
        
                            <div class="business-scale-wrapper">
                                <div class="image">
                                    <img src="{{asset('onbording/asset/img/pictures/small-business.svg')}}" alt="">
                                </div>
        
                                <div class="content">
                                    <h4>Small Business</h4>
                                    <span>Makeup, Fashion, Online Entrepreneur</span>
                                </div>
                            </div>
                        </label>
        
                        <label class="business-slale-list-item" onclick="settype('Retail & wholesales')">
                            <input type="checkbox">
        
                            <div class="business-scale-wrapper">
                                <div class="image">
                                    <img src="{{asset('onbording/asset/img/pictures/large-business.svg')}}" alt="">
                                </div>
        
                                <div class="content">
                                    <h4>Retail & Wholesale</h4>
                                    <span>Pharmacy, Supermarket, Restaurant, Bars and Spare Parts</span>
                                </div>
                            </div>
                        </label>
        
                        <label class="business-slale-list-item" onclick="settype('Companies & manufacturing')">
                            <input type="checkbox">
        
                            <div class="business-scale-wrapper">
                                <div class="image">
                                    <img src="{{asset('onbording/asset/img/pictures/large-business.svg')}}" alt="">
                                </div>
        
                                <div class="content">
                                    <h4>Companies & Manufacturing</h4>
                                    <span>Oil Companies, Construction Companies, Pure Water Factories & Startups</span>
                                </div>
                            </div>
                        </label>
                    </div>
        
                    <div class="onboarding-business-btn-wrapper">
                        <button>Continue</button>
                    </div>
                </div>
        </form>
        

    </div>
    
    <script src="{{asset('onbording/asset/js/main.js')}}"></script>
    
    <script>
        function settype(e) {
            document.getElementById("business_type").value = e;
             
        }
    </script>
</body>
</html>