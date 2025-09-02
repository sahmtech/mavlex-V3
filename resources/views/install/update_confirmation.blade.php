@extends('layouts.install', ['no_header' => 1])
@section('title', 'POS Installation - Update')

@section('content')
<style>
.grid-container {
  display: grid;
  grid-template-columns: 1fr;

}

.grid-content {
  grid-column: 2 / 3;
}

</style>
<div class="container grid-container">
    <div class="row">

        <div class="col-md-8 col-md-offset-2">
            <br/><br/>
          <div class="box box-primary active">
            <!-- /.box-header -->
            <div class="box-body">

              @if(session('error'))
                <div class="alert alert-danger">
                    {!! session('error') !!}
                </div>
              @endif

              @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                  </ul>
                </div>
              @endif

              <form class="form" id="details_form" method="post" 
                      action="{{route('install.update')}}">
                    {{ csrf_field() }}

                    <h4> License Details <small class="text-danger">Make sure to provide correct information from bardpos.com license information</small></h4>
                    <hr/>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="purchase_code">Purchase Code (License Code):*</label>
                            <input type="text" name="PURCHASE_CODE" required class="form-control" id="purchase_code">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="bpos_username">Username:*</label>
                            <input type="text" name="BPOS_USERNAME" required class="form-control" id="bpos_username">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                          <label for="bpos_email">Your Email:</label>
                          <input type="bpos_email" name="BPOS_EMAIL" class="form-control" id="bpos_email" placeholder="optional">
                          <p class="help-block">For Newsletter & support</p>
                        </div>
                    </div>
                    @include('install.partials.i_service')
                    @include('install.partials.e_license')

                    <div class="col-md-12">
                        <button type="submit" id="install_button" class="btn btn-primary pull-right">I Agree, Update</button>
                    </div>
              </form>
            </div>
          <!-- /.box-body -->
          </div>
        </div>

    </div>
</div>
@endsection

@section('javascript')
  <script type="text/javascript">
    $(document).ready(function(){
      $('select#MAIL_MAILER').change(function(){
        var driver = $(this).val();

        if(driver == 'smtp'){
          $('div.smtp').removeClass('hide');
          $('input.smtp_input').attr('disabled', false);
        } else {
          $('div.smtp').addClass('hide');
          $('input.smtp_input').attr('disabled', true);
        }
      })

      $('form#details_form').submit(function(){
        $('button#install_button').attr('disabled', true).text('Installing...');
        $('div.install_msg').removeClass('hide');
        $('.back_button').hide();
      });

    })
  </script>
@endsection