<!DOCTYPE html>
<html>
<head>
    <title>Offer Update - HireHub</title>
</head>
<body>
    <h2>Hello {{ $freelancerName }},</h2>

    <p>We regret to inform you that your offer for the project <strong>{{ $projectTitle }}</strong> has <strong>not been accepted</strong>.</p>

    <div>
        <p><strong>Project:</strong> {{ $projectTitle }}</p>
        <p><strong>Your Offer Amount:</strong> ${{ number_format($offerAmount, 2) }}</p>
        <p><strong>Client:</strong> {{ $clientName }}</p>
    </div>

    <p>The client has selected another freelancer for this project.</p>

    <p>Don't worry! There are many other projects waiting for you.<br>
    Keep applying and good luck with your next opportunity! 💪</p>

    <p>Best regards,<br>The HireHub Team</p>
</body>
</html>
