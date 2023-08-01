<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <h2>Registration Successful</h2>
    <p>Dear {{ $name }},</p>
    <p>Thank you for registering. Your account has been successfully created. Please find your login details below:</p>
    
    <p><strong>Name:</strong> {{  $name }}</p>
    <p><strong>Email:</strong> {{  $email }}</p>
    <p><strong>Password:</strong> {{  $password }}</p>

    <p>Please keep your login details secure and do not share them with anyone.</p>
    <p>If you have any questions or need further assistance, please feel free to contact us.</p>
    
    <p>Thank you,</p>
    <p>Allways Legal</p>
</body>
</html>
