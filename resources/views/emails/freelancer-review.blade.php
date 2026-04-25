<!DOCTYPE html>
<html>
<head>
    <title>Your Average Rating - HireHub</title>
</head>
<body>
    <h2>Hello {{ $freelancerName }},</h2>

    <p>Good news! You have received a new review.</p>

    <div style="background-color: #f0f8ff; padding: 15px; border-left: 4px solid #4CAF50;">
        <p><strong>📊 Your New Average Rating:</strong></p>
        <p style="font-size: 24px; font-weight: bold; color: #4CAF50;">
            {{ number_format($freelancerAvgRating, 1) }} / 5.0 ⭐
        </p>
    </div>

    <p>Keep up the great work! 🌟</p>

    <p>Best regards,<br>The HireHub Team</p>
</body>
</html>
