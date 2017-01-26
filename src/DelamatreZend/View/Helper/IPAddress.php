<?php

namespace DelamatreZend\View\Helper;

class IPAddress extends AbstractHelper
{

    public function __invoke()
    {

        if(getenv('HTTP_CLIENT_IP')) {
            $ip_address = getenv('HTTP_CLIENT_IP');
        }elseif(getenv('HTTP_X_FORWARDED_FOR')) {
            $ip_address = getenv('HTTP_X_FORWARDED_FOR');
        }elseif(getenv('HTTP_X_FORWARDED')) {
            $ip_address = getenv('HTTP_X_FORWARDED');
        }elseif(getenv('HTTP_FORWARDED_FOR')) {
            $ip_address = getenv('HTTP_FORWARDED_FOR');
        }elseif(getenv('HTTP_FORWARDED')) {
            $ip_address = getenv('HTTP_FORWARDED');
        }elseif(getenv('REMOTE_ADDR')) {
            $ip_address = getenv('REMOTE_ADDR');
        }else {
            $ip_address = 'UNKNOWN';
        }

        return $ip_address;

    }

}