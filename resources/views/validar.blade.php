<html>
  <head>
  </head>
  <body>
  <h1>Hola! {{$user->name}}</h1>
  <p>Te registraste con tu correo: {{$user->email}}</p>
  <p>Haz clic aquí por favor <a href='http://127.0.0.1:8000/api/valida/{{$user->id}}'> para validar tu correo</a></p>
  </body>
</html>