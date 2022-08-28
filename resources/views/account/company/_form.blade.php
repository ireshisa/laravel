<?php
// From Company's Form
$classLeftCol = 'col-md-3';
$classRightCol = 'col-md-9';

if (isset($originForm)) {
	// From User's Form
	if ($originForm == 'user') {
		$classLeftCol = 'col-md-3';
		$classRightCol = 'col-md-7';
	}
	
	// From Post's Form
	if ($originForm == 'post') {
		$classLeftCol = 'col-md-3';
		$classRightCol = 'col-md-8';
	}
}
?>
<div id="companyFields">
	<!-- name -->
<?php $companyNameError = (isset($errors) and $errors->has('company.name')) ? ' is-invalid' : ''; ?>
	<div class="form-group row required">
		<label class="{{ $classLeftCol }} control-label" for="company.name">{{ t('Company Name') }} <sup>*</sup></label>
		<div class="{{ $classRightCol }}">
			<input name="name"
				   placeholder="{{ t('Company Name') }}"
				   class="form-control input-md{{ $companyNameError }}"
				   type="text"
				   value="{{ old('company.name', (isset($company->name) ? $company->name : '')) }}">
		</div>
	</div>

	<!-- logo -->
	<?php $companyLogoError = (isset($errors) and $errors->has('company.logo')) ? ' is-invalid' : ''; ?>
	<div class="form-group row">
		<label class="{{ $classLeftCol }} control-label{{ $companyLogoError }}" for="company.logo"> {{ t('Logo') }} </label>
		<div class="{{ $classRightCol }}">
			<div {!! (config('lang.direction')=='rtl') ? 'dir="rtl"' : '' !!} class="file-loading mb10">
				<input id="logo" name="logo" type="file" class="file{{ $companyLogoError }}">
			</div>
			<small id="" class="form-text text-muted">
				{{ t('File types: :file_types', ['file_types' => showValidFileTypes('image')]) }}
			</small>
		</div>
	</div>

	<!-- description -->
	<?php $companyDescriptionError = (isset($errors) and $errors->has('company.description')) ? ' is-invalid' : ''; ?>
	<div class="form-group row required">
		<label class="{{ $classLeftCol }} control-label" for="company.description">{{ t('Company Description') }} <sup>*</sup></label>
		<div class="{{ $classRightCol }}">
			<textarea class="form-control{{ $companyDescriptionError }}"
					  name="description"
					  rows="10"
			>{{ old('company.description', (isset($company->description) ? $company->description : '')) }}</textarea>
			<small id="" class="form-text text-muted">
				{{ t('Describe the company') }} - ({{ t(':number characters maximum', ['number' => 1000]) }})
			</small>
		</div>
	</div>

	<!-- Team size -->
	<?php $companyTeamSizeError = (isset($errors) and $errors->has('company.teamsize')) ? ' is-invalid' : ''; ?>
	<div class="form-group row">
		<label class="{{ $classLeftCol }} control-label" for="company.address">{{ ('Team Size') }}<sup>*</sup></label>
		<div class="input-group {{ $classRightCol }}">
			@if ($teamsize->count() > 0)
				@foreach ($teamsize as $team)
					<div class="form-check form-check-inline pt-2">
						<input name="teamsize_id"
							   id="teamsize_id-{{ $team->id }}"
							   value="{{ $team->id }}"
							   class="form-check-input{{ $companyTeamSizeError }}"
							   type="radio"
								{{ isset($company->teamsize_id) ? ($company->teamsize_id == $team->id ? 'checked="checked"' : '') : '' }}>
						<label class="form-check-label" for="gender_id">
							{{ $team->name }}
						</label>
					</div>
				@endforeach
			@endif
		</div>
	</div>

	<!-- address -->
	<?php $companyAddressError = (isset($errors) and $errors->has('company.address')) ? ' is-invalid' : ''; ?>
	<div class="form-group row">
		<label class="{{ $classLeftCol }} control-label" for="company.address">{{ t('Address') }}<sup>*</sup></label>
		<div class="input-group {{ $classRightCol }}">
			<div class="input-group-prepend">
				<span class="input-group-text"><i class="icon-location"></i></span>
			</div>
			<input name="address"
				   type="text"
				   class="form-control{{ $companyAddressError }}"
				   placeholder=""
				   value="{{ old('company.address', (isset($company->address) ? $company->address : '')) }}"
			>
		</div>
	</div>

	<div class="form-group row">
		<label class="{{ $classLeftCol }}  control-label">Province</label>
		<div class="input-group {{ $classRightCol }}">
			<div class="input-group-prepend">
				<span class="input-group-text"><i class="icon-location"></i></span>
			</div>
		<select name="province_id" class="form-control">

			<option value="">--Select Province--</option>
			@foreach($admin_divs as $admin_div)
				<option value="{{$admin_div->code}}" {{((isset($company) && ($company->province_id == $admin_div->code)) ? 'selected' : '')}}>{{$admin_div->name}}</option>
			@endforeach
		</select>
		</div>
	</div>

	<div class="form-group row">
		<label class="{{ $classLeftCol }} control-label">City</label>
		<div class="input-group {{ $classRightCol }}">
			<div class="input-group-prepend">
				<span class="input-group-text"><i class="icon-location"></i></span>
			</div>
		<select name="city_id" class="form-control">
			<option value="">--Select City--</option>

		</select>
		</div>
	</div>

	<!-- email -->
	<?php $companyEmailError = (isset($errors) and $errors->has('company.email')) ? ' is-invalid' : ''; ?>
	<div class="form-group row">
		<label class="{{ $classLeftCol }} control-label" for="company.email">{{ t('Email') }}<sup>*</sup></label>
		<div class="input-group {{ $classRightCol }}">
			<div class="input-group-prepend">
				<span class="input-group-text"><i class="icon-mail"></i></span>
			</div>
			<input name="email" type="text"
				   class="form-control{{ $companyEmailError }}" placeholder=""
				   value="{{ old('company.email', (isset($company->email) ? $company->email : '')) }}">
		</div>
	</div>

	<!-- phone -->
	<?php $companyPhoneError = (isset($errors) and $errors->has('company.phone')) ? ' is-invalid' : ''; ?>
	<div class="form-group row">
		<label class="{{ $classLeftCol }} control-label" for="company.phone">{{ t('Phone') }}<sup>*</sup></label>
		<div class="input-group {{ $classRightCol }}">
			<div class="input-group-prepend">
				<span class="input-group-text"><i class="icon-phone-1"></i></span>
			</div>
			<input name="phone" type="text"
				   class="form-control{{ $companyPhoneError }}" placeholder=""
				   value="{{ old('company.phone', (isset($company->phone) ? $company->phone : '')) }}">
		</div>
	</div>

	<!-- Company Yearfounded -->
	<?php $companyYearFoundError = (isset($errors) and $errors->has('company.yearfound')) ? ' is-invalid' : ''; ?>
	<div class="form-group row">
		<label class="{{ $classLeftCol }} control-label" for="company.phone">{{ ('Year Found') }}<sup>*</sup></label>
		<div class="input-group {{ $classRightCol }}">
			<div class="input-group-prepend">
				<span class="input-group-text"><i class="icon-calendar"></i></span>
			</div>
			<input name="yearfound" type="text" id="yearpicker"
				   class="form-control{{ $companyYearFoundError }}" placeholder=""
				   value="{{ old('company.phone', (isset($company->yearfound) ? $company->yearfound : '')) }}">
		</div>
	</div>

	<!-- Company Sector -->
	<?php $companySectorError = (isset($errors) and $errors->has('company.sector')) ? ' is-invalid' : ''; ?>
	<div class="form-group row">
		<label class="{{ $classLeftCol }} control-label" for="company.phone">{{ ('Sector') }}<sup>*</sup></label>
		<div class="input-group {{ $classRightCol }}">
			<div class="input-group-prepend">
				<span class="input-group-text"><i class="icon-suitcase"></i></span>
			</div>
			<select name="sector_id" id="" class="form-control{{ $companySectorError}}">
				<option value=""></option>
				@foreach($cats as $cat)
					<option value="{{$cat->id}}" {{ isset($company->sector_id) ? ($company->sector_id == $cat->id ? 'selected' : '') : '' }}>{{$cat->name}}</option>
				@endforeach
			</select>
		</div>
	</div>

	<!-- website -->
	<?php $companyWebsiteError = (isset($errors) and $errors->has('company.website')) ? ' is-invalid' : ''; ?>
	<div class="form-group row">
		<label class="{{ $classLeftCol }} control-label" for="company.website">{{ t('Website') }}</label>
		<div class="input-group {{ $classRightCol }}">
			<div class="input-group-prepend">
				<span class="input-group-text"><i class="icon-globe"></i></span>
			</div>
			<input name="website" type="text"
				   class="form-control{{ $companyWebsiteError }}" placeholder=""
				   value="{{ old('company.website', (isset($company->website) ? $company->website : '')) }}">
		</div>
	</div>

	<!-- facebook -->
	<?php $companyFacebookError = (isset($errors) and $errors->has('company.facebook')) ? ' is-invalid' : ''; ?>
	<div class="form-group row">
		<label class="{{ $classLeftCol }} control-label" for="company.facebook">Facebook</label>
		<div class="input-group {{ $classRightCol }}">
			<div class="input-group-prepend">
				<span class="input-group-text"><i class="icon-facebook"></i></span>
			</div>
			<input name="facebook" type="text"
				   class="form-control{{ $companyFacebookError }}" placeholder=""
				   value="{{ old('company.facebook', (isset($company->facebook) ? $company->facebook : '')) }}">
		</div>
	</div>

	<!-- twitter -->
	<?php $companyTwitterError = (isset($errors) and $errors->has('company.twitter')) ? ' is-invalid' : ''; ?>
	<div class="form-group row">
		<label class="{{ $classLeftCol }} control-label" for="company.twitter">Twitter</label>
		<div class="input-group {{ $classRightCol }}">
			<div class="input-group-prepend">
				<span class="input-group-text"><i class="icon-twitter"></i></span>
			</div>
			<input name="twitter" type="text"
				   class="form-control{{ $companyTwitterError }}" placeholder=""
				   value="{{ old('company.twitter', (isset($company->twitter) ? $company->twitter : '')) }}">
		</div>
	</div>

	<!-- linkedin -->
	<?php $companyLinkedinError = (isset($errors) and $errors->has('company.linkedin')) ? ' is-invalid' : ''; ?>
	<div class="form-group row">
		<label class="{{ $classLeftCol }} control-label" for="company.linkedin">Linkedin</label>
		<div class="input-group {{ $classRightCol }}">
			<div class="input-group-prepend">
				<span class="input-group-text"><i class="icon-linkedin"></i></span>
			</div>
			<input name="linkedin" type="text"
				   class="form-control{{ $companyLinkedinError }}" placeholder=""
				   value="{{ old('company.linkedin', (isset($company->linkedin) ? $company->linkedin : '')) }}">
		</div>
	</div>

	<!-- Company Registration No -->
	<div class="form-group row required">
		<label class="{{ $classLeftCol }} control-label">{{ ('Registration No') }}</label>
		<div class="col-md-9">
			<input name="registrationNo" type="text" class="form-control" placeholder="" value="{{ (isset($company->registrationNo) ? $company->registrationNo : '') }}">
		</div>
	</div>

