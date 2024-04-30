<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\ProductBackInStock;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Shop;
use Exception;
use Carbon\Carbon;

class SendMailController extends Controller
{
    public function index($id)
    {
        $shops = Shop::get();

        foreach($shops as $shop){
            $api = new WebshopappApiClient($shop->cluster, $shop->api_key, $shop->api_secret, $shop->main_language);
            $variants = $api->variants->get(null, [
                'updated_at_min' => Carbon::now()->subMinutes(5)->format('Y-m-d H:i:s')
            ]);
            foreach($variants as $variant) {
                if ($variant['stockLevel'] > 0) {
    
                    $customers = Customer::where([
                        'variant_id' => $variant['id'],
                        'notification' => 0
                    ])->get();
    
                    if ($customers) {
                        $product = $api->products->get($variant['product']['resource']['id']);
                        foreach ($customers as $customer) {
                            Mail::to($customer->email)->send(new ProductBackInStock($customer, $variant, $product));
                            $customer->notification = 1;
                            $customer->save();
                        }
                    }
    
                }
    
            }
        }

        

        


        
    }
}


        // cluster, api_key, api_secret, main_language
        // $api = new WebshopappApiClient('eu1', '0c00fceb0289bd87b9daea304c5381ac', '7f8c597d8347afe6ff46baa2fc14507b', 'nl');