<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Resume</title>
</head>
<body>
    <div style="margin: 0 auto;display: block;width: 500px;">
        <table width="100%" border="1">
            <tr>
                <td colspan="2" style="text-align: center">
                    <img src="{{$imagePath}}" style="width:200px;"> 
                </td>
            </tr>
            <tr>
                <td>Name:</td>
                <td>{{$name}}</td>
            </tr>
            <tr>
                <td>Address:</td>
                <td>{{$address}}</td>
            </tr>
            <tr>
                <td>Mobile Number:</td>
                <td>{{$mobileNumber}}</td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>{{$email}}</td>
            </tr>
        </table>
    </div>
</body>
</html>