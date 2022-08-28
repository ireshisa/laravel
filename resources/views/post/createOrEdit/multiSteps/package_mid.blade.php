<form class="form" id="postForm" method="POST" action="{{ url('/payment') }}">

    {!! csrf_field() !!}
    {{--                                    <input type="hidden" name="post_id" value="{{ $post->id }}">--}}
    <input type="hidden" name="amount" value="">
    <fieldset>

        @if (isset($packages))
            <div class="well pb-0">
                <h3><i class="icon-certificate icon-color-1"></i> {{ ('Buy connects') }} </h3>
                <!--<p>-->
                <!--    {{ t('premium_plans_hint') }}-->
                <!--</p>-->
                <?php $packageIdError = (isset($errors) and $errors->has('package_id')) ? ' is-invalid' : ''; ?>
                <div class="form-group mb-0">

                    <table id="packagesTable" class="table table-hover checkboxtable mb-0">
                        <?php
                        //                                                            session()->put('enable_trial',false);
                        //dd(session()->all());
                        //                                                            dd($packages);



                        // Get Current Payment data

                        $currentPaymentMethodId = 0;
                        $currentPaymentActive = 1;
                        //															if (isset($post->latestPayment) and !empty($post->latestPayment)) {
                        //																$currentPaymentMethodId = $post->latestPayment->payment_method_id;
                        //																if ($post->latestPayment->active == 0) {
                        //																	$currentPaymentActive = 0;
                        //																}
                        //															}
                        ?>

                        @foreach ($packages as $key=>$package)
                            <?php
                            $currentPackageId = 0;
                            $currentPackagePrice = 0;
                            $packageStatus = '';
                            $badge = '';

                            //															if (isset($post, $post->featured) and $post->featured == 1) {
                            //																if (isset($post->latestPayment) and !empty($post->latestPayment)) {
                            //																	if (isset($post->latestPayment->package) and !empty($post->latestPayment->package)) {
                            //																		$currentPackageId = $post->latestPayment->package->tid;
                            //																		$currentPackagePrice = $post->latestPayment->package->price;
                            //																	}
                            //																}
                            //
                            //																// Prevent Package's Downgrading
                            //																if ($currentPackagePrice > $package->price) {
                            //																	$packageStatus = ' disabled';
                            //																	$badge = ' <span class="badge badge-danger">' . t('Not available') . '</span>';
                            //																} elseif ($currentPackagePrice == $package->price) {
                            //																	$badge = '';
                            //																} else {
                            //																	if ($package->price > 0) {
                            //																		$badge = ' <span class="badge badge-success">' . t('Upgrade') . '</span>';
                            //																	}
                            //																}
                            //																if ($currentPackageId == $package->tid) {
                            //																	$badge = ' <span class="badge badge-default">' . t('Current') . '</span>';
                            //																	if ($currentPaymentActive == 0) {
                            //																		$badge .= ' <span class="badge badge-warning">' . t('Payment pending') . '</span>';
                            //																	}
                            //																}
                            //															} else {
                            //																if ($package->price > 0) {
                            //																	$badge = ' <span class="badge badge-success">' . t('Upgrade') . '</span>';
                            //																}
                            //															}
                            ?>
                            <tr>
                                <td class="text-left align-middle p-3">
                                    <div class="form-check">
                                        <input class="form-check-input package-selection{{ $packageIdError }}"
                                               type="radio"
                                               name="package_id"
                                               id="packageId-{{ $package->tid }}"
                                               value="{{ $package->tid }}"
                                               data-connects="{{ $package->connects }}"
                                               data-amount="{{$package->price}}"
                                               data-name="{{ $package->name }}"
                                               data-currencysymbol="{{ $package->currency->symbol }}"
                                               data-currencyinleft="{{ $package->currency->in_left }}" {{(($key==0)?'checked':'')}}
                                              
                                        >
                                        <label>
                                            <strong class="tooltipHere"
                                                    title=""
                                                    data-placement="right"
                                                    data-toggle="tooltip"
                                                    data-original-title="{!! $package->description !!}"
                                            >{!! $package->name . $badge !!}</strong>
                                        </label>

                                    </div>
                                </td>
                                <td class="text-center align-middle p-3"><span class="badge badge-success mx-1 font-weight-bold">{{($package->connects > 10000)?"Unlimited":$package->connects}} </span> Connects</td>
                                <td class="text-right align-middle p-3">
                                    <p id="price-{{ $package->tid }}" class="mb-0">
                                        @if ($package->currency->in_left == 1)
                                            <span class="price-currency">{!! $package->currency->symbol !!}</span>
                                        @endif
                                        <span class="price-int">{{ $package->price }}</span>
                                        @if ($package->currency->in_left == 0)
                                            <span class="price-currency">{!! $package->currency->symbol !!}</span>
                                        @endif
                                    </p>
                                </td>
                            </tr>
                        @endforeach

                        <tr>
                         <?php /* 	<td class="text-left align-middle p-3">
                           	<?php $paymentMethodIdError = (isset($errors) and $errors->has('payment_method_id')) ? ' is-invalid' : ''; ?>
                              <div class="form-group mb-0">
                            	<div class="col-md-10 col-sm-12 p-0">
                                  <select class="form-control selecter" name="payment_method_id" id="paymentMethodId">
                                    @foreach ($paymentMethods as $paymentMethod)
                                        @if (view()->exists('payment::' . $paymentMethod->name))
                                    <option value="{{ $paymentMethod->id }}" data-name="{{ $paymentMethod->name }}" {{ (old('payment_method_id')==$paymentMethod->id) ? 'selected="selected"' : '' }}>
                                        @if ($paymentMethod->name == 'offlinepayment')
                                         {{ trans('offlinepayment::messages.Offline Payment') }}
                                        @else
                                            {{ $paymentMethod->display_name }}
                                        @endif
                                    </option>
                                        @endif
                                    @endforeach
                                    <option value="2" data-name="DirectPay"  'selected="selected"' : '' }} >DirectPay </option>
                                  </select>
                                </div>
                            </div>
                            </td> */?>
                            
                            <td class="text-right align-middle p-3" colspan="3">
                                <p class="mb-0">
                                    <strong>
                                        {{ t('Payable Amount') }}:
                                        <span class="price-currency amount-currency currency-in-left" style="display: none;"></span>
                                        <span class="payable-amount">0</span>
                                        <span class="price-currency amount-currency currency-in-right" style="display: none;"></span>
                                    </strong>
                                </p>
                            </td>
                        </tr>

                    </table>
                </div>
            </div>

        @if (isset($paymentMethods) and $paymentMethods->count() > 0)
            <!-- Payment Plugins -->
            <?php $hasCcBox = 0; ?>
            @foreach($paymentMethods as $paymentMethod)
                @if (view()->exists('payment::' . $paymentMethod->name))
                    @include('payment::' . $paymentMethod->name, [$paymentMethod->name . 'PaymentMethod' => $paymentMethod])
                @endif
                <?php if ($paymentMethod->has_ccbox == 1 && $hasCcBox == 0) $hasCcBox = 1; ?>
            @endforeach
        @endif
    @endif

    <!-- Button  -->
        <div class="form-group">
            <div class="col-md-12 text-center mt-4">

                {{--                                                @if (getSegment(2) == 'create')--}}
                {{--                                                    <a id="skipBtn" href="{{ lurl('posts/create/' . $post->tmp_token . '/finish') }}" class="btn btn-default btn-lg">{{ t('Skip') }}</a>--}}
                {{--                                                @else--}}
                {{--                                                    <a id="skipBtn" href="{{ \App\Helpers\UrlGen::post($post) }}" class="btn btn-default btn-lg">{{ t('Skip') }}</a>--}}
                {{--                                                @endif--}}
                {{--                                                <button id="submitPostForm" class="btn btn-success btn-lg submitPostForm"> {{ t('Pay') }} </button>--}}
               @php
               if (Request::segment(1) == "posts")
    {
               @endphp
                <a id="skipBtn" href="{{ lurl('/posts/matched') }}" class="btn btn-default btn-lg mx-1">{{ t('Skip') }}</a>
        @php
          }