<?php /* @if (isset($company) and !empty($company))
		<!-- country_code -->
		<?php $companyCountryCodeError = (isset($errors) and $errors->has('company.country_code')) ? ' is-invalid' : ''; ?>
		<div class="form-group row required">
			<label class="{{ $classLeftCol }} control-label{{ $companyCountryCodeError }}" for="company.country_code">{{ t('Country') }}</label>
			<div class="{{ $classRightCol }}">
				<select id="countryCode" name="country_code" class="form-control sselecter{{ $companyCountryCodeError }}">
					<option value="0" {{ (!old('company.country_code') or old('company.country_code')==0) ? 'selected="selected"' : '' }}> {{ t('Select a country') }} </option>
					@foreach ($countries as $item)
						<option value="{{ $item->get('code') }}"
								{{ (old('company.country_code',
								(isset($company->country_code) ? $company->country_code : ((!empty(config('country.code'))) ? config('country.code') : 0)))==$item->get('code')) ? 'selected="selected"' : '' }}>
							{{ $item->get('name') }}
						</option>
					@endforeach
				</select>
			</div>
		</div>

		<!-- city_id -->
		<?php $companyCityIdError = (isset($errors) and $errors->has('company.city_id')) ? ' is-invalid' : ''; ?>
		<div class="form-group row">
			<label class="{{ $classLeftCol }} control-label{{ $companyCityIdError }}" for="company.city_id">{{ t('City') }}</label>
			<div class="{{ $classRightCol }}">
				<select id="cityId" name="city_id" class="form-control sselecter{{ $companyCityIdError }}">
					<option value="0" {{ (!old('company.city_id') or old('company.city_id')==0) ? 'selected="selected"' : '' }}>
						{{ t('Select a city') }}
					</option>
				</select>
			</div>
		</div>

		<!-- address -->
		<?php $companyAddressError = (isset($errors) and $errors->has('company.address')) ? ' is-invalid' : ''; ?>
		<div class="form-group row">
			<label class="{{ $classLeftCol }} control-label" for="company.address">{{ t('Address') }}</label>
			<div class="input-group {{ $classRightCol }}">
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="icon-location"></i></span>
				</div>
				<input name="address"
					   type="text"
					   class="form-control{{ $companyAddressError }}"
					   placeholder=""
					   value="{{ old('company.address', (isset($company->address) ? $company->address : '')) }}"
				>
			</div>
		</div>

		<!-- phone -->
		<?php $companyPhoneError = (isset($errors) and $errors->has('company.phone')) ? ' is-invalid' : ''; ?>
		<div class="form-group row">
			<label class="{{ $classLeftCol }} control-label" for="company.phone">{{ t('Phone') }}</label>
			<div class="input-group {{ $classRightCol }}">
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="icon-phone-1"></i></span>
				</div>
				<input name="phone" type="text"
					   class="form-control{{ $companyPhoneError }}" placeholder=""
					   value="{{ old('company.phone', (isset($company->phone) ? $company->phone : '')) }}">
			</div>
		</div>

		<!-- fax -->
		<?php echo (isset($errors) and $errors->has('company.fax')) ? ' is-invalid' : ''; ?>
		<div class="form-group row">
			<label class="{{ $classLeftCol }} control-label" for="company.fax">{{ t('Fax') }}</label>
			<div class="{{ $classRightCol }}">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="icon-print"></i></span>
					</div>
					<input name="fax" type="text"
						   class="form-control" placeholder=""
						   value="{{ old('company.fax', (isset($company->fax) ? $company->fax : '')) }}">
				</div>
			</div>
		</div>

		<!-- email -->
		<?php $companyEmailError = (isset($errors) and $errors->has('company.email')) ? ' is-invalid' : ''; ?>
		<div class="form-group row">
			<label class="{{ $classLeftCol }} control-label" for="company.email">{{ t('Email') }}</label>
			<div class="input-group {{ $classRightCol }}">
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="icon-mail"></i></span>
				</div>
				<input name="email" type="text"
					   class="form-control{{ $companyEmailError }}" placeholder=""
					   value="{{ old('company.email', (isset($company->email) ? $company->email : '')) }}">
			</div>
		</div>

		<!-- website -->
		<?php $companyWebsiteError = (isset($errors) and $errors->has('company.website')) ? ' is-invalid' : ''; ?>
		<div class="form-group row">
			<label class="{{ $classLeftCol }} control-label" for="company.website">{{ t('Website') }}</label>
			<div class="input-group {{ $classRightCol }}">
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="icon-globe"></i></span>
				</div>
				<input name="website" type="text"
					   class="form-control{{ $companyWebsiteError }}" placeholder=""
					   value="{{ old('company.website', (isset($company->website) ? $company->website : '')) }}">
			</div>
		</div>

		<!-- facebook -->
		<?php $companyFacebookError = (isset($errors) and $errors->has('company.facebook')) ? ' is-invalid' : ''; ?>
		<div class="form-group row">
			<label class="{{ $classLeftCol }} control-label" for="company.facebook">Facebook</label>
			<div class="input-group {{ $classRightCol }}">
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="icon-facebook"></i></span>
				</div>
				<input name="facebook" type="text"
					   class="form-control{{ $companyFacebookError }}" placeholder=""
					   value="{{ old('company.facebook', (isset($company->facebook) ? $company->facebook : '')) }}">
			</div>
		</div>

		<!-- twitter -->
		<?php $companyTwitterError = (isset($errors) and $errors->has('company.twitter')) ? ' is-invalid' : ''; ?>
		<div class="form-group row">
			<label class="{{ $classLeftCol }} control-label" for="company.twitter">Twitter</label>
			<div class="input-group {{ $classRightCol }}">
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="icon-twitter"></i></span>
				</div>
				<input name="twitter" type="text"
					   class="form-control{{ $companyTwitterError }}" placeholder=""
					   value="{{ old('company.twitter', (isset($company->twitter) ? $company->twitter : '')) }}">
			</div>
		</div>

		<!-- linkedin -->
		<?php $companyLinkedinError = (isset($errors) and $errors->has('company.linkedin')) ? ' is-invalid' : ''; ?>
		<div class="form-group row">
			<label class="{{ $classLeftCol }} control-label" for="company.linkedin">Linkedin</label>
			<div class="input-group {{ $classRightCol }}">
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="icon-linkedin"></i></span>
				</div>
				<input name="linkedin" type="text"
					   class="form-control{{ $companyLinkedinError }}" placeholder=""
					   value="{{ old('company.linkedin', (isset($company->linkedin) ? $company->linkedin : '')) }}">
			</div>
		</div>

		<!-- googleplus -->
		<?php $companyGoogleplusError = (isset($errors) and $errors->has('company.googleplus')) ? ' is-invalid' : ''; ?>
		<div class="form-group row">
			<label class="{{ $classLeftCol }} control-label" for="company.googleplus">Google+</label>
			<div class="input-group {{ $classRightCol }}">
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="icon-googleplus-rect"></i></span>
				</div>
				<input name="googleplus" type="text"
					   class="form-control{{ $companyGoogleplusError }}" placeholder=""
					   value="{{ old('company.googleplus', (isset($company->googleplus) ? $company->googleplus : '')) }}">
			</div>
		</div>

	<!-- pinterest -->
		<?php $companyPinterestError = (isset($errors) and $errors->has('company.pinterest')) ? ' is-invalid' : ''; ?>
		<div class="form-group row">
			<label class="{{ $classLeftCol }} control-label" for="company.pinterest">Pinterest</label>
			<div class="input-group {{ $classRightCol }}">
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="icon-docs"></i></span>
				</div>
				<input name="pinterest" type="text"
					   class="form-control{{ $companyPinterestError }}" placeholder=""
					   value="{{ old('company.pinterest', (isset($company->pinterest) ? $company->pinterest : '')) }}">
			</div>
		</div>
	@endif */ ?>
