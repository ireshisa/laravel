<?php
	$fullUrl = rawurldecode(url(\Illuminate\Support\Facades\Request::getRequestUri()));
	$plugins = array_keys((array)config('plugins'));
	$publicDisk = \Storage::disk(config('filesystems.default'));
?>
<!DOCTYPE html>
<html lang="{{ ietfLangTag(config('app.locale')) }}"{!! (config('lang.direction')=='rtl') ? ' dir="rtl"' : '' !!}>
<head>
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	@include('common.meta-robots')
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="apple-mobile-web-app-title" content="{{ config('settings.app.app_name') }}">
	<meta name="facebook-domain-verification" content="olslwgpubed62fplh8cx2v262mo060" />
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ $publicDisk->url('app/default/ico/apple-touch-icon-144-precomposed.png') . getPictureVersion() }}">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ $publicDisk->url('app/default/ico/apple-touch-icon-114-precomposed.png') . getPictureVersion() }}">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ $publicDisk->url('app/default/ico/apple-touch-icon-72-precomposed.png') . getPictureVersion() }}">
	<link rel="apple-touch-icon-precomposed" href="{{ $publicDisk->url('app/default/ico/apple-touch-icon-57-precomposed.png') . getPictureVersion() }}">
	<!--<link rel="shortcut icon" href="{{ imgUrl(config('settings.app.favicon'), 'favicon') }}">-->
	<link rel="icon" type="image/png" sizes="16x16" href="{{url('images/favicon-16x16.png')}}">

	<meta name="facebook-domain-verification" content="olslwgpubed62fplh8cx2v262mo060" />

	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>{!! MetaTag::get('title') !!}</title>
	{!! MetaTag::tag('description') !!}{!! MetaTag::tag('keywords') !!}
	@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
		@if (strtolower($localeCode) == strtolower(config('lang.abbr', config('app.locales'))))
			<link rel="canonical" href="{{ LaravelLocalization::getLocalizedURL($localeCode) }}"/>
		@else
			<link rel="alternate" href="{{ LaravelLocalization::getLocalizedURL($localeCode) }}" hreflang="{{ strtolower($localeCode) }}"/>
		@endif
	@endforeach
	
	@if (isset($post))
		@if (isVerifiedPost($post))
			@if (config('services.facebook.client_id'))
				<meta property="fb:app_id" content="{{ config('services.facebook.client_id') }}" />
			@endif
		
			{!! MetaTag::twitterCard() !!}
		@endif
	@else
		@if (config('services.facebook.client_id'))
			<meta property="fb:app_id" content="{{ config('services.facebook.client_id') }}" />
		@endif
	
		{!! MetaTag::twitterCard() !!}
	@endif
	@include('feed::links')
	@if (config('settings.seo.google_site_verification'))
		<meta name="google-site-verification" content="{{ config('settings.seo.google_site_verification') }}" />
	@endif
	@if (config('settings.seo.msvalidate'))
		<meta name="msvalidate.01" content="{{ config('settings.seo.msvalidate') }}" />
	@endif
	@if (config('settings.seo.alexa_verify_id'))
		<meta name="alexaVerifyID" content="{{ config('settings.seo.alexa_verify_id') }}" />
	@endif
	@if (config('settings.seo.yandex_verification'))
		<meta name="yandex-verification" content="{{ config('settings.seo.yandex_verification') }}" />
	@endif
	
	@yield('before_styles')

	@if (config('lang.direction') == 'rtl')
		<link href="https://fonts.googleapis.com/css?family=Cairo|Changa" rel="stylesheet">
		<link href="{{ url(mix('css/app.rtl.css')) }}" rel="stylesheet">
	@else
		<link href="{{ url(mix('css/app.css')) }}" rel="stylesheet">
	@endif
	@if (config('plugins.detectadsblocker.installed'))
		<link href="{{ url('assets/detectadsblocker/css/style.css') . getPictureVersion() }}" rel="stylesheet">
	@endif
	
	@include('layouts.inc.tools.style')
	<script src="https://www.google-analytics.com/analytics.js"></script>
	
	<style>
          .social-btn .btn {
              margin: 10px 0;
              font-size: 15px;
              text-align: left; 
              line-height: 24px;    
              color:white !important;
          }
          .social-btn .btn i {
              float: left;
              margin: 4px 15px  0 5px;
              min-width: 15px;
          }
          .input-group-addon .fa{
              font-size: 18px;
          }
    </style>
	<style>
        .btn-facebook {
  	      color: #ffffff !important;
  	      background-color: #3b5998 !important;
        }
        .btn-google{
          background: #dd4b39 !important;
        }
        .btn-linkedin{
            background-color:#0e76a8 !important;
        }
        
        .person-info img
        {
 width: 150px !important;
    height: 150px !important;
    object-fit: cover !important;
    border-radius: 20px !important;
        }
    </style>
	@yield('after_styles')
	@stack('styles')
	@if (isset($plugins) and !empty($plugins))
		@foreach($plugins as $plugin)
			@yield($plugin . '_styles')
		@endforeach
	@endif
	
	@if (config('settings.style.custom_css'))
		{!! printCss(config('settings.style.custom_css')) . "\n" !!}
	@endif
	
	@if (config('settings.other.js_code'))
		{!! printJs(config('settings.other.js_code')) . "\n" !!}
	@endif

	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
