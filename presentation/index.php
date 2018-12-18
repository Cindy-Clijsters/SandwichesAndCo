<!DOCTYPE html>
<html lang="nl">
<head>
    <title>{{ company.name }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ company.name }}" />
    <meta name="keywords" content="{{ company.name }}, sandwiches, take away" />
    <meta name="author" content="Cindy Clijsters" />

    {{ include('includes/stylesheet.php') }}

</head>
<body class="bg-white" data-spy="scroll" data-target="#ftco-navbar-spy" data-offset="0">

    <div class="site-wrap">

        <nav class="site-menu" id="ftco-navbar-spy">
            <div class="site-menu-inner" id="ftco-navbar">
                <ul class="list-unstyled">
                    <li><a href="#section-home">Home</a></li>
                    <li><a href="#section-about">Over ons</a></li>
                    <li><a href="#section-menu">Ons menu</a></li>
                    <li><a href="#section-contact">Contact</a></li>
                </ul>
            </div>
        </nav>
        
        {{ include('includes/siteHeader.php') }}

        <div class="main-wrap " id="section-home">

            {{ include('includes/imageHeader.php') }}

            <div class="section pb-3 bg-white" id="section-about" data-aos="fade-up">
                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-12 col-lg-8 section-heading">
                            <h2 class="heading mb-5">Over ons</h2>
                            {{ company.aboutUs|raw }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="section bg-white pt-2 pb-2 text-center" data-aos="fade">
                <p><img src="assets/img/bg_hero.png" alt="Sfeer foto" class="img-fluid"></p>
            </div>

            <div class="section bg-light" id="section-menu" data-aos="fade-up">
                <div class="container">
                    <div class="row section-heading justify-content-center mb-5">
                        <div class="col-md-8 text-center">
                            <h2 class="heading mb-3">Ons menu</h2>
                        </div>
                    </div>
                    
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <ul class="nav site-tab-nav" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-breakfast-tab" data-toggle="pill" href="#pills-breakfast" role="tab" aria-controls="pills-breakfast" aria-selected="true">Categorie 1</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-lunch-tab" data-toggle="pill" href="#pills-lunch" role="tab" aria-controls="pills-lunch" aria-selected="false">Categorie 2</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-dinner-tab" data-toggle="pill" href="#pills-dinner" role="tab" aria-controls="pills-dinner" aria-selected="false">Categorie 3</a>
                                </li>
                            </ul>                
                            
                            <div class="tab-content" id="pills-tabContent">
                                
                                <div class="tab-pane fade show active" id="pills-breakfast" role="tabpanel" aria-labelledby="pills-breakfast-tab">
                                    <div class="d-block d-md-flex menu-food-item">
                                        <div class="text order-1 mb-3">
                                            <img src="assets/img/img_1.jpg" alt="Lorem ipsum">
                                            <h3><a href="#">Lorem ipsum</a></h3>
                                            <p>Dolor sit amet, consectetur adipiscing elit</p>
                                        </div>
                                        <div class="price order-2">
                                            <strong>€ 99,99</strong>
                                        </div>
                                    </div>

                                    <div class="d-block d-md-flex menu-food-item">
                                        <div class="text order-1 mb-3">
                                            <img src="assets/img/img_2.jpg" alt="Maecenas elementum">
                                            <h3><a href="#">Maecenas elementum</a></h3>
                                            <p>Leo sed mi faucibus, quis semper augue vulputate</p>
                                        </div>
                                        <div class="price order-2">
                                            <strong>€ 99,99</strong>
                                        </div>
                                    </div>

                                    <div class="d-block d-md-flex menu-food-item">
                                        <div class="text order-1 mb-3">
                                            <img src="assets/img/img_3.jpg" alt="Integer eget">
                                            <h3><a href="#">Integer eget</a></h3>
                                            <p>Nnibh sollicitudin, tincidunt magna nec, ultricies mauris. Mauris in lacus ac risus interdum hendrerit vel at erat.</p>
                                        </div>
                                        <div class="price order-2">
                                            <strong>€ 99,99</strong>
                                        </div>
                                    </div>

                                    <div class="d-block d-md-flex menu-food-item">
                                        <div class="text order-1 mb-3">
                                            <img src="assets/img/img_1.jpg" alt="Donec tincidunt magna">
                                            <h3><a href="#">Donec tincidunt magna</a></h3>
                                            <p>Nullam placerat metus quis nibh dictum, in sollicitudin mi imperdiet.</p>
                                        </div>
                                        <div class="price order-2">
                                        <strong>€ 99,99</strong>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="tab-pane fade" id="pills-lunch" role="tabpanel" aria-labelledby="pills-lunch-tab">

                                    <div class="d-block d-md-flex menu-food-item">
                                        <div class="text order-1 mb-3">
                                            <img src="assets/img/img_2.jpg" alt="Morbi dictum">
                                            <h3><a href="#">Morbi dictum</a></h3>
                                            <p>Nunc facilisis purus eu blandit faucibus.</p>
                                        </div>
                                        <div class="price order-2">
                                            <strong>€ 99,99</strong>
                                        </div>
                                    </div>

                                    <div class="d-block d-md-flex menu-food-item">
                                        <div class="text order-1 mb-3">
                                            <img src="assets/img/img_1.jpg" alt="Nunc eleifend">
                                            <h3><a href="#">Nunc eleifend</a></h3>
                                            <p>Ut venenatis ex vel porta cursus. Fusce tincidunt tellus vitae iaculis tempus.</p>
                                        </div>
                                        <div class="price order-2">
                                            <strong>€ 99,99</strong>
                                        </div>
                                    </div>

                                    <div class="d-block d-md-flex menu-food-item">
                                        <div class="text order-1 mb-3">
                                            <img src="assets/img/img_3.jpg" alt="Pellentesque dictum">
                                            <h3><a href="#">Pellentesque dictum</a></h3>
                                            <p>Vivamus convallis nulla sit amet tortor fermentum, vel malesuada massa placerat.</p>
                                        </div>
                                        <div class="price order-2">
                                            <strong>€ 99,99</strong>
                                        </div>
                                    </div>

                                    <div class="d-block d-md-flex menu-food-item">
                                        <div class="text order-1 mb-3">
                                            <img src="assets/img/img_2.jpg" alt="Praesent consequat">
                                            <h3><a href="#">Praesent consequat</a></h3>
                                            <p>Pellentesque condimentum sem ac ex consectetur, non facilisis elit lacinia.</p>
                                        </div>
                                        <div class="price order-2">
                                            <strong>€ 99,99</strong>
                                        </div>
                                    </div>

                                </div>
                                
                                <div class="tab-pane fade" id="pills-dinner" role="tabpanel" aria-labelledby="pills-dinner-tab">

                                    <div class="d-block d-md-flex menu-food-item">
                                        <div class="text order-1 mb-3">
                                            <img src="assets/img/img_3.jpg" alt="Curabitur pellentesque">
                                            <h3><a href="#">Curabitur pellentesque</a></h3>
                                            <p>Nullam porttitor risus sollicitudin, pretium risus nec, fermentum purus.</p>
                                        </div>
                                        <div class="price order-2">
                                            <strong>€ 99,99</strong>
                                        </div>
                                    </div>

                                    <div class="d-block d-md-flex menu-food-item">
                                        <div class="text order-1 mb-3">
                                            <img src="assets/img/img_1.jpg" alt="Fusce ut erat rhoncus">
                                            <h3><a href="#">Fusce ut erat rhoncus</a></h3>
                                            <p>Donec efficitur arcu vel nunc mollis, eget interdum massa bibendum.</p>
                                        </div>
                                        <div class="price order-2">
                                            <strong>€ 99,99</strong>
                                        </div>
                                    </div>

                                    <div class="d-block d-md-flex menu-food-item">
                                        <div class="text order-1 mb-3">
                                            <img src="assets/img/img_2.jpg" alt="Aliquam semper">
                                            <h3><a href="#">Aliquam semper</a></h3>
                                            <p>Curabitur ac purus vitae dui dignissim consequat.</p>
                                        </div>
                                        <div class="price order-2">
                                            <strong>€ 99,99</strong>
                                        </div>
                                    </div>

                                    <div class="d-block d-md-flex menu-food-item">
                                        <div class="text order-1 mb-3">
                                            <img src="assets/img/img_3.jpg" alt="Etiam placerat">
                                            <h3><a href="#">Etiam placerat</a></h3>
                                            <p>Nulla varius lectus nec maximus iaculis. Vivamus pretium massa et vulputate vulputate.</p>
                                        </div>
                                        <div class="price order-2">
                                            <strong>€ 99,99</strong>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section" data-aos="fade-up" id="section-contact">
                <div class="container">
                    <div class="row section-heading justify-content-center mb-5">
                        <div class="col-md-8 text-center">
                            <h2 class="heading mb-3">Contact</h2>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-10 p-5 form-wrap">
                            <form action="#">
                                <div class="row mb-4">
                                    <div class="form-group col-md-4">
                                        <label for="name" class="label">Naam</label>
                                        <div class="form-field-icon-wrap">
                                            <span class="icon ion-android-person"></span>
                                            <input type="text" class="form-control" id="name">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="email" class="label">E-mail</label>
                                        <div class="form-field-icon-wrap">
                                            <span class="icon ion-email"></span>
                                            <input type="email" class="form-control" id="email">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="phone" class="label">Telefoon/GSM</label>
                                        <div class="form-field-icon-wrap">
                                            <span class="icon ion-android-call"></span>
                                            <input type="text" class="form-control" id="phone">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="message" class="label">Bericht</label>
                                        <textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-md-4">
                                        <input type="submit" class="btn btn-primary btn-outline-primary btn-block" value="Bericht versturen">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> <!-- .section -->

            <div class="map-wrap" id="map"  data-aos="fade"></div>

            {{ include('includes/footer.php') }}

        </div>
    </div>

    <!-- loader -->
    <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#ff7a5c"/></svg></div>

    {{ include('includes/scripts.php') }}
</body>
</html>