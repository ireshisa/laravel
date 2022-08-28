{{--
//
--}}
<?php
	$fullUrl = rawurldecode(url(request()->getRequestUri()));
    $tmpExplode = explode('?', $fullUrl);
    $fullUrlNoParams = current($tmpExplode);
?>
@extends('layouts.master')

@section('search')
	@parent
	@include('search.inc.form')
@endsection

@section('content')
	<div class="main-container">
		
		@include('search.inc.breadcrumbs')
		@include('search.inc.categories')
		<?php if (\App\Models\Advertising::where('slug', 'top')->count() > 0): ?>
			@include('layouts.inc.advertising.top', ['paddingTopExists' => true])
		<?php
			$paddingTopExists = false;
		else:
			if (isset($paddingTopExists) and $paddingTopExists) {
				$paddingTopExists = false;
			}
		endif;
		?>
		@include('common.spacer')
		
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
			</div>

			<div class="row">
				
				<!-- Sidebar -->
				@include('search.inc.sidebar')
				
				<link rel='stylesheet' id='wp-jobsearch-selectize-def-css'  href='https://searchjobs.remaxroyalproperty.com/wp-content/plugins/wp-jobsearch/css/selectize.default.css?ver=1.5.9' type='text/css' media='all' />
				<link rel='stylesheet' id='wp-jobsearch-css-css'  href='https://searchjobs.remaxroyalproperty.com/wp-content/plugins/wp-jobsearch/css/plugin.css?ver=1.5.9' type='text/css' media='all' />
				<style>
				.col-md-3.jobsearch-typo-wrap, .col-md-3.jobsearch-typo-wrap {
					padding-left: 15px;
					padding-right: 15px;
				}
				.reset-button{
					padding: 5px !important;
					margin: 10px auto;
					color: #fff !important;
					font-size: 17px;
					text-transform: uppercase;
				}
				.reset-button:before,.jobsearch-fltbox-title a:before{
					content: "" !important;
				}
				.fa.fa-angle-down{
					float: right;
					color: #ccc;
				}
				.jobsearch-filter-responsive-wrap .btn-primary{
					margin-bottom: 10px;
				}
				.search-row-wrapper {
					background: #fff;
				}
				.btn-primary {
					background-color: #02979D;
					border-color: #02979D;
				}
				.inner-box.enable-long-words 
				{
					border: none;
					background: white;
				}
				.categories-list ul.list-unstyled li {
					margin-bottom: 10px;
				}
				.save-search-bar{
					background:white;
				}
				</style>
				<!-- Content -->
				<div class="col-md-9 page-content col-thin-left jobsearch-typo-wrap">
					<div class="sortfiltrs-contner with-rssfeed-enable">
						<div class="jobsearch-filterable jobsearch-filter-sortable jobsearch-topfound-title">
							<h2 class="jobsearch-fltcount-title">
								{{ $count->get('all') }} Jobs Found
							</h2>
						</div>
					</div>
					<div class="category-list" style="    border: 0;">
						<div class="tab-box clearfix" style="    background: transparent;display:none;">

							<!-- Nav tabs -->
							<div class="col-xl-12 box-title no-border" style="background: white;">
								<div class="inner">
									<h2>
										<small>{{ $count->get('all') }} {{ t('Jobs Found') }}</small>
									</h2>
								</div>
							</div>

							<!-- Mobile Filter bar -->
							<div class="col-xl-12 mobile-filter-bar">
								<ul class="list-unstyled list-inline no-margin no-padding">
									<li class="filter-toggle">
										<a class="">
											<i class="icon-th-list"></i> {{ t('Filters') }}
										</a>
									</li>
									<li>
										<div class="dropdown">
											<a data-toggle="dropdown" class="dropdown-toggle">{{ t('Sort by') }}</a>
											<ul class="dropdown-menu">
												<li>
													<a href="{!! qsurl($fullUrlNoParams, request()->except(['orderBy', 'distance']), null, false) !!}" rel="nofollow">
														{{ t('Sort by') }}
													</a>
												</li>
												<li>
													<a href="{!! qsurl($fullUrlNoParams, array_merge(request()->except('orderBy'), ['orderBy'=>'relevance']), null, false) !!}" rel="nofollow">
														{{ t('Relevance') }}
													</a>
												</li>
												<li>
													<a href="{!! qsurl($fullUrlNoParams, array_merge(request()->except('orderBy'), ['orderBy'=>'date']), null, false) !!}" rel="nofollow">
														{{ t('Date') }}
													</a>
												</li>
												@if (isset($isCitySearch) and $isCitySearch and \App\Helpers\DBTool::checkIfMySQLDistanceCalculationFunctionExists(config('settings.listing.distance_calculation_formula')))
													@for($iDist = 0; $iDist <= config('settings.listing.search_distance_max', 500); $iDist += config('settings.listing.search_distance_interval', 50))
													<li>
														<a href="{!! qsurl($fullUrlNoParams, array_merge(request()->except('distance'), ['distance' => $iDist]), null, false) !!}" rel="nofollow">
															{{ t('Around :distance :unit', ['distance' => $iDist, 'unit' => unitOfLength()]) }}
														</a>
													</li>
													@endfor
												@endif
											</ul>

										</div>
									</li>
								</ul>
							</div>
							<div class="menu-overly-mask"></div>
							<!-- Mobile Filter bar End-->


							<div class="tab-filter hide-xs">
								<select id="orderBy" class="niceselecter select-sort-by" data-style="btn-select" data-width="auto">
									<option value="{!! qsurl($fullUrlNoParams, request()->except(['orderBy', 'distance']), null, false) !!}">{{ t('Sort by') }}</option>
									<option{{ (request()->get('orderBy')=='relevance') ? ' selected="selected"' : '' }}
											value="{!! qsurl($fullUrlNoParams, array_merge(request()->except('orderBy'), ['orderBy'=>'relevance']), null, false) !!}">
										{{ t('Relevance') }}
									</option>
									<option{{ (request()->get('orderBy')=='date') ? ' selected="selected"' : '' }}
											value="{!! qsurl($fullUrlNoParams, array_merge(request()->except('orderBy'), ['orderBy'=>'date']), null, false) !!}">
										{{ t('Date') }}
									</option>
									@if (isset($isCitySearch) and $isCitySearch and \App\Helpers\DBTool::checkIfMySQLDistanceCalculationFunctionExists(config('settings.listing.distance_calculation_formula')))
										@for($iDist = 0; $iDist <= config('settings.listing.search_distance_max', 500); $iDist += config('settings.listing.search_distance_interval', 50))
											<option{{ (request()->get('distance', config('settings.listing.search_distance_default', 100))==$iDist) ? ' selected="selected"' : '' }}
													value="{!! qsurl($fullUrlNoParams, array_merge(request()->except('distance'), ['distance' => $iDist]), null, false) !!}">
												{{ t('Around :distance :unit', ['distance' => $iDist, 'unit' => unitOfLength()]) }}
											</option>
										@endfor
									@endif
								</select>
							</div>

						</div>

						<div class="listing-filter hidden-xs">
							<div class="pull-left col-sm-6 col-xs-12">
								<div class="breadcrumb-list text-center-xs">
									{!! (isset($htmlTitle)) ? $htmlTitle : '' !!}
								</div>
							</div>
							<div class="pull-right col-sm-6 col-xs-12 text-right text-center-xs listing-view-action">
								@if (!empty(\Illuminate\Support\Facades\Input::all()))
									<?php $attr = ['countryCode' => config('country.icode')]; ?>
									<a class="clear-all-button text-muted" href="{!! lurl(trans('routes.v-search', $attr), $attr) !!}">{{ t('Clear all') }}</a>
								@endif
							</div>
							<div style="clear:both;"></div>
						</div>

						<div class="adds-wrapper jobs-list">
							@include('search.inc.posts')
						</div>

						<div class="tab-box save-search-bar text-center">
							@if (request()->filled('q') and request()->get('q') != '' and $count->get('all') > 0)
								<a name="{!! qsurl($fullUrlNoParams, request()->except(['_token', 'location']), null, false) !!}" id="saveSearch" count="{{ $count->get('all') }}">
									<i class="icon-star-empty"></i> {{ t('Save Search') }}
								</a>
							@else
								<a href="#"> &nbsp; </a>
							@endif
						</div>
					</div>
					
					<nav class="pagination-bar mb-5 pagination-sm" aria-label="">
						{!! $paginator->appends(request()->query())->render() !!}
					</nav>

					@if (!auth()->check())
						<div class="post-promo text-center">
							<h2> {{ t('Looking for a job?') }} </h2>
							<h5> {{ t('Upload your Resume and easily apply to jobs from any device!') }} </h5>
							<a href="{{ lurl(trans('routes.register')) . '?type=2' }}" class="btn btn-border btn-post btn-add-listing">
								{{ t('Add your Resume') }} <i class="icon-attach"></i>
							</a>
						</div>
					@endif

				</div>
				
				<div style="clear:both;"></div>

				<!-- Advertising -->
				@include('layouts.inc.advertising.bottom')

			</div>

		</div>
	</div>
@endsection

@section('modal_location')
	@parent
	@include('layouts.inc.modal.location')
@endsection

@section('after_scripts')
	<script>
        $(document).ready(function () {
			$('#postType a').click(function (e) {
				e.preventDefault();
				var goToUrl = $(this).attr('href');
				redirect(goToUrl);
			});
			$('#orderBy').change(function () {
				var goToUrl = $(this).val();
				redirect(goToUrl);
			});
		});
	</script>
@endsection
