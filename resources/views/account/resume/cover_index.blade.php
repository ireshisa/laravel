{{--
//
--}}
@extends('layouts.master')

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
		
				<div class="col-md-3 page-sidebar">
					@include('account.inc.sidebar')
				</div>
				<!--/.page-sidebar-->
				
				<div class="col-md-9 page-content">
					<div class="inner-box">
						<h2 class="title-2"><i class="icon-town-hall"></i> {{ t('My Cover letter') }} </h2>
						<div class="mb30">
							<a href="{{ lurl('account/resumes/create') }}" class="btn btn-default"><i class="icon-plus"></i></a>
						</div>
						<br>
						
						<div class="table-responsive">
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
													<p>
														<a class="btn btn-primary btn-sm" href="{{ lurl('account/resumes/' . $resume->id . '/edit') }}">
															<i class="fa fa-edit"></i> {{ t('Edit') }}
														</a>
													</p>
													<p>
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
						</div>
					
					</div>

					<br>
					<div class="inner-box">
						<h2 class="title-2">Details</h2>

						<div class="col-lg-12">
							<form action="{{ lurl('account/resumes/skills') }}" method="POST" class="form">
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
								<div class="form-group">
									<label for="">Location</label>
									<input class="form-control" type="text" name="location" value="{{auth()->user()->location}}" required>
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
							
								
								
									@include('account.resume._partial_resume',['data'=>auth()->user()])
								
								<div class="form-group">
									<label for="">Qualifications(One per line)</label>
									<textarea name="qualifications" id="" cols="30" rows="3" class="form-control" required>{{auth()->user()->qualifications}}</textarea>
								</div>
								<div class="form-group">
									<label for="">Experience</label>
									<select name="experience" id="" class="form-control" required>
										<option value=""></option>
										<option value="6m" {{auth()->user()->experience == '6m' ? 'selected' : ''}}>6 Months</option>
										<option value="1y" {{auth()->user()->experience == '1y' ? 'selected' : ''}}>1 Year</option>
										<option value="2y" {{auth()->user()->experience == '2y' ? 'selected' : ''}}>2 Years</option>
										<option value="3y" {{auth()->user()->experience == '3y' ? 'selected' : ''}}>3 Years</option>
										<option value="4y" {{auth()->user()->experience == '4y' ? 'selected' : ''}}>4 Years</option>
										<option value="5y" {{auth()->user()->experience == '5y' ? 'selected' : ''}}>5 Years</option>
									</select>
								</div>
								<div class="form-group">
									<label for="">Expected salary(LKR)</label>
									<input class="form-control" type="number" name="salary" value="{{auth()->user()->salary}}" step=".5" min="10000" required>
								</div>
								<div class="form-group">
									<label for="">Skills (Comma separated)</label>
									<input class="form-control" type="text" name="skills"  value="{{auth()->user()->skills}}" required>
								</div>


								<div class="form-group">
									<label for="">About me</label><br>
									<textarea name="about_me" class="form-control" id="" cols="30" rows="3">{{auth()->user()->about_me}}</textarea>
								</div>

								<div class="form-group">
									<button type="submit" class="btn btn-primary">Save</button>
									<a href="{{route('resume.download')}}" target="_blank" class="btn btn-primary">CV View & Download</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('after_scripts')
	<script src="{{ url('assets/js/footable.js?v=2-0-1') }}" type="text/javascript"></script>
	<script src="{{ url('assets/js/footable.filter.js?v=2-0-1') }}" type="text/javascript"></script>
	
	

	
	
	
	
	
	
	
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
	</script>
@endsection
