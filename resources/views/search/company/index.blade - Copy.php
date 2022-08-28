{{--
//
--}}
@extends('layouts.master')

@section('search')
	
@endsection

@section('content') 
	<!-- @include('common.spacer') -->
<!-
	<br/><br/>
	<div class="main-container">
		<div class="container">
			<div class="jobsearch-row">

				<div class="jobsearch-columsn-9 jobsearch-typo-wrap">
					<div class="wp-jobsearch-employer-content wp-jobsearch-dev-employer-content" id="jobsearch-data-employer-content-3690" data-id="3690">
						<div id="jobsearch-loader-3690"></div>
							
							<div class="sortfiltrs-contner">
							<div class="jobsearch-filterable jobsearch-filter-sortable jobsearch-topfound-title">
						
							</div>
							</div>
					</div>
				</div>
				
				
					<div class="latest-products">
					<div class="container">
					  	<div class="row">
							<div class="col-md-12">
						  		<div class="section-heading">
									<h2 class="jobsearch-fltcount-title">
										{{isset($companies)?$companies->count():0}} &nbsp;Employers Found          
									</h2>
						  		</div>
							</div>	
					  </div>
					</div>
				</div>
				
				
				
				
				<style>
					  .latest-products {
	margin-top: 30px;
}

.latest-products .section-heading a {
	float: right;
	margin-top: -35px;
	text-transform: uppercase;
	font-size: 13px;
	font-weight: 700;
	color: #f33f3f;
}

.product-item {
	border: 1px solid #eee;
	margin-bottom: 30px;
}

.product-item .down-content {
	padding: 30px;
	position: relative;
}

.product-item img {
	width: 100%;
	overflow: hidden;
}

.product-item .down-content h4 {
	font-size: 17px;
	color: #1a6692;
	margin-bottom: 20px;
}

.product-item .down-content h6 {
	position: absolute;
	top: 30px;
	right: 30px;
	font-size: 18px;
	color: #121212;
}

.product-item .down-content p {
	margin-bottom: 20px;
}

.product-item .down-content ul li {
	display: inline-block;
}

.product-item .down-content ul li i {
	color: #f33f3f;
	font-size: 14px;
}

