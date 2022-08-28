<div class="text-center">
    <h4 class="title-4">Educations</h4>
</div>


<div class="moreEducations">
    @if(!empty($data['extra_educations']))
    @php
    $education=$data['extra_educations'];
    $count= count($data['extra_educations']['title']);
    @endphp
    @for($e=0;$e<$count;$e++) @if($e==0)
    <div class="form-group row flex-row-reverse">
        {{-- <label for="inputEducation" class="col-sm-2 col-form-label"> </label>--}}
        {{-- <div class="col-md-12 d-flex ">--}}
        <div class="flex-shrink-1">
            <div class="d-block position-relative">
               
                <label class="d-block"><input type="checkbox" class="d-inline mx-2 my-2 extra_educations" name="extra_educations[current][]" {{(!empty($education) && array_key_exists('current',$education) && $education['current'][0] == ($e+1))?'checked':''}} value="{{$e+1}}" /> Set As Current </label>
               <a href="#" class="addEducation cv-add-but d-block mx-auto btn  btn-success btn-sm"><span>Add Education </span></a>
            </div>
            
            
            
        </div>
        <div class="d-flex  flex-grow-1">
            <div class="col-sm-12 float-right">
                <br>
               
                <input type="text" name="extra_educations[start_date][]" class="form-control" placeholder="Enter Start Date" onfocus="(this.type='date')" value="{{$education['start_date'][$e] ?? ""}}">
                <input type="text" name="extra_educations[end_date][]" class="form-control {{(!empty($education) && array_key_exists('current',$education) && $education['current'][0] == ($e+1))?'d-none':''}}" placeholder="Enter End Date" onfocus="(this.type='date')" value="{{$education['end_date'][$e] ?? ""}}">
                <input type="text" name="extra_educations[title][]" class="form-control" placeholder=" Enter Education Title" value="{{$education['title'][$e] ?? ""}}">
                <input type="text" name="extra_educations[institue][]" class="form-control" placeholder="Enter Institute" value="{{$education['institue'][$e] ?? ""}}">
                <textarea class="form-control" id="inputEducation" name="extra_educations[description][]" placeholder="About Education">{{$education['description'][$e] ?? ""}}</textarea>
                <hr>
                <br>
            </div>
        </div>

        {{-- </div>--}}
</div>
@else
@php
//if ($education['current'][0] == ($e+1))
// {
// dd($education);
//}
@endphp
<div class="form-group row flex-row-reverse">
    {{-- <label for="inputEducation" class="col-sm-2 col-form-label"> </label>--}}
    {{-- <div class="col-md-12 d-flex ">--}}
    <div class="flex-shrink-1">
        <div class="d-block position-relative">
            
            <label><input type="checkbox" class="d-inline mx-2 my-2" name="extra_educations[current][]" {{(!empty($education) && array_key_exists('current',$education) && $education['current'][0] == ($e+1))?'checked':''}} value="{{$e+1}}" /> Set As Current </label>
           <a href="#" class="remove_education_field  btn btn-danger d-block btn-sm"><span class="">Remove Education</span></a>
        </div>
        
          
        
        
        
    </div>
    <div class="d-flex  flex-grow-1">
        <div class="col-sm-12 float-right">

            <input type="text" name="extra_educations[start_date][]" class="form-control"  onfocus="(this.type='date')" placeholder="Enter Start Date" value="{{$education['start_date'][$e] ?? ""}}">
            <input type="text" name="extra_educations[end_date][]" class="form-control"  onfocus="(this.type='date')" placeholder="Enter End Date" value="{{$education['end_date'][$e] ?? ""}}">
            <input type="text" name="extra_educations[title][]" class="form-control" placeholder="Enter Education Title" value="{{$education['title'][$e] ?? ""}}">
            <input type="text" name="extra_educations[institue][]" class="form-control" placeholder="Enter Institute" value="{{$education['institue'][$e] ?? ""}}">
            <textarea class="form-control" id="inputEducation" name="extra_educations[description][]" placeholder="About Education">{{$education['description'][$e] ?? ""}}</textarea>
            <hr>
            <br>
        </div>
    </div>

    {{-- </div>--}}
</div>

<div class="form-group row ">
    {{-- <label for="inputEducation" class="col-sm-2 col-form-label"> </label>--}}

    <div class="text-right"> </div>
