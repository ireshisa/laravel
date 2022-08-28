<!-- this (.mobile-filter-sidebar) part will be position fixed in mobile version -->
<div class="col-md-3 page-sidebar mobile-filter-sidebar pb-4 jobsearch-typo-wrap px-3"
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
				<label class="form-check-label small text-uppercase card-link-secondary">Last
					Hour</label>
			</div>
			<div class="form-check pl-0 mb-3" >
				<input type="radio" name="date_posted" value="24h" class="form-check-input filled-in">
				<label class="form-check-label small text-uppercase card-link-secondary">Last 24
					Hours</label>
			</div>
			<div class="form-check pl-0 mb-3" >
				<input type="radio" name="date_posted" value="7d" class="form-check-input filled-in">
				<label class="form-check-label small text-uppercase card-link-secondary">Last
					7 Days</label>
			</div>
			<div class="form-check pl-0 mb-3 pb-1" >
				<input type="radio" name="date_posted" value="14d" class="form-check-input filled-in">
				<label class="form-check-label small text-uppercase card-link-secondary">Last 14
					days</label>
			</div>
			<div class="form-check pl-0 mb-3 pb-1" >
				<input type="radio" name="date_posted" value="30d" class="form-check-input filled-in">
				<label class="form-check-label small text-uppercase card-link-secondary">Last 30
					days</label>
			</div>
		</div>
	</div>






	<div class="jobsearch-filter-responsive-wrap filter-panel">
		<div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">
			<div class="jobsearch-fltbox-title filter-head ">
				<div class="d-inline-block ">
					<h4>Age</h4>
				</div>
				<div class="d-inline-block float-right"><i class="fa fa-chevron-down"></i></div>


			</div>
		</div>

		<div class="filter-content py-3">


			<div class="form-check pl-0 mb-3" >
				<input type="radio" class="form-check-input filled-in" name="age" value="18-22">
				<label class="form-check-label small text-uppercase card-link-secondary" >18-22 Years</label>
			</div>
			<div class="form-check pl-0 mb-3" >
				<input type="radio" class="form-check-input filled-in" name="age" value="23-27" >
				<label class="form-check-label small text-uppercase card-link-secondary" >23-27 Years</label>
			</div>
			<div class="form-check pl-0 mb-3" >
				<input type="radio" class="form-check-input filled-in" name="age" value="28-32">
				<label class="form-check-label small text-uppercase card-link-secondary" >28-32 Years</label>
			</div>
			<div class="form-check pl-0 mb-3" >
				<input type="radio" class="form-check-input filled-in" name="age" value="33-37">
				<label class="form-check-label small text-uppercase card-link-secondary" >33-37 Years</label>
			</div>
			<div class="form-check pl-0 mb-3" >
				<input type="radio" class="form-check-input filled-in" name="age" value="38-42">
				<label class="form-check-label small text-uppercase card-link-secondary" >38-42 Years</label>
			</div>
			<div class="form-check pl-0 mb-3" >
				<input type="radio" class="form-check-input filled-in" name="age"value="43-47">
				<label class="form-check-label small text-uppercase card-link-secondary" >43-47 Years</label>
			</div>
			<div class="form-check pl-0 mb-3" >
				<input type="radio" class="form-check-input filled-in" name="age" value="48-52">
				<label class="form-check-label small text-uppercase card-link-secondary" >48-52 Years</label>
			</div>
			<div class="form-check pl-0 mb-3" >
				<input type="radio"  class="form-check-input filled-in" name="age" value="53-57">
				<label class="form-check-label small text-uppercase card-link-secondary" >53-57 Years</label>
			</div>
			<div class="form-check pl-0 mb-3" >
				<input type="radio" class="form-check-input filled-in"  name="age" value="57-200" >
				<label class="form-check-label small text-uppercase card-link-secondary" >Above 57 Years</label>
			</div>
		</div>
	</div>

	<div class="jobsearch-filter-responsive-wrap filter-panel">
		<div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">
			<div class="jobsearch-fltbox-title filter-head ">
				<div class="d-inline-block ">
					<h4>Salary</h4>
				</div>
				<div class="d-inline-block float-right"><i class="fa fa-chevron-down"></i></div>


			</div>
		</div>

		<div class="filter-content py-3">

			<p>
				<label for="salary-amount">Salary range:</label>
				<input type="text" id="salary-amount" readonly
					   style="border:0; color:#f6931f; font-weight:bold;">
				<input type="hidden" id="salary-filter" name="salary-amount" value="">
			</p>

			<div id="salary-range"></div>
		</div>
	</div>

	<div class="jobsearch-filter-responsive-wrap filter-panel">
		<div class="jobsearch-search-filter-wrap jobsearch-search-filter-toggle jobsearch-remove-padding">
			<div class="jobsearch-fltbox-title filter-head ">
				<div class="d-inline-block ">
					<h4>Gender</h4>
				</div>
				<div class="d-inline-block float-right"><i class="fa fa-chevron-down"></i></div>


			</div>
		</div>

		<div class="filter-content py-3">


			<div class="form-check pl-0 mb-3" >
				<input type="checkbox" class="form-check-input filled-in" name="gender" value="male" >
				<label class="form-check-label small text-uppercase card-link-secondary"
				>Male</label>
			</div>
			<div class="form-check pl-0 mb-3" >
				<input type="checkbox" class="form-check-input filled-in" name="gender" value="female">
				<label class="form-check-label small text-uppercase card-link-secondary"  >Female</label>
			</div>

		</div>
	</div>



</div>

@section('after_scripts')
	@parent
	<script>
		var baseUrl = '{{ $fullUrlNoParams }}';

		$(document).ready(function ()
		{
			$('input[type=radio][name=postedDate]').click(function() {
				var postedQueryString = $('#postedQueryString').val();
				
				if (postedQueryString != '') {
					postedQueryString = postedQueryString + '&';
				}
				postedQueryString = postedQueryString + 'postedDate=' + $(this).val();

				var searchUrl = baseUrl + '?' + postedQueryString;
				redirect(searchUrl);
			});

			$('#blocPostType input[type=checkbox]').click(function() {
				var postTypeQueryString = $('#postTypeQueryString').val();

				if (postTypeQueryString != '') {
					postTypeQueryString = postTypeQueryString + '&';
				}
				var tmpQString = '';
				$('#blocPostType input[type=checkbox]:checked').each(function(){
					if (tmpQString != '') {
						tmpQString = tmpQString + '&';
					}
					tmpQString = tmpQString + 'type[]=' + $(this).val();
				});
				postTypeQueryString = postTypeQueryString + tmpQString;

				var searchUrl = baseUrl + '?' + postTypeQueryString;
				redirect(searchUrl);
			});
		});
	</script>
@endsection