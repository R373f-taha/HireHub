<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offer Accepted - HireHub</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #4CAF50;
            margin: 0;
        }
        .content {
            padding: 10px 0;
        }
        .highlight {
            background-color: #f0f8ff;
            padding: 15px;
            border-left: 4px solid #4CAF50;
            margin: 20px 0;
            border-radius: 4px;
        }
        .project-title {
            font-size: 1.2em;
            font-weight: bold;
            color: #2196F3;
        }
        .amount {
            font-size: 1.5em;
            font-weight: bold;
            color: #4CAF50;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #4CAF50;
            color: white !important;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            padding-top: 20px;
            margin-top: 20px;
            border-top: 1px solid #eee;
            font-size: 0.8em;
            color: #777;
        }
        .info-row {
            margin: 10px 0;
            padding: 8px;
            background-color: #f9f9f9;
            border-radius: 4px;
        }
        .label {
            font-weight: bold;
            width: 120px;
            display: inline-block;
        }
        .success-badge {
            background-color: #4CAF50;
            color: white;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.8em;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎉 Congratulations, {{ $freelancerName }}! 🎉</h1>
        </div>

        <div class="content">
            <p>Good news! Your offer has been <span class="success-badge">ACCEPTED</span> by the client.</p>

            <div class="highlight">
                <p class="project-title">📋 Project: {{ $projectTitle }}</p>
                <p class="amount">💰 Offer Amount: ${{ number_format($offerAmount, 2) }}</p>
            </div>

    

            <div class="info-row">
                <span class="label">👤 Client:</span>
                <span>{{ $clientName }}</span>
            </div>

            <div class="info-row">
                <span class="label">✅ Accepted on:</span>
                <span>{{ $acceptedAt->format('F j, Y, g:i a') }}</span>
            </div>

            <div style="text-align: center;">
                <a href="{{ url('/api/V1/projects/' . $projectId) }}" class="button">
                    View Project Details →
                </a>
            </div>

            <p><strong>What happens next?</strong></p>
            <ul>
                <li>You will be working directly with the client on this project</li>
                <li>The client will provide you with all necessary details</li>
                <li>Once the project is completed, you'll receive your payment</li>
                <li>After completion, the client can leave a review for you</li>
            </ul>

            <p style="margin-top: 20px;">
                Best regards,<br>
                <strong>The HireHub Team</strong>
            </p>
        </div>

        <div class="footer">
            <p>This is an automated message, please do not reply directly to this email.</p>
            <p>&copy; {{ date('Y') }} HireHub - Freelance Marketplace. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
