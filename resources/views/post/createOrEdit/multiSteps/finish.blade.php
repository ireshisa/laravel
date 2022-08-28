{{--
//
--}}
@extends('layouts.master')
@push('styles')
a.btn-add-listing {
color:white !important;
}
@endpush
@section('wizard')
	@include('post.createOrEdit.multiSteps.inc.wizard')
@endsection

@section('content')
	@include('common.spacer')

	<div class="main-container">
		<div class="container">
			<div class="row">

				@if (Session::has('flash_notification'))
					<div class="col-xl-12">
						<div class="row">
							<div class="col-xl-12">
								@include('flash::message')
							</div>
						</div>
					</div>
				@endif

				<div class="col-xl-12 page-content">

					@if (Session::has('success'))
						<div class="inner-box category-content">
							<div class="row">
								<div class="col-xl-12">
									<div class="alert alert-success pgray  alert-lg" role="alert">
										<h2 class="no-margin no-padding">&#10004; {{ t('Congratulations!') }}</h2>
										<p>{{ session('message') }} <a href="{{ lurl('/') }}">{{ t('Homepage') }}</a></p>
									</div>
								</div>
							</div>
						</div>
					@endif
					@if ($showPackages)
					@include('post.createOrEdit.multiSteps.packages')
						@else
							@include('customs.talents.post-talents');
						<a class="btn text-white d-block m-auto btn-post" style="padding:10px;color:white;background-color:#001289" href="{{url('/')}}">Go Back</a>
						@endif
<br>
				</div>
			</div>
		</div>
	</div>

@endsection



