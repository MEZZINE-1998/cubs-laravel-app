
<!DOCTYPE html>
<html>
<head>
	<title>Digiwise</title>
	<meta charset="utf-8">
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
</head>
<body>
	<div class="container">
		<p>Your Lab Demand request has been successfully received and it will be processed as soon as possible.</p>
		<p>You'll receive your access terms in the next 24 hours.</p>

		<br>
		<p>Request description :</p>
		<p>Technology : {{ $lab->technologie }}</p>
		<p>Start date : {{ $lab->startdate }}</p>
		<p>End date : {{ $lab->enddate }}</p>

		<br>
		<a href="{{url('cvs/')}}" style="color: green">Link to Digiwise portal !</a>
	</div>
</body>
</html>