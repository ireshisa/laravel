{{--
//
--}}
@extends('layouts.master')

@section('content')
	@include('common.spacer')
	<div class="main-container">
		<div class="container mobile-padding">
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
		
				<div class="col-md-3 page-sidebar">
					@include('account.inc.sidebar')
				</div>
				<!--/.page-sidebar-->
				
				<div class="col-md-9 page-content">
					<div class="inner-box">
						<h2 class="title-2"><i class="icon-town-hall"></i> {{ ('My Resumes') }} </h2>
{{--						<div class="mb30">--}}
{{--							<a href="{{ lurl('account/resumes/create') }}" class="btn btn-outline-primary"><i class="icon-plus"></i> {{ ('Add a New Resume') }}</a>--}}
{{--						</div>--}}
{{--						<br>--}}
						
				<?php	/*	<div class="table-responsive">
							<form name="listForm" method="POST" action="{{ lurl('account/resumes/delete') }}">
								{!! csrf_field() !!}
								<div class="table-action">
									<label for="checkAll">
										<input type="checkbox" id="checkAll">
										{{ t('Select') }}: {{ t('All') }} |
										<button type="submit" class="btn btn-sm btn-default delete-action">
											<i class="fa fa-trash"></i> {{ t('Delete') }}
										</button>
									</label>
									<div class="table-search pull-right col-sm-7">
										<div class="form-group">
											<div class="row">
												<label class="col-sm-5 control-label text-right">{{ t('Search') }} <br>
													<a title="clear filter" class="clear-filter" href="#clear">[{{ t('clear') }}]</a>
												</label>
												<div class="col-sm-7 searchpan">
													<input type="text" class="form-control" id="filter">
												</div>
											</div>
										</div>
									</div>
								</div>

								<table id="addManageTable" class="table table-striped table-bordered add-manage-table table demo"
									   data-filter="#filter" data-filter-text-only="true">
									<thead>
									<tr>
										<th data-type="numeric" data-sort-initial="true"></th>
										<th> {{ t('File') }}</th>
										<th data-sort-ignore="true"> {{ t('Name') }} </th>
										<th> {{ t('Option') }}</th>
									</tr>
									</thead>
									<tbody>

									<?php
									if (isset($resumes) && $resumes->count() > 0):
									foreach($resumes as $key => $resume):
									?>
									<tr>
										<td style="width:2%" class="add-img-selector">
											<div class="checkbox">
												<label><input type="checkbox" name="entries[]" value="{{ $resume->id }}"></label>
											</div>
										</td>
										<td style="width:14%" class="add-img-td">
											<a class="btn btn-default" href="{{ fileUrl($resume->filename) }}" target="_blank">
												<i class="icon-attach-2"></i> {{ t('Download') }}
											</a>
										</td>
										<td style="width:58%" class="items-details-td">
											<div>
												<p>
													{{ \Illuminate\Support\Str::limit($resume->name, 40) }}
												</p>
											</div>
										</td>
										<td style="width:10%" class="action-td">
											<div>
												@if ($resume->user_id==$user->id)
													<p class="text-center">
														<a class="btn btn-primary btn-sm" href="{{ lurl('account/resumes/' . $resume->id . '/edit') }}">
															<i class="fa fa-edit"></i> {{ t('Edit') }}
														</a>
													</p>
													<p class="text-center">
														<a class="btn btn-danger btn-sm delete-action" href="{{ lurl('account/resumes/'.$resume->id.'/delete') }}">
															<i class="fa fa-trash"></i> {{ t('Delete') }}
														</a>
													</p>
												@endif
											</div>
										</td>
									</tr>
									<?php endforeach; ?>
									<?php endif; ?>
									</tbody>
								</table>
							</form>
						</div>

						<div class="pagination-bar text-center">
							{{ (isset($resumes)) ? $resumes->links() : '' }}
						</div> */?>

					</div>
{{--					<br>--}}
                    <form action="{{ lurl('account/resumes/skills') }}" method="POST" class="form" id="editor-form">

				<div class="inner-box" style="display: none;">
						<h2 class="title-2">Cover Letter</h2>


                            												<textarea class="form-control "
														  id="cover-letter"
														  name="cover_letter"
														  rows="10"
												>{!! (($user->myCoverLetter)?$user->myCoverLetter->cover_letter:'<p>
    *CurrentDate*
</p>
<p>
    *ToWhom*,<br>
    *Employer/Company*,<br>
    *Address*,<br>
    *Address2*<br>
</p>
<p>
    Dear Mr.<ToWhom>,
</p>
<p>
    I am writing to apply for the programmer position advertised in the Search Jobs Global. As requested, I enclose a
    completed job application, my certification, my resume, and three references
</p>
<p>
    The role is very appealing to me, and I believe that my strong technical experience and education make me a
    highly competitive candidate for this position. My key strengths that would support my success in this position
    include:

</p>

<p>
    <ul>
    <li>
        I have successfully designed, developed, and supported live-use applications.

    </li>
    <li> I strive continually for excellence.</li>
    <li>I provide exceptional contributions to customer service for all customers.</li>
</ul>
</p>

<p>
    With a BS degree in Computer Programming, I have a comprehensive understanding of the full
    lifecycle for software development projects. I also have experience in learning and applying new technologies as
    appropriate. Please see my resume for additional information on my experience.

</p>

<p>
    I can be reached anytime via email at '.auth()->user()->email .' or by cell phone, '.((auth()->user()->phone)?auth()->user()->phone:'<EnterPhone>').

'</p>
<p>
    Thank you for your time and consideration. I look forward to speaking with you about this employment opportunity.
</p>
<p>
    Sincerely,
    <br>'.auth()->user()->name.
    '</p>')!!}</textarea>
							<small id="" class="form-text text-muted">{{ t('Describe what makes your ad unique') }}</small>
						</div>


					<br>
					<div class="inner-box mobile-padding">
						<h2 class="title-2">Details</h2>

						<div class="col-lg-12 mobile-padding">

								<div class="form-group" style="width: 30%">
									<label for="">Age</label>
									<input class="form-control" type="number" name="age" value="{{auth()->user()->age}}" step="1" min="18" required>
								</div>
								<div class="form-group">
									<label for="">Gender</label>
									<select name="gender" id="" class="form-control" required>
										<option value=""></option>
										<option value="male" {{auth()->user()->gender == 'male' ? 'selected' : ''}}>Male</option>
										<option value="female" {{auth()->user()->gender == 'female' ? 'selected' : ''}}>Female</option>
									</select>
								</div>
{{--								<div class="form-group">--}}
{{--									<label for="">Location</label>--}}
{{--									<input class="form-control" type="text" name="location" value="{{auth()->user()->location}}" required>--}}
{{--								</div>--}}

								<?php $cityIdError = (isset($errors) and $errors->has('city_id')) ? ' is-invalid' : ''; ?>
								<div id="cityBox" class="form-group" style="width: 30%">
									<label class="" for="city_id">
										{{ t('City') }} <sup>*</sup>
									</label>
										<select id="cityId" name="city_id" class="form-control sselecter{{ $cityIdError }}">
											<option value="0" {{ (!old('city_id') or old('city_id')==0) ? 'selected="selected"' : (isset($user->city_id) ? 'selected' : '') }}>
												{{ t('Select a city') }}
											</option>
										</select>
								</div>

								<?php $postTypeIdError = (isset($errors) and $errors->has('post_type_id')) ? ' is-invalid' : ''; ?>
								<div id="postTypeBloc" class="form-group" style="width: 30%">
									<label class="">
										{{ t('Job Type') }} <sup>*</sup>
									</label>
										<select name="post_type_id" id="postTypeId" class="form-control selecter{{ $postTypeIdError }}">
											@foreach ($postTypes as $postType)
												<option value="{{ $postType->tid }}"
														@if (old('post_type_id')==$postType->tid)
														selected="selected"
														@endif
												>{{ $postType->name }}</option>
											@endforeach
										</select>
								</div>

								<div class="form-group">
									<label for="">Sector</label>
									<select name="sector_id" id="" class="form-control" required>
										<option value=""></option>
										@foreach($cats as $cat)
											<option value="{{$cat->id}}" {{auth()->user()->sector_id == $cat->id ? 'selected' : ''}}>{{$cat->name}}</option>
										@endforeach
									</select>
								</div>
								
								<div class="form-group">
									<label for="">Qualifications</label>
{{--									<textarea name="qualifications" id="" cols="30" rows="3" class="form-control" required>{{auth()->user()->qualifications}}</textarea>--}}
									<select name="qualifications" id="" class="form-control" required>
										<option value=""></option>
										<option value="Certificate" {{auth()->user()->qualifications == 'Certificate' ? 'selected' : ''}}>Certificate</option>
										<option value="Bachelors" {{auth()->user()->qualifications == 'Bachelors' ? 'selected' : ''}}>Bachelors</option>
										<option value="Masters" {{auth()->user()->qualifications == 'Masters' ? 'selected' : ''}}>Masters</option>
										<option value="Phd" {{auth()->user()->qualifications == 'Phd' ? 'selected' : ''}}>Phd</option>
										<option value="None" {{auth()->user()->qualifications == 'None' ? 'selected' : ''}}>None</option>
									</select>
								</div>
								<div class="form-group">
									<label for="">Experience</label>
									<select name="experience" id="" class="form-control" required>
										<option value=""></option>
										<option value="6 months" {{auth()->user()->experience == '6 months' ? 'selected' : ''}}>6 Months</option>
										<option value="1 years" {{auth()->user()->experience == '1 years' ? 'selected' : ''}}>1 Year</option>
										<option value="2 years" {{auth()->user()->experience == '2 years' ? 'selected' : ''}}>2 Years</option>
										<option value="3 years" {{auth()->user()->experience == '3 years' ? 'selected' : ''}}>3 Years</option>
										<option value="4 years" {{auth()->user()->experience == '4 years' ? 'selected' : ''}}>4 Years</option>
										<option value="5 years" {{auth()->user()->experience == '5 years' ? 'selected' : ''}}>5 Years</option>
										<option value="more than 5 years" {{auth()->user()->experience == ' more than 5 years' ? 'selected' : ''}}>More than 5 Years</option>
										<option value="None" {{auth()->user()->experience == 'None' ? 'selected' : ''}}>None</option>
									</select>
								</div>
								<div class="form-group">
									<label for="">Expected salary(LKR)</label>
									<input class="form-control" type="number" name="salary" value="{{auth()->user()->salary}}" step=".5" min="10000" required>
								</div>
{{--								<div class="form-group">--}}
{{--									<label for="">Skills (Comma separated)</label>--}}
{{--									<input class="form-control" type="text" name="skills"  value="{{auth()->user()->skills}}" >--}}
{{--								</div>--}}


								<div class="form-group">
									<label for="">About me</label><br>
									<textarea name="about_me" class="form-control" id="" cols="30" rows="3">{{auth()->user()->about_me}}</textarea>
								</div>
