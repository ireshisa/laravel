{{--
//
--}}
@extends('layouts.master')

@section('search')
	
@endsection

@section('content')
	<!-- @include('common.spacer') -->
	<link rel='stylesheet' id='wp-jobsearch-selectize-def-css'  href='https://searchjobs.remaxroyalproperty.com/wp-content/plugins/wp-jobsearch/css/selectize.default.css?ver=1.5.9' type='text/css' media='all' />
	<link rel='stylesheet' id='wp-jobsearch-css-css'  href='https://searchjobs.remaxroyalproperty.com/wp-content/plugins/wp-jobsearch/css/plugin.css?ver=1.5.9' type='text/css' media='all' />
	<link rel='stylesheet' id='wp-jobsearch-css-css'  href='https://searchjobs.remaxroyalproperty.com/wp-content/themes/careerfy/css/wp-jobsearch-plugin.css?ver=4.7.0' type='text/css' media='all' />
	<br/><br/>
	<div class="main-container">
		<div class="container">
			<div class="jobsearch-row">
				<div class="jobsearch-columsn-9 jobsearch-typo-wrap">
					<div class="wp-jobsearch-employer-content wp-jobsearch-dev-employer-content" id="jobsearch-data-employer-content-3690" data-id="3690">
						<div id="jobsearch-loader-3690"></div>
						<div class="sortfiltrs-contner">
							<div class="jobsearch-filterable jobsearch-filter-sortable jobsearch-topfound-title">
							<h2 class="jobsearch-fltcount-title">
								{{isset($companies)?$companies->count():0}} &nbsp;Employers Found           
							</h2>
							</div>
						</div>
						<input type="hidden" class="adv_filter_toggle" value="false">    
						<div class="careerfy-employer careerfy-employer-grid" id="jobsearch-employer-3690">
							<ul class="row">
							@if (isset($companies) and $companies->count() > 0)
								@foreach($companies as $key => $iCompany)
									<?php
										// Get companies URL
										$attr = ['countryCode' => config('country.icode'), 'id' => $iCompany->id];
										$companyUrl = lurl(trans('routes.v-search-company', $attr), $attr);
									?>
									<!-- <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 f-category">
										<a href="{{ $companyUrl }}">
											<img alt="{{ $iCompany->name }}" class="img-fluid" src="{{ imgUrl(\App\Models\Company::getLogo($iCompany->logo), 'medium') }}">
											<h6> {{ t('Jobs at') }}
												<span class="company-name">{{ $iCompany->name }}</span>
												<span class="jobs-count text-muted">({{ $iCompany->posts_count }})</span>
											</h6>
										</a>
									</div> -->
									<li class="col-md-4  ">
										<div class="careerfy-employer-grid-wrap">
											<span class="promotepof-badgeemp hide">Featured <i class="fa fa-star" title="Featured"></i></span>
											<figure>
												<a href="{{ $companyUrl }}" class="careerfy-employer-grid-image"><img src="{{ imgUrl(\App\Models\Company::getLogo($iCompany->logo), 'medium') }}" alt=""></a>
												<figcaption>
												<!-- <small class="hide">                <a class="">
												Automotive Jobs                </a>
												</small>                                     -->
												<h2 style="line-height: 40px;">
													<a href="{{ $companyUrl }}">
													{{ $iCompany->name }}                                        </a>
												</h2>
												<span  class="hide">Pakistan</span>
												</figcaption>
											</figure>
											<!-- <ul class="careerfy-employer-thumblist hide">
												<li><a href="javascript:void(0);"><img src="http://searchjobs.remaxroyalproperty.com/wp-content/uploads/2017/11/candidate-20.jpg" alt=""></a></li>
												<li><a href="javascript:void(0);"><img src="https://careerfy.net/demo/wp-content/uploads/candidate-01.jpg" alt=""></a></li>
												<li><a href="javascript:void(0);"><img src="https://careerfy.net/demo/wp-content/uploads/candidate-17.jpg" alt=""></a></li>
												<li><a href="javascript:void(0);"><img src="https://careerfy.net/demo/wp-content/uploads/candidate-15.jpg" alt=""></a></li>
											</ul>
											<a href="{{ $companyUrl }}" class="careerfy-employer-thumblist-size hide">+100 team size</a> -->
										</div>
										<a href="{{ $companyUrl }}" style="width:100%;" class="careerfy-employer-grid-btn">{{ $iCompany->posts_count }} Vacancy</a>
										<a href="javascript:void(0);" class="hide careerfy-employer-grid-btn jobsearch-open-signin-tab jobsearch-wredirct-url" data-id="197" data-beforelbl="Follow" data-afterlbl="Followed" data-wredircto="{{ $companyUrl }}"><i class="fa fa-user-plus"></i> Follow</a>
									</li>
								@endforeach
							@else
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 f-category" style="width: 100%;">
									{{ t('No result. Refine your search using other criteria.') }}
								</div>
							@endif
							
							</ul>
						</div>
					</div>
					<input type="hidden" id="employer_page-3690" name="employer_page">                    
				</div>
			</div>
			<div class="col-lg-12 content-box hide">
				<div class="row row-featured row-featured-category row-featured-company">
					<div class="col-lg-12 box-title no-border">
						<div class="inner">
							<h2>
								<span class="title-3">{{ t('Companies List') }}</span>
								<?php $attr = ['countryCode' => config('country.icode')]; ?>
								<a class="sell-your-item" href="{{ lurl(trans('routes.v-search', $attr), $attr) }}">
									{{ t('Browse Jobs') }}
									<i class="icon-th-list"></i>
								</a>
							</h2>
						</div>
					</div>
					
					@if (isset($companies) and $companies->count() > 0)
						@foreach($companies as $key => $iCompany)
							<?php
								// Get companies URL
								$attr = ['countryCode' => config('country.icode'), 'id' => $iCompany->id];
								$companyUrl = lurl(trans('routes.v-search-company', $attr), $attr);
							?>
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 f-category">
								<a href="{{ $companyUrl }}">
									<img alt="{{ $iCompany->name }}" class="img-fluid" src="{{ imgUrl(\App\Models\Company::getLogo($iCompany->logo), 'medium') }}">
									<h6> {{ t('Jobs at') }}
										<span class="company-name">{{ $iCompany->name }}</span>
										<span class="jobs-count text-muted">({{ $iCompany->posts_count }})</span>
									</h6>
								</a>
							</div>
						@endforeach
					@else
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 f-category" style="width: 100%;">
							{{ t('No result. Refine your search using other criteria.') }}
						</div>
					@endif
			
				</div>
			</div>
			
			<div style="clear: both"></div>
			
			<div class="pagination-bar text-center">
				{{ (isset($companies)) ? $companies->links() : '' }}
			</div>
			
		</div>
	</div>
@endsection