</div>
@endif
@endfor
@else
<div class="form-group row flex-row-reverse">
    <div class="flex-shrink-1">
        <div class="d-block position-relative">
         
            <label class="d-block"><input type="checkbox" class="d-inline mx-2 my-2" name="extra_educations[current][]" {{(!empty($education) && array_key_exists('current',$education) && $education['current'][0] == ($e+1))?'checked':''}} value="1" /> Set As Current </label>
                <a href="#" class="addEducation d-block mx-auto btn cv-add-but  btn-success btn-sm"><span>+</span></a>
        </div>
    </div>
    {{-- <label for="inputEducations" class="col-sm-2 col-form-label"> </label>--}}
    <div class="d-flex  flex-grow-1">
        <div class="col-sm-12 float-right">

                <input type="text" name="extra_educations[start_date][]" class="form-control" onfocus="(this.type='date')"  placeholder="Enter Start Date" >
      

    

                <input type="text" name="extra_educations[end_date][]" class="form-control" onfocus="(this.type='date')"  placeholder="Enter End Date" >
          

            <input type="text" name="extra_educations[title][]" class="form-control" placeholder="Enter Education Level">
            <input type="text" name="extra_educations[institue][]" class="form-control" placeholder="Enter Institute">

            <textarea class="form-control" id="inputEducations" name="extra_educations[description][]" placeholder="About Educations"></textarea>
            <hr>
            <br>
        </div>
    </div>

</div>
@endif
</div>

<div class="text-center">
    <h4 class=" title-4">Skills</h4>
</div>


<div class="moreSkills">
    @if(!empty($data['extra_skills']))
    @php
    $extra_skills=$data['extra_skills'];
    $count= count($data['extra_skills']['title']);
    @endphp
    @for($s=0;$s<$count;$s++) @if($s==0) <div class="form-group row flex-mobile-col">
        {{-- <label for="inputSkill" class="col-sm-2 col-form-label"> </label>--}}
        <div class="col-sm-10 float-right">
            {{-- <input type="text"  onfocus="(this.type='date')"  name="extra_skills[start_date][]" class="form-control" placeholder="Enter Start Date" value="{{$extra_skills['start_date'][$s] ?? ""}}">--}}
            {{-- <input type="text"  onfocus="(this.type='date')"  name="extra_skills[end_date][]" class="form-control" placeholder="Enter End Date" value="{{$extra_skills['end_date'][$s] ?? ""}}">--}}
            <input type="text" name="extra_skills[title][]" class="form-control" placeholder="Enter Skill Name" value="{{$extra_skills['title'][$s] ?? ""}}">
            {{-- <textarea class="form-control" id="inputSkill" name="extra_skills[description][]" placeholder="About Skill">{{$extra_skills['description'][$s] ?? ""}}</textarea>--}}
        </div>
        <div class="text-right"><span class="btn btn-success btn-sm addSkill width100">Add Skill </span></div>
</div>
@else
<div class="form-group row flex-mobile-col ">
    {{-- <label for="inputSkill" class="col-sm-2 col-form-label"> </label>--}}
    <div class="col-sm-10 float-right">
        {{-- <input type="date" name="extra_skills[start_date][]" class="form-control" placeholder="Enter Start Date" value="{{$extra_skills['start_date'][$s] ?? ""}}">--}}
        {{-- <input type="date" name="extra_skills[end_date][]" class="form-control" placeholder="Enter End Date" value="{{$extra_skills['end_date'][$s] ?? ""}}">--}}
        <input type="text" name="extra_skills[title][]" class="form-control" placeholder="Enter Skill Name" value="{{$extra_skills['title'][$s] ?? ""}}">
        {{-- <textarea class="form-control" id="inputSkill" name="extra_skills[description][]" placeholder="About Skill">{{$extra_skills['description'][$s] ?? ""}}</textarea>--}}
    </div>
    <a href="#" class="remove_skill_field"><span class="btn btn-danger btn-sm width100">Remove skill</span></a>
</div>
@endif
@endfor
@else
<div class="form-group row flex-mobile-col ">
    {{-- <label for="inputSkills" class="col-sm-2 col-form-label"> </label>--}}
    <div class="col-sm-10 float-right">
        {{-- <input type="date" name="extra_skills[start_date][]" class="form-control" placeholder="Enter Start Date">--}}
        {{-- <input type="date" name="extra_skills[end_date][]" class="form-control" placeholder="Enter End Date">--}}
        <input type="text" name="extra_skills[title][]" class="form-control" placeholder="Enter Skill Name">
        {{-- <textarea class="form-control" id="inputSkills" name="extra_skills[description][]" placeholder="About Skills"></textarea>--}}
    </div>
    <div class="text-right"><span class="btn btn-success btn-sm addSkill width100">Add Skill</span></div>
