<html>
<head>
	<title>Compose Email</title>
</head>
<body>
	<form action="sendEmail.php" method="POST">
		To:  <input type="text" id="email" name="email"/><br/>
		Subject: <input type="text" id="subject" name="subject"/>
		<br/>
		Message: <textarea name="body" id="body"></textarea><br/>
		<input type="submit"/>
	</form>
</body>
</html>