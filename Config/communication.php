<?php
return [
    "SMSIR" =>  [
	    "USER_API_KEY"    =>  env("SMSIR_USER_API_KEY", ""),
	    "SECRET_KEY" =>  env("SMSIR_SECRET_KEY", ""),
        "LINE_NUMBER"   =>  env("SMSIR_LINE_NUMBER", "")
    ]
];