</div>
@endif
</div>



<div class="text-center">
    <h4 class="title-4">Acheivements</h4>
</div>


<div class="moreAcheivements">
    @if(!empty($data['acheivements']))
    @php
    $acheivement=$data['acheivements'];
    $count= count($data['acheivements']['title']);
    @endphp
    @for($e=0;$e<$count;$e++) @if($e==0) <div class="form-group row flex-mobile-col ">
        {{-- <label for="inputEducation" class="col-sm-2 col-form-label"> </label>--}}
        <div class="col-sm-10 float-right">

            {{-- <input type="date" name="acheivements[start_date][]" class="form-control" placeholder="Enter Start Date" value="{{$acheivement['start_date'][$e] ?? ""}}">--}}
            {{-- <input type="date" name="acheivements[end_date][]" class="form-control" placeholder="Enter End Date" value="{{$acheivement['end_date'][$e] ?? ""}}">--}}
            <input type="text" name="acheivements[title][]" class="form-control" placeholder="Enter Title" value="{{$acheivement['title'][$e] ?? ""}}">
            <textarea class="form-control" id="inputEducation" name="acheivements[description][]" placeholder="About Acheivement">{{$acheivement['description'][$e] ?? ""}}</textarea>
        </div>
        <div class="text-right"><span class="btn btn-success btn-sm addAcheivement width100">Add Acheivement</span></div>
</div>
@else
<div class="form-group row flex-mobile-col ">
    {{-- <label for="inputEducation" class="col-sm-2 col-form-label"> </label>--}}
    <div class="col-sm-10 float-right">
        {{-- <input type="date" name="acheivements[start_date][]" class="form-control" placeholder="Enter Start Date" value="{{$acheivement['start_date'][$e] ?? ""}}">--}}
        {{-- <input type="date" name="acheivements[end_date][]" class="form-control" placeholder="Enter End Date" value="{{$acheivement['end_date'][$e] ?? ""}}">--}}
        <input type="text" name="acheivements[title][]" class="form-control" placeholder="Enter Title" value="{{$acheivement['title'][$e] ?? ""}}">

        <textarea class="form-control" id="inputEducation" name="acheivements[description][]" placeholder="About Acheivement">{{$acheivement['description'][$e] ?? ""}}</textarea>
    </div>
    <a href="#" class="remove_acheivement_field"><span class="btn btn-danger btn-sm  width100">Remove Acheivement</span></a>
</div>
@endif
@endfor
@else
<div class="form-group row flex-mobile-col">
    {{-- <label for="inputEducations" class="col-sm-2 col-form-label"> </label>--}}
    <div class="col-sm-10 float-right">
        {{-- <input type="date" name="acheivements[start_date][]" class="form-control" placeholder="Enter Start Date">--}}
        {{-- <input type="date" name="acheivements[end_date][]" class="form-control" placeholder="Enter End Date">--}}
        <input type="text" name="acheivements[title][]" class="form-control" placeholder="Enter Acheivement">


        <textarea class="form-control" id="inputAcheivements" name="acheivements[description][]" placeholder="About Acheivement"></textarea>
    </div>
    <div class="text-right"><span class="btn btn-success btn-sm addAcheivement  width100">Add Acheivement</span></div>
</div>
@endif
</div>









<div class="text-center">
    <h4 class=" title-4">Experience</h4>
</div>



