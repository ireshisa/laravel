@if (isset($countPosts) and isset($countUsers) and isset($countCities))
@include('home.inc.spacer')
<div class="container">
	<div class="page-info page-info-lite rounded">
		<div class="text-center section-promo border border-info" style="margin-bottom: 20px" >
			<div class="row">
				
				@if (isset($countPosts))
				<div class="col-sm-4 col-xs-6 col-xxs-12">
					<div class="iconbox-wrap">
						<div class="iconbox">
							<div class="iconbox-wrap-icon">
								<i style="color: #16a085;" class="icon icon-docs"></i>
							</div>
							<div class="iconbox-wrap-content">
								<h5 ><span style="color: #16a085;">{{ $countPosts }}</span></h5>
								<div class="iconbox-wrap-text" style="color: #16a085;">{{ t('Jobs') }}</div>
							</div>
						</div>
					</div>
				</div>
				@endif
				
				@if (isset($countUsers))
				<div class="col-sm-4 col-xs-6 col-xxs-12">
					<div class="iconbox-wrap">
						<div class="iconbox">
							<div class="iconbox-wrap-icon">
								<i style="color: #16a085;" class="icon icon-group"></i>
							</div>
							<div class="iconbox-wrap-content">
								<h5><span style="color: #16a085;">{{ $countUsers }}</span></h5>
								<div class="iconbox-wrap-text" style="color: #16a085;">{{ t('Users') }}</div>
							</div>
						</div>
					</div>
				</div>
				@endif
				
				@if (isset($countCities))
				<div class="col-sm-4 col-xs-6  col-xxs-12">
					<div class="iconbox-wrap">
						<div class="iconbox">
							<div class="iconbox-wrap-icon">
								<i style="color: #16a085;" class="icon icon-map" ></i>
							</div>
							<div class="iconbox-wrap-content">
								<h5><span style="color: #16a085;">{{ $countCities . '+' }}</span></h5>
								<div class="iconbox-wrap-text" style="color: #16a085;">{{ t('Locations') }}</div>
							</div>
						</div>
					</div>
				</div>
				@endif
	
			</div>
		</div>
	</div>
</div>
@endif