else {
    @endphp
    <a id="skipBtn" href="{{ lurl('/') }}" class="btn btn-default btn-lg mx-1">{{ t('Skip') }}</a>
@php
}
        @endphp
                <button type="submit" id="payBtn" href="{{ lurl('payments') }}" class="btn btn-success btn-lg mx-1">{{ t('Buy') }}</button>

            </div>
        </div>

    </fieldset>
</form>
@section('after_scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/1.2.3/jquery.payment.min.js"></script>
    @if (file_exists(public_path() . '/assets/plugins/forms/validation/localization/messages_'.config('app.locale').'.min.js'))
        <script src="{{ url('/assets/plugins/forms/validation/localization/messages_'.config('app.locale').'.min.js') }}" type="text/javascript"></script>
    @endif

    <script>
       
         @if (isset($packages) and isset($paymentMethods))

        var currentPackagePrice = {{ $currentPackagePrice }};
        var currentPaymentActive = {{ $currentPaymentActive }};
        $(document).ready(function ()
        {
            /* Show price & Payment Methods */
            var selectedPackage = $('input[name=package_id]:checked').val();
            var packagePrice = getPackagePrice(selectedPackage);
            var packageCurrencySymbol = $('input[name=package_id]:checked').data('currencysymbol');
            var packageCurrencyInLeft = $('input[name=package_id]:checked').data('currencyinleft');
            var paymentMethod = $('#paymentMethodId').find('option:selected').data('name');
            var activateTrans = "{{t('ActivateTrial')}}";
            var buyTrans = "{{t('Buy')}}";
            showAmount(packagePrice, packageCurrencySymbol, packageCurrencyInLeft);
            $("#packagesTable tbody tr:first td input[type='radio']").prop('checked',true).trigger('click');
            // $('.package-selection').trigger('click');
            // $("#payBtn").hide();


            /* Select a Package */
            $('.package-selection').click(function () {
                selectedPackage = $(this).val();
                $("#payBtn").show();
                if (selectedPackage != 1)
                {


                    $("#payBtn").text(buyTrans);


                    $("input[name='amount']").val($(this).data('amount'));

                }
                else {
                    $("#payBtn").text(activateTrans);
                    $("#skipBtn").show();
                }
                packagePrice = getPackagePrice(selectedPackage);
                packageCurrencySymbol = $(this).data('currencysymbol');
                packageCurrencyInLeft = $(this).data('currencyinleft');
                showAmount(packagePrice, packageCurrencySymbol, packageCurrencyInLeft);

            });

            /* Select a Payment Method */
            $('#paymentMethodId').on('change', function () {
                paymentMethod = $(this).find('option:selected').data('name');
                showPaymentSubmitButton(currentPackagePrice, packagePrice, currentPaymentActive, paymentMethod);
            });

            /* Form Default Submission */
            $('#submitPostForm').on('click', function (e) {
                e.preventDefault();

                if (packagePrice <= 0) {
                    $('#postForm').submit();
                }

                return true;
            });

            $('#submitPostForm').on('click', function (e) {
                e.preventDefault();

                if (packagePrice <= 0) {
                    $('#postForm').submit();
                }
                if (packagePrice > 0) {
                    localStorage.setItem("pay", packagePrice);
                    localStorage.setItem("type", packagePrice);
                    $('#smallModal').modal('show');
                    //window.open("{{  lurl('/search-talent') }}" ,'popUpWindow','height=400,width=600,left=10,top=10,,scrollbars=yes,menubar=no'); return false;
                }

                return true;
            });
        });

        @endif
        /* Show or Hide the Payment Submit Button */
        /* NOTE: Prevent Package's Downgrading */
        /* Hide the 'Skip' button if Package price < 0 */



    </script>
@endsection
