<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <style>
            .header{
                background: #F5F8FA;
                padding: 10px 0;
            }
            .header h3{color:#bbbfc3;}
            .content{
                border-bottom: 1px solid #edeff2;
                border-top: 1px solid #edeff2;
                padding: 20px 0;
            }
            .footer{
                background: #F5F8FA;
                padding: 10px 0;
            }
            .msg{color: #525252;text-align: left;line-height: 24px;}
            /*.user_detail p{color: #525252;margin-bottom: 5px;text-align: left;}*/
            .footer p{color:#bbbfc3;margin-bottom: 5px;margin-top: 0;}
            .email a{text-decoration: none;color:#bbbfc3;font-weight: bold;}
        </style>
    </head>
    <body>

    <center>
        <div class="maincontent">
            <div class="header">
                <h3 style="font-size: 1.4em;">Password reset successfully.</h3>
            </div>
            <div class="content">
                <div class="user_detail">

                    <p style="font-size: 16px;color:#525252;
                       text-align: center;">Dear <b>{{$fullname}}</b>, Your admin account password has been reset successfully, new password details are as below:</p>

                    <p style="font-size: 16px;color:#525252;
                       text-align: center;">
                        Email : {!!$email!!}
                    </p>
                    <p style="font-size: 16px;color:#525252;
                       text-align: center;">
                        New password : {!!$new_password!!}
                    </p>
                    <p class="text-align: center;margin-top: 20px;margin-bottom: 30px;">
                        <a style="color: #fff;
                           background: #1276b7;
                           text-decoration: none;
                           padding: 8px 18px;
                           border-radius: 0px;
                           font-size: 14px;
                           font-weight: bold;" href="{{$login_url}}">Click to Login</a>
                    </p>
                </div>
            </div>
            <div class="footer">
                <p style="font-weight: bold;">{{$site_name}}</p>
                <p style="font-weight: bold;">{{$phno1}}</p>
                <p class="email" style="text-decoration: none;">{{$dbemail}}</p>
            </div>
        </div>
    </center>
</body>
</html>

