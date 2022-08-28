
<hr>



       <div class="text-center">
          <h4  class="title-4">Referees</h4>
          </div>


          <div class="moreReferees">
@if(!empty($data['referees']))
    @php
        $education=$data['referees'];
        $count= count($data['referees']['name']);
    @endphp
    @for($e=0;$e<$count;$e++)
        @if($e==0)
            <div class="form-group row ">
                {{--                               <label for="inputEducation" class="col-sm-2 col-form-label"> </label>--}}
                <div class="col-sm-11 float-right">

                    <input type="text" name="referees[name][]" class="form-control" placeholder="Enter Name" value="{{$education['name'][$e] ?? ""}}">
                    <input type="text" name="referees[position][]" class="form-control" placeholder="Enter Position" value="{{$education['position'][$e] ?? ""}}">
                    <input type="text" name="referees[company][]" class="form-control" placeholder="Enter Company" value="{{$education['company'][$e] ?? ""}}">
                    <input type="text" name="referees[email][]" class="form-control" placeholder="Enter Email" value="{{$education['email'][$e] ?? ""}}">
                    <input type="text" name="referees[phone][]" class="form-control" placeholder="Enter Phone" value="{{$education['phone'][$e] ?? ""}}">

                </div>
                <div class="text-right"><span class="btn btn-success btn-sm addReferee">+</span></div>
            </div>
        @else
            <div class="form-group row ">
                {{--                                <label for="inputEducation" class="col-sm-2 col-form-label"> </label>--}}

                <div class="col-sm-11 float-right">

                    <input type="text" name="referees[name][]" class="form-control" placeholder="Enter Name" value="{{$education['name'][$e] ?? ""}}">
                    <input type="text" name="referees[position][]" class="form-control" placeholder="Enter Position" value="{{$education['position'][$e] ?? ""}}">
                    <input type="text" name="referees[company][]" class="form-control" placeholder="Enter Company" value="{{$education['company'][$e] ?? ""}}">
                    <input type="text" name="referees[email][]" class="form-control" placeholder="Enter Email" value="{{$education['email'][$e] ?? ""}}">
                    <input type="text" name="referees[phone][]" class="form-control" placeholder="Enter Phone" value="{{$education['phone'][$e] ?? ""}}">

                </div>
                <a href="#" class="remove_referee_field"><span class="btn btn-danger btn-sm">-</span></a>
            </div>
        @endif
    @endfor
@else
    <div class="form-group row ">
        {{--                        <label for="inputEducations" class="col-sm-2 col-form-label"> </label>--}}

        <div class="col-sm-11 float-right">

            <input type="text" name="referees[name][]" class="form-control" placeholder="Enter Name">
            <input type="text" name="referees[position][]" class="form-control" placeholder="Enter Position">
            <input type="text" name="referees[company][]" class="form-control" placeholder="Enter Company">
            <input type="text" name="referees[email][]" class="form-control" placeholder="Enter Email">
            <input type="text" name="referees[phone][]" class="form-control" placeholder="Enter Phone">

        </div>
        <div class="text-right"><span class="btn btn-success btn-sm addReferee">+</span></div>
    </div>
    @endif
    </div>
    <hr>
@push('scripts')

    <script>
        $(document).ready(function() {
            var max_fields      = 2; //maximum input boxes allowed
            var wrapper   		= $(".moreReferees"); //Fields wrapper
            var add_button      = $(".addReferee"); //Add button ID

            var x = 1; //initlal text box count
            $(add_button).click(function(e){ //on add input button click
                e.preventDefault();
          
                if(x < max_fields){ //max input box allowed
                    x++; //text box increment
                    $(wrapper).append(`<div>
                            <div class="form-group row ">
<!--                              <label for="inputExperience" class="col-sm-2 col-form-label"> </label>-->
                                  <div class="col-sm-11 float-right">
                                      <input type="text" name="referees[name][]" class="form-control" placeholder="Enter Name">
            <input type="text" name="referees[position][]" class="form-control" placeholder="Enter Position">
            <input type="text" name="referees[company][]" class="form-control" placeholder="Enter Company">
            <input type="text" name="referees[email][]" class="form-control" placeholder="Enter Email">
            <input type="text" name="referees[phone][]" class="form-control" placeholder="Enter Phone">

                                  </div>
                          <a href="#" class="remove_referee_field"><span class="btn btn-danger btn-sm">-</span></a>
                      </div>
                    </div>
           			`); //add input box
                }
            });

            $(wrapper).on("click",".remove_referee_field", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent('div').remove(); x--;
            })
        });
    </script>
    @endpush