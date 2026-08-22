<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Service Appointment Request</title>
</head>
<body style="font-family: Arial, sans-serif; color: #0C1524; line-height: 1.5;">
    <h2 style="margin: 0 0 16px;">New Service Appointment Request</h2>

    <table cellpadding="6" cellspacing="0" style="border-collapse: collapse;">
        <tr>
            <td style="font-weight: bold;">Name</td>
            <td>{{ $name }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Mobile</td>
            <td>{{ $mobile }}</td>
        </tr>
        @if ($model)
        <tr>
            <td style="font-weight: bold;">Motorcycle model</td>
            <td>{{ $model }}</td>
        </tr>
        @endif
        @if ($regNo)
        <tr>
            <td style="font-weight: bold;">Registration number</td>
            <td>{{ $regNo }}</td>
        </tr>
        @endif
        @if ($centre)
        <tr>
            <td style="font-weight: bold;">Service centre</td>
            <td>{{ $centre }}</td>
        </tr>
        @endif
        @if ($date)
        <tr>
            <td style="font-weight: bold;">Preferred date</td>
            <td>{{ $date }}</td>
        </tr>
        @endif
        @if ($serviceType)
        <tr>
            <td style="font-weight: bold;">Type of service</td>
            <td>{{ $serviceType }}</td>
        </tr>
        @endif
    </table>

    @if ($notes)
        <p style="margin: 20px 0 8px; font-weight: bold;">Additional notes</p>
        <p style="margin: 0; white-space: pre-wrap;">{{ $notes }}</p>
    @endif
</body>
</html>
