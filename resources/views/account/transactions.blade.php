{{--
//
--}}
@extends('layouts.master')

@section('content')
	@include('common.spacer')
	<div class="main-container">
		<div class="container">
			<div class="row">
				
				<div class="col-md-3 page-sidebar">
					@include('account.inc.sidebar')
				</div>
				<!--/.page-sidebar-->
				
				<div class="col-md-9 page-content">
					<div class="inner-box">
						<h2 class="title-2"><i class="icon-money"></i> {{ t('Transactions') }} </h2>
						
						<div style="clear:both"></div>
						
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
								<tr>
									<th><span>Payment Ref.</span></th>
									<th>{{ t('Package') }}</th>
									<th>Date</th>

								</tr>
								</thead>
								<tbody>
								<?php
								if (isset($transactions) && $transactions->count() > 0):
									foreach($transactions as  $transaction):
								?>
								<tr>
									<td>{{$transaction->payment_ref }}</td>
									<td>
										{{$transaction->package->short_name}}
									</td>
									<td>
										{{date('D,d F Y',strtotime($transaction->updated_at))}}
									</td>

								</tr>
								<?php endforeach; ?>
								<?php endif; ?>
								</tbody>
							</table>
						</div>
						
						<nav aria-label="">
							{{ (isset($transactions)) ? $transactions->links() : '' }}
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
@endsection