</div>

@section('after_styles')
	@parent
	<style>
		#companyFields .select2-container {
			width: 100% !important;
		}
		.file-loading:before {
			content: " {{ t('Loading') }}...";
		}
		.krajee-default.file-preview-frame .kv-file-content {
			height: auto;
		}
		.krajee-default.file-preview-frame .file-thumbnail-footer {
			height: 30px;
		}
	</style>
@endsection

@section('after_scripts')
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js">	</script>
	<script src="{{asset('assets/js/formsubmit.js')}}"></script>
	<script>
		$('#yearpicker').datepicker({
			minViewMode: "years",
			format: 'yyyy',
			autoclose: true
		});
	</script>
	@parent
	<script>
		/* Initialize with defaults (logo) */
		$('#logo').fileinput(
		{
			theme: "fa",
			language: '{{ config('app.locale') }}',
			@if (config('lang.direction') == 'rtl')
				rtl: true,
			@endif
			dropZoneEnabled: false,
			showPreview: true,
			previewFileType: 'image',
			allowedFileExtensions: {!! getUploadFileTypes('image', true) !!},
			browseLabel: '{!! t("Browse") !!}',
			showUpload: false,
			showRemove: false,
			minFileSize: {{ (int)config('settings.upload.min_image_size', 0) }}, {{-- in KB --}}
			maxFileSize: {{ (int)config('settings.upload.max_image_size', 1000) }}, {{-- in KB --}}
			@if (isset($company) and !empty($company->logo) and isset($disk) and $disk->exists($company->logo))
				/* Retrieve Existing Logo */
				initialPreview: [
					'<img src="{{ url('storage/'.$company->logo, '') }}" class="file-preview-image">',
				],
			@endif
			/* Remove Drag-Drop Icon (in footer) */
			fileActionSettings: {dragIcon: '', dragTitle: ''},
			layoutTemplates: {
				/* Show Only Actions (in footer) */
				footer: '<div class="file-thumbnail-footer pt-2">{actions}</div>',
				/* Remove Delete Icon (in footer) */
				actionDelete: ''
			}
		});
	</script>
	@if (isset($company) and !empty($company))
	<script>
		/* Translation */
		var lang = {
			'select': {
				'country': "{{ t('Select a country') }}",
				'admin': "{{ t('Select a location') }}",
				'city': "{{ t('Select a city') }}"
			}
		};

		/* Locations */
		var countryCode = '{{ old('company.country_code', (isset($company) ? $company->country_code : 0)) }}';
		var adminType = 0;
		var selectedAdminCode = 0;
		var cityId = '{{ old('company.city_id', (isset($company) ? $company->city_id : 0)) }}';
	</script>
	
	<script src="{{ url('assets/js/app/d.select.location.js') . vTime() }}"></script>
	@endif
		<script>
		$(document).ready(function () {
			var province_id = "{{(isset($company)?$company->province_id:'')}}";
			var city_id = "{{(isset($company)?$company->city_id:'')}}";
		//	console.log(province_id);
		$("select[name='city_id']").closest('.form-group').hide();
			if (province_id != "" && province_id !="NULL")
			{
				$("select[name='city_id']").closest('.form-group').hide();
				$("select[name='city_id'] option").remove();
				var html = `<option value="">--Select City--</option>`;
				getData(siteUrl+"/ajax/countries/cities/"+province_id).then((res)=>{
					//console.log(res);
					res.forEach(function (item,index) {

						html += `<option value="${item.id}">${item.text}</option>`;
					});
					$("select[name='city_id']").closest('.form-group').show();
					$("select[name='city_id']").html(html);
					if (city_id != "" && city_id !="NULL")
					{
						$("select[name='city_id']").val(city_id);
					}

				});
			}
		 	$("select[name='city_id']").closest('.form-group').hide();
			$("select[name='province_id']").on('change',function () {
				$("select[name='city_id']").closest('.form-group').hide();
				if ($(this).val() != "")
				{
					$("select[name='city_id']").show();
					$("select[name='city_id'] option").remove();
					var html = `<option value="">--Select City--</option>`;
					getData(siteUrl+"/ajax/countries/cities/"+$(this).val()).then((res)=>{
						//console.log(res);
						res.forEach(function (item,index) {

							html += `<option value="${item.id}">${item.text}</option>`;
						});
						$("select[name='city_id']").closest('.form-group').show();
						$("select[name='city_id']").html(html);
					});
				}

			})
		})
	</script>
@endsection