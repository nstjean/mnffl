<!DOCTYPE html>
<html>
<head>
    <title>Welcome To MNFFL</title>
</head>

<body>
	<h2>Welcome to the MNFFL, {{$user['name']}}</h2>
	<br/>
	Your registered email to use for logging in: {{$user['email']}}<br/>
	<br/>
	You can log in here:<br/>
	<a href="http://mnffl.test/login">http://mnffl.test/login</a><br/>
	<br/>
	If the administrator did not give you your password you can reset your password here:<br/>
	<a href="http://mnffl.test/password/reset">http://mnffl.test/password/reset</a><br/>
</body>

</html>