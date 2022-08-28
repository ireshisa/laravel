@extends('layouts.master')
@push('payment_script')
    <script src="https://cdn.directpay.lk/live/00061/v1/directpayCardPayment.js?v=2.0.1"></script>
@endpush
@section('content')
    @include('common.spacer')
    <div class="main-container">
        <div class="container">

            <div class="row" style="display: none" id="success-box">
                <div class="col-md-6 col-sm-12 payment-box d-block m-auto">

                    <i class="fa fa-check-circle text-success"></i>
                    <h2 class="bg-success color-white py-2 text-center" id="success-head">Payment Successful</h2>
                    <h4 class="my-2 text-center" id="success-desc">Payment Successful</h4>

                </div>
            </div>

            <div class="row" id="error-box" style="display: none">
                <div class="col-md-6 col-sm-12 payment-box d-block m-auto">

                    <i class="fa fa-check-circle text-danger"></i>
                    <h2 class="bg-danger color-white py-2 text-center" id="error-head">Payment Error</h2>
                    <h4 class="my-2 text-danger" id="error-desc">There was an Error while Processing the Payment. Please
                        Try Again</h4>

                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    @include('flash::message')
                </div>

                @if ($package_id == 1)
                    <div class="col-md-12">

                    </div>
                @else
                    <div class="col-md-6 col-sm-12 m-auto d-block page-content">
                        <div id="card_container"></div>


                        <script>

                            var ref_id = "{{uniqid()}}";
                            var amount = "{{$prices}}";
                            var url = "{{url('upgrade_package')}}";
                            var pack_id = "{{$package_id}}";
                            var token = "{{csrf_token()}}";

                            DirectPayCardPayment.init({
                                container: 'card_container', //<div id="card_container"></div>
                                merchantId: 'OS09009', //Live merchant_id
                               // merchantId: 'GC04565', //Test merchant_id
                                amount: amount,
                                refCode: ref_id, //unique referance code form merchant
                                currency: 'LKR',
                                type: 'ONE_TIME_PAYMENT',
                                customerEmail: "{{auth()->user()->email}}",
                                customerMobile: "{{auth()->user()->phone}}",
                                description: '{{$short_name}}',  //product or service description
                                debug: true,
                                responseCallback: responseCallback,
                                errorCallback: errorCallback,
                                logo: 'https://test.com/directpay_logo.png',
                              //  apiKey: '724ab0de69f4e43d17c4bff1e56c0226' //Live
                                apiKey: 'b53d4de83783223c8912de6169904e137845333faf2c682cb185bbb689098d3d' //Test
                            });

                            //response callback.
                            function responseCallback(result) {

                                if (result.status == 200 && result.data.status == "SUCCESS") {



                                    var fData = new FormData();
                                    fData.append("package_id",pack_id);
                                    fData.append("payment_ref",result.data.transactionId);
                                    submitForm(url,fData).then((res)=> {
                                        console.log(res);
                                        setTimeout(() => {
                                            $("#card_container").hide();
                                            if (res.status)
                                            {
                                                $("#error-box").hide();
                                                $("#success-box").show();
                                                $("#success-head").html(res.title);
                                                $("#success-desc").html(res.description);
                                            }
                                            else {
                                                $("#error-box").show();
                                                $("#success-box").hide();
                                                $("#success-head").html(error.title);
                                                $("#success-desc").html(error.description);
                                            }



                                        }, 2000);
                                    },(error)=> {
                                        $("#card_container").hide();
                                        $("#error-box").show();
                                        $("#success-box").hide();
                                        $("#error-head").html("Package Upgrade Error");
                                        $("#error-desc").html("Package Upgrade Failed. Please Contact Our Support to Resolve.");
                                    })

                                }

                            }

                            //error callback
                            function errorCallback(result) {
                                console.log("successCallback-Client", result);
                                console.log(JSON.stringify(result));
                                setTimeout(() => {
                                    $("#card_container").hide();
                                    $("#success-box").hide();
                                    $("#error-box").show();
                                }, 1500);
                                //
                                //

                            }
                        </script>

                    </div>
                @endif
            </div>


        </div>
    </div>
@endsection
<script src="{{asset('assets/js/formsubmit.js')}}"></script>
@section('after_scripts')

    <script>

        $(document).ready(function () {
            var pack_id = "{{$package_id}}";

            if (pack_id == "1") {
                var fData = new FormData();

                fData.append("package_id",parseInt(pack_id));
                submitForm("{{url('upgrade_package')}}", fData).then((res) => {
                    $("#card_container").hide();
                    if (res.status == "success")
                    {
                        $("#error-box").hide();
                        $("#success-box").show();
                        $("#success-head").html(res.title);
                        $("#success-desc").html(res.description);
                    }
                    else {
                        $("#error-box").show();
                        $("#success-box").hide();
                        $("#success-head").html(error.title);
                        $("#success-desc").html(error.description);
                    }
                }, (error) => {
                    $("#error-box").show();
                    $("#success-box").hide();
                    $("#success-head").html("Trial Activation Error");
                    $("#success-desc").html("There was an Error While Activating the Package. Please Contact Our Support or Try Again");
                })
            }


        })
    </script>

@endsection
