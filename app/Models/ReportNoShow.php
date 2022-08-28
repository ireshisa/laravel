<?php


namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Larapen\Admin\app\Models\Crud;

class ReportNoShow extends BaseModel
{
    use Crud;
 protected $table = "report_no_show";
 protected $fillable = ['meeting_id','comments'];

 public function meeting()
 {
     return $this->belongsTo(Meetings::class,'meeting_id');
 }

 public function getJobTitle()
 {
     $text = "";
    if (isset($this->meeting))
     {
         $meeting =  $this->meeting->load('post');

         if (!empty($meeting->post))
         {
             $text = $meeting->post->title;
         }

     }
     return $text;
 }

    public function getMeetingDate()
    {
        $text = "";
        if (isset($this->meeting))
        {
            $date =  date('j F Y',strtotime($this->meeting->m_date)).' '.$this->meeting->m_from.' - '.$this->meeting->m_to;

          $text = $date;

        }
        return $text;
    }


    public function getCompany()
    {
        $text = "";
        if (isset($this->meeting))
        {
             $company =  $this->meeting->load('post','post.user');
if (!empty($company->post))
{
    $text = $company->post->company_name;

}

        }
        return $text;
    }

    public function getCandidate()
    {
        $text = "";
        if (isset($this->meeting))
        {
            $company =  $this->meeting->load('candidate');

                $text = $company->candidate->name;



        }
        return $text;
    }

    public function getActions() {
    $btns ="";
    if ($this->status_id == 0)
    {
        $btns.= "<a class='btn btn-sm btn-success mr-2 approve' data-id='".$this->id."'><i class='fa fa-check'></i> Approve </a>";
        $btns.= "<a class='btn btn-sm btn-danger mr-2 reject' data-id='".$this->id."'><i class='fa fa-close'></i> Reject </a>";
    }

        $btns.= "<a class='btn btn-sm btn-danger mr-2' data-button-type='delete' href='".url('admin/report/'.$this->id)."'><i class='fa fa-close'></i> Delete </a>";
     return $btns;
         }

         public function  getStatus() {

     $statuses = [["text"=>"Requested","class"=>"border-primary"],
         ["text"=>"Approved","class"=>"border-success"],
         ["text"=>"Denied","class"=>"border-danger"]];

                return "<div class='py-1 my-1 px-2 border ".$statuses[$this->status_id]['class']."'>".$statuses[$this->status_id]['text']."</span>";


         }


}