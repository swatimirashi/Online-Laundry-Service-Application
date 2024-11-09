<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
</head>
<body>
<style>
    body 
    {
        background-image: url('laundry4.jpg');
        background-attachment: fixed;
        background-size: cover;
        background-repeat: no-repeat;
    }

    .container 
    {
        text-align: center;
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        height:250px;
        width:450px;
        margin-left: 500px;
        margin-bottom:250px;
        margin-top:200px;
    }

    h1 
    {
        color: black;
        font-size: 30px;
        margin-bottom: 10px;
    }

    p 
    {
        color: gray;
        font-size: 18px;
        margin-bottom: 20px;
    }

    .click
    {
        height: 80px;
        margin-top: 30px;
    }
</style>
<div class="container">
    <img class="click" src="click1.jpg"></img>
    <h1>Thank You!</h1>
    <p>We'll keep you updated with pickup and delivery notifications.</p>
</div>
<audio id="notificationSound" src="tone.mp3"></audio>
<script>
    var audio = document.getElementById("notificationSound");
    audio.volume = 0.9; 
    audio.play();

    setTimeout(function() 
    {
        window.location.href = "myaccount.php";
    }, 2500);
</script>
</body>
</html>