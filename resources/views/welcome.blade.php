<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Six Idiots</title>

    <style>
        html {
            font-size: 62.5%;
        }
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #000;
            font-size: 1.6rem;
            font-family: sans-serif;
        }

        h1 {
            position: relative;
            text-transform: uppercase;
            font-size: 5rem;
            letter-spacing: 4px;
            overflow: hidden;
            background: linear-gradient(90deg, #000, #fff, #000);
            background-repeat: no-repeat;
            background-size: 80%;
            animation: glowing 2s linear infinite;
            -webkit-background-clip: text;
            -webkit-text-fill-color: rgba(255, 255, 255, 0);
        }

        @keyframes glowing {
            0% {
                background-position: -500%;
            }
            100% {
                background-position: 500%;
            }
        }
    </style>
</head>
<body>
    <h1>Six Idiots</h1>
</body>
</html>
