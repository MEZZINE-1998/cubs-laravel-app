
<!DOCTYPE html>
<html>
<head>
	<title>Digiwise</title>
	<meta charset="utf-8">
    <!-- Styles -->
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
</head>
<body>
	<div class="col-md-6 text-center">
		<span>Hi {{ $user->name }}, <br>your Digiwise Profile has been created, please access to your profile in order to add a resume and update your personal information</span><br>
		<b>Link : </b><a style="color: blue" href="{{url('')}}">Digiwise Portal</a><br>
		<b>Email : </b><span style="color: blue">{{ $user->email }}</span><br>
		<b>Password : </b><span>{{ $user->password }}</span><br>
	</div>
</body>
</html>