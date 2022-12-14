<?php
/**
//
 */

namespace App\Http\Controllers\Account;


use Torann\LaravelMetaTags\Facades\MetaTag;

class TransactionsController extends AccountBaseController
{
	private $perPage = 10;
	
	public function __construct()
	{
		parent::__construct();
		
		$this->perPage = (is_numeric(config('settings.listing.items_per_page'))) ? config('settings.listing.items_per_page') : $this->perPage;
	}
	
	/**
	 * List Transactions
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
		$data = [];


		$data['transactions'] = $this->transactions->paginate($this->perPage);
		view()->share('pagePath', 'transactions');

//dd($this->transactions->count());
		// Meta Tags
		MetaTag::set('title', t('My Transactions'));
		MetaTag::set('description', t('My Transactions on :app_name', ['app_name' => config('settings.app.app_name')]));
		
		return view('account.transactions', $data);
	}
}
