<style>
body {
    background-color:#fff !important;
    font-family:Avenir,Helvetica,sans-serif;
}

#email {
    background-color:#fff !important;
    font-family:Avenir,Helvetica,sans-serif;
    font-size:14px;
}

#email tr td {
    padding-top:15px !important;
}
            a.emp-img {
                width:200px;
                height:auto;
                cursor:pointer;
                margin:auto;
                display:block;
            }
            
            table tr 
</style>
<span style="font-size:14px;font-family:Avenir,Helvetica,sans-serif">
    Hi {{$data->firstname}},<br>
    We are excited to see you signing up at Search Jobs Global.
</span>
  
    @if ($data->user_type_id == 2)
    <table id="email" border="0" width="100%" cellspacing="0" cellpadding="0">
        <tbody  style="font-size:14px">
        <tr>
            <td>
                @if ($data->user_type_id == 2)
<div>
        <a href="{{url('http://searchjobs.global/faq-candidate')}}"> {{ HTML::image('/images/candid.jpg',"Search Jobs") }}</a>
        </div>
       
        @endif
            </td>
        </tr>
        
        
               <tr>
                <td style='align-center'>
                     <a class="emp-img" href="https://youtu.be/qcUZIVeHKK0">{{ HTML::image('/images/employer.png',"Search Jobs") }}</a>
          <div>
            <a  href="{{url('http://searchjobs.global/faq-candidate')}}" style="padding:5px 8px;text-align:center;text-decoration:none;background-color:#3160ad;border-radius:15px; color:white; margin:25px auto;display:block;max-width:150px"> Get Started</a>
        </div>
                </td>
            </tr>
        <tr>
            <td style="padding:5px">
                <b>1. Creating a professional CV through the platform</b>
            </td>
        </tr>
        <tr>
            <td>
                You just have to create and account and fill all the information and the CV will be created for you. You can simply download and get it printed.
            </td>
        </tr>
        <tr>
            <td style="padding:5px;padding-top:10px">
                <b>2. Application tracking in one place</b>
        </tr>
        <tr>
            </td>
            <td>
                Know what happens after you connect or get connected for job posts.
            </td>
        </tr>
        <tr>
            <td style="padding:5px;padding-top:10px">
                <b>3. Follow companies and get notified </b>
            </td>
        </tr>
        <tr>
            <td>
                Follow the companies you wish to work for and get notified when a job is posted by the company.
            </td>
        </tr>
        <tr>
            <td style="padding:5px;padding-top:10px">
                <b>4. Create alerts</b>
            </td>
        </tr>
        <tr>
            <td>
                Use the filters and create alerts when you want to be notified. When a job matching your requirements is posted. You will automatically be notified via email.
            </td>
        </tr>
        <tr>
            <td style="padding:5px;padding-top:10px">
                <b>And More.</b>
            </td>
        </tr>
        <tr>
            <td>
                We will be building more exciting features and make getting hired easy.
            </td>
        </tr>
        </tbody>
    </table>
    @else
        <table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tbody>
            <tr>
                <td style='align-center'>
                     <a class="emp-img" href="https://youtu.be/PcT7c8uqzBEht">{{ HTML::image('/images/employer.png',"Search Jobs") }}</a>
            <div style="margin-top:10px;margin-bottom:10px">
                <a  href="{{url('http://searchjobs.global/faq-employer')}}" style="padding:5px 8px;text-align:center;text-decoration:none;background-color:#3160ad;border-radius:15px; color:white; margin:25px auto;display:block;max-width:150px"> Get Started</a>
            </div>
                </td>
            </tr>
            <tr>
                <td style="padding:5px;padding-top:10px">
                    <b>1. Post Jobs for Free</b>
                </td>
            </tr>
            <tr>
                <td>
                    Post jobs and explore candidates free of charge. Pay only when candidates attend interviews.
                </td>
            </tr>
            <tr>
                <td style="padding:5px;padding-top:10px">
                    <b>2. Guaranteed interviews</b>
                </td>
            </tr>
            <tr>
                <td>
                    Say no more for time wasters. Moreover, we will only charge you if the candidate has attended the interview only.
                </td>
            </tr>
            <tr>
                <td style="padding:5px;padding-top:10px">
                    <b>3. One click interviews </b>
                </td>
            </tr>
            <tr>
                <td>
                    You only have to enter the date, time and the location and an email will be sent to the candidate notifying regarding the interview.
                </td>
            </tr>
            <tr>
                <td style="padding:5px;padding-top:10px">
                    <b>4. Let us make calls on behalf of you</b>
                </td>
            </tr>
            <tr>
                <td>
                    We can also assist you in taking calls to candidates informing about the scheduled interview at a small fee while you focus on growing your business.
                </td>
            </tr>
            <tr>
                <td style="padding:5px;padding-top:10px">
                    <b>And More.</b>
                </td>
            </tr>
            <tr>
                <td>
                    We will be building more exciting features and make hiring easy, affordable and hassle free. We are happy to see you joining us in our journey.
                </td>
            </tr>
            </tbody>
        </table>

        @endif
<p style="margin:10px 0px; font-size:14px">
    Regards,<br>
    Search Jobs Team
    </p>


