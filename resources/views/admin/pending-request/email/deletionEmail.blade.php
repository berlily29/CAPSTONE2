<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Deletion Notification</title>
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
                <h1>Account Deletion Notification</h1>
            </td>
        </tr>
        <tr>
            <td style="padding: 10px 20px;">
                <p>Dear <strong> {{ $user->fname }} {{ $user->lname }}</strong>,</p>
                <p>We are writing to inform you that your account has been deleted from our system. If you did not request this deletion, please contact our support team immediately.</p>
                <p>We value your privacy and have taken all necessary steps to ensure that your data has been removed from our records.</p>
                <p>If you have any questions or need further assistance, feel free to reach out to us.</p>
                <p>Thank you for being a part of our community.</p>
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
