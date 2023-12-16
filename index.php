<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Byr's News</title>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: linear-gradient(to right, #2E4374, #1D2951);
        }

        .start-container {
            text-align: center;
            color: white;
            margin-bottom: 13vh;
            margin-right: 5px;
        }

        .brand-name {
            position: relative;
            top: 25px;
            right : 8px;
            color: white;
            font-size: 46px;
            padding-bottom: 5px;
            margin: 0px 60px;
            font-weight: 800;
            letter-spacing: 3px;
            border-radius: 15%;
            text-shadow: #161616 1px 0 1px;
        }
        
        .brand-name:hover {
            text-shadow: #ccc 2px 0 1px;
        }

        .brand-name span {
            color: crimson;
        }

        h1 {
            text-shadow: #161616 2px 0 28px;
            color: white;
            font-size: 48px;
            margin-bottom: 20px;
        }

        p {
            font-weight: 500;
            color: #ccc;
            font-size: 24px;
            margin-bottom: 30px;
            text-shadow: #161616 2px 0 28px;
        }

        .start-button {
            font-weight: 500;
            display: inline-block;
            padding: 12px 24px;
            font-size: 19.5px;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            transition: background-color 0.3s;
        }

        .start-button:hover {
            background-color: #1D2951;
        }
    </style>
</head>

<body>
    <div class="start-container">
        <a class="gdrive" href="https://www.canva.com/design/DAF1WY-N3P4/tS7zC6gFbjl_8Jw0ybpsjA/edit?utm_content=DAF1WY-N3P4&utm_campaign=designshare&utm_medium=link2&utm_source=sharebutton"><i class='bx bxs-folder' style="color : white; font-size: 20px;">_PPT</i></a>
        <div class="brand-name">&copy;<b>BYR's <span>News</span></b></div>
        <h1>Welcome to Our News Portal</h1>
        <p>Stay informed with the latest academic summaries.</p>
        <a href="home.php" class="start-button">Explore News</a>
    </div>
</body>

</html>