<div class="moreExperience">
    @if(!empty($data['extra_experiences']))
    {{-- @dd($data['extra_experiences'])--}}
    @php
    $extra_experiences=$data['extra_experiences'];
    $count= count($data['extra_experiences']['title']);
    @endphp
    @for($i=0;$i<$count;$i++) @if($i==0) <div>
        <div class="form-group row  flex-row-reverse">
            <div class="flex-shrink-1">
                <div class="d-block position-relative">
                  
                    <label class="d-block"><input type="checkbox" class="d-inline mx-2 my-2" name="extra_experiences[current][]" {{(!empty($extra_experiences) && array_key_exists('current',$extra_experiences) && $extra_experiences['current'][0] == ($i+1))?'checked':''}} value="{{$i+1}}" /> Set As Current </label>
                      <a href="#" class="addExperience cv-add-but d-block mx-auto btn  btn-success btn-sm"><span>Add Experience</span></a>
                </div>
                
              
            </div>
            <div class="d-flex  flex-grow-1">
                {{-- <label for="inputExperience" class="col-sm-2 col-form-label"> </label>--}}
                <div class="col-sm-12 float-right">

                  
                        <input type="text" name="extra_experiences[start_date][]" onfocus="(this.type='date')" class="form-control " placeholder="Enter Start Date" value="{{$extra_experiences['start_date'][$i] ?? ""}}">

              

                
                        <input type="text" name="extra_experiences[end_date][]" onfocus="(this.type='date')" class="form-control {{(!empty($extra_experiences) && array_key_exists('current',$extra_experiences) && $extra_experiences['current'][0] == ($i+1))?'d-none':''}} value="{{$i+1}}" placeholder="Enter End Date" value="{{$extra_experiences['end_date'][$i] ?? ""}}">

              



                    <input type="text" name="extra_experiences[title][]" class="form-control" placeholder="Enter Job  Title" value="{{$extra_experiences['title'][$i] ?? ""}}">
                    <input type="text" name="extra_experiences[company][]" class="form-control" placeholder="Enter Company Name" value="{{$extra_experiences['company'][$i] ?? ""}}">

                    <textarea class="form-control" id="inputExperience" name="extra_experiences[description][]" placeholder="About Experience">{{$extra_experiences['description'][$i] ?? ""}}</textarea>
                    <hr>
                                      <br>
                </div>

            </div>
        </div>
</div>

@else
<div>
    <div class="form-group row flex-row-reverse">
        <div class="flex-shrink-1">
            <div class="d-block position-relative">
               
                <label class="d-block"><input type="checkbox" class="d-inline mx-2 my-2" {{(!empty($extra_experiences) && array_key_exists('current',$extra_experiences) && $extra_experiences['current'][0] == ($i+1))?'checked':''}} name="extra_experiences[current][]" value="{{$i+1}}" /> Set As Current </label>
                 <a href="#" class="remove_experience_field cv-add-but d-block mx-auto btn  btn-danger btn-sm"><span>Remove Experience</span></a>
            </div>
        </div>
        <div class="d-flex  flex-grow-1">
            {{-- <label for="inputExperience" class="col-sm-2 col-form-label"> </label>--}}
            <div class="col-sm-12 float-right">

              
                    <input type="text"  onfocus="(this.type='date')" name="extra_experiences[start_date][]" class="form-control  name="extra_experiences[current][]" value="{{$i+1}}"" placeholder="Enter Start Date" value="{{$extra_experiences['start_date'][$i] ?? ""}}">

             
                    <input type="text" onfocus="(this.type='date')" name="extra_experiences[end_date][]" class="form-control {{(!empty($extra_experiences) && array_key_exists('current',$extra_experiences) && $extra_experiences['current'][0] == ($i+1))?'d-none':''}}" placeholder="Enter End Date" value="{{$extra_experiences['end_date'][$i] ?? ""}}">

            
                <input type="text" name="extra_experiences[title][]" class="form-control" placeholder="Enter Job  Title" value="{{$extra_experiences['title'][$i] ?? ""}}">
                <input type="text" name="extra_experiences[company][]" class="form-control" placeholder="Enter Company Name" value="{{$extra_experiences['company'][$i] ?? ""}}">

                <textarea class="form-control" id="inputExperience" name="extra_experiences[description][]" placeholder="About Experience">{{$extra_experiences['description'][$i] ?? ""}}</textarea>

                <hr>
                                      <br>
            </div>

        </div>
    </div>
</div>

@endif
@endfor
@else
<div class="form-group row  flex-row-reverse">
    <div class="flex-shrink-1">
        <div class="d-block position-relative">

            <label class="d-block"><input type="checkbox" class="d-inline mx-2 my-2" name="extra_experiences[current][]" value="1" /> Set As Current </label>
             <a href="#" class="addExperience cv-add-but d-block mx-auto btn  btn-success btn-sm"><span>+</span></a>
        </div>
    </div>
    <div class="d-flex  flex-grow-1">
        {{-- <label for="inputExperience" class="col-sm-2 col-form-label"> </label>--}}
        <div class="col-sm-12 float-right">


    
                <input type="text" name="extra_experiences[start_date][]"  onfocus="(this.type='date')" class="form-control" placeholder="Enter Start Date" >

    
                <input type="text" name="extra_experiences[end_date][]"  onfocus="(this.type='date')" class="form-control" placeholder="Enter End Date" >


            <input type="text" name="extra_experiences[title][]" class="form-control" placeholder="Enter Job  Title">
            <input type="text" name="extra_experiences[company][]" class="form-control" placeholder="Enter Company Name">

            <textarea class="form-control" id="inputExperience" name="extra_experiences[description][]" placeholder="About Experience"></textarea>
            <hr>
                                      <br>
        </div>
    </div>
