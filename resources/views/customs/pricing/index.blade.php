<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .description ul li {
        margin-top: 0px !important;
    }
</style>
@extends('layouts.master')

{{-- @section('wizard')
    @include('post.createOrEdit.multiSteps.inc.wizard')
@endsection --}}

@section('content')
	@include('common.spacer')
    <div class="main-container">
        <div class="container">
            <form id="package_form" method="post" action="{{url('/payment')}}">
                <input type="hidden" name="package_id" value="">
            </form>
            <div class="row">
@php
                $packages = $packages->flatten();
                @endphp
                @include('post.inc.notification') 
                <div class="col-md-12 page-content">
                    <div class="inner-box border-0" style="overflow-x: auto">
                        <h2 class="title-2"><strong><i class="icon-tag"></i> Plans & Pricing</strong></h2>
                        <table class="table table-bordered pricing-table" style="min-width: 800px;">
                            <tr>
                                <td></td>
                         {{-- <h2 class="title-2"><strong> {{ ('Note- Post a job is free you can skip and buy connects later') }}</strong></h2> --}}
                        @foreach($packages as $package)



                      <td class="text-center">
                          <h3>{{$package->name}}</h3>
                            <h2>{{($package->id == 1)?'0 LKR':$package->price.' LKR'}}</h2>
                          <h5>*{{$package->duration}} Months</h5>
                          <h5>Unlimited Job Posts</h5>
                          @if (auth()->check())
                              @if (auth()->user()->user_type_id ==1)

                                  <a class="btn d-block  btn-black package m-auto" style="max-width: 100px" data-package_id="{{$package->id}}">Buy
                                  </a>



                              @endif
                          @else
                              <a href="{{url('/register')}}" class="btn btn-black d-block mx-auto" style="max-width: 100px">Sign Up
                              </a>
                          @endif
                      </td>
