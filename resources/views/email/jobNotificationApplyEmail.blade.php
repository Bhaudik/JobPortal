<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job Application Notification</title>
    <style>
        body,
        h3 {
            color: #333
        }

        .footer,
        h1 {
            text-align: center
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, .1)
        }

        .details,
        p {
            margin-bottom: 20px
        }

        h1 {
            font-size: 24px;
            color: #4caf50
        }

        p {
            font-size: 16px;
            line-height: 1.6
        }

        h3 {
            font-size: 18px;
            border-bottom: 2px solid #4caf50;
            padding-bottom: 8px;
            margin-bottom: 15px
        }

        .contact-info p,
        .details p {
            margin: 5px 0
        }

        .footer {
            font-size: 14px;
            color: #888
        }

        .footer a {
            color: #4caf50;
            text-decoration: none
        }

        .highlight {
            font-weight: 700;
            color: #4caf50
        }

        .contact-info {
            background-color: #f1f1f1;
            padding: 10px;
            border-radius: 5px
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Job Application Notification</h1>

        <p>Dear <span class="highlight">{{ $mailData['user']->name }}</span>,</p>

        <p>Thank you for applying to the job position at <span
                class="highlight">{{ $mailData['employer']->company_name }}</span>. We have received your application for
            the position of <span class="highlight">{{ $mailData['job']->title }}</span>.</p>

        <h3>Job Details:</h3>
        <div class="details">
            <p><strong>Job Title:</strong> {{ $mailData['job']->title }}</p>
            <p><strong>Employer:</strong> {{ $mailData['employer']->company_name }}</p>
            <p><strong>Location:</strong> {{ $mailData['job']->location }}</p>
            <p><strong>Salary:</strong> {{ $mailData['job']->salary }}</p>
        </div>

        <h3>Your Contact Information:</h3>
        <div class="contact-info">
            <p><strong>Email:</strong> {{ $mailData['user']->email }}</p>
            <p><strong>Mobile Phone:</strong> {{ $mailData['user']->mobile_phone }}</p>
        </div>

        <p>We will review your application and get back to you shortly.</p>

        <p>Thank you for applying!</p>

        <p class="footer">Best regards,<br>
            The <span class="highlight">{{ $mailData['employer']->company_name }}</span> Team</p>
    </div>
</body>

</html>
