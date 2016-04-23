<?php

return [


    /**
     * 账号基本信息，请从微信公众平台/开放平台获取
     */
    'app_id'  => env('WECHAT_APPID', 'your-app-id'),         // AppID
    'secret'  => env('WECHAT_SECRET', 'your-app-secret'),     // AppSecret



    /**
     * 微信支付
     */
     'payment' => [
         'merchant_id'        => env('WECHAT_PAYMENT_MERCHANT_ID', 'your-mch-id'),
         'key'                => env('WECHAT_PAYMENT_KEY', 'key-for-signature')
     ],
];
