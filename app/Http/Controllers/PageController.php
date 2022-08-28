<?php
/**
//
 */

namespace App\Http\Controllers;

use App\Helpers\ArrayHelper;
use App\Http\Requests\ContactRequest;
use App\Models\City;
use App\Models\Comment;
use App\Models\Page;
use App\Models\Permission;
use App\Models\User;
use App\Notifications\FormSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Torann\LaravelMetaTags\Facades\MetaTag;
use App\Models\Package;
use Illuminate\Support\Facades\Auth;

class PageController extends FrontController
{
	use Traits\BuyPackage;
	/**
	 * ReportController constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		
		$this->middleware('demo.restriction')->only(['contactPost']);
	}
	
    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($slug)
    {
		// Get the Page
        $page = Page::where('slug', $slug)->trans()->first();
        if (empty($page)) {
            abort(404);
        }
        view()->share('page', $page);
        view()->share('uriPathPageSlug', $slug);
	
		// Check if an external link is available
		if (!empty($page->external_link)) {
			return headerLocation($page->external_link);
		}

        // SEO
        $title = $page->title;
        $description = Str::limit(str_strip($page->content), 200);

        // Meta Tags
        MetaTag::set('title', $title);
        MetaTag::set('description', $description);

        // Open Graph
        $this->og->title($title)->description($description);
        if (!empty($page->picture)) {
            if ($this->og->has('image')) {
                $this->og->forget('image')->forget('image:width')->forget('image:height');
            }
            $this->og->image(imgUrl($page->picture, 'page'), [
                'width'  => 600,
                'height' => 600,
            ]);
        }
        view()->share('og', $this->og);


        $comments = Comment::where('page_id', $page->id)->get();

//        dd($comments);

        return view('pages.index')->with('comments', $comments);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contact()
    {
		// Get the Country's largest city for Google Maps
		$city = City::currentCountry()->orderBy('population', 'desc')->first();
		view()->share('city', $city);
	
		// Meta Tags
		MetaTag::set('title', getMetaTag('title', 'contact'));
		MetaTag::set('description', strip_tags(getMetaTag('description', 'contact')));
		MetaTag::set('keywords', getMetaTag('keywords', 'contact'));

        return view('pages.contact');
    }

    public function faqPage()
    {
        return view('pages.faq');
    }
    
     public function ourstoryPage()
    {
        return view('pages.ourstory');
    }

    public function blogPage()
    {
        $blogs = Page::where('active', '1')
            ->type('blog')
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('pages.blog', compact('blogs'));
    }

    public function candidatesupportPage()
    {
        return view('pages.candidatesupport');
    }

    public function faqemployerPage()
    {
        $packages = null;
        if (Auth::check())
        {
            $user = User::with('purchasedPackage')->findOrFail(Auth::user()->id);

            $packageInfo = $this->showPackages($user);
            $packages = $packageInfo['packages'];

        }
        else
        {
            $packages =  Package::trans()->applyCurrency()->with('currency')->orderBy('lft')->get();
        }
        // Meta Tags
        MetaTag::set('title', t('Pricing'));
        MetaTag::set('description', t('Pricing - :app_name', ['app_name' => config('settings.app.app_name')]));

        return view('pages.faqemployer',compact('packages'));
    }

    public function faqcandidatePage()
    {
        return view('pages.faqcandidate');
    }


    public function policyPage()
    {
        return view('pages.privacy');
    }

    public function termsPage()
    {
        return view('pages.terms');
    }

    public function advicePage()
    {
        return view('pages.advice');
    }
    /**
     * @param ContactRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function contactPost(ContactRequest $request)
    {
        // Store Contact Info
		$contactForm = $request->all();
		$contactForm['country_code'] = config('country.code');
		$contactForm['country_name'] = config('country.name');
		$contactForm = ArrayHelper::toObject($contactForm);

        // Send Contact Email
        try {
            if (config('settings.app.email')) {
				Notification::route('mail', config('settings.app.email'))->notify(new FormSent($contactForm));
            } else {
                $admins = User::permission(Permission::getStaffPermissions())->get();
                if ($admins->count() > 0) {
					Notification::send($admins, new FormSent($contactForm));
					/*
                    foreach ($admins as $admin) {
						Notification::route('mail', $admin->email)->notify(new FormSent($contactForm));
                    }
					*/
                }
            }
			flash(t("Your message has been sent to our moderators. Thank you"))->success();
        } catch (\Exception $e) {
            flash($e->getMessage())->error();
        }

        return redirect(config('app.locale') . '/' . trans('routes.contact'));
    }

    public function createComment(Request $request, $id) {

        $comment = new Comment;

        $comment->comment = $request->comment;
        $comment->from_user_id = auth()->user()->id;
        $comment->page_id = $id;

        $comment->save();

        return back();

    }

    public function deleteComment($id) {

        $comment = Comment::where('id', $id)->delete();

        return back();

    }

    public function editComment(Request $request, $id) {

        $comment = Comment::where('id', $id)->update([ 'comment' => $request->comment]);

        return back();

    }
}
