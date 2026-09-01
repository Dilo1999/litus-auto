<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Motorcycle Enquiry</title>
</head>
<body style="font-family: Arial, sans-serif; color: #0C1524; line-height: 1.5;">
    <h2 style="margin: 0 0 16px;">New Motorcycle Enquiry</h2>

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
            <td style="font-weight: bold;">Model</td>
            <td>{{ $model }}</td>
        </tr>
        @if ($showroom)
        <tr>
            <td style="font-weight: bold;">Nearest showroom</td>
            <td>{{ $showroom }}</td>
        </tr>
        @endif
        @if ($payment)
        <tr>
            <td style="font-weight: bold;">Payment preference</td>
            <td>{{ $payment }}</td>
        </tr>
        @endif
    </table>
</body>
</html>
