{{--
//
--}}

@extends('layouts.master')

@section('wizard')
    @include('post.createOrEdit.multiSteps.inc.wizard')
@endsection

@section('content')
	@include('common.spacer')
    <div class="main-container">
        <div class="container">
            <div class="row">
    
                @include('post.inc.notification')
                
                <div class="col-md-12 page-content">
                    <div class="inner-box">
						
                        <h2 class="title-2"><strong><i class="icon-tag"></i> {{ t('Pricing') }}</strong></h2>
						
                        <div class="row">
                            <div class="col-sm-12">
                                @include('post.createOrEdit.multiSteps.package_mid')
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.page-content -->
                
                <div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="smallBody">
                    <div>
					<div id="card_container"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                
            </div>
        </div>
    </div>
@endsection

@section('after_styles')
@endsection


