<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #E5E7EB;
            margin: 0;
            padding: 0;
        }
        table {
            max-width: 600px;
            margin: 20px auto;
            background-color: #f9f9f9;
            border: 1px solid #dddddd;
            border-radius: 8px;
            padding: 20px;
        }
        h1 {
            color: black;
            font-size: 24px;
            margin-bottom: 10px;
        }
        p {
            color: black;
            font-size: 16px;
            line-height: 1.2;
        }
        a {
            display: inline-block;
            padding: 12px 20px;
            background-color: #f472b6; /* Tailored pink color */
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 17px;
            text-align: center;
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

        .btn-url {
            color: white;
        }
    </style>
</head>
<body>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <td style="text-align: center; padding-bottom: 2px;">
                 <h1>Email Verification</h1>
            </td>
        </tr>
        <tr>
            <td style="padding: 10px 20px;">
                <p>Hi there,</p>
                <p>Thanks for signing up! To complete your registration, please verify your email address.</p>
                <p>Click the link below to verify your email:</p>
                <p style="text-align: center; margin: 20px 0; padding-top:5px; padding-bottom:10px;">
                    <a class="btn-url" href="{{ $url }}" style="color:white;">Verify Your Email</a>
                </p>
                <p>If you did not create an account, please ignore this email.</p>
            </td>
        </tr>
        <tr>
            <td class="footer">
                <p>&copy; 2024 Angat Pampanga. All rights reserved.</p>
            </td>
        </tr>
    </table>
</body>
</html>
