<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\WebshopappApiClient;
use App\Models\Shop;
use Illuminate\Support\Carbon;
use App\Models\Subscription;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProductBackInStock;

class CheckShopVariants extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-shop-variants';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check all changed variants each 5 minutes and send notifications to subscribers.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        
        $shops = Shop::get();

        foreach($shops as $shop){
            $api = new WebshopappApiClient($shop->cluster, $shop->api_key, $shop->api_secret, $shop->main_language);
            $variants = $api->variants->get(null, [
                'updated_at_min' => Carbon::now()->subMinutes(5)->format('Y-m-d H:i:s')
            ]);
            foreach($variants as $variant) {
                if ($variant['stockLevel'] > 0) {
    
                    $subscriptions = Subscription::where([
                        'variant_id' => $variant['id'],
                        'notification' => 0
                    ])->get();
    
                    if ($subscriptions) {
                        $product = $api->products->get($variant['product']['resource']['id']);
                        foreach ($subscriptions as $subscription) {
                            Mail::to($subscription->email)->send(new ProductBackInStock($subscription, $variant, $product));
                            $subscription->notification = 1;
                            $subscription->save();
                        }
                    }
    
                }
    
            }
        }

    }
}
