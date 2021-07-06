
<!DOCTYPE html>
<html>
<head>
	<title>Digiwise</title>
	<meta charset="utf-8">
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
</head>
<body>
	<div class="col-md-6 text-center">
		<span>Hi, a new interview from {{ $Recrutement->nom_entreprise }} has been scheduled</span><br>
		<span>Position : {{ $Recrutement->post }}</span><br>
        <span>Description : {{ $Recrutement->description }}</span><br><br>
		<a href="{{url('admin/'.$id_admin)}}" style="color: green">Consult your profile for more information !</a>
	</div>
</body>
</html>