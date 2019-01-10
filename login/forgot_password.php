<html>
<head>

</head>
<body>
    <form id="forgot" method="POST"  onsubmit="document.getElementById('display').textContent = 'You can now check your email and follow the instructions'; return false;">
        <h1 style="color: whitesmoke;">Enter your email address and submit</h1>
        <input type="email" id="email" title="email" required>
        <input type="submit" value="submit">
    </form>
    <h1 id="display" style="margin-left: 10%; color: whitesmoke;"></h1>
</body>
</html>