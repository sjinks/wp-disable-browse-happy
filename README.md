# wp-disable-browse-happy

WordPress plugin to disable queries to BrowseHappy API (ie, for privacy reasons)

When you go to the Admin Dashboard of your WordPress site, WP checks
whether your browser is up-to-date, and displays a notice if it is not
(i.e., "You are using an insecure browser!" or "Your browser is out of date!").

This is probably not a bad thing, but:
1. It could be annoying for Linux users (they may have a browser with all
security patches backported yet its version will not be the latest)
2. `wp_check_browser_version()` function, which implements the check, does that
with a call to `http://api.wordpress.org/core/browse-happy/1.1/` (or `https://`
if the SSL support is enabled):

```php
// include an unmodified $wp_version
include( ABSPATH . WPINC . '/version.php' );

$url = 'http://api.wordpress.org/core/browse-happy/1.1/';
$options = array(
        'body'       => array( 'useragent' => $_SERVER['HTTP_USER_AGENT'] ),
        'user-agent' => 'WordPress/' . $wp_version . '; ' . home_url( '/' )
);

if ( wp_http_supports( array( 'ssl' ) ) ) {
        $url = set_url_scheme( $url, 'https' );
}

$response = wp_remote_post( $url, $options );
```

You can see that this code sends your user agent string, WordPress version, and
the URL and IP address (implicitly) of the blog.

[WordPess plugin guidelines](https://developer.wordpress.org/plugins/wordpress-org/detailed-plugin-guidelines/) say that
"In the interest of protecting user privacy, plugins may not contact external servers
without the explicit consent of the user".

I think that the same should apply to the WP Core itself; since WP "leaks the data" by default,
and there is no way to opt out of that in the UI, this plugin can be used to turn off that functionality.
