<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập hệ thống - Lab OAuth</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7f6; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-card { background: #fff; padding: 40px; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); text-align: center; width: 100%; max-width: 380px; }
        h2 { color: #333; margin-bottom: 8px; }
        p { color: #777; font-size: 14px; margin-bottom: 30px; }
        .btn { display: flex; align-items: center; justify-content: center; padding: 12px; margin-bottom: 16px; border-radius: 6px; text-decoration: none; font-weight: 600; transition: all 0.3s ease; border: 1px solid transparent; }
        .btn-google { background-color: #fff; color: #555; border-color: #ddd; }
        .btn-google:hover { background-color: #f8f8f8; border-color: #ccc; }
        .btn-facebook { background-color: #1877F2; color: #fff; }
        .btn-facebook:hover { background-color: #166fe5; }
        .btn img { width: 20px; margin-right: 12px; }
        .footer { margin-top: 25px; border-top: 1px solid #eee; padding-top: 15px; font-size: 13px; color: #999; }
    </style>
</head>
<body>
    <div class="login-card">
        <h2>Đăng nhập</h2>
        <p>Vui lòng chọn phương thức xác thực</p>

        <a href="{{ url('auth/google') }}" class="btn btn-google">
            <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" alt="Google">
            Tiếp tục với Google
        </a>

        <a href="{{ url('auth/facebook') }}" class="btn btn-facebook">
            <img src="https://upload.wikimedia.org/wikipedia/commons/b/b8/2021_Facebook_icon.svg" style="filter: brightness(0) invert(1);" alt="Facebook">
            Tiếp tục với Facebook
        </a>

        <div class="footer">
            Sinh viên thực hiện: <strong>Nguyễn Trọng An</strong>
        </div>
    </div>
</body>
</html>