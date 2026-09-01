<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Contact Form Message</title>
</head>
<body style="font-family: Arial, sans-serif; color: #0C1524; line-height: 1.5;">
    <h2 style="margin: 0 0 16px;">New Contact Form Message</h2>

    <table cellpadding="6" cellspacing="0" style="border-collapse: collapse;">
        <tr>
            <td style="font-weight: bold;">Name</td>
            <td>{{ $name }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Mobile</td>
            <td>{{ $mobile }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Email</td>
            <td>{{ $email }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Inquiry type</td>
            <td>{{ $inquiryType }}</td>
        </tr>
        @if ($showroom)
        <tr>
            <td style="font-weight: bold;">Nearest showroom</td>
            <td>{{ $showroom }}</td>
        </tr>
        @endif
    </table>

    <p style="margin: 20px 0 8px; font-weight: bold;">Message</p>
    <p style="margin: 0; white-space: pre-wrap;">{{ $messageBody }}</p>
</body>
</html>
