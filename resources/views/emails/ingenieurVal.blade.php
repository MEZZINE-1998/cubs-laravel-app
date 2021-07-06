
<!DOCTYPE html>
<html>
<head>
	<title>Digiwise</title>
	<meta charset="utf-8">
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
</head>
<body>
	<div class="container">
		<span>Congratulations !</span><br>
		<span>
			We are pleased to inform you that you are selected for the vacant post of {{ $Recrutement->post }} with {{ $Recrutement->nom_entreprise }} company. We congratulate you on this achievement.
		</span>
		<br><br>
		<a href="{{url('cvs/'.$id_ing)}}" style="color: green">Consult your profile for more information !</a>
	</div>
</body>
</html>