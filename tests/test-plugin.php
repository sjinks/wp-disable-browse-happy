<?php

class PluginTest extends WP_UnitTestCase
{
	/**
	 * @dataProvider dataProvider
	 * @param string $url
	 * @param callable $func
	 */
	public function testRequests($url, $func)
	{
		WildWolf\WordPress\DisableBrowseHappyPlugin::instance()->admin_init();
		$res = $func($url);
		$this->assertWPError($res);
	}

	public function dataProvider()
	{
		return [
			['https://api.wordpress.org/core/browse-happy/', 'wp_remote_get'],
			['http://api.wordpress.org/core/browse-happy/',  'wp_remote_get'],
			['https://api.wordpress.org/core/browse-happy/', 'wp_remote_head'],
			['http://api.wordpress.org/core/browse-happy/',  'wp_remote_head'],
			['https://api.wordpress.org/core/browse-happy/', 'wp_remote_post'],
			['http://api.wordpress.org/core/browse-happy/',  'wp_remote_post'],
		];
	}
}