.product-item .down-content span {
	position: absolute;
	right: 30px;
	bottom: 30px;
	font-size: 13px;
	color: #f33f3f;
	font-weight: 500;
}


				  </style>



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
									
									<li class="col-md-4" >
										<div class="product-item">
											<span class="promotepof-badgeemp hide">Featured <i class="fa fa-star" title="Featured"></i></span>
											
											{{-- <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a> --}}
											<figure>
											
												<a href="{{ $companyUrl }}" class="careerfy-employer-grid-image">
													<img src="{{ imgUrl(\App\Models\Company::getLogo($iCompany->logo), 'medium') }}" width="338" height="249" alt="" >
												</a>
											
											<figcaption>
												<!-- <small class="hide">                <a class="">
												Automotive Jobs                </a>
												</small>                                     -->
												<div class="down-content">
													<a href="#"><h4><a href="{{ $companyUrl }}">
														{{ $iCompany->name }} 
													</a></h4></a>
													{{-- <h6>$25.75</h6> --}}
													<a href="{{ $companyUrl }}" style="width:100%;" class="careerfy-employer-grid-btn">{{ $iCompany->posts_count }} Vacancy</a>
													<a href="javascript:void(0);" class="hide careerfy-employer-grid-btn jobsearch-open-signin-tab jobsearch-wredirct-url" data-id="197" data-beforelbl="Follow" data-afterlbl="Followed" data-wredircto="{{ $companyUrl }}"><i class="fa fa-user-plus"></i> Follow</a>
												
												  
												
											  </div>
												
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
									</li>
								@endforeach
							@else
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 f-category" style="width: 100%;">
									{{ t('No result. Refine your search using other criteria.') }}
								</div>
							@endif
							
							</ul>
						</div>
						

				 {{-- <!-- Portfolio Section -->

				 <div class="row">
					<div class="col-lg-4 col-sm-6 portfolio-item">
					  <div class="card h-100">
						<a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
						<div class="card-body">
						  <h4 class="card-title">
							<a href="#">Project One</a>
						  </h4>
						  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur eum quasi sapiente nesciunt? Voluptatibus sit, repellat sequi itaque deserunt, dolores in, nesciunt, illum tempora ex quae? Nihil, dolorem!</p>
						</div>
					  </div>
					</div>
				  
			 
	 
					<div class="col-lg-4 col-sm-6 portfolio-item"style="margin-top: 25px">
					  <div class="card h-100">
						<a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
						<div class="card-body">
						  <h4 class="card-title">
							<a href="#">Project Five</a>
						  </h4>
						  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
						</div>
					  </div>
					</div>
					
					<div class="col-lg-4 col-sm-6 portfolio-item" style="margin-top: 25px">
					  <div class="card h-100">
						<a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
						<div class="card-body">
						  <h4 class="card-title">
							<a href="#">Project Six</a>
						  </h4>
						  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque earum nostrum suscipit ducimus nihil provident, perferendis rem illo, voluptate atque, sit eius in voluptates, nemo repellat fugiat excepturi! Nemo, esse.</p>
						</div>
					  </div>
					</div>
				  </div>
				  <!-- /.row --> --}}


						<!-- Sidebar -->
						{{-- <div class="col-md-3 page-sidebar mobile-filter-sidebar pb-4 jobsearch-typo-wrap border border-info ">
							<div class="jobsearch-filter-responsive-wrap">
								<div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">
									<div class="jobsearch-fltbox-title">
										<a href="/search-talent" class="btn btn- btn-sm btn-block reset-button" style="background-color: #03989e">Filters</a>
									</div>
								</div>
							</div>
							<div class="jobsearch-filter-responsive-wrap>
								<h6 class="font-weight-bold mb-3">Date Posted</h6>
						
								<div class="form-check pl-0 mb-3" style="margin-left: 50px">
								<input type="checkbox" class="form-check-input filled-in" id="new">
								<label class="form-check-label small text-uppercase card-link-secondary" for="new">Last Hour</label>
								</div>
								<div class="form-check pl-0 mb-3" style="margin-left: 50px">
								<input type="checkbox" class="form-check-input filled-in" id="used">
								<label class="form-check-label small text-uppercase card-link-secondary" for="used">Last 24 Hours</label>
								</div>
								<div class="form-check pl-0 mb-3"style="margin-left: 50px">
								<input type="checkbox" class="form-check-input filled-in" id="collectible">
								<label class="form-check-label small text-uppercase card-link-secondary" for="collectible">Last 7 Days</label>
								</div>
								<div class="form-check pl-0 mb-3 pb-1" style="margin-left: 50px">
								<input type="checkbox" class="form-check-input filled-in" id="renewed">
								<label class="form-check-label small text-uppercase card-link-secondary" for="renewed">Last 14 days</label>
								</div>
								<div class="form-check pl-0 mb-3 pb-1" style="margin-left: 50px">
									<input type="checkbox" class="form-check-input filled-in" id="renewed">
									<label class="form-check-label small text-uppercase card-link-secondary" for="renewed">Last 30 days</label>
									</div>
							</div>
		
							<div class="jobsearch-filter-responsive-wrap">
								<div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">
									<div class="jobsearch-fltbox-title">
										<a href="/search-talent" class="btn btn- btn-sm btn-block reset-button" style="background-color: #03989e">Search filters</a>
									</div>
								</div>
							</div>
		
							<div class="jobsearch-filter-responsive-wrap>
								<h6 class="font-weight-bold mb-3">Sector</h6>
						
								<div class="form-check pl-0 mb-3" style="margin-left: 50px">
								<input type="checkbox" class="form-check-input filled-in" id="new">
								<label class="form-check-label small text-uppercase card-link-secondary" for="new">Accounting / Finance</label>
								</div>
								<div class="form-check pl-0 mb-3" style="margin-left: 50px">
								<input type="checkbox" class="form-check-input filled-in" id="used">
								<label class="form-check-label small text-uppercase card-link-secondary" for="used">Automotive Jobs</label>
								</div>
								<div class="form-check pl-0 mb-3"style="margin-left: 50px">
								<input type="checkbox" class="form-check-input filled-in" id="collectible">
								<label class="form-check-label small text-uppercase card-link-secondary" for="collectible">Construction / Facilities</label>
								</div>
								<div class="form-check pl-0 mb-3 pb-1" style="margin-left: 50px">
								<input type="checkbox" class="form-check-input filled-in" id="renewed">
								<label class="form-check-label small text-uppercase card-link-secondary" for="renewed">Education Training</label>
								</div>
								<div class="form-check pl-0 mb-3 pb-1" style="margin-left: 50px">
								<input type="checkbox" class="form-check-input filled-in" id="renewed">
								<label class="form-check-label small text-uppercase card-link-secondary" for="renewed">Health Care </label>
								</div>
								<div class="form-check pl-0 mb-3 pb-1" style="margin-left: 50px">
								<input type="checkbox" class="form-check-input filled-in" id="renewed">
								<label class="form-check-label small text-uppercase card-link-secondary" for="renewed">Education Training</label>
								</div>
								<div class="form-check pl-0 mb-3 pb-1" style="margin-left: 50px">
								<input type="checkbox" class="form-check-input filled-in" id="renewed">
								<label class="form-check-label small text-uppercase card-link-secondary" for="renewed">Restaurant / Food Services </label>
								</div>
							</div>
		
							<div class="jobsearch-filter-responsive-wrap">
								<div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">
									<div class="jobsearch-fltbox-title">
										<a href="/search-talent" class="btn btn- btn-sm btn-block reset-button" style="background-color: #03989e">Search filters</a>
									</div>
								</div>
							</div>
		
							<div class="jobsearch-filter-responsive-wrap>
								<h6 class="font-weight-bold mb-3">Academic Level</h6>
						
								<div class="form-check pl-0 mb-3" style="margin-left: 50px">
								<input type="checkbox" class="form-check-input filled-in" id="new">
								<label class="form-check-label small text-uppercase card-link-secondary" for="new">Certificate</label>
								</div>
								<div class="form-check pl-0 mb-3" style="margin-left: 50px">
								<input type="checkbox" class="form-check-input filled-in" id="used">
								<label class="form-check-label small text-uppercase card-link-secondary" for="used">Diploma</label>
								</div>
								<div class="form-check pl-0 mb-3"style="margin-left: 50px">
								<input type="checkbox" class="form-check-input filled-in" id="collectible">
								<label class="form-check-label small text-uppercase card-link-secondary" for="collectible">Associate</label>
								</div>
								<div class="form-check pl-0 mb-3 pb-1" style="margin-left: 50px">
								<input type="checkbox" class="form-check-input filled-in" id="renewed">
								<label class="form-check-label small text-uppercase card-link-secondary" for="renewed">Degree Bachelor</label>
								</div>
								<div class="form-check pl-0 mb-3 pb-1" style="margin-left: 50px">
								<input type="checkbox" class="form-check-input filled-in" id="renewed">
								<label class="form-check-label small text-uppercase card-link-secondary" for="renewed">Associate </label>
								</div>
								<div class="form-check pl-0 mb-3 pb-1" style="margin-left: 50px">
								<input type="checkbox" class="form-check-input filled-in" id="renewed">
								<label class="form-check-label small text-uppercase card-link-secondary" for="renewed">Master’s Degree </label>
								</div>
							</div>
		
							<div class="jobsearch-filter-responsive-wrap">
								<div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">
									<div class="jobsearch-fltbox-title">
										<a href="/search-talent" class="btn btn- btn-sm btn-block reset-button" style="background-color: #03989e">Search filters</a>
									</div>
								</div>
							</div>
		
							<div class="jobsearch-filter-responsive-wrap>
								<h6 class="font-weight-bold mb-3">Condition</h6>
						
								<div class="form-check pl-0 mb-3" style="margin-left: 50px">
								<input type="checkbox" class="form-check-input filled-in" id="new">
								<label class="form-check-label small text-uppercase card-link-secondary" for="new">New</label>
								</div>
								<div class="form-check pl-0 mb-3" style="margin-left: 50px">
								<input type="checkbox" class="form-check-input filled-in" id="used">
								<label class="form-check-label small text-uppercase card-link-secondary" for="used">Used</label>
								</div>
								<div class="form-check pl-0 mb-3"style="margin-left: 50px">
								<input type="checkbox" class="form-check-input filled-in" id="collectible">
								<label class="form-check-label small text-uppercase card-link-secondary" for="collectible">Collectible</label>
								</div>
								<div class="form-check pl-0 mb-3 pb-1" style="margin-left: 50px">
								<input type="checkbox" class="form-check-input filled-in" id="renewed">
								<label class="form-check-label small text-uppercase card-link-secondary" for="renewed">Renewed</label>
								</div>
							</div>
		
							<div class="jobsearch-filter-responsive-wrap">
								<div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">
									<div class="jobsearch-fltbox-title">
										<a href="/search-talent" class="btn btn- btn-sm btn-block reset-button" style="background-color: #03989e">Reset filters</a>
									</div>
								</div>
							</div>
							
		
						
						</div> --}}
			</div>
		</div>
	</div>

			
		 
		
		 
			<div style="clear: both"></div>
			
			<div class="pagination-bar text-center">
				{{ (isset($companies)) ? $companies->links() : '' }}
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
			
			
		
	</div>

	
	
	

	  @endsection
