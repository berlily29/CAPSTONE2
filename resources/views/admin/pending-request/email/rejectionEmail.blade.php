<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejection Notification</title>
</head>
<body style="background-color: #f472b6; padding: 24px; font-family: Arial, sans-serif;">
    <div style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); padding: 24px;">
        <h1 style="font-size: 24px; font-weight: bold; color: #1f2937;">Rejection Notification</h1>
        <p style="margin-top: 16px; color: #4b5563;">Dear {{ $user->fname }} {{ $user->lname }},</p>
        <p style="margin-top: 16px; color: #4b5563;">We regret to inform you that your Attachment ID has been rejected.</p>
        <p style="margin-top: 16px; color: #4b5563;">Reason for rejection: <strong>{{ $reason }}</strong></p>
        <p style="margin-top: 16px; color: #4b5563;">If you have any questions or need further clarification, please feel free to reach out to our support team.</p>
        <p style="margin-top: 16px; color: #4b5563;">Thank you for your understanding.</p>
        <p style="margin-top: 16px; color: #4b5563;">Best regards,<br>Angat Pampanga</p>
    </div>
    <div style="margin-top: 24px; text-align: center; color: #6b7280;">
        <p>&copy; {{ date('Y') }} Angat Pampanga. All rights reserved.</p>
    </div>
</body>
</html>