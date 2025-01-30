<!DOCTYPE html>
<html lang="ar"  dir="{{ session()->has('dir') ? session()->get('dir') : 'rtl' , }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>
<body>
    <p>Thank you for registering. Please verify your email by clicking the button below:</p>
    <a href="{{ $verificationLink }}" class="text-decoration-underline">Verify Email</a>
</body>
</html>