</div>
@endif

</div>

<style>
    @media screen and (max-width: 500px) 
    {
       .flex-row-reverse {
    /*-ms-flex-direction: column !important;*/
    /*flex-direction: column !important;*/
        flex-direction: column-reverse !important;;
}
        
    }
</style>






@push('scripts')


<script>
    'use stick';

    $(document).ready(function() {
        var max_fields = 11; //maximum input boxes allowed
        var wrapper = $(".moreExperience"); //Fields wrapper
        var add_button = $(".addExperience"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function(e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append(`<div>
                            <div class="form-group row flex-row-reverse">
<div class="flex-shrink-1">
                          <div class="d-block position-relative">
                            
                              <label class="d-block"><input type="checkbox" class="d-inline mx-2 my-2" name="extra_experiences[current][]" value="` + x + `"/> Set As Current </label>
                                <a href="#" class="remove_experience_field cv-add-but d-block mx-auto btn  btn-danger btn-sm"><span>Remove Experience</span></a>
                          </div>
                      </div>
                      <div class="d-flex  flex-grow-1">
<!--                              <label for="inputExperience" class="col-sm-2 col-form-label"> </label>-->
                                  <div class="col-sm-12 float-right">
                <input type="text" onfocus="(this.type='date')" name="extra_experiences[start_date][]" class="form-control" placeholder="Enter Start Date" >
                <input type="text" onfocus="(this.type='date')" name="extra_experiences[end_date][]" class="form-control" placeholder="Enter End Date">
                                      <input type="text" name="extra_experiences[title][]" class="form-control" placeholder="Enter Job Title">
                                      <input type="text" name="extra_experiences[company][]" class="form-control" placeholder="Enter Company Name">

                                      <textarea class="form-control" id="inputExperience" name="extra_experiences[description][]" placeholder="About Experience"></textarea>
                                    <hr>
                                      <br>

                                  </div>

                      </div>
                    </div>
           			`); //add input box
                $("input[name='extra_educations[current][]'").each(function(index, item) {
                    $(this).val(index + 1);
                })
            }
            
               
         $('[name="extra_experiences[current][]"]').click(function() {
 if(this.checked==true)
             {
     
     
}else
{
   var x=this.parentElement.parentElement.parentElement.parentElement;
        x.querySelector('[name="extra_experiences[end_date][]"]').classList.remove('d-none');  
}

    });
            
        });

        $(wrapper).on("click", ".remove_experience_field", function(e) { //user click on remove text
            e.preventDefault();
            $(this).closest('.flex-row-reverse').remove();
            x--;
            $("input[name='extra_experiences[current][]'").each(function(index, item) {
                $(this).val(index + 1);
            })
        })
    });

    $(document).ready(function() {
        var max_fields = 11; //maximum input boxes allowed
        var wrapper = $(".moreAcheivements"); //Fields wrapper
        var add_button = $(".addAcheivement"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function(e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append(`<div>
                            <div class="form-group row flex-mobile-col">
<!--                              <label for="inputExperience" class="col-sm-2 col-form-label"> </label>-->
                                  <div class="col-sm-10 float-right">
                                      <!--<input type="date" name="acheivements[start_date][]" class="form-control" placeholder="Enter Start Date">-->
                                        <!--<input type="date" name="acheivements[end_date][]" class="form-control" placeholder="Enter End Date">-->
                                    <input type="text" name="acheivements[title][]" class="form-control" placeholder="Enter Acheivment">
                                    <textarea class="form-control" id="inputAcheivement" name="acheivements[description][]" placeholder="About Acheivment"></textarea>
                                    </div>
                                    <a href="#" class="remove_acheivement_field"><span class="btn btn-danger btn-sm add Acheivement width100">Remove Acheivement</span></a>
                                    </div>
                                    </div>
                                    `); //add input box
            }
        });

        $(wrapper).on("click", ".remove_acheivement_field", function(e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });


    $(document).ready(function() {
        var max_fields = 11; //maximum input boxes allowed
        var wrapper = $(".moreSkills"); //Fields wrapper
        var add_button = $(".addSkill"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function(e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append(`<div>
                                    <div class="form-group row flex-mobile-col ">
                                    <!--                              <label for="inputSkill" class="col-sm-2 col-form-label"> </label>-->
                                    <div class="col-sm-10 float-right">
                                        <!--<input type="date" name="extra_skills[start_date][]" class="form-control" placeholder="Enter Start Date">-->
                                        <!--<input type="date" name="extra_skills[end_date][]" class="form-control" placeholder="Enter End Date">-->
                                    <input type="text" name="extra_skills[title][]" class="form-control" placeholder="Enter Skill Name">
                                    <!--<textarea class="form-control" id="inputSkill" name="extra_skills[description][]" placeholder="About Skill"></textarea>-->
                                    </div>
                                    <a href="#" class="remove_skill_field"><span class="btn btn-danger btn-sm width100">Remove skill</span></a>
                                    </div>
                                    </div>
                                    `); //add input box
            }
        });

        $(wrapper).on("click", ".remove_skill_field", function(e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
    $(document).ready(function() {
        var max_fields = 11; //maximum input boxes allowed
        var wrapper = $(".moreEducations"); //Fields wrapper
        var add_button = $(".addEducation"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function(e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append(`<div>
                                    <div class="form-group row flex-row-reverse">
                                    <!--                              <label for="inputEducation" class="col-sm-2 col-form-label"> </label>-->
                                    <div class="flex-shrink-1">
                                    <div class="d-block position-relative">
                                  
                                    <label class="d-block"><input type="checkbox" class="d-inline mx-2 my-2" name="extra_educations[current][]" value="` + x + `"/> Set As Current </label>
                                      <a href="#" class="remove_education_field d-block mx-auto btn  btn-danger btn-sm"><span>Remove Education</span></a>

                                    </div>
                                    </div>
                                    <div class="d-flex  flex-grow-1">
                                    <div class="col-sm-12 float-right">
  
                <input type="text"  onfocus="(this.type='date')" name="extra_educations[start_date][]" class="form-control" placeholder="Enter Start Date" >
                <input type="text"  onfocus="(this.type='date')" name="extra_educations[end_date][]" class="form-control" placeholder="Enter End Date" >
          
                                    <input type="text" name="extra_educations[title][]" class="form-control" placeholder="Enter Education  Title">
                                    <input type="text" name="extra_educations[institue][]" class="form-control" placeholder="Enter Institute">
                                    <textarea class="form-control" id="inputEducation" name="extra_educations[description][]" placeholder="About Education"></textarea>
                                    <hr>
            <br>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    `); //add input box
                $("input[name='extra_educations[current][]'").each(function(index, item) {
                    $(this).val(index + 1);
                })
            }
            
            
            
$('[name="extra_educations[current][]"]').click(function() {
  if(this.checked==true)
             {
var x=this.parentElement.parentElement.parentElement.parentElement;
x.querySelector('[name="extra_educations[end_date][]"]').classList.add('d-none');
}
else
{
    var x=this.parentElement.parentElement.parentElement.parentElement;
x.querySelector('[name="extra_educations[end_date][]"]').classList.remove('d-none');
    
}


});
            
            
            
            
            
            
            
        });

        $(wrapper).on("click", ".remove_education_field", function(e) { //user click on remove text
            e.preventDefault();
            $(this).closest('.flex-row-reverse').remove();
            x--;
            $("input[name='extra_educations[current][]'").each(function(index, item) {
                $(this).val(index + 1);
            })
        });


    });
    
      $('[name="extra_educations[current][]"]').click(function() {
          
           if(this.checked==true)
             {
       
      var x=this.parentElement.parentElement.parentElement.parentElement;
        x.querySelector('[name="extra_educations[end_date][]"]').classList.add('d-none');
             }else
             {
                 
                       var x=this.parentElement.parentElement.parentElement.parentElement;
        x.querySelector('[name="extra_educations[end_date][]"]').classList.remove('d-none');
             }


    });
    
    
    
         $('[name="extra_experiences[current][]"]').click(function() {
             
             
             if(this.checked==true)
             {
                     var x=this.parentElement.parentElement.parentElement.parentElement;
        x.querySelector('[name="extra_experiences[end_date][]"]').classList.add('d-none');
     
             }else
             {
                 
                                 var x=this.parentElement.parentElement.parentElement.parentElement;
        x.querySelector('[name="extra_experiences[end_date][]"]').classList.remove('d-none');
             }

 


    });
    
</script>
@endpush