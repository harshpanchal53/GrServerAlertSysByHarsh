<!DOCTYPE html>
<html>
<head>
    <title>Server Offline Alert</title>
</head>
<body>
    <h2>Server Offline Alert 🚨</h2>
    <p>The following server is currently offline:</p>

    <ul>
        <li><strong>Name:</strong> {{ $serverName }}</li>
        <li><strong>IP:</strong> {{ $serverIp }}</li>
        <li><strong>Port:</strong> {{ $serverPort }}</li>
    </ul>

    <p>Please check the server status immediately.</p>
    <p>Regards,<br>System Monitoring Team</p>
</body>
</html>
