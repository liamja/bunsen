# My First Test

To introduce Bunsen, we'll write a simple controller test. We'll create a test for the _Welcome_ controller found in default installations of CodeIgniter. This test will look for the existence of the phrase _"Welcome to CodeIgniter"_. If the phrase is output to the browser, the test should pass.

Here is the _Welcome_ controller, found in new installations of CodeIgniter:

```php
class Welcome extends CI_Controller
{
	public function index()
    {
		$this->load->view('welcome_message');
	}
}
```

We can see that accessing `/welcome/index` will load the `welcome_message` view and output the contents to the browser.

Here is the contents of the `welcome_message` view, minus some HTML boilerplate:

```html
<div id="container">
	<h1>Welcome to CodeIgniter!</h1>

	<div id="body">
		<p>The page you are looking at is being generated dynamically by CodeIgniter.</p>

		<p>If you would like to edit this page you'll find it located at:</p>
		<code>application/views/welcome_message.php</code>

		<p>The corresponding controller for this page is found at:</p>
		<code>application/controllers/welcome.php</code>

		<p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="user_guide/">User Guide</a>.</p>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>
```

Let's assume we are the maintainers of CodeIgniter. Let us also assume that displaying this welcome text is important in demonstrating its value. We should ensure any changes we make to CodeIgniter don't break this welcome page.

To ensure this page is working, we can test for the existence of this text in CodeIgniter's response to the browser.

## Writing Our Test

Begin by creating a new file at `test/controllers/welcome_test.php`.

All test classes must extend `Bunsen\TestCase`.

```php
class Welcome_test extends Bunsen\TestCase
{
}
```

The parent class `TestCase` contains helpful methods that make testing CodeIgniter easier.

Next we need to create a method that PHPUnit can call:

```php
class Welcome_test extends Bunsen\TestCase
{
    function testIndex()
    {
    }
}
```

To test the index page, we need to build up an HTTP request that we can send to CodeIgniter. Bunsen accepts PSR-7 HTTP messages as substitutes for real requests.

While any PSR-7 implementation can be used, Bunsen uses Guzzle's PSR-7 library, so that's what we'll use for this example.


```php
class Welcome_test extends Bunsen\TestCase
{
    function testIndex()
    {
        $request = new GuzzleHttp\Psr7\Request('GET', '/welcome/index');
    }
}
```

We've now created a new instance of a PSR-7-compatible HTTP message. We've specified that it should be a GET request to the `/welcome/index` URL.

Let's send the request message to CodeIgniter, via Bunsen.

```php
class Welcome_test extends Bunsen\TestCase
{
    function testIndex()
    {
        $request = new GuzzleHttp\Psr7\Request('GET', '/welcome/index');
        
        $this->send($request);
    }
}
```

The `send()` method takes an HTTP request message and sends it off to CodeIgniter. CodeIgniter will then process the request, running the controller method handled by the route we specified.

After the request is made, we can examine the response by looking for our test string in the output. We'll use PHPUnit's regex assertion to look for the text.


```php
class Welcome_test extends Bunsen\TestCase
{
    function testIndex()
    {
        $request = new GuzzleHttp\Psr7\Request('GET', '/welcome/index');
        
        $this->send($request);
        
        $this->expectOutputRegex('/Welcome to CodeIgniter/');
    }
}
```

Run the test by calling `phpunit` from the command line. Your test should pass, with output like the following:

```shell
$ phpunit
PHPUnit 3.7.0 by Sebastian Bergmann.

.

Time: 0 seconds, Memory: 5.25Mb

OK (1 test, 1 assertion)
```

You've now written your first test!

That's the simplest controller test you can make with Bunsen. The following sections will describe what Bunsen is doing behind-the-scenes and how to write advanced tests.