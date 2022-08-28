
<div class="col-md-3 col-sm-12 pr-3 mr-5 ml-3 page-sidebar mobile-filter-sidebar pb-4 jobsearch-typo-wrap "
	 id="filter-options">
	<div class="jobsearch-filter-responsive-wrap filter-panel">
		<div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">
			<div class="jobsearch-fltbox-title filter-head ">
				<div class="d-inline-block ">
					<h4>Posted</h4>
				</div>
				<div class="d-inline-block float-right"><i class="fa fa-chevron-down"></i></div>


			</div>
		</div>

		<div class="filter-content py-3">


			<div class="form-check pl-0 mb-3" >
				<input type="radio" name="date_posted" value="1h" class="form-check-input filled-in">
				<label class="form-check-label  text-capitalize card-link-secondary">Last
					Hour</label>
			</div>
			<div class="form-check pl-0 mb-3" >
				<input type="radio" name="date_posted" value="24h" class="form-check-input filled-in">
				<label class="form-check-label  text-capitalize card-link-secondary">Last 24
					Hours</label>
			</div>
			<div class="form-check pl-0 mb-3" >
				<input type="radio" name="date_posted" value="7d" class="form-check-input filled-in">
				<label class="form-check-label  text-capitalize card-link-secondary">Last
					7 Days</label>
			</div>
			<div class="form-check pl-0 mb-3 pb-1" >
				<input type="radio" name="date_posted" value="14d" class="form-check-input filled-in">
				<label class="form-check-label  text-capitalize card-link-secondary">Last 14
					days</label>
			</div>
			<div class="form-check pl-0 mb-3 pb-1" >
				<input type="radio" name="date_posted" value="30d" class="form-check-input filled-in">
				<label class="form-check-label  text-capitalize card-link-secondary">Last 30
					days</label>
			</div>
			<div class="form-check pl-0 mb-3 pb-1" >
				<input type="radio" name="date_posted" value="all" class="form-check-input filled-in">
				<label class="form-check-label  text-capitalize card-link-secondary">All</label>
			</div>
		</div>
	</div>


	<div class="jobsearch-filter-responsive-wrap filter-panel">
		<div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">
			<div class="jobsearch-fltbox-title filter-head ">
				<div class="d-inline-block ">
					<h4>Locations</h4>
				</div>
				<div class="d-inline-block float-right"><i class="fa fa-chevron-down"></i>
				</div>


			</div>
		</div>

		<div class="py-3 filter-content px-2">
			<div class="form-group">
				<label>Province
				</label>
				<select class="form-control" name="province_search">
					<option>Select Province</option>
					@foreach($provinces as $province)
						<option value="{{$province->code}}">{{$province->name}}</option>
					@endforeach
				</select>

			</div>

			<div class="form-group">
				<label>City
				</label>
				<select class="form-control" multiple="multiple" name="city_search">

				</select>

			</div>
			<button type="button" class="btn find btn-block btn-primary m-auto"
					style="max-width: 200px">
				Find
			</button>
		</div>
	</div>





	<div class="jobsearch-filter-responsive-wrap filter-panel">
		<div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">
			<div class="jobsearch-fltbox-title filter-head ">
				<div class="d-inline-block ">
					<h4>Job Type</h4>
				</div>
				<div class="d-inline-block float-right"><i class="fa fa-chevron-down"></i></div>


			</div>
		</div>

		<div class="filter-content py-3">

			@foreach($post_types as $post_type)
				<div class="form-check pl-0 mb-3" >
					<input type="checkbox" class="form-check-input filled-in" name="types" value="{{$post_type->id}}">
					<label class="form-check-label  text-capitalize card-link-secondary" >{{$post_type->name}}</label>
				</div>
			@endforeach
			<div class="form-check pl-0 mb-3" >
				<input type="radio" class="form-check-input filled-in" name="types" value="all">
				<label class="form-check-label  text-capitalize card-link-secondary" >All</label>
			</div>

		</div>
	</div>

	<?php /*
	@if(auth()->check() && auth()->user()->user_type_id == 2)
		<div class="jobsearch-filter-responsive-wrap filter-panel">
			<div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">
				<div class="jobsearch-fltbox-title filter-head ">
					<div class="d-inline-block ">
						<h4>Email me New Jobs</h4>
					</div>
					<div class="d-inline-block float-right"><i class="fa fa-chevron-down"></i>
					</div>


				</div>
			</div>

			<div class="py-3 filter-content px-2">

				<form method="POST" action="" id="create-alert-form">
					{{ csrf_field() }}
					@if(isset($alert_id))
						<input type="hidden" name="alert_id" value="{{$alert_id}}"/>
					@endif
					<div class="form-group">
						<?php $nameError = (isset($errors) and $errors->has('name')) ? ' is-invalid' : ''; ?>
						<input type="text" class="form-control {{ $nameError }}" name="name"  value="{{$alertName ?? ''}}" placeholder="Job Alert Name"/>


					</div>
					<?php $emailError = (isset($errors) and $errors->has('email')) ? ' is-invalid' : ''; ?>
					<div class="form-group">
						<input type="email" class="form-control {{ $emailError }}" name="email" value="{{$alertEmail ?? ''}}" placeholder="Email Address"/>

					</div>
					<div class="row">
						<div class="col-md-12 col-lg-6">
							<input name="frequency" class="radio-frequency" maxlength="75" type="radio" value="Daily" {{((isset($notifyType) && $notifyType=="Daily")?"checked":"")}}><label>Daily</label>
						</div>
						<div class="col-md-12 col-lg-6">
							<input name="frequency" class="radio-frequency" maxlength="75" type="radio" value="Weekly" {{((isset($notifyType) && $notifyType=="Weekly")?"checked":"")}}><label>Weekly</label>
						</div>
						<div class="col-md-12 col-lg-6">
							<input name="frequency" class="radio-frequency" maxlength="75" type="radio" value="Monthly" {{((isset($notifyType) && $notifyType=="Monthly")?"checked":"")}}><label>Monthly</label>
						</div>
						<div class="col-md-12 col-lg-6">
							<input name="frequency" class="radio-frequency" maxlength="75" type="radio" value="Annually" {{((isset($notifyType) && $notifyType=="Annually")?"checked":"")}}><label>Annually</label>
						</div>
					</div>
					<button type="submit"  id="create-alert-btn" class="btn find btn-block btn-primary m-auto"
							style="max-width: 200px">
						{{((isset($alert_id))?"Update Alert":"Create Alert")}}
					</button>
				</form>
			</div>
		</div>
	@endif */?>

	<div class="jobsearch-filter-responsive-wrap filter-panel">
		<div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">
			<div class="jobsearch-fltbox-title filter-head ">
				<div class="d-inline-block ">
					<h4>Categories</h4>
				</div>
				<div class="d-inline-block float-right"><i class="fa fa-chevron-down"></i></div>


			</div>
		</div>

		<div class="filter-content py-3">

			@foreach($categories as $category)
				<div class="form-check pl-0 mb-3" >
					<input type="checkbox" class="form-check-input filled-in" name="category_id" value="{{$category->id}}">
					<label class="form-check-label align-middle  text-truncate text-capitalize card-link-secondary" style="max-width: 90%" >{{$category->name}}</label>
				</div>
			@endforeach
		</div>
	</div>

	<div class="jobsearch-filter-responsive-wrap filter-panel">
		<div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">
			<div class="jobsearch-fltbox-title filter-head ">
				<div class="d-inline-block ">
					<h4>Salary Range</h4>
				</div>
				<div class="d-inline-block float-right"><i class="fa fa-chevron-down"></i></div>


			</div>
		</div>

		<div class="filter-content py-3">


			<div class="form-check pl-0 mb-3" >
				<input type="checkbox" class="form-check-input filled-in" name="salary" value="500-1000">
				<label class="form-check-label  text-capitalize card-link-secondary" >500LKR - 1000LKR</label>
			</div>
			<div class="form-check pl-0 mb-3" >
				<input type="checkbox" class="form-check-input filled-in" name="salary" value="1000-5000">
				<label class="form-check-label  text-capitalize card-link-secondary" >1000LKR - 5000LKR</label>
			</div>
			<div class="form-check pl-0 mb-3" >
				<input type="checkbox" class="form-check-input filled-in" name="salary" value="5000-10000">
				<label class="form-check-label  text-capitalize card-link-secondary" >5000LKR - 10,000LKR</label>
			</div>
			<div class="form-check pl-0 mb-3" >
				<input type="checkbox" class="form-check-input filled-in" name="salary" value="10000-20000">
				<label class="form-check-label  text-capitalize card-link-secondary" >10,000LKR - 20,000LKR</label>
			</div>
			<div class="form-check pl-0 mb-3" >
				<input type="checkbox" class="form-check-input filled-in" name="salary" value="20000-30000">
				<label class="form-check-label  text-capitalize card-link-secondary" >20,000LKR - 30,000LKR</label>
			</div>
			<div class="form-check pl-0 mb-3" >
				<input type="checkbox" class="form-check-input filled-in" name="salary" value="30000-50000">
				<label class="form-check-label  text-capitalize card-link-secondary" >30,000LKR - 50,000LKR</label>
			</div>
			<div class="form-check pl-0 mb-3" >
				<input type="checkbox" class="form-check-input filled-in" name="salary" value="50000-100000">
				<label class="form-check-label  text-capitalize card-link-secondary" >50,000LKR - 100,000LKR</label>
			</div>
			<div class="form-check pl-0 mb-3" >
				<input type="checkbox" class="form-check-input filled-in" name="salary" value="50000-100000">
				<label class="form-check-label  text-capitalize card-link-secondary" >> 100,000LKR</label>
			</div>
			<div class="form-check pl-0 mb-3" >
				<input type="radio" class="form-check-input filled-in" name="salary" value="all">
				<label class="form-check-label  text-capitalize card-link-secondary" >All</label>
			</div>
		</div>
	</div>

	<a class="btn find btn-block btn-primary m-auto" href="{{ url('latest-jobs') }}"
	   style="max-width: 200px">
		Reset
	</a>
	<br>
	
	                  <div   value="aasda" class="btn btn-block btn-danger m-auto closebuttone btnmf-none" onclick="cloce()" style="max-width: 200px">
                        close
                    </div>


</div>
@section('after_scripts')
	@parent
	<script>
		var baseUrl = '{{ $fullUrlNoParams }}';


		jQuery(document).on("click",".list-filter.jobsearch-search-filter-wrap .list-title",function(){
			jQuery(this).parent().toggleClass("active");
			return false;
		})
	</script>
	<script>
		

	</script>
@endsection