
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        {!!Form::open({'action' => 'AdminController@login'!!}
        <input type="hidden" id="password" name="password" />
        {!!FormClose!!}
        
        <script>
        $(#'password').value = prompt('salasana');
        </script>
    </body>
</html>
