@extends('layouts.app')

@section('content')
	<div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="overview-wrap">
                    <h2 class="title-1">Add-ons</h2>
                </div>
                <p>Boost your affiliate marketing abilities with these add-ons!</p>
                <hr />
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="addon-box">
                    <div class="addon-image">
                        <img src="https://www.redbai.com/wp-content/uploads/2018/04/mailchimp.jpg">
                    </div>
                    <div class="addon-description">
                        <h5 id="title">MailChimp</h5>
                        <hr />
                        <p id="description">Signups can automatically get added to whichever list you may have available on Mailchimp.</p>
                        <p id="price">$1/month</p>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footer')
    </div>
@endsection

@section('public_js')
    <script type="text/javascript">
        $(document).ready(function() {
            window.location.reload(true);
        });
    </script>
@endsection