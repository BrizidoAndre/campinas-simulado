<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('styles.css')}}">
    <title>Taiwan Explorer</title>
</head>
<body>
{{--    header starts--}}
<header class="website-header">
    <img src="{{asset('assets/images/logo.svg')}}" alt="Taiwan Explorer's logo" class="logo-website">
    <nav>
        <ul class="list-unstyled list-website">
            @session('info')
            <li class="nav-link-item info-user">{{$value}}</li>
            @endsession
            <li class="nav-link-item"><a class="nav-link" href="#guide">Regional Guide</a></li>
            <li class="nav-link-item"><a class="nav-link" href="#experiences">Experiences</a></li>
            <li class="nav-link-item"><a class="nav-link" href="#pratical">Pratical Information</a></li>
            <li class="nav-link-item"><a class="nav-link" href="#essential">Essential Information</a></li>
            <li class="nav-link-item"><a class="nav-link" href="#contact">Contact</a></li>
        </ul>
    </nav>
</header>
{{--    header ends ends--}}
{{--    main start--}}
<main class="website-main">
    {{--    hero section starts--}}
    <section id="hero">
        <picture>
            <source srcset="{{asset('assets/images/taiwan-cover.jpg')}}" media="(width >= 760px)"/>
            <img class="image-hero" src="{{asset('assets/images/taiwan-cover-low-res.jpg')}}"
                 alt="Hero cover with low resolution"/>
        </picture>
        <h1 class="title white">Taiwan Small Island, Big Adventures</h1>
        <p class="white">From marble gorges to neon nights-discover four regions, countless experiences.</p>
        <a href="#guide" class="btn btn-hero">
            Explore Regions
            &rarr;
        </a>
    </section>
    {{--    hero section ends--}}
    {{--    guide section starts--}}
    <section id="guide" class="margin-horizontal">
        <h2>Regional Guide</h2>
        <p>Click a region on the map to explore.</p>
        <div class="grid-map">
            <div class="container-map">
                <img src="{{asset('assets/images/taiwan-map.svg')}}" alt="Map of taiwan" class="image-map">
                <div class="grid-btn-map">
                    <button class="btn-none north"></button>
                    <button class="btn-none east"></button>
                    <button class="btn-none central"></button>
                    <button class="btn-none south"></button>
                </div>
            </div>
            <div class="grid-regions">
                <div class="card-region card-region-selected">
                    <div class="row jc-sb">
                        <h3>North</h3>
                        <span class="ball ball-green"></span>
                    </div>
                    <p>Urban energy & nature: Taipei 101, night markets, Jufen's old streets, Yehliu's unique
                        geology.</p>
                    <ul class="list-region">
                        @foreach(\App\Models\Attraction::where('region_id',1)->get() as $atraction)
                            <li>
                                <div>
                                    <img class="list-region-pin" src="{{asset('assets/icons/icon-pin.svg')}}"
                                         alt="Pin of list">
                                    <span class="bolder">{{$atraction->name}}</span>: {{$atraction->description}}
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-region">
                    <div class="row jc-sb">
                        <h3>Central</h3>
                        <span class="ball ball-blue"></span>
                    </div>
                    <p>
                        Misty mountains & lakes: Sun Moon Lake cycling, Taichung art, Alishan sunrise forests.
                    </p>
                    <ul class="list-region">
                        @foreach(\App\Models\Attraction::where('region_id',2)->get() as $atraction)
                            <li>
                                <img class="list-region-pin" src="{{asset('assets/icons/icon-pin.svg')}}"
                                     alt="Pin of list">
                                <span class="bolder">{{$atraction->name}}</span>:
                                {{$atraction->description}}
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-region">
                    <div class="row jc-sb">
                        <h3>South</h3>
                        <span class="ball ball-orange"></span>
                    </div>
                    <p>
                        Historic flavors & beaches: Tainan temples, Kaohsiung harbor art, Kenting's tropical coast.
                    </p>
                    <ul class="list-region">
                        @foreach(\App\Models\Attraction::where('region_id',3)->get() as $atraction)
                            <li>
                                <img class="list-region-pin" src="{{asset('assets/icons/icon-pin.svg')}}"
                                     alt="Pin of list">
                                <span class="bolder">{{$atraction->name}}</span>:
                                {{$atraction->description}}
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-region">
                    <div class="row jc-sb">
                        <h3>East</h3>
                        <span class="ball ball-purple"></span>
                    </div>
                    <p>
                        Wild coasts & gorges: Taroko marble cliffs, Hualien ocean vistas, Taitung hot air vibes.
                    </p>
                    <ul class="list-region">
                        @foreach(\App\Models\Attraction::where('region_id',4)->get() as $atraction)
                            <li>
                                <img class="list-region-pin" src="{{asset('assets/icons/icon-pin.svg')}}"
                                     alt="Pin of list">
                                <span class="bolder">{{$atraction->name}}</span>:
                                {{$atraction->description}}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
    {{--    guide section ends--}}
    {{--    experiencers section starts--}}
    <section id="experiences" class="margin-horizontal">
        <div class="row jc-sb">
            <h2>Cultural & Culinary Experiences</h2>
            <div class="row container-btn-experiences shadow">
                <button class="btn btn-experience btn-experience-selected">Cultural</button>
                <button class="btn btn-experience ">Culinary</button>
            </div>
        </div>
        <div class="experience-cultural shadow">
            <div class="experience-container-slide shadow">
                <div class="experience-slide">
                    <div class="container-experience">
                        <div class="container-experience-image">
                            <picture>
                                <source srcset="{{asset('assets/images/cultural-1.jpg')}}" media="(width >= 760px)"/>
                                <img class="image-experience" src="{{asset('assets/images/cultural-1-low-res.jpg')}}"
                                     alt="Hero cover with low resolution"/>
                            </picture>
                            <p class="experience-label">Cultural - Template Etiquette Walk</p>
                        </div>
                        <div class="container-experience-text">
                            <h3 class="experience-title">Temple Etiquette Walk</h3>
                            <p>Learn incense rituals, fortune sticks, and local customs.</p>
                            <button class="btn btn-experience">Ask about this experience &rarr;</button>
                        </div>
                    </div>
                </div>
                <div class="experience-slide">
                    <div class="container-experience">
                        <div class="container-experience-image">
                            <picture>
                                <source srcset="{{asset('assets/images/cultural-2.jpg')}}" media="(width >= 760px)"/>
                                <img class="image-experience" src="{{asset('assets/images/cultural-2-low-res.jpg')}}"
                                     alt="Hero cover with low resolution"/>
                            </picture>
                            <p class="experience-label">Cultural - Aboriginal Crafts</p>
                        </div>
                        <div class="container-experience-text">
                            <h3 class="experience-title">Aboriginal Crafts</h3>
                            <p>Textiles & woodcrafts with indigenous artisans.</p>
                            <button class="btn btn-experience">Ask about this experience &rarr;</button>
                        </div>
                    </div>
                </div>
                <div class="experience-slide">
                    <div class="container-experience">
                        <div class="container-experience-image">
                            <picture>
                                <source srcset="{{asset('assets/images/cultural-3.jpg')}}" media="(width >= 760px)"/>
                                <img class="image-experience" src="{{asset('assets/images/cultural-3-low-res.jpg')}}"
                                     alt="Cultural 3 image resolution"/>
                            </picture>
                            <p class="experience-label">Cultural - Tea Ceremony in Alishan</p>
                        </div>
                        <div class="container-experience-text">
                            <h3 class="experience-title">Tea Ceremony in Alishan</h3>
                            <p>Savor high-mountain oolongs and brewing technique.</p>
                            <button class="btn btn-experience">Ask about this experience &rarr;</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="experience-culinary d-none">
            <div class="experience-slide">
                <div class="container-experience">
                    <div class="container-experience-image">
                        <picture>
                            <source srcset="{{asset('assets/images/culinary-1.jpg')}}" media="(width >= 760px)"/>
                            <img class="image-experience" src="{{asset('assets/images/culinary-1-low-res.jpg')}}"
                                 alt="Culinary 1 image resolution"/>
                        </picture>
                        <p class="experience-label">Culinary - Night Market Tasting</p>
                    </div>
                    <div class="container-experience-text">
                        <h3 class="experience-title">Night Market Tasting</h3>
                        <p>Stinky tofu, bubble tea, oyster omelets & more.</p>
                        <button class="btn btn-experience">Ask about this experience &rarr;</button>
                    </div>
                </div>
            </div>
            <div class="experience-slide">
                <div class="container-experience">
                    <div class="container-experience-image">
                        <picture>
                            <source srcset="{{asset('assets/images/culinary-2.jpg')}}" media="(width >= 760px)"/>
                            <img class="image-experience" src="{{asset('assets/images/culinary-2-low-res.jpg')}}"
                                 alt="Culinary 2 image resolution"/>
                        </picture>
                        <p class="experience-label">Culinary - Sea-to-Table in Hualien</p>
                    </div>
                    <div class="container-experience-text">
                        <h3 class="experience-title">Sea-to-Table in Hualien</h3>
                        <p>Fresh catch, coastal views, local recipes.</p>
                        <button class="btn btn-experience">Ask about this experience &rarr;</button>
                    </div>
                </div>
            </div>
            <div class="experience-slide">
                <div class="container-experience">
                    <div class="container-experience-image">
                        <picture>
                            <source srcset="{{asset('assets/images/culinary-3.jpg')}}" media="(width >= 760px)"/>
                            <img class="image-experience" src="{{asset('assets/images/culinary-3-low-res.jpg')}}"
                                 alt="Culinary 3 image resolution"/>
                        </picture>
                        <p class="experience-label">Culinary - Pineapple Cake Workshop</p>
                    </div>
                    <div class="container-experience-text">
                        <h3 class="experience-title">Pineapple Cake Workshop</h3>
                        <p>Bake iconic treats to bring home.</p>
                        <button class="btn btn-experience">Ask about this experience &rarr;</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--    experiencers section ends--}}
    {{--    pratical section starts--}}
    <section id="pratical" class="margin-horizontal">
        <h2>Pratical Information</h2>
        <p>Pack the essentials-travel made simple.</p>
        <div class="row jc-fs">
            <div class="row container-btn-pratical shadow">
                <button class="btn btn-pratical btn-pratical-selected">transportation</button>
                <button class="btn btn-pratical">transportation</button>
                <button class="btn btn-pratical">transportation</button>
            </div>
        </div>
    </section>
    {{--    pratical section ends--}}
    {{--    essential section start--}}
    <section id="essential" class="margin-horizontal">
        <h2>Essential Information</h2>
        <p>Official support and key contacts for your trip to Taiwan.</p>
        <div class="grid-essential">
            <div class="shadow card-essential">
                <h3 class="title-card-essential">
                    <img src="{{asset('assets/icons/icon-bag.svg')}}" alt="Icon of a bag" class="title-card-icon">
                    Taiwan Tourism Bureau
                </h3>
                <ul class="list-unstyled list-essential">
                    <li class="item-essential">
                        <img class="icon-item-essential" src="{{asset('assets/icons/icon-bag.svg')}}"
                             alt="icon of a bag">
                        +886-2-0000-0000
                    </li>
                    <li class="item-essential">
                        <img class="icon-item-essential" src="{{asset('assets/icons/icon-globe.svg')}}"
                             alt="Internet icon">
                        info@example.com
                    </li>
                    <li class="item-essential">
                        <img class="icon-item-essential" src="{{asset('assets/icons/icon-globe.svg')}}"
                             alt="Internet icon">
                        example.com
                    </li>
                </ul>
                <div class="row">
                    <button class="btn btn-essential btn-play">
                        <img class="icon-btn-essential" src="{{asset('assets/icons/icon-youtube-white.svg')}}"
                             alt="Youtube's icon">
                        Read aloud
                    </button>
                    <button class="btn btn-essential btn-pause shadow">
                        &squarf;
                        Stop
                    </button>
                </div>
            </div>
            <div class="shadow card-essential">
                <h3 class="title-card-essential">
                    <img src="{{asset('assets/icons/icon-globe.svg')}}" alt="Globe icon" class="title-card-icon">
                    Official Website QR
                </h3>
                <div class="row container-code">
                    <img src="{{asset('assets/images/qr-code.png')}}" alt="QR code of the website" class="code">
                    <div>
                        <p>Scan to visit the official tourism website.</p>
                        <a href="" class="link-website">Open Website &rarr;</a>
                    </div>
                </div>
            </div>
            <div class="shadow card-essential">
                <h3 class="title-card-essential">
                    📞Emergency & Safety Contacts
                </h3>
                <ul class="list-unstyled">
                    <li>
                        📞 <span class="bolder">Police:</span> 000
                    </li>
                    <li>
                        📞 <span class="bolder">Fire/Ambulance:</span> 000
                    </li>
                    <li>
                        📞 <span class="bolder">Tourism Hotline:</span> 0800-000-000
                    </li>
                </ul>
            </div>
        </div>
        <div class="shadow card-essential card-essential-download">
            <h3 class="title-card-essential">Downloadable Travel Guide</h3>
            <p>Comprehensive PDF guide with maps, itineraries, and essential tips for you Taiwan adventure.</p>
            <a class="btn btn-primary btn-download" download href="{{asset('assets/pdf/taiwan-travel-guide.pdf')}}">
                &rarr;
                Download Travel Guide (PDF)
            </a>
        </div>
    </section>
    {{--    essential section ends--}}
    {{--    contact section start--}}
    <section id="contact" class="margin-horizontal margin-bigger">
        <h2>Travel Consultation</h2>
        <p>Get personalized recommendations for your Taiwan adventure.</p>
        <form action="" class="form-contact shadow" method="post">
            @csrf
            <div class="row-input">
                <div class="container-input">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-input" placeholder="Your full name" id="name" name="name">
                </div>
                <div class="container-input">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-input" placeholder="you@example.com" id="email" name="email">
                </div>
            </div>
            <div class="row-input">
                <div class="container-input">
                    <label for="country" class="form-label">Country</label>
                    <input type="text" class="form-input" placeholder="Where are you based?" id="country"
                           name="country">
                </div>
                <div class="container-input">
                    <label for="interests" class="form-label">Interests</label>
                    <input type="text" class="form-input" name="interests"
                           id="interests"
                           placeholder="Culture, food, nature, beaches"
                    >
                </div>
            </div>
            <div class="container-input">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-input" name="message" id="message" rows="6"
                          placeholder="Tell us about your dream Taiwan trip!"></textarea>
            </div>
            <div class="row jc-fe">
                <button class="btn btn-submit">Submit</button>
            </div>
        </form>
    </section>
    {{--    contact section ends--}}
</main>
{{--    main ends--}}
{{--footer start--}}
<footer class="website-footer margin-horizontal">
    <div class="row jc-sb">
        <img src="{{asset('assets/images/logo.svg')}}" alt="Taiwan Explorer's logo" class="logo-website">
        <ul class="list-unstyled list-footer">
            <li><img aria-label="Icon press" src="{{asset('assets/icons/icon-facebook.svg')}}" alt="Facebook's logo"
                     class="icon-footer"></li>
            <li><img aria-label="Icon press" src="{{asset('assets/icons/icon-instagram.svg')}}" alt="Instagram's logo"
                     class="icon-footer"></li>
            <li><img aria-label="Icon press" src="{{asset('assets/icons/icon-youtube.svg')}}" alt="Youtube's logo"
                     class="icon-footer"></li>
        </ul>
    </div>
    <hr class="footer">
    <div class="container-copyright row jc-sb">
        <p>© 2025 Taiwan Explorer</p>
        <div class="row row-footer">
            <a class="footer-link privacy-link" href="">Privacy Policy</a>
            <a class="footer-link" href="">Terms and Condition</a>
        </div>
    </div>
</footer>
{{--footer end--}}
<script src="{{asset('script.js')}}"></script>
</body>
</html>