@endforeach
</tr>
                            <tr class="row-heading">
                                <td colspan="6" class="text-center font-weight-bold">Features</td>
                                <!--@if($packages[0]->name == "Free Trial")-->
                                <!--<td></td>-->
                                <!--@endif-->
                                <!--<td></td>-->
                                <!--<td></td>-->
                                <!--<td></td>-->
                                <!--<td></td>-->
                            </tr> <tr>
                                <td>Connects</td>
                                @foreach($packages as $package)
                                <td class="text-center">{{$package->connects}}</td>
                               @endforeach
                            </tr>
                            <tr>
                                <td>Job Posts Approval Time</td>
                                @if($packages[0]->name == "Free Trial")
                                <td class="text-center">Instant</td>
                                @endif
                                <td class="text-center">Instant</td>
                                <td class="text-center">Instant</td>
                                <td  class="text-center">Instant</td>
                                <td  class="text-center">Instant</td>
                            </tr>
                            <tr>
                                <td>Review Employees</td>
                                @if($packages[0]->name == "Free Trial")
                                <td class="text-center"><i class="fa fa-check"></i> </td>
                                @endif
                                <td class="text-center"><i class="fa fa-check"></i> </td>
                                <td class="text-center"><i class="fa fa-check"></i> </td>
                                <td class="text-center"><i class="fa fa-check"></i> </td>
                                <td class="text-center"><i class="fa fa-check"></i> </td>
                            </tr>
                            <tr>
                                <td>View Talent Profile</td>
                                @if($packages[0]->name == "Free Trial")
                                <td class="text-center"><i class="fa fa-check"></i> </td>
                                @endif
                                <td class="text-center"><i class="fa fa-check"></i> </td>
                                <td class="text-center"><i class="fa fa-check"></i> </td>
                                <td class="text-center"><i class="fa fa-check"></i> </td>
                                <td class="text-center"><i class="fa fa-check"></i> </td>
                            </tr>
                            <tr>
                                <td>Save Candidates</td>
                                @if($packages[0]->name == "Free Trial")
                                <td class="text-center"><i class="fa fa-check"></i> </td>
                                @endif
                                <td class="text-center"><i class="fa fa-check"></i> </td>
                                <td class="text-center"><i class="fa fa-check"></i> </td>
                                <td class="text-center"><i class="fa fa-check"></i> </td>
                                <td class="text-center"><i class="fa fa-check"></i> </td>
                            </tr>
                            <tr>
                                <td>Scheduling Interviews</td>
                                @if($packages[0]->name == "Free Trial")
                                <td class="text-center"><i class="fa fa-check"></i> </td>
                                @endif
                                <td class="text-center"><i class="fa fa-check"></i> </td>
                                <td class="text-center"><i class="fa fa-check"></i> </td>
                                <td class="text-center"><i class="fa fa-check"></i> </td>
                                <td class="text-center"><i class="fa fa-check"></i> </td>
                            </tr>
                            <tr>
                                <td>Basic HR Advise</td>
                                @if($packages[0]->name == "Free Trial")
                                <td class="text-center"><i class="fa fa-check"></i> </td>
                                @endif
                                <td class="text-center"><i class="fa fa-check"></i> </td>
                                <td class="text-center"><i class="fa fa-check"></i> </td>
                                <td class="text-center"><i class="fa fa-check"></i> </td>
                                <td class="text-center"><i class="fa fa-check"></i> </td>
                            </tr>
                            <tr class="row-heading" style="opacity: 0.9">
                                <td  colspan="6" class="text-center font-weight-bold">Additional</td>
                                <!--@if($packages[0]->name == "Free Trial")-->
                                <!--<td></td>-->
                                <!--@endif-->
                                <!--<td></td>-->
                                <!--<td></td>-->
                                <!--<td></td>-->
                                <!--<td></td>-->
                            </tr>
                            <tr>
                                <td>Calling Interviews<br> (Optional)</td>
                                @if($packages[0]->name == "Free Trial")
                                <td class="text-center">Rs 600</td>
                                @endif
                                <td class="text-center">Rs 600</td>
                                <td class="text-center">Rs 1000</td>
                                <td class="text-center">Rs 2500</td>
                                <td class="text-center">Rs 35/Call</td>
                            </tr>
            </table>


    
                        <style>
                            .pricing-table-container {
                                margin-top: 25px;
                            }
                        
                            .pricing-table-container p {
                                font-size: 20px;
                                margin-bottom: 0px;
                                padding-top: 3px;
                            }
                        
                            .pricing-table-container small {
                                font-size: 13px;
                            }
                        
                            .pricing-table-container .price_border {
                                border-right: 1px dotted black;
                                height: 7em;
                            }
                        
                            .pricing-table-container .price {
                                color: green;
                                font-size: 45px;
                                text-align: center;
                            }
                        
                            .pricing-table-container .qrdiv {
                                border-left: 1px dotted black;
                                height: 7em;
                            }
                        
                            .pricing-table-container .paragraph_options {
                                font-size: 12px;
                                margin-bottom: 7px;
                            }
                        
                            .pricing-table-container .pricing-table-container ul li {
                                font-size: 15px;
                                border-bottom: 1px solid black;
                            }
                        
                        @media screen and (max-width: 768px) {
                            .pricing-table-container .price_border {
                                border: none;
                            }
                        
                            .pricing-table-container .qrdiv {
                                border: none;
                                margin-left: 75px;
                            }
                        
                            .pricing-table-container ul {
                                -webkit-padding-start: 0;
                            }
                        
                            .pricing-table-container ul li {
                                list-style-type: none;
                            }

                        }

                        </style>
    
   
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('after_scripts')
    <script>
        $(document).ready(function() {
    
            $("a.package").on('click',function () {

               $("input[name='package_id']").val($(this).data('package_id'));
               $("#package_form").submit();
            })
        })
    </script>
    @endsection
