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
    Hi {{$data['firstname']}},<br>
   
</span>
  

    <table id="email" border="0" width="100%" cellspacing="0" cellpadding="0">
        <tbody  style="font-size:14px">
        <tr>
            
           <h2> A new job has been posted that matches the criteria for the Alert {{$data['alertname']}}<br>
Click the button below to view the job.</h2> 
        <div>
            <a  href="{{url('https://searchjobs.global/post/')}}{{$data['company_postid']}}" style="padding:5px 8px;text-align:center;text-decoration:none;background-color:#3160ad;border-radius:15px; color:white; margin:25px auto;display:block;max-width:150px"> Click</a>
        </div>
        </tr>

      
    <tr>
        <br><br><br>
        <h9 style="margin:10px 0px; font-size:14px; color: #555;">Click this url to see the job post <u>{{url('https://searchjobs.global/post/')}}{{$data['company_postid']}}</u></h9>
        </tr>
        </tbody>
    </table>
    
    
<p style="margin:10px 0px; font-size:14px">
    Regards,<br>
    Search Jobs Team
    </p>


