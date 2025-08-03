<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Booking Receipt</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #222; }
        .header { text-align: center; margin-bottom: 30px; }
        .section { margin-bottom: 15px; }
        .label { font-weight: bold; width: 150px; display: inline-block; }
        .value { display: inline-block; }
        .box { border: 1px solid #ccc; border-radius: 8px; padding: 20px; max-width: 500px; margin: 0 auto; }
    </style>
</head>
<body>
    <div class="box">
        <div class="header">
            <h2>Mt. Magdiwata Eco Farm and Resort</h2>
            <h3>Booking Receipt</h3>
        </div>
        <div class="section"><span class="label">Name:</span> <span class="value">{{ $name }}</span></div>
        <div class="section"><span class="label">Email:</span> <span class="value">{{ $email }}</span></div>
        <div class="section"><span class="label">Adults:</span> <span class="value">{{ $adults }}</span></div>
        <div class="section"><span class="label">Children:</span> <span class="value">{{ $children }}</span></div>
        <div class="section"><span class="label">Room Type:</span> <span class="value">{{ $room_type }}</span></div>
        <div class="section"><span class="label">Check-in Date:</span> <span class="value">{{ $room_date }}</span></div>
        <div class="section"><span class="label">Check-out Date:</span> <span class="value">{{ $room_checkout }}</span></div>
        <div class="section"><span class="label">Activity:</span> <span class="value">{{ $activity }}</span></div>
        <div class="section"><span class="label">Activity Date:</span> <span class="value">{{ $activity_date }}</span></div>
        <div class="section"><span class="label">Special Requests:</span> <span class="value">{{ $notes }}</span></div>
        <div class="section" style="margin-top:30px; font-size:12px; color:#888;">Thank you for booking with us!</div>
    </div>
</body>
</html>
