<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="mask-icon" href="{{ asset('static/favicon/safari-pinned-tab.svg') }}" color="#f9941d">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('media/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('media/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('media/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('media/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('media/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('media/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('media/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('media/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('media/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('media/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('media/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('media/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('media/favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('media/favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/tailwindcss.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}">
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/style_landing_page.css') }}"> -->

    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/983b1bd0fa.js" crossorigin="anonymous"></script>

    <title>Welcome to BENU COUTURE</title>
</head>
<body class="landing-body">
    <header class="landing-header">
        <div class="header-bckgnd">
            <div class="header-bckgnd__font">
                <div class="header-bckgnd__moving header-bckgnd__moving--1">
                    <img src="{{ asset('landing/pictures/benu_landing_clouds_illustration.svg') }}" style="height: 100%;" />
                </div>
                <div class="header-bckgnd__moving header-bckgnd__moving--2">
                    <img src="{{ asset('landing/pictures/benu_landing_clouds_illustration.svg') }}" style="height: 100%;" />
                </div>
            </div>
            <div class="header-bckgnd__bird" id="header-bird-pic">
                <img src="{{ asset('landing/pictures/benu_landing_illustration.svg') }}" class="header-bckgnd__bird__img" />
            </div>
        </div>
        
        <div class="header_logo">
            <img src="{{ asset('landing/pictures/logo_benu_couture_blanc.svg') }}" class="header_logo__img" />
        </div>
        <div class="header_socialmedia">
            <p>
                <!-- <a href="https://www.facebook.com/benuvillageesch/" target="_blank"><i class="fab fa-facebook-f"></i></a> -->
                <a href="{{ route('landing') }}" class="hover:underline @if(Route::currentRouteName() == 'landing') underline @endif">FR</a>
            </p>
            <p>
                <!-- <a href="https://www.instagram.com/benu_village/" target="_blank"><i class="fab fa-instagram"></i></a> -->
                <a href="{{ route('landing-lu') }}" class="hover:underline @if(Route::currentRouteName() == 'landing-lu') underline @endif">LU</a>
            </p>
            <p>
                <!-- <a href="https://lu.linkedin.com/company/benu-village-esch" target="_blank"><i class="fab fa-linkedin-in"></i></a> -->
                <a href="{{ route('landing-de') }}" class="hover:underline @if(Route::currentRouteName() == 'landing-de') underline @endif">DE</a>
            </p>
            <p>
                <!-- <a href="https://lu.linkedin.com/company/benu-village-esch" target="_blank"><i class="fab fa-linkedin-in"></i></a> -->
                <a href="{{ route('landing-en') }}" class="hover:underline @if(Route::currentRouteName() == 'landing-en') underline @endif">EN</a>
            </p>
        </div>
    </header>

    <main>
        <section class="pattern_bg">
            <div class="central_col">
                <div class="central_textbox">
                    <div class="central_textbox__teaser">
                        <p>
                            Soon....
                        </p>
                    </div>
                    <h1>BENU COUTURE</h1>
                    <p class="central_textbox__sub">
                        Website launch: 2nd quarter 2022
                    </p>
                    <p class="central_textbox__desc">
                        Two pairs of jeans that you no longer want? A jumper you love but no longer fits? <strong>BENU COUTURE</strong> is the first UpCycling tailor shop in Luxembourg that produces its imaginative and unique creations on site from local clothing donations. Our team of professional tailors and designers works hard every day to create the most beautiful combinations and unique products for you, using outstanding quality fabrics: Composed mainly of natural materials, they offer the highest quality and durability.
                    </p>
                    <p class="central_textbox__desc">
                        Our creations are handmade and do not undergo any chemical treatment. <strong>BENU COUTURE</strong> also offers to patch up your favourite pieces or to integrate them into a new, personal creation just for you.
                    </p>
                    <ul class="central_textbox__desc">
                        <li><strong>BENU COUTURE</strong></li>
                        <li class="text-left flex">
                            <p class="pr-2 pt-2 lg:pt-3">@svg('list_cintre')</p>
                            <p> designs and produces unique upcycled fashion locally,
                            </p>
                        </li>
                        <li class="text-left flex">
                            <p class="pr-2 pt-2 lg:pt-3">@svg('list_cintre')</p>
                            <p> offers a wide range of sizes from XS to 5XL as well as wonders for our youngest,
                            </p>
                        </li>
                        <li class="text-left flex">
                            <p class="pr-2 pt-2 lg:pt-3">@svg('list_cintre')</p>
                            <p> repairs and transforms according to your individual ideas: Colour change, design, size, ...,
                            </p>
                        </li>
                        <li class="text-left flex">
                            <p class="pr-2 pt-2 lg:pt-3">@svg('list_cintre')</p>
                            <p> raises awareness for the problems of today's fashion industry, takes a stand and discusses topics related to sustainable clothing.
                            </p>
                        </li>
                    </ul>
                    <p class="central_textbox__desc">
                        <strong>BENU COUTURE</strong> is waiting for its own website couture.benu.lu (probably by end of May 2022).
                    </p>
                </div>
                <div class="contact-form-container">
                    <div>
                        <h2 class="text-center mb-6">
                            Keep in touch
                        </h2>
                        <!-- <div>
                            <form method="POST" class="contact_form">
                                <input type="email" name="newsletter_email" placeholder="Je m'inscris à la newsletter">
                                <input type="submit" name="newsletter_btn" value="Je m'inscris">
                            </form>
                        </div> -->
                        <div class="contact-link text-center">
                            <a href="https://benu.lu/fr/contactez-nous/" class="btn-couture-plain btn-couture-plain--dark-hover" target="_blank">I subscribe to the newsletter</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="universe">
            <div class="text-center">
                <h2>
                    The BENU universe
                </h2>
                <div class="universe__links">
                    <div>
                        <a href="https://www.benureuse.lu/en/" class="btn-large btn-yellow" target="_blank">BENU REUSE</a>
                    </div>
                    <div>
                        <a href="https://benu.lu/en/" class="btn-large btn-green" target="_blank">BENU VILLAGE</a>
                    </div>
                </div>
            </div>
        </section>

        <footer class="landing-footer">
            <div class="landing-footer__links">
                <div class="landing-footer__links__header-container">
                    <div class="landing-footer__links__header">
                        Follow us on
                    </div>
                </div>
                <div class="landing-footer__links__icons">
                    <a href="https://www.facebook.com/benuvillageesch/" target="_blank" class="landing-footer__links__icon">
                        <!-- <a href="https://www.facebook.com/benuvillageesch/" target="_blank"><i class="fab fa-facebook-f"></i></a> -->
                        <p>
                            <i class="fab fa-facebook-f"></i>
                        </p>
                    </a>
                    <a href="https://www.instagram.com/benu_village/" target="_blank" class="landing-footer__links__icon">
                        <!-- <a href="https://www.instagram.com/benu_village/" target="_blank"><i class="fab fa-instagram"></i></a> -->
                        <p>
                            <i class="fab fa-instagram"></i>
                        </p>
                    </a>
                    <a href="https://lu.linkedin.com/company/benu-village-esch" target="_blank" class="landing-footer__links__icon">
                        <p>
                            <i class="fab fa-linkedin-in"></i>
                        </p>
                        <!-- <a href="https://lu.linkedin.com/company/benu-village-esch" target="_blank"><i class="fab fa-linkedin-in"></i></a> -->
                    </a>
                </div>
            </div>
            <div class="text-center landing-footer__copyright">
                &#169; 2022 - Design: Kamoo Studio <br/> & Development: BENU Village Esch asbl
            </div>
        </footer>
    </main>

    <!-- No layout to reduce weight, cannot use js from app  -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(function() {
            let width = window.innerWidth;
            if (width >= 1024) {
                let newTop = '130px';
                $('#header-bird-pic').css('top', newTop);
                setInterval(function() {
                    if(window.innerWidth >= 1024) {
                        newTop = 60 + 150*Math.random();
                        newTop += 'px';
                        $('#header-bird-pic').css('top', newTop);
                    } else {
                        newTop = '80px';
                        $('#header-bird-pic').css('top', newTop);
                    }
                }, 2500);
            }
        });
    </script>
</body>
</html>