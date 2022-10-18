<!-- ======= Footer ======= -->
<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-info">
                        <a href="#hero"><img src={{ asset("storage/logo/Logo.webp") }}
                            style="max-height: 170px; width: auto;"></a>
                        <p>
                            @setting('address')<br><br>
                            <strong>N<sup>0</sup> de téléphone:</strong> @setting('phone')<br>
                            <strong>Email:</strong> @setting('email')<br>
                        </p>
                        <div class="social-links mt-3">
                            {{-- <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a> --}}
                            <a href="@setting('facebook_link')" target="_blank" class="facebook"><i class="bx bxl-facebook"></i></a>
                            <a href="@setting('instagram_link')" target="_blank" class="instagram"><i class="bx bxl-instagram"></i></a>
                            {{-- <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a> --}}
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Description</h4>
                    <p>@setting('description')</p>
                </div>

                <div class="col-lg-2 col-md-6 footer-links">
                    <h4>Liens utiles</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Accueil</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#about">À propos</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#services">Services</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#portfolio">Projets</a></li>
                    </ul>
                </div>

                @livewire('client.projects-component')

                @livewire('client.availability-component')
            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            &copy; Copyright <strong><span>@setting('app_name', "Ono Design")</span></strong>. Tous droits réservés
        </div>

    </div>
</footer><!-- End Footer -->
