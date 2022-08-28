<?php

namespace App\Models;

use App\Helpers\Number;
use App\Models\Scopes\ActiveScope;
use App\Models\Scopes\LocalizedScope;
use App\Models\Traits\CountryTrait;
use App\Observer\CityObserver;
use Larapen\Admin\app\Models\Crud;

class Meetings extends BaseModel {
use Crud;
    protected $fillable = [
        'my_id',
        'title',
        'candidate_id',
        'm_date',
        'm_from',
        'm_to',
        'm_location',
        'post_id',
        'message',
        'id',
    ];

    public function candidate() {
        return $this->belongsTo(User::class, 'candidate_id');
    }

    public function employer() {
        return $this->belongsTo(User::class, 'my_id');
    }
    public function post() {
        return $this->belongsTo(Post::class, 'post_id');
    }
    public function report() {
        return $this->hasOne(ReportNoShow::class, 'meeting_id');
    }
    public function company() {
        return $this->belongsTo(Company::class, 'my_id', 'user_id');
    }
    
    
    
    public function scheduleDate() {
      $text = "Meeting Title : ".$this->title."<br>";
      $text.= "Date and Time : ".date('d-m-Y H:i',strtotime($this->m_date.' '.$this->m_from))." - ".date('H:i',strtotime($this->m_date.' '.$this->m_to))."<br>";
      $text.="Location :".$this->m_location;
return $text;
    }
    
    
       public function title_function() {
      $text = "<a href='https://searchjobs.global/post/".$this->post_id."' target='_blank'> View post ";
      $text.="</a>";
     return $text;
    }
    
    // candidate_id
    
    
  
          public function viewcandidate() {
      $text = "<a href='https://searchjobs.global/search-talent/seeker/".$this->candidate_id."' target='_blank'> View Candidte ";
      $text.="</a>";
     return $text;
    }
    
    
    
    public function createdAt() {
        return date('d-m-Y H:i',strtotime($this->created_at));
    }
}
