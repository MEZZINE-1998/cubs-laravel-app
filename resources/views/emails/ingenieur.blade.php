
<!DOCTYPE html>
<html>
<head>
	<title>Digiwise</title>
	<meta charset="utf-8">
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
</head>
<body>
	<div class="container">
		<span>Hi, you're invited to pass an interview with {{ $Recrutement->nom_entreprise }} for {{ $Recrutement->post }} position</span><br>
        <span>Description : {{ $Recrutement->description }}</span><br><br>
        <span>Interview date : {{ $date_entretien }}</span><br><br>
		<a href="{{url('')}}" style="color: green">See more information here !</a>
	</div>
</body>
</html>


