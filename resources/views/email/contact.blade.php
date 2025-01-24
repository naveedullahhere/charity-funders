<!DOCTYPE html>
<html>
<head>
</head>
<body>
<table cellspacing="0">
    <tbody>
        <h2>New Contact Form Submission</h2>
    <tr>
        <td> 
            <p><strong>Name:</strong> {{ $contactData['first_name'] }} {{$contactData['last_name']}}</p>
            <p><strong>Email:</strong> {{ $contactData['email'] }}</p>
            <p><strong>Phone:</strong> {{ $contactData['phone'] }}</p>
            <p><strong>Message:</strong></p>
            <p>{{ $contactData['message'] }}</p>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
