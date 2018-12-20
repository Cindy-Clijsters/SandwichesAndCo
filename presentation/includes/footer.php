<footer class="ftco-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-5">
                <div class="footer-widget">
                    <h3 class="mb-4">Over ons</h3>
                    {{ company.aboutUsSummary|raw }}
                </div>

                <div class="footer-widget">
                    <h3 class="mb-4">Volg ons</h3>
                    <ul class="list-unstyled social">
                        <li><a href="#"><span class="fa fa-tripadvisor"></span></a></li>
                        <li><a href="#"><span class="fa fa-twitter"></span></a></li>
                        <li><a href="#"><span class="fa fa-facebook"></span></a></li>
                        <li><a href="#"><span class="fa fa-instagram"></span></a></li>
                    </ul>
                </div>   
            </div>

            <div class="col-md-4 mb-5">
                <div class="footer-widget">
                    <h3 class="mb-4">Adres</h3>
                    <p>{{ company.address }}<br>
                    {{ company.postalCode }} {{ company.city }}<br><br>
                    Telefoonnummer: <a href="tel:{{ company.telephone }}">{{ company.telephone }}</a><br>
                    E-mail: <a href="mailto:{{ company.email }}">{{ company.email }}</a><br>
                    Btw-nummer: {{ company.vatNumber }}</p>
                </div>
            </div>

            <div class="col-md-4 ">
                <div class="footer-widget">
                    <h3 class="mb-4">Openingsuren</h3>
                    <p>Maandag : gesloten<br>
                    Dinsdag : 08:00 - 20:00<br>
                    Woensdag : 08:00 tot 20:00<br>
                    Donderdag : 08:00 tot 20:00<br>
                    Vrijdag : 08:00 tot 20:00<br>
                    Zaterdag : 08:00 tot 20:00<br>
                    Zondag : gesloten</p>
                </div>
            </div>

        </div>

        <div class="row pt-5">
            <div class="col-md-12 text-center">
                <p>Copyright &copy; {{ "now"|date("Y") }} {{ company.name }}</p>
            </div>
        </div>
    </div>
</footer> 