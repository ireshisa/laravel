<?php
//

namespace App\Providers;

use Aws\S3\S3Client;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Cached\CachedAdapter;
use League\Flysystem\Cached\Storage\Memory;
use League\Flysystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Spatie\FlysystemDropbox\DropboxAdapter;

class DigitalOceanServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        //
    }
	
	/**
	 * Perform post-registration booting of services.
	 *
	 * @return void
	 */
	public function boot()
	{
		Storage::extend('digitalocean', function ($app, $config) {
			$region = $config['region'];
			
			$client = new S3Client([
				'credentials' => [
					'key'    => $config['key'],
					'secret' => $config['secret']
				],
				'region'   => $region,
				'version'  => 'latest',
				'endpoint' => "https://$region.digitaloceanspaces.com",
			]);
			
			$adapter = new AwsS3Adapter($client, $config['bucket']);
			
			// return new Filesystem($adapter);
			$store = new Memory();
			return new Filesystem(new CachedAdapter($adapter, $store));
		});
	}
}
