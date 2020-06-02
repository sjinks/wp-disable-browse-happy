<?php
namespace WildWolf\WordPress;

final class DisableBrowseHappyPlugin
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
		\add_action('admin_init', [$this, 'admin_init']);
	}

	public function admin_init()
	{
		\add_filter('pre_http_request', [$this, 'pre_http_request'], 10, 3);
	}

	/**
	 * @param false|array|\WP_Error $preempt Whether to preempt an HTTP request's return value. Default false.
	 * @param array $request HTTP request arguments.
	 * @param string $url The request URL.
	 */
	public function pre_http_request($ret, array $request, string $url)
	{
		if (\preg_match('!^https?://api\.wordpress\.org/core/.*?-happy/!i', $url)) {
			return new \WP_Error('http_request_failed', \sprintf('Request to %s is not allowed.', $url));
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
