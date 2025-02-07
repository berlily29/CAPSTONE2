<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Rejection Notification</title>
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
            text-align: center;
        }
        p {
            color: black;
            font-size: 16px;
            line-height: 1.5;
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
            <td style="text-align: center; padding-bottom: 2px;">
                <h1>You are permanently banned!</h1>
            </td>
        </tr>
        <tr>
            <td style="padding: 10px 20px;">
                <p>Dear <strong> {{ $user->fname }} {{ $user->lname }}</strong>,</p>
                <p>We regret to inform you that we have to ban you from applying as an Event Organizer.</p>
                <p>Reason for banning: <strong>Multiple attempts and rejections</strong></p>
                <p>If you have any questions or need further clarification, please feel free to reach out to our support team.</p>
                <p>Thank you for your understanding.</p>
                <p>Best regards,<br>Angat Pampanga</p>
            </td>
        </tr>
        <tr>
            <td class="footer">
                <p>&copy; {{ date('Y') }} Angat Pampanga. All rights reserved.</p>
            </td>
        </tr>
    </table>
</body>
</html>
