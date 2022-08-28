<?php
	
	namespace App\Providers;
	
	
	use Illuminate\Support\ServiceProvider;
	
	class HelperServiceProvider  extends ServiceProvider
	{
	
		public function register()
		{
		    $file = app_path('Helpers/Functions/profile_count_helper.php');
		    if (file_exists($file)) {
		        require_once($file);
		    }
		}
	
		
	}
