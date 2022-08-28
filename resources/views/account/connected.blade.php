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
					    @if(auth()->user()->user_type_id == 1)
						<h2 class="title-2">
							<i class="icon-mail"></i> {{ ('Connected Applicants') }}
						</h2>
						<p class="mb-4">This shows the candidates who you have approved and the candidates who have approved your job posts</p>
						@else
						<h2 class="title-2">
							<i class="icon-mail"></i> {{ ('Applied Jobs') }}
						</h2>
						<p class="mb-4">You can see the jobs you have connected and their connected status here. if the company has accepted your connection
                        request, you can see them under connected companies section.</p>
						@endif
						
						<!--<p>Employer can view the candidates connected</p>-->
						<div id="reloadBtn" class="mb30" style="display: none;">
							<a href="" class="btn btn-primary" class="tooltipHere" title="" data-placement="{{ (config('lang.direction')=='rtl') ? 'left' : 'right' }}"
							   data-toggle="tooltip"
							   data-original-title="{{ t('Reload to see New Messages') }}"><i class="icon-arrows-cw"></i> {{ t('Reload') }}</a>
							<br><br>
						</div>
						
						<div style="clear:both"></div>
						
						<div class="table-responsive">
							<form name="listForm" method="POST" action="{{ lurl('account/'.$pagePath.'/delete') }}">
								{!! csrf_field() !!}
								<div class="table-action">
									<!--<label for="checkAll">-->
									<!--	<input type="checkbox" id="checkAll">-->
									<!--	{{ t('Select') }}: {{ t('All') }} |-->
									<!--	<button type="submit" class="btn btn-sm btn-default delete-action">-->
									<!--		<i class="fa fa-trash"></i> {{ t('Delete') }}-->
									<!--	</button>-->
									<!--</label>-->
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
								
								<table id="addManageTable" class="table table-striped table-bordered add-manage-table table demo" data-filter="#filter" data-filter-text-only="true">
									<thead>
									<tr>
										<!--<th style="width:2%" data-type="numeric" data-sort-initial="true"></th>-->
										<th style="width:38%" data-sort-ignore="true">{{ ('Applicants') }}</th>
										<th style="width:35%" data-sort-ignore="true">{{ ('Approved By') }}</th>
										<th style="width:25%">{{ t('Option') }}</th>
									</tr>
									</thead>
									<tbody>
									<?php
									
									if (isset($conversations) && $conversations->count() > 0):
										foreach($conversations as $key => $conversation):
										    	if (!empty($conversation->fromUser->name)):
									?>
									<tr>
										<!--<td class="add-img-selector">-->
										<!--	<div class="checkbox">-->
										<!--		<label><input type="checkbox" name="entries[]" value="{{ $conversation->id }}"></label>-->
										<!--	</div>-->
										<!--</td>-->
										@if(auth()->user()->user_type_id == 1)
										<td>
											<div style="word-break:break-all;" class="min-tabale">
											<!--   @if(!empty($conversation->job_title))-->
											<!--   	<strong>{{ ('Job Title') }}:</strong>-->
											<!--{{ $conversation->job_title ?? "" }}<br>-->
												<!--@endif-->
												<strong>{{ ('Applied at') }}:</strong>
												{{ $conversation->created_at->formatLocalized(config('settings.app.default_datetime_format')) }}
												@if (\App\Models\Message::conversationHasNewMessages($conversation))
													<!--<i class="icon-flag text-primary"></i>-->
												@endif
												<br>
										        <strong>{{ ('Job Applied') }}:</strong>&nbsp;{{ $conversation->post->title }}<br>
												<strong>Company Name:</strong>&nbsp;{{ $conversation->post->company_name }}<br>
												{{--<strong>Applicant Name:</strong>&nbsp;{{ \Illuminate\Support\Str::limit((($conversation->fromUser->user_type_id == 2)?$conversation->fromUser->name:$conversation->toUser->name), 50) }}<br>--}}
												@if(auth()->user()->id != $conversation->to_user_id)
												<strong>Applicant Name:</strong>&nbsp;{{ $conversation->to_name }}<br>
												<strong>Contact No:</strong>&nbsp;{{ $conversation->to_phone }}<br>
												<strong>Email:</strong>&nbsp;{{ $conversation->to_email }}<br>
												{!! (!empty($conversation->filename) and $disk->exists($conversation->filename)) ? ' <i class="icon-attach-2"></i> ' : '' !!}&nbsp;
												@else
													<strong>Applicant Name:</strong>&nbsp;{{ $conversation->from_name }}<br>
													<strong>Contact No:</strong>&nbsp;{{ $conversation->from_phone }}<br>
													<strong>Email:</strong>&nbsp;{{ $conversation->from_email }}<br>
													{!! (!empty($conversation->filename) and $disk->exists($conversation->filename)) ? ' <i class="icon-attach-2"></i> ' : '' !!}&nbsp;
												@endif
											</div>
										</td>
									@else
											<td>
												<div style="word-break:break-all;">
												<!--   @if(!empty($conversation->job_title))-->
												<!--   	<strong>{{ ('Job Title') }}:</strong>-->
												<!--{{ $conversation->job_title ?? "" }}<br>-->
													<!--@endif-->
													<strong>{{ ('Applied at') }}:</strong>
													{{ $conversation->created_at->formatLocalized(config('settings.app.default_datetime_format')) }}
													@if (\App\Models\Message::conversationHasNewMessages($conversation))
														<i class="icon-flag text-primary"></i>
													@endif
													<br>

													<strong>{{ ('Job Applied') }}:</strong>&nbsp;{{ $conversation->post->title }}<br>
													{{--<strong>Applicant Name:</strong>&nbsp;{{ \Illuminate\Support\Str::limit((($conversation->fromUser->user_type_id == 2)?$conversation->fromUser->name:$conversation->toUser->name), 50) }}<br>--}}
{{--													<strong>Applicant Name:</strong>&nbsp;{{ $conversation->from_name }}<br>--}}
													<strong>Company Name:</strong>&nbsp;{{ $conversation->post->company_name }}<br>
													<strong>Contact No:</strong>&nbsp;{{ $conversation->from_phone }}<br>
													<!--<strong>Email:</strong>&nbsp;{{ $conversation->from_email }}<br>-->
													<strong>Email:</strong>&nbsp;{{ \App\Models\Company::find($conversation->post->company_id)->email }}<br>
													{!! (!empty($conversation->filename) and $disk->exists($conversation->filename)) ? ' <i class="icon-attach-2"></i> ' : '' !!}&nbsp;

												</div>
											</td>
									@endif
										<!--<td>-->
										<!--	<div class="text-center">-->
										<!--		<div class="text-center">-->
										<!--			<button class="btn btn-outline-primary conneted">{{ \Illuminate\Support\Str::limit($conversation->from_name, 50) }}</button>-->
										<!--		</div>-->
										<!--	</div>-->
										<!--</td>-->
										<td>
											<div class="text-center">    
												<span style="display:block; border-radius: 10px;" class="p-2 btn-outline-primary conneted text-center">
												  
												    
												    
												    	  {!! (!empty($conversation->to_name))  ? $conversation->to_name : 'User Not in System' !!}
									
							
											
												    
												    
												    
												    
												    </span>
											</div>

										</td>
										<td class="action-td">
											<div>
												@if(auth()->user()->user_type_id == 1)
													@if(auth()->user()->id != $conversation->to_user_id)
													<p class="text-center">
														{{--													<a class="btn btn-view btn-sm" style="width: 7rem" href="{{ lurl('account/connected/'.$conversation->post_id.'/'. (($conversation->from_user_id != auth()->user()->id)?$conversation->from_user_id:$conversation->to_user_id)) }}"><i class="fa fa-eye"></i> {{ t('View') }}</a>--}}
														<a class="btn btn-view btn-sm" style="width: 7rem" href="{{ url('search-talent/seeker/'. $conversation->to_user_id) }}"><i class="fa fa-eye"></i> {{ t('View') }}</a>
														{{--													<a class="btn btn-primary btn-sm" href="{{ lurl('account/conversations/' . $conversation->id.'/messages' ) }}">--}}
														{{--														<i class="fa fa-eye"></i> {{ t('View') }}--}}
														{{--													</a>--}}
													</p>
													@else
													<p class="text-center">
														{{--													<a class="btn btn-view btn-sm" style="width: 7rem" href="{{ lurl('account/connected/'.$conversation->post_id.'/'. (($conversation->from_user_id != auth()->user()->id)?$conversation->from_user_id:$conversation->to_user_id)) }}"><i class="fa fa-eye"></i> {{ t('View') }}</a>--}}
														<a class="btn btn-view btn-sm" style="width: 7rem" href="{{ url('search-talent/seeker/'. $conversation->from_user_id) }}"><i class="fa fa-eye"></i> {{ t('View') }}</a>
														{{--													<a class="btn btn-primary btn-sm" href="{{ lurl('account/conversations/' . $conversation->id.'/messages' ) }}">--}}
														{{--														<i class="fa fa-eye"></i> {{ t('View') }}--}}
														{{--													</a>--}}
													</p>
													@endif
												@else
													<p class="text-center">
														<!--<a class="btn btn-view btn-sm" style="width: 7rem" href="{{ lurl('account/connected/'.$conversation->post_id.'/'. (($conversation->from_user_id != auth()->user()->id)?$conversation->from_user_id:$conversation->to_user_id)) }}"><i class="fa fa-eye"></i> {{ t('View') }}</a>-->
														<a class="btn btn-view btn-sm" style="width: 7rem" href="{{ url('post/'.$conversation->post_id) }}"><i class="fa fa-eye"></i> {{ t('View') }}</a>
														{{--													<a class="btn btn-primary btn-sm" href="{{ lurl('account/conversations/' . $conversation->id.'/messages' ) }}">--}}
														{{--														<i class="fa fa-eye"></i> {{ t('View') }}--}}
														{{--													</a>--}}
													</p>
												@endif
												<!--<p class="text-center">-->
												<!--	<a class="btn btn-primary btn-sm" href="{{ lurl('candidate-support') }}">-->
												<!--		<i class="fa fa-columns"></i> {{ ('Reschedule Interview') }}-->
												<!--	</a>-->
												<!--</p>-->
{{--												<p>--}}
{{--													<a class="btn btn-danger btn-sm delete-action" href="{{ lurl('account/conversations/' . $conversation->id . '/delete') }}">--}}
{{--														<i class="fa fa-trash"></i> {{ t('Delete') }}--}}
{{--													</a>--}}
{{--												</p>--}}
											</div>
										</td>
									</tr>
									<?php endif; ?>
									<?php endforeach; ?>
									<?php endif; ?>
									</tbody>
								</table>
							</form>
						</div>
						
						<nav class="" aria-label="">
							{{ (isset($conversations)) ? $conversations->links() : '' }}
						</nav>
						
						<div style="clear:both"></div>
					
					</div>
				</div>
				<!--/.page-content-->
				
			</div>
			<!--/.row-->
		</div>
		<!--/.container-->
	</div>
	<!-- /.main-container -->

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