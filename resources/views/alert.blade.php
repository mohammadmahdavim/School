<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    {{--<script src='https://www.google.com/recaptcha/api.js'></script>--}}
</head>
<body>

<div class="container">
    <p>Welcome to my website...</p>
</div>
<form action="/getDate " method="post">
    {{csrf_field()}}
    <textarea name="massege" id="massege" ></textarea>
    <div class="g-recaptcha" data-sitekey="6LdxmYUUAAAAAIIzKmWDTEkAjDhWX9Rvwyhbcliz"></div>
<button type="submit">submit</button>



</form>
<!-- Include this after the sweet alert js file -->
@include('sweet::alert')

</body>
</html>