<link href="{{ url('css/custom.css') . getPictureVersion() }}" rel="stylesheet">
	<script>
		paceOptions = {
			elements: true
		};
	</script>
	<script src="{{ url('assets/js/pace.min.js') }}"></script>
	<script src="{{ url('assets/plugins/modernizr/modernizr-custom.js') }}"></script>
	
	@section('recaptcha_scripts')
		@if (
			config('settings.security.recaptcha_activation')
			and config('recaptcha.site_key')
			and config('recaptcha.secret_key')
		)
			<style>
				.is-invalid .g-recaptcha iframe,
				.has-error .g-recaptcha iframe {
					border: 1px solid #f85359;
				}
			</style>
			@if (config('recaptcha.version') == 'v3')
				<script type="text/javascript">
					function myCustomValidation(token){
						/* read HTTP status */
						/* console.log(token); */
						
						if ($('#gRecaptchaResponse').length) {
							$('#gRecaptchaResponse').val(token);
						}
					}
				</script>
				{!! recaptchaApiV3JsScriptTag([
					'action' 		    => request()->path(),
					'custom_validation' => 'myCustomValidation'
				]) !!}
			@else
				{!! recaptchaApiJsScriptTag() !!}
			@endif
		@endif
	@show
<script async src="https://www.googletagmanager.com/gtag/js?id=G-4YGFB7JK04"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-4YGFB7JK04');
</script>
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '4538896552841191');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www. .com/tr?id=4538896552841191&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->

</head>

<body class="{{ config('app.skin') }}">
@stack('payment_script')
<div id="wrapper">

	@section('header')
		@include('layouts.inc.header')
	@show

	@section('search')
	@show
		
	@section('wizard')
	@show

<?php /*	@if (isset($siteCountryInfo))
		<div class="h-spacer"></div>
		<div class="container">
			<div class="row">
				<div class="col-xl-12">
					<div class="alert alert-warning">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<a data-toggle="modal" href="#quickLogin"><strong>Login</strong></a> for faster access to the best deals. <a data-toggle="modal" href="#quickRegister"><strong>Click</strong></a> here if you don't have an account.
					</div>
				</div>
			</div>
		</div>
	@endif */ ?>

	@yield('content')

	@section('info')
	@show
	
	@section('footer')
		@include('layouts.inc.footer')
	@show

</div>

@section('modal_location')
@show
@section('modal_abuse')
@show
@section('modal_message')
@show

@includeWhen(!auth()->check(), 'layouts.inc.modal.login')
@includeWhen(!auth()->check(), 'layouts.inc.modal.register')
@include('layouts.inc.modal.change-country')
@include('cookieConsent::index')

@if (config('plugins.detectadsblocker.installed'))
	@if (view()->exists('detectadsblocker::modal'))
		@include('detectadsblocker::modal')
	@endif
@endif

