# Pranto Multilanguage
Pranto Multilanguage is a **dynamic multi-language** system. Where admin can easily add/romove language as he likes.
### Requirements
- PHP >= 5.4
### Composer Installation
Installation is straightforward, setup is similar to every other Laravel Package.

`composer require pranto/multi-language`

**Note**: This package supports the new auto-discovery features of Laravel 5.5, so if you are working on a Laravel 5.5 project, then your install is complete, you can skip to step 3.

If you are using Laravel 5.0 - 5.4 then you need to add a provider and alias. Inside of your config/app.php define a new service provider

`'providers' => [
	Pranto\MultiLanguage\MultiLanguageServiceProvider::class,
];`

### How To Implement In View
This package is easy to use. It provides a handful of helpful functions for changing language. Add similar this code to frontend.

`<select id="langSel">
	<option style="color: black" value="en"> English</option>
	@foreach($lang as $data)
	    <option value="{{$data->code}}" @if(Session::get('lang') === $data->code) selected  @endif> {{$data->name}}</option>
	@endforeach
</select>`

` <script>
	$(document).on('change', '#langSel', function () {
	    var code = $(this).val();
	    window.location.href = "{{url('/')}}/change-lang/"+code ;
	});
  </script>`