<hr>
							@include('account.resume._partial_resume',['data'=>auth()->user()])
							<div class="text-center">

							<h4  class="title-4">Social Media</h4>
							</div>
							<div class="row">
<div class="col-md-6 col-sm-12">
							<div class="form-group d-flex align-items-center">
								<label for="" class="d-inline-flex mx-1"></label>
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="icon-facebook"></i></span>
								</div>
								<input class="form-control d-inline-flex flex-grow-1 " type="text" name="social[facebook]"  value="{{(!empty(auth()->user()->social_links)?auth()->user()->social_links['facebook']:null)}}" >
							</div>
</div>
							<div class="col-md-6 col-sm-12">
							<div class="form-group d-flex align-items-center">
								<label for="" class="d-inline-flex mx-1"></label>
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="icon-twitter"></i></span>
								</div>
								<input class="d-inline-flex flex-grow-1 form-control" type="text" name="social[twitter]"  value="{{(!empty(auth()->user()->social_links)?auth()->user()->social_links['twitter']:null)}}">
							</div>
							</div>
								<div class="col-md-6 col-sm-12">
							<div class="form-group d-flex align-items-center">
								<label for="" class="d-inline-flex mx-1"></label>
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="icon-linkedin"></i></span>
								</div>
								<input class="form-control d-inline-flex flex-grow-1 " type="text" name="social[linkedin]"  value="{{(!empty(auth()->user()->social_links)?auth()->user()->social_links['linkedin']:null)}}" >
							</div>
								</div>
							<div class="col-md-6 col-sm-12">
							<div class="form-group d-flex align-items-center">

								<label for="" class="d-inline-flex mx-1"></label>
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="icon-instagram-filled"></i></span>
								</div>
								<input class="form-control d-inline-flex flex-grow-1 " type="text" name="social[instagram]"  value="{{(!empty(auth()->user()->social_links)?auth()->user()->social_links['instagram']:null)}}" >
							</div>
							</div>
							</div>
						<hr>




							@include('account.resume._referee_resume',['data'=>auth()->user()])

								<div class="form-group">
									<button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{url('/search-talent/seeker/'.auth()->user()->id)}}" target="_blank" class="btn ml-2 btn-secondary btn-border">Preview CV</a>
									<a href="{{route('resume.download')}}" target="_blank" class="btn ml-2 btn-secondary btn-border">Download CV</a>
								</div>

						</div>
					</div>

                    </form>
				</div>
			</div>
		</div>
	</div>

