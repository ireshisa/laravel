<?php
/**
//
 */

namespace App\Http\Controllers\Account;

use App\Helpers\UrlGen;
use App\Http\Controllers\Traits\BuyPackage;
use App\Http\Requests\ReplyMessageRequest;
use App\Models\Notification;
use App\Models\User;
use App\Models\Message;
use App\Notifications\ConnectStatus;
use App\Notifications\ReplySent;
use Illuminate\Support\Facades\Auth;
use Torann\LaravelMetaTags\Facades\MetaTag;

class ConversationsController extends AccountBaseController
{
    use BuyPackage;
	private $perPage = 10;
	
	public function __construct()
	{
		parent::__construct();
		
		$this->perPage = (is_numeric(config('settings.listing.items_per_page'))) ? config('settings.listing.items_per_page') : $this->perPage;
	}
	
	/**
	 * Conversations List
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
		$data = [];
		
		// Set the Page Path
	        view()->share('pagePath', 'conversations');

        // Get the Conversations
		$data['conversations'] = $this->conversations->whereIn('is_read', ['0' ,'1'])->paginate($this->perPage);
		
		// Meta Tags
		MetaTag::set('title', t('Conversations Received'));
		MetaTag::set('description', t('Conversations Received on :app_name', ['app_name' => config('settings.app.app_name')]));
		
		return view('account.conversations', $data);
	}
	
	/**
	 * Conversation Messages List
	 *
	 * @param $conversationId
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function messages($conversationId)
	{
		$data = [];
		
		// Set the Page Path
		view()->share('pagePath', 'conversations');
		
		// Get the Conversation
		$conversation = Message::where('id', $conversationId)
			->byUserId(auth()->user()->id)
			->firstOrFail();
		view()->share('conversation', $conversation);
		
		// Get the Conversation's Messages
		$data['messages'] = Message::where('parent_id', $conversation->id)
			->byUserId(auth()->user()->id)
			->orderByDesc('id');
		$data['countMessages'] = $data['messages']->count();
		$data['messages'] = $data['messages']->paginate($this->perPage);
		
		// Mark the Conversation as Read
		if ($conversation->is_read != 1) {
			if ($data['countMessages'] > 0) {
				// Check if the latest Message is from the current logged user
				if ($data['messages']->has(0)) {
					$latestMessage = $data['messages']->get(0);
					if ($latestMessage->from_user_id != auth()->user()->id) {
						$conversation->is_read = 1;
						$conversation->save();
					}
				}
			} else {
				if ($conversation->from_user_id != auth()->user()->id) {
					$conversation->is_read = 1;
					$conversation->save();
				}
			}
		}
		
		// Meta Tags
		MetaTag::set('title', t('Messages Received'));
		MetaTag::set('description', t('Messages Received on :app_name', ['app_name' => config('settings.app.app_name')]));
		
		return view('account.messages', $data);
	}
	
	/**
	 * @param $conversationId
	 * @param ReplyMessageRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function reply($conversationId, ReplyMessageRequest $request)
	{
		// Get Conversation
		$conversation = Message::findOrFail($conversationId);
	
		// Get Recipient Data
		if ($conversation->from_user_id != auth()->user()->id) {
			$toUserId = $conversation->from_user_id;
			$toName = $conversation->from_name;
			$toEmail = $conversation->from_email;
			$toPhone = $conversation->from_phone;
		} else {
			$toUserId = $conversation->to_user_id;
			$toName = $conversation->to_name;
			$toEmail = $conversation->to_email;
			$toPhone = $conversation->to_phone;
		}
		
		// Don't reply to deleted (or non exiting) users
		if (config('settings.single.guests_can_post_ads') != 1 && config('settings.single.guests_can_contact_ads_authors') != 1) {
			if (User::where('id', $toUserId)->count() <= 0) {
				flash(t("This user no longer exists.") . ' ' . t("Maybe the user's account has been disabled or deleted."))->error();
				return back();
			}
		}
		
		// New Message
		$message = new Message();
		$input = $request->only($message->getFillable());
		foreach ($input as $key => $value) {
			$message->{$key} = $value;
		}

		$message->post_id = $conversation->post->id ?? 0;
		$message->parent_id = $conversation->id;
		$message->from_user_id = auth()->user()->id;
		$message->from_name = auth()->user()->name;
		$message->from_email = auth()->user()->email;
		$message->from_phone = auth()->user()->phone;
		$message->to_user_id = $toUserId;
		$message->to_name = $toName;
		$message->to_email = $toEmail;
		$message->to_phone = $toPhone;
		$message->subject = 'RE: ' . $conversation->subject;
		
		$message->message = $request->input('message')
			. '<br><br>'
			. t('Related to the ad')
			. ': <a href="' . UrlGen::post($conversation->post) . '">' . t('Click here to see') . '</a>';
		
		// Save
		$message->save();
			
		// Save and Send user's resume
		if ($request->hasFile('filename')) {
			$message->filename = $request->file('filename');
			$message->save();
		}
		
		// Mark the Conversation as Unread
		if ($conversation->is_read != 0) {
			$conversation->is_read = 0;
			$conversation->save();
		}
		
		// Send Reply Email
		try {
			$message->notify(new ReplySent($message));
			flash(t("Your reply has been sent. Thank you!"))->success();
		} catch (\Exception $e) {
			flash($e->getMessage())->error();
		}
		
		return back();
	}
	
	/**
	 * Delete Conversation
	 *
	 * @param null $conversationId
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function destroy($conversationId = null)
	{
		// Get Entries ID
		$ids = [];
		if (request()->filled('entries')) {
			$ids = request()->input('entries');
		} else {
			if (!is_numeric($conversationId) && $conversationId <= 0) {
				$ids = [];
			} else {
				$ids[] = $conversationId;
			}
		}
		
		// Delete
		$nb = 0;
		foreach ($ids as $item) {
			// Get the conversation
			$message = Message::with(['fromUser.myCompanies','toUser.myCompanies','post'])->where('id', $item)
				->byUserId(auth()->user()->id)
				->first();
				//dd($message);
			$from_user = $message->fromUser->firstname;
            $byWhom = auth()->user()->firstname;
            if (auth()->user()->user_type_id == 1)
            {
                
                $bUser = User::with('myCompanies')->findOrFail(auth()->user()->id);
                $byWhom = $bUser->myCompanies[0]->name;
            }
             $notify_user = User::findOrFail($message->fromUser->id);
            if ($message->from_user_id != auth()->user()->id)
            {
                 $notify_user = User::with('myCompanies')->findOrFail($message->fromUser->id);
            }
            
          $type = \auth()->user()->user_type_id;
$to_user = "Candidate Name : ".$message->toUser->firstname;
			if ($message->fromUser->user_type_id == 1)
            {
            
                $from_user= $message->fromUser->myCompanies[0]->name;
                // $to_user = User::findOrFail(auth()->user()->id);
                $to_user = "Candidate Name : ".$message->toUser->firstname;
              //  $byWhom = $who->myCompanies[0]->name;
                
            }
            if ($message->toUser->user_type_id == 1)
            {
                //dd($message->toUser);
               // $who= $message->toUser;
                $from_user= $message->fromUser->firstname;
                // $who = User::with('myCompanies')->findOrFail($message->toUser->id);
              //  $byWhom = $who->myCompanies[0]->name;
              
                $to_user = "Employer Name : ".$message->toUser->myCompanies[0]->name;
            }
            
            
 
            
			if (!empty($message)) {
				if (empty($message->deleted_by)) {
					// Delete the Entry for current user
					$message->deleted_by = auth()->user()->id;
					$message->save();
					$nb = 1;
				} else {
					// If the 2nd user delete the Entry,
					// Delete the Entry (definitely)
					if ($message->deleted_by != auth()->user()->id) {
						$nb = $message->delete();
					}
				}


			}
			//dd($toWhom);
			if (auth()->user()->id != $message->from_id)
			{
			   
            $notification= "Your Connect Request has been declined by ".$byWhom;
            $conn = Notification::create(["notification"=>$notification,"to_user_id"=>$message->from_user_id,"type"=>"danger","created_by"=>\auth()->user()->id,"url"=>url('/account/pending')]);

            $mail = new \stdClass();
            $mail->name =  $notify_user->firstname;
            if ($notify_user->user_type_id == 1)
            {
               $notify_user->myCompanies[0]->name;
            }
            $mail->title = $message->post->title;
            $mail->by = $byWhom;
            $mail->status = 3;
            $mail->type = $type;
            $mail->name2 = $to_user;
            $notify_user->notify(new ConnectStatus($mail));
			}
            //dd($mail);
		}
		
		// Confirmation
		if ($nb == 0) {
			flash(t("No deletion is done. Please try again."))->error();
		} else {
			$count = count($ids);
			if ($count > 1) {
				flash(t("x :entities has been deleted successfully.", ['entities' => t('messages'), 'count' => $count]))->success();
			} else {
				flash(t("1 :entity has been deleted successfully.", ['entity' => t('message')]))->success();
			}
		}
		
		return back();
	}
	
	public function destroyPendingApproval($conversationId = null)
    {
        // Get Entries ID
        $ids = [];
        if (request()->filled('entries')) {
            $ids = request()->input('entries');
        } else {
            if (!is_numeric($conversationId) && $conversationId <= 0) {
                $ids = [];
            } else {
                $ids[] = $conversationId;
            }
        }

        // Delete
        $nb = 0;
        foreach ($ids as $item) {
            // Get the conversation
            $message = Message::where('id', $item)
                ->byUserId(auth()->user()->id)
                ->first();

            if (!empty($message)) {
                if (!empty($message->deleted_by)) {
                    // Delete the Entry for current user
                    $message->delete_request = '1';
                    $message->save();
                    $nb = 1;
                } else {
                    // If the 2nd user delete the Entry,
                    // Delete the Entry (definitely)
                    if ($message->deleted_by != auth()->user()->id) {
                        $nb = $message->delete();
                    }
                }
            }
        }

        // Confirmation
        if ($nb == 0) {
            flash(t("No deletion is done. Please try again."))->error();
        } else {
            $count = count($ids);
            if ($count > 1) {
                flash(t("x :entities has been deleted successfully.", ['entities' => t('messages'), 'count' => $count]))->success();
            } else {
                flash(t("1 :entity has been deleted successfully.", ['entity' => t('message')]))->success();
            }
        }

        return back();
    }
	
	/**
	 * Delete Message
	 *
	 * @param $conversationId
	 * @param null $messageId
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function destroyMessages($conversationId, $messageId = null)
	{
		// Get Entries ID
		$ids = [];
		if (request()->filled('entries')) {
			$ids = request()->input('entries');
		} else {
			if (!is_numeric($messageId) && $messageId <= 0) {
				$ids = [];
			} else {
				$ids[] = $messageId;
			}
		}
		
		// Delete
		$nb = 0;
		foreach ($ids as $item) {
			// Don't delete the main conversation
			if ($item == $conversationId) {
				continue;
			}
			
			// Get the message
			$message = Message::where('parent_id', $conversationId)->where('id', $item)
				->byUserId(auth()->user()->id)
				->first();
			
			if (!empty($message)) {
				if (empty($message->deleted_by)) {
					// Delete the Entry for current user
					$message->deleted_by = auth()->user()->id;
					$message->save();
					$nb = 1;
				} else {
					// If the 2nd user delete the Entry,
					// Delete the Entry (definitely)
					if ($message->deleted_by != auth()->user()->id) {
						$nb = $message->delete();
					}
				}
			}
		}
		
		// Confirmation
		if ($nb == 0) {
			flash(t("No deletion is done. Please try again."))->error();
		} else {
			$count = count($ids);
			if ($count > 1) {
				flash(t("x :entities has been deleted successfully.", ['entities' => t('messages'), 'count' => $count]))->success();
			} else {
				flash(t("1 :entity has been deleted successfully.", ['entity' => t('message')]))->success();
			}
		}
		
		return back();
	}
	
	public function approve($conversationId)
	{
		$data = [];
		
		// Get the Conversation
		$conversation = Message::with(['post','fromUser.myCompanies','toUser.myCompanies'])->where('id', $conversationId)
			->byUserId(auth()->user()->id)
			->firstOrFail();

	//	dd($conversation);
       // $name = \auth()->user()->name;
      $from_user = $conversation->fromUser->name;
      $notify_user = User::findOrFail($conversation->from_user_id);
      $toWhom = $conversation->toUser->name;
      $type = 2;

        if (\auth()->user()->user_type_id == 1)
        {
            $packageInfo =  $this->checkPackageExpiry();
            $toWhom = $conversation->toUser->myCompanies[0]->name;
//       $company_user=User::with('myCompanies')->findOrFail(\auth()->user()->id);

//       $name = $company_user->myCompanies[0]->name;





       if ($packageInfo['expiry'])
       {
           $this->deductConnect();
           $conversation->is_approved = 1;

           $conversation->save();
           flash("Succesfully Approved")->success();
       }
       else {
           flash($packageInfo['message'])->error();
           return redirect()->back();
       }
        }
        else {
            $packageInfo = $this->checkPackageExpiry($conversation->to_user_id);
            $packageInfo2 = $this->checkPackageExpiry($conversation->from_user_id);
$type = 1;

            if ($packageInfo['expiry'] || $packageInfo2['expiry'])
            {
                $from_user = $conversation->fromUser->myCompanies[0]->name;
                $this->deductConnect($conversation->from_user_id);
                $conversation->is_approved  = 1;
                $type = 1;
                $conversation->save();
                flash("You have successfully approved the connection request")->success();
            }
            else
            {
                flash("The Employer doesn't have sufficient Connnects to Get Connected. Please Try Again Later")->error();

            }

        }
        $notification= "Your Connect Request has been approved by ".$toWhom;
        $conn = Notification::create(["notification"=>$notification,"to_user_id"=>$conversation->from_user_id,"type"=>"success","created_by"=>\auth()->user()->id,"url"=>url('/account/pending')]);

        $mail = new \stdClass();
        $mail->name =  $from_user;
        $mail->title = $conversation->post->title;
        $mail->by = $toWhom;
        $mail->status = 2;
        $mail->type = $type;
        $mail->name2 = $toWhom;

        $notify_user->notify(new ConnectStatus($mail));
		return redirect()->back();
	}
	
}
