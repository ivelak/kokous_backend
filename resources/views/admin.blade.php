
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        {!!Form::open(['action' => 'AdminController@login'])!!}
        <input type="hidden" id="password" name="password" />
        {!!Form::close()!!}
        
        <script>
        var x = window.prompt('Syötä salasana:');
		document.querySelector("#password").value = x;
		document.forms[0].submit();
		
        </script>
    </body>
</html>
