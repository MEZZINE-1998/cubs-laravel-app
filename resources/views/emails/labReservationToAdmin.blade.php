<!DOCTYPE html>
<html>
<head>
	<title>Digiwise</title>
	<meta charset="utf-8">
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
</head>
<body>
	<div class="container">
		<p>Hi, {{ $entreprise_name }} demand our Lab ressources.</p>
		<br>
		<p>Demand description :</p>
		<p>Technology : {{ $lab->technologie }}</p>
		<p>Start date : {{ $lab->startdate }}</p>
		<p>End date : {{ $lab->enddate }}</p>
		<br>
		<a href="{{url('cvs/')}}" style="color: green">Link to Digiwise portal !</a>
	</div>
</body>
</html>