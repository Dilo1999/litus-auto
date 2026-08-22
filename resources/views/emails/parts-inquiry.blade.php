<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Parts Inquiry</title>
</head>
<body style="font-family: Arial, sans-serif; color: #0C1524; line-height: 1.5;">
    <h2 style="margin: 0 0 16px;">New Parts Inquiry</h2>

    <table cellpadding="6" cellspacing="0" style="border-collapse: collapse;">
        <tr>
            <td style="font-weight: bold;">Motorcycle brand</td>
            <td>{{ $brand }}</td>
        </tr>
        @if ($year)
        <tr>
            <td style="font-weight: bold;">Year of make</td>
            <td>{{ $year }}</td>
        </tr>
        @endif
        @if ($model)
        <tr>
            <td style="font-weight: bold;">Motorcycle model</td>
            <td>{{ $model }}</td>
        </tr>
        @endif
        @if ($category)
        <tr>
            <td style="font-weight: bold;">Category</td>
            <td>{{ $category }}</td>
        </tr>
        @endif
        <tr>
            <td style="font-weight: bold;">Customer name</td>
            <td>{{ $name }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Contact number</td>
            <td>{{ $contact }}</td>
        </tr>
    </table>

    @if ($parts)
        <p style="margin: 20px 0 8px; font-weight: bold;">Parts needed</p>
        <p style="margin: 0; white-space: pre-wrap;">{{ $parts }}</p>
    @endif
</body>
</html>
