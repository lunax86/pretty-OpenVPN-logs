<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--meta name="viewport" content="width=device-width, initial-scale=1.0"-->
    <meta content="width=1050" name="viewport">

    <title><?= $head['title'] ?></title>

    <meta name="description" content="<?= $head['description'] ?>" />
    <meta name="rating" content="<?= $head['rating'] ?>" />
    <meta name="distribution" content="<?= $head['distribution'] ?>" />
    <meta name="company" content="<?= $head['company'] ?>" />

    <link rel="icon" type="image/png" href="/icon/favicon.ico"/>

    <link rel="stylesheet" href="/css/main.min.css">
</head>
<body>
    
    <div id="loader" class="show">
        <img src="/img/mouse.jpg" alt="" width="300" height="240">
        <p>Loading ...</p>
    </div>

    <div id="tooltip"></div>

    <header>

        <div class="header-containder">

            <h1 class="title"><strong><?= $vpnName ?> Logs </strong> <span id="last-update"></span></h1>

            <div class="options">

            <div class="select-box" id="color-scheme">
                <div class="select">
                    <div class="select-title"><span>Color Scheme</span>
                        <div class="arrow"></div>
                    </div>
                    <ul class="select-options">
                        <li class="select-option" data-value="theme06">[Default] Blue Latte</li>
                        <li class="select-option" data-value="theme01">[Light] Summer</li>
                        <li class="select-option" data-value="theme02">[Light] Frozen Lake</li>
                        <li class="select-option" data-value="theme03">[Dark] Submarine</li>
                        <li class="select-option" data-value="theme04">[Dark] Night Sky</li>
                        <li class="select-option" data-value="theme05">[Light] Forest</li>
                        <li class="select-option" data-value="theme07">[Light] Cherry</li>

                    </ul>
                </div>
            </div>

            <div class="select-box" id="date-format">
                <div class="select">
                    <div class="select-title"><span>Date Format</span>
                        <div class="arrow"></div>
                    </div>
                    <ul class="select-options">
                        <li class="select-option" data-value="robot">Robot</li>
                        <li class="select-option" data-value="en">English</li>
                        <li class="select-option" data-value="cz">Czech</li>
                    </ul>
                </div>
            </div>            

            </div>
        </div>

    </header>

    <section>

        <h2><?= $vpnName ?> Status</h2>
        <div id="status" class="table-wrapper">
            ...
        </div>

        <h2><?= $vpnName ?> Journal</h2>
        <div id="journal" class="tabs-wrapper">
            ...
        </div>

    </section>

    <script src="/js/main.min.js"></script> 
</body>
</html>