@endsection

@section('after_styles')
	@include('layouts.inc.tools.wysiwyg.css')
    <style>
        .simditor-body {
            max-height:250px !important;
            overflow-y: auto !important;
            overflow-x: hidden !important;
        }
         @media screen and (max-width: 500px) {
  .col-sm-11  {
      width:80% !important;
  }
  
  
  .form-group
  {
      width:100% !important;
  }
        }
       
    </style>
@endsection

@section('after_scripts')

	@include('layouts.inc.tools.wysiwyg.js')
	<script src="{{ url('assets/js/footable.js?v=2-0-1') }}" type="text/javascript"></script>
	<script src="{{ url('assets/js/footable.filter.js?v=2-0-1') }}" type="text/javascript"></script>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/1.2.3/jquery.payment.min.js"></script>
	@if (file_exists(public_path() . '/assets/plugins/forms/validation/localization/messages_'.config('app.locale').'.min.js'))
		<script src="{{ url('assets/plugins/forms/validation/localization/messages_'.config('app.locale').'.min.js') }}" type="text/javascript"></script>
	@endif

	<script src="{{ url('assets/plugins/bootstrap-fileinput/js/plugins/sortable.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('assets/plugins/bootstrap-fileinput/js/fileinput.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('assets/plugins/bootstrap-fileinput/themes/fa/theme.js') }}" type="text/javascript"></script>
	@if (file_exists(public_path() . '/assets/plugins/bootstrap-fileinput/js/locales/'.ietfLangTag(config('app.locale')).'.js'))
		<script src="{{ url('assets/plugins/bootstrap-fileinput/js/locales/'.ietfLangTag(config('app.locale')).'.js') }}" type="text/javascript"></script>
	@endif

	<script>
		/* Translation */
		var lang = {
			'select': {
				'category': "{{ t('Select a category') }}",
				'subCategory': "{{ t('Select a sub-category') }}",
				'country': "{{ t('Select a country') }}",
				'admin': "{{ t('Select a location') }}",
				'city': "{{ t('Select a city') }}"
			},
			'price': "{{ t('Price') }}",
			'salary': "{{ t('Salary') }}",
			'nextStepBtnLabel': {
				'next': "{{ t('Next') }}",
				'submit': "{{ t('Submit') }}"
			}
		};


		/* Locations */
		var countryCode = '{{ old('country_code', config('country.code', 0)) }}';
		var adminType = '{{ config('country.admin_type', 0) }}';
		var selectedAdminCode = '{{ old('admin_code', (isset($admin) ? $admin->code : 0)) }}';
		var cityId = '{{ old('city_id', (isset($user) ? $user->city_id : 0)) }}';

	</script>
	<script src="{{ url('assets/js/app/d.select.category.js') . vTime() }}"></script>
	<script src="{{ url('assets/js/app/d.select.location.js') . vTime() }}"></script>

	<script type="text/javascript">
		$(function () {
			$('#addManageTable').footable().bind('footable_filtering', function (e) {
				var selected = $('.filter-status').find(':selected').text();
				if (selected && selected.length > 0) {
					e.filter += (e.filter && e.filter.length > 0) ? ' ' + selected : selected;
					e.clear = !e.filter;
				}
			});

			$('.clear-filter').click(function (e) {
				e.preventDefault();
				$('.filter-status').val('');
				$('table.demo').trigger('footable_clear_filter');
			});

			$('#checkAll').click(function () {
				checkAll(this);
			});

			$('a.delete-action, button.delete-action').click(function(e)
			{
				e.preventDefault(); /* prevents the submit or reload */
				var confirmation = confirm("{{ t('confirm_this_action') }}");

				if (confirmation) {
					if( $(this).is('a') ){
						var url = $(this).attr('href');
						if (url !== 'undefined') {
							redirect(url);
						}
					} else {
						$('form[name=listForm]').submit();
					}

				}

				return false;
			});
		});
	</script>
		<!-- include custom script for ads table [select all checkbox]  -->
	<script>
		function checkAll(bx) {
			var chkinput = document.getElementsByTagName('input');
			for (var i = 0; i < chkinput.length; i++) {
				if (chkinput[i].type == 'checkbox') {
					chkinput[i].checked = bx.checked;
				}
			}
		}
		
		
		function uncheckAll(vqr) {
	
			var chkinput = document.getElementsByName(vqr);
			for (var i = 0; i < chkinput.length; i++) {
				if (chkinput[i].type == 'radio') {
				
					if(chkinput[i].checked) chkinput[i].checked = false;
				}
			}
		}

	</script>


@endsection
