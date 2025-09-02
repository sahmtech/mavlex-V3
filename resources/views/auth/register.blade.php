
@extends('layouts.auth')
@section('title', __('lang_v1.register'))

@section('stylesheet')
    <style>
        
    </style>
@endsection 

@section('content')
    <div class="details">
    <h2>@lang('lang_v1.create_account_heading', ['app_name' => env('APP_NAME')])</h2>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="input-wrapper">
            <label for="first_name">Enter Full Name</label>
            <input type="text" name="first_name" value="" required>
        </div>
        @if($errors->has('first_name'))
            <div class="input-error">
                <strong>{{ $errors->first('first_name') }}</strong>
            </div>
        @endif

        <div class="input-wrapper">
            <div class="phone-number-wrapper">
                <div class="country-code">
                    <label for="country_code">Country Code</label>
                    {!! Form::select('country_code', $countryCodes, 'NG - 234', ['placeholder' => 'Country Code', 'required']); !!}
                </div>
                <div>
                    <label for="contact_number">Phone Number</label>
                    <input type="number" name="contact_number" id="contact_number" value="" placeholder="000-000-000" required>
                </div>
            </div>
        </div>

        @if($errors->has('contact_number'))
            <div class="input-error">
                <strong>{{ $errors->first('contact_number') }}</strong>
            </div>
        @endif
        
        <div class="input-wrapper">
            <label for="username">Choose Username</label>
            <input type="text" name="username" onchange="myfunction(this.value)" id="username" value="{{ old('username') }}"  required>
            
            <p style="color: red" id="username_display"> </p>
        </div>
        @if($errors->has('username'))
            <div class="input-error">
                <strong>{{ $errors->first('username') }}</strong>
            </div>
        @endif

        <div class="input-wrapper">
            <label for="email">Enter Email Address</label>
            <input id="email" type="email" name="email" value="" required>
        </div>
        @if($errors->has('email'))
            <div class="input-error">
                <strong>{{ $errors->first('email') }}</strong>
            </div>
        @endif

        <div class="input-wrapper">
            <label for="password">@lang('lang_v1.password')</label>
            <input id="password" type="password" name="password" value="" required>
        </div>
        @if($errors->has('password'))
            <div class="input-error">
                <strong>{{ $errors->first('password') }}</strong>
            </div>
        @endif

        <div class="psw-strent-wrap">
            <div class="item" id="length">
                <i class="fa-sharp fa-solid fa-circle-check"></i>
                <div class="strenght-test">At least 8 characters</div>
            </div>

            <div class="item" id="lowercase">
                <i class="fa-sharp fa-solid fa-circle-check"></i>
                <div class="strenght-test">At least 1 lowercase letter</div>
            </div>

            <div class="item" id="uppercase">
                <i class="fa-sharp fa-solid fa-circle-check"></i>
                <div class="strenght-test">At least 1 uppercase letter</div>
            </div>

            <div class="item" id="numerical">
                <i class="fa-sharp fa-solid fa-circle-check"></i>
                <div class="strenght-test">At least 1 numerical number</div>
            </div>

            <div class="item" id="special">
                <i class="fa-sharp fa-solid fa-circle-check"></i>
                <div class="strenght-test">At least 1 special character</div>
            </div>
        </div>
        
        <div class="button-wrapper">
            <button type="submit">@lang('lang_v1.register')</button>
        </div>

        {!! Form::hidden('package_id', request()->get('package')); !!}
    </form>

        <div class="form-footer">
            <p>@lang('lang_v1.already_have_an_account') <a href="{{ route('login') }}">@lang('lang_v1.login')</a></p>
        </div>
 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>       
<script>

$(document).ready(function() {
    $('#contact_number').on('input propertychange paste', function (e) {
        var reg = /^0+/gi;
        if (this.value.match(reg)) {
            this.value = this.value.replace(reg, '');
        }
    });
    
});

function myfunction(){
    $("#contact_number").on("keyup", function () {               
      if ($(this).val() == 0) {
      $(this).val(null);                                     
      }                
    });
    axios.post('/business/register/check-username', {
        username: document.getElementById('username').value,
    })
    .then(function (response) {
        if (response.data.status) {

        document.getElementById('username_display').innerHTML = ""

        }else{

        document.getElementById('username').value = ""
        document.getElementById('username_display').innerHTML = "Username has already been taken"

        }
    })
    .catch(function (error) {
        console.log(error);
    });
}

const password = document.getElementById('password');

password.addEventListener("input", checkPasswordStrength);

function checkPasswordStrength(e) {
    console.log(e.target.value);
  var password = e.target.value;
  // Initialize variables
  var strength = 0;
  var length = document.getElementById("length");
  var lowercase = document.getElementById("lowercase");
  var uppercase = document.getElementById("uppercase");
  var numerical = document.getElementById("numerical");
  var special = document.getElementById("special");

  // Check password length
  if (password.length < 8) {
    length.classList.remove("green");
  } else {
    strength += 1;
    length.classList.add("green");
  }

  // Check for lower case
  if (password.match(/[a-z]/)) {
    strength += 1;
    lowercase.classList.add("green");
  } else {
    lowercase.classList.remove("green");
  }

  // Check for upper case
  if (password.match(/[A-Z]/)) {
    strength += 1;
    uppercase.classList.add("green");
  } else {
    uppercase.classList.remove("green");
  }

  // Check for numbers
  if (password.match(/\d/)) {
    strength += 1;
    numerical.classList.add("green");
  } else {
    numerical.classList.remove("green");
  }

  // Check for special characters
  if (password.match(/[^a-zA-Z\d]/)) {
    strength += 1;
    special.classList.add("green");
  } else {
    special.classList.remove("green");
  }

}

 </script>
    

@stop
@section('javascript')

@endsection