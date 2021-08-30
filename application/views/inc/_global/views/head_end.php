    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" id="css-main" href="<?php echo $one->assets_folder; ?>/css/oneui.min.css">
    <?php if ($one->theme) { ?>
    <link rel="stylesheet" id="css-theme"
        href="<?php echo $one->assets_folder; ?>/css/themes/<?php echo $one->theme; ?>.min.css">
    <?php } ?>

    <style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
    </style>
    </head>

    <body>