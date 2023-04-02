<?php

namespace Database\Seeders;

use App\Enums\ActiveInactiveState;
use App\Models\Api;
use App\Models\Config;
use App\Models\Faq;
use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $configs = [
            [
                'name' => 'is_installed',
                'value' => '0'
            ],
            [
                'name' => 'maintenance_mode',
                'value' => '0'
            ],
            [
                'name' => 'title',
                'value' => 'SMM-Panel'
            ],
            [
                'name' => 'meta_description',
                'value' => 'SMM Panel is a professional panel that only offers High Quality services.'
            ],
            [
                'name' => 'meta_keywords',
                'value' => 'smm panel, social media marketing, smm'
            ],
            [
                'name' => 'website_logo',
                'value' => ''
            ],
            [
                'name' => 'website_favicon',
                'value' => ''
            ],
            [
                'name' => 'currency',
                'value' => 'USD'
            ],
            [
                'name' => 'currency_symbol',
                'value' => '$'
            ],
            [
                'name' => 'service_updates_page',
                'value' => '1'
            ],
            [
                'name' => 'register_page',
                'value' => '1'
            ],
            [
                'name' => 'directly_login',
                'value' => '1'
            ],
            [
                'name' => 'autologin_after_registration',
                'value' => '0'
            ],
            [
                'name' => 'forgot_password',
                'value' => '1'
            ],
            [
                'name' => 'errorlogs_delete',
                'value' => '7'
            ],
            [
                'name' => 'errorlogs_importance_level',
                'value' => '0'
            ],
            [
                'name' => 'ticket_status',
                'value' => '1',
            ],
            [
                'name' => 'max_open_ticket',
                'value' => '5',
            ],
            [
                'name' => 'terms_content',
                'value' => 'We reserve the right to change these terms of service without notice. You are expected to read all terms of service before placing any order to insure you are up to date with any changes or any future changes.',
            ],
            [
                'name' => 'policy_content',
                'value' => 'No refunds will be made to your payment method. After a deposit has been completed, there is no way to reverse it. You must use your balance',
            ],
            [
                'name' => 'javascript_embed_header',
                'value' => ''
            ],
            [
                'name' => 'javascript_embed_footer',
                'value' => ''
            ],
            [
                'name' => 'facebook_link',
                'value' => 'https://www.facebook.com'
            ]
            ,
            [
                'name' => 'twitter_link',
                'value' => 'https://www.twitter.com'
            ],
            [
                'name' => 'instagram_link',
                'value' => 'https://www.instagram.com'
            ]
            ,
            [
                'name' => 'youtube_link',
                'value' => 'https://www.youtube.com'
            ],
        ];

        $faqs = [
            [
                'question' => 'What is SMM Panel?',
                'answer' => 'SMM panel, which is the short form of Social Media marketing panel is generally utilized concerning advertising organizations, brands, or ventures via web-based media. As you surely understand, Social media is the thing to get done where individuals from varying backgrounds associate for a considerable length of time.',
            ],
            [
                'question' => 'What is Partial status?',
                'answer' => 'Partial Status is when we partially refund the remains of an order. Sometimes for some reasons we are unable to deliver a full order, so we refund you the remaining undelivered amount.',
            ]
        ];

        $paymentmethods = [
            [
                'name' => 'PayPal',
                'slug' => 'paypal',
                'icon' => 'bxl-paypal',
                'status' => ActiveInactiveState::ACTIVE->value,
                'min_amount' => '1',
                'max_amount' => '1000',
                'is_manual' => ActiveInactiveState::INACTIVE->value,
                'content' => '<br><center>Your payments will be added to your balance instantly.</center>',
            ]
        ];

        $apis = [
            [
                'name' => 'JAP',
                'url' => 'https://justanotherpanel.com/api/v2',
                'key' => 'KEY',
                'services_action' => 'services',
                'add_action' => 'add',
                'status_action' => 'status',
                'refill_action' => 'refill',
                'refill_status_action' => 'refill_status',
                'balance_action' => 'balance',
                'service_key' => 'service',
                'link_key' => 'link',
                'quantity_key' => 'quantity',
                'order_key' => 'order',
                'orders_key' => 'orders',
                'refill_key' => 'refill'
            ]
        ];

        collect($configs)->each(function ($config){
            Config::create($config);
        });

        collect($faqs)->each(function ($faq){
            Faq::create($faq);
        });

        collect($paymentmethods)->each(function ($paymentmethod){
            PaymentMethod::create($paymentmethod);
        });

        collect($apis)->each(function ($api){
            Api::create($api);
        });
    }
}
