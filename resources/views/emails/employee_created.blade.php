<!DOCTYPE html>
<html>
<head>
    <title>Employee Login Credentials</title>
</head>
<body>
    <h2>Hello {{ $employee->name }},</h2>
    <p>Your employee account has been created.</p>
    <p>Here are your login credentials:</p>
    <ul>
        <li>Email: {{ $employee->email }}</li>
        <li>Temporary Password: {{ $password }}</li>
    </ul>
    <p>Please login at <a href="{{ url('/login') }}">{{ url('/login') }}</a> and change your password immediately.</p>
    <br>
    <p>Regards,<br>Your Company</p>
</body>
</html>
