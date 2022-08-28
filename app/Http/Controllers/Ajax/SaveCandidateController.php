<?php
	
	
	namespace App\Http\Controllers\Ajax;
	
	
	use App\Http\Controllers\FrontController;
	use App\Models\SaveCandidate;
	use Illuminate\Http\Request;
	
	class SaveCandidateController extends FrontController
	{
	    /**
	     * PostController constructor.
	     */
	    public function __construct()
	    {
	        parent::__construct();
	    }
	    
	    /**
	     * @param Request $request
	     * @return \Illuminate\Http\JsonResponse
	     */
	    public function saveCandidate(Request $request)
	    {
	        $candidate_id = $request->input('candidateId');

	        $status = 0;
	        if (auth()->check()) {
	            $savedCandidate = SaveCandidate::where('user_id', auth()->user()->id)->where('candidate_id', $candidate_id);
	            if ($savedCandidate->count() > 0) {
	                // Delete SavedPost
	                $savedCandidate->delete();
	            } else {
	                // Store SavedPost
	                $savedCandidateInfo = [
	                    'user_id' => auth()->user()->id,
	                    'candidate_id' => $candidate_id,
	                ];
	                $savedCandidate = new SaveCandidate($savedCandidateInfo);
	                $savedCandidate->save();
	                $status = 1;
	            }
	        }
	       if(auth()->check()): 
	        $result = [
	            'logged'   => (auth()->check()) ? auth()->user()->id : 0,
	            'candidate_id'   => $candidate_id,
	             'status'   => $status,
	             'message'=>'candidate save successfully',
	             'loginUrl' => url(config('lang.abbr') . '/' . trans('routes.login')),
	        ];
	        else:
	            $result = [
	            'logged'   => (auth()->check()) ? auth()->user()->id : 0,
	            'candidate_id'   => $candidate_id,
	             'status'   => $status,
	             'message'=>'Sorry candidate could not save, You must Loggedin ',
	             'loginUrl' => url(config('lang.abbr') . '/' . trans('routes.login')),
	        ];
	        endif;
	        
	        return response()->json($result, 200, [], JSON_UNESCAPED_UNICODE);
	    }

        public function deleteCandidate(Request $request)
        {


            if (auth()->check()) {
                $savedCandidate = SaveCandidate::where('user_id', auth()->user()->id)->where('candidate_id', $request->candidateId)->first();

                $savedCandidate->delete();
                $result = ["message"=>"Candidate removed sucesssfully from your wish list"];
                return response()->json($result, 200, [], JSON_UNESCAPED_UNICODE);
            }

        }

		
	}