<script>
	{{-- Init. Root Vars --}}
	var siteUrl = '<?php echo url((!currentLocaleShouldBeHiddenInUrl() ? config('app.locale') : '' ) . '/'); ?>';
	var languageCode = '<?php echo config('app.locale'); ?>';
	var countryCode = '<?php echo config('country.code', 0); ?>';
	var timerNewMessagesChecking = <?php echo (int)config('settings.other.timer_new_messages_checking', 0); ?>;
	
	{{-- Init. Translation Vars --}}
	var langLayout = {
		'hideMaxListItems': {
			'moreText': "{{ t('View More') }}",
			'lessText': "{{ t('View Less') }}"
		},
		'select2': {
			errorLoading: function(){
				return "{!! t('The results could not be loaded.') !!}"
			},
			inputTooLong: function(e){
				var t = e.input.length - e.maximum, n = {!! t('Please delete #t character') !!};
				return t != 1 && (n += 's'),n
			},
			inputTooShort: function(e){
				var t = e.minimum - e.input.length, n = {!! t('Please enter #t or more characters') !!};
				return n
			},
			loadingMore: function(){
				return "{!! t('Loading more results…') !!}"
			},
			maximumSelected: function(e){
				var t = {!! t('You can only select #max item') !!};
				return e.maximum != 1 && (t += 's'),t
			},
			noResults: function(){
				return "{!! t('No results found') !!}"
			},
			searching: function(){
				return "{!! t('Searching…') !!}"
			}
		}
	};
</script>

@yield('before_scripts')

<script src="{{ url(mix('js/app.js')) }}"></script>

@if (file_exists(public_path() . '/assets/plugins/select2/js/i18n/'.config('app.locale').'.js'))
	<script src="{{ url('assets/plugins/select2/js/i18n/'.config('app.locale').'.js') }}"></script>
@endif
@if (config('plugins.detectadsblocker.installed'))
	<script src="{{ url('assets/detectadsblocker/js/script.js') . getPictureVersion() }}"></script>
@endif
<script>
	$(document).ready(function () {
		{{-- Select Boxes --}}
		$('.selecter').select2({
			language: langLayout.select2,
			dropdownAutoWidth: 'true',
			minimumResultsForSearch: Infinity,
			width: '100%'
		});
		
		{{-- Searchable Select Boxes --}}
		$('.sselecter').select2({
			language: langLayout.select2,
			dropdownAutoWidth: 'true',
			width: '100%'
		});
		
		
				{{-- Searchable  job candidate--}}
		$("select[name='sector_id']").select2({
			language: langLayout.select2,
			dropdownAutoWidth: 'true',
			width: '100%'
		});
		
					{{-- Searchable  job company form--}}
		$("select[name='parent_id']").select2({
			language: langLayout.select2,
			dropdownAutoWidth: 'true',
			width: '100%'
		});
		
		
		
		
		
		{{-- Social Share --}}
		$('.share').ShareLink({
			title: '{{ addslashes(MetaTag::get('title')) }}',
			text: '{!! addslashes(MetaTag::get('title')) !!}',
			url: '{!! $fullUrl !!}',
			width: 640,
			height: 480
		});
		
		{{-- Modal Login --}}
		@if (isset($errors) and $errors->any())
			@if (old('quickLoginForm') == '1')
				$('#quickLogin').modal();
			@else
				$('#quickRegister').modal();
			@endif
		@endif
		
		$('.toggle-social').on('click', function($e)
		{
			$e.preventDefault();

			$('#social-login').data('type', $(this).data('type'));

			$('#socialLoginModel').modal('show');
		})
$(".loader-wrapper").remove();
		$('#social-login').on('click', function($e)
		{
			$e.preventDefault();
// 			console.log(data('type'));

			window.location.replace(($(this).data('type') === 0 ? "{{ lurl('auth/facebook') }}" : "{{ lurl('auth/google') }}") + "?type=" + $("#socialLoginModel input[name='userType']:checked").val());
		})

	});
</script>

@yield('after_scripts')

@if (isset($plugins) and !empty($plugins))
	@foreach($plugins as $plugin)
		@yield($plugin . '_scripts')
	@endforeach
@endif
@stack('scripts')

@if (config('settings.footer.tracking_code'))
	{!! printJs(config('settings.footer.tracking_code')) . "\n" !!}
@endif


</body>
<!-- Global site tag (gtag.js) - Google Analytics -->

</html>


