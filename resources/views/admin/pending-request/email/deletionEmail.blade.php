<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Deletion Notification</title>
</head>
<body style="background-color: #f472b6; padding: 24px; font-family: Arial, sans-serif;">
    <div style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); padding: 24px;">
        <h1 style="font-size: 24px; font-weight: bold; color: #1f2937;">Account Deletion Notification</h1>
        <p style="margin-top: 16px; color: #4b5563;">Dear {{ $user->fname }} {{ $user->lname }},</p>
        <p style="margin-top: 16px; color: #4b5563;">We are writing to inform you that your account has been successfully deleted from our system. If you did not request this deletion, please contact our support team immediately.</p>
        <p style="margin-top: 16px; color: #4b5563;">We value your privacy and have taken all necessary steps to ensure that your data has been removed from our records.</p>
        <p style="margin-top: 16px; color: #4b5563;">If you have any questions or need further assistance, feel free to reach out to us.</p>
        <p style="margin-top: 16px; color: #4b5563;">Thank you for being a part of our community.</p>
        <p style="margin-top: 16px; color: #4b5563;">Best regards,<br>Angat Pampanga</p>
    </div>
    <div style="margin-top: 24px; text-align: center; color: #6b7280;">
        <p>&copy; {{ date('Y') }} Angat Pampanga. All rights reserved.</p>
    </div>
</body>
</html>