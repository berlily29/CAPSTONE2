<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        table {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border: 1px solid #dddddd;
            border-radius: 8px;
            padding: 20px;
        }
        h1 {
            color: #333333;
            font-size: 24px;
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
            transition: background-color 0.3s ease;
        }
        a:hover {
            background-color: #e11d48; /* Hover effect for button */
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #aaaaaa;
            padding-top: 20px;
            border-top: 1px solid #dddddd;
        }
        .footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <td style="text-align: center; padding-bottom: 20px;">
                <h1>Password Reset</h1>
            </td>
        </tr>
        <tr>
            <td style="padding: 10px 20px;">
                <p>Greetings,</p>
                <p>We noticed you requested to reset your password. Don't worry, we've got you covered!</p>
                <p>Click the link below to proceed:</p>
                <p style="text-align: center; margin: 20px 0;">
                    <a href="{{ $url }}">Verify Your Session</a>
                </p>
                <p>If you did not request this, please ignore this email.</p>
            </td>
        </tr>
        <tr>
            <td class="footer">
                <p>&copy; 2024 Angat Buhay Pampanga. All rights reserved.</p>
            </td>
        </tr>
    </table>
</body>
</html>
