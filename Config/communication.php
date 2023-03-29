<?php
return [
    "SMSIR" =>  [
	    "USER_API_KEY"    =>  env("SMSIR_USER_API_KEY", ""),
	    "SECRET_KEY" =>  env("SMSIR_SECRET_KEY", ""),
        "LINE_NUMBER"   =>  env("SMSIR_LINE_NUMBER", "")
    ],
    "SLACK" => [
        "HOOK_URL" => env("SLACK_HOOK_URL", "")
    ],
    "GOOGLECLOUD"   =>  [
        "FCM_SEND_URL"  =>  env("GOOGLE_FCM_SEND_URL", "https://fcm.googleapis.com/fcm/send"),
        "AUTHORIZATION" =>  env("GOOGLE_FCM_AUTHORIZATION", ""),
    ]
];