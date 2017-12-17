<?php

namespace WildWolf\WordPress;

class DisableBrowseHappyPlugin
{
    public static function instance()
    {
        static $self = null;

        if (!$self) {
            $self = new self();
        }

        return $self;
    }

    private function __construct()
    {
        add_action('admin_init', [$this, 'admin_init']);
    }

    public function admin_init()
    {
        add_filter('pre_http_request', [$this, 'pre_http_request'], 10, 3);
    }

    public function pre_http_request($ret, $request, $url)
    {
        if (preg_match('!^https?://api\.wordpress\.org/core/browse-happy/!i', $url)) {
            return true;
        }

        return $ret;
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}
