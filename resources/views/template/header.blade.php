<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link rel="stylesheet" type="text/css" media="screen" href="/css/perfect-scrollbar.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="/css/style.css">
    <link defer="" rel="stylesheet" type="text/css" media="screen" href="/css/animate.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="/js/perfect-scrollbar.min.js"></script>
    <script defer="" src="/js/popper.min.js"></script>
    <script defer="" src="/js/tippy-bundle.umd.min.js"></script>
    <script defer="" src="/js/sweetalert.min.js"></script>
    <style scoped="">
        /* range picker */

        input[type='range']::-webkit-slider-runnable-track {
            width: 100%;
            height: 8px;
            background: #dee2e6;
            border: none;
            border-radius: 3px;
        }

        input[type='range']::-webkit-slider-thumb {
            -webkit-appearance: none;
            border: none;
            height: 16px;
            width: 16px;
            border-radius: 50%;
            background: #4361ee;
            margin-top: -4px;
        }

        .dark input[type='range']::-webkit-slider-runnable-track {
            background: #1b2e4b;
        }

        .dark input[type='range'] {
            background-color: transparent;
        }

        input[type='range']:focus {
            outline: none;
        }

        input[type='range']:active::-webkit-slider-thumb {
            background: #4361eec2;
            cursor: pointer;
        }

        body {
            background-image: url('{{ $backgroundImage }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: 'Times New Roman', Times, serif;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8);
            /* Menambahkan transparansi untuk membuat form lebih mudah dibaca */
            padding: 20px;
            border-radius: 10px;
            margin-top: 50px;
        }
    </style>
