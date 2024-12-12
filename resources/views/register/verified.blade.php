<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Verified</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            border: 1px solid #dddddd;
            border-radius: 8px;
            padding: 40px;
            text-align: center;
        }
        h1 {
            color: #333333;
            font-size: 28px;
            margin-bottom: 10px;
        }
        p {
            color: #555555;
            font-size: 16px;
            line-height: 1.5;
        }
        a {
            display: inline-block;
            padding: 12px 20px;
            background-color: #f472b6; /* Tailored pink color */
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
            text-align: center;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }
        a:hover {
            background-color: #e11d48; /* Hover effect for button */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Congratulations!</h1>
        <p>Your account has been successfully verified.</p>
        <p>Re-login and proceed to your dashboard.</p>
        <a href="{{ route('login') }}">Go to Login</a>
    </div>
</body>
</html>
