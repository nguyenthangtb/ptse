<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        h2 {
            color: #0056b3;
            border-bottom: 2px solid #0056b3;
            padding-bottom: 10px;
        }
        .info-item {
            margin-bottom: 15px;
        }
        .label {
            font-weight: bold;
            display: inline-block;
            width: 120px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Thông tin liên hệ mới</h2>
        <p>Bạn nhận được một yêu cầu liên hệ mới từ website:</p>
        
        <div class="info-item">
            <span class="label">Họ tên:</span> {{ $data['name'] }}
        </div>
        
        <div class="info-item">
            <span class="label">Email:</span> <a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a>
        </div>
        
        <div class="info-item">
            <span class="label">Số điện thoại:</span> <a href="tel:{{ $data['phone'] }}">{{ $data['phone'] }}</a>
        </div>
        
        <div class="info-item">
            <span class="label">Nội dung:</span>
            <p style="background-color: #f9f9f9; padding: 10px; border-radius: 4px; margin-top: 5px;">
                {{ $data['message'] }}
            </p>
        </div>
        
        <p style="font-size: 0.9em; color: #777; margin-top: 30px; border-top: 1px solid #eee; padding-top: 10px;">
            Email này được gửi tự động từ website.
        </p>
    </div>
</body>
</html>
