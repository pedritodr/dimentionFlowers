<div class="breadcrumb-area gray-bg">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="<?= site_url('portada') ?>">Portada</a></li>
                <li class="active">Contacto</li>
            </ul>
        </div>
    </div>
</div>
<div class="contact-us ptb-68">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="contact-page-title mb-40">
                    <h1>
                        Hola
                        <br>
                        contactanos
                    </h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <ul class="contact-tab-list nav">
                    <li><a class="" href="#contact-address" data-toggle="tab">Nuestro Equipo</a></li>
                    <li><a href="#contact-form-tab" data-toggle="tab" class="active">Déjanos un mensaje</a></li>
                    <li><a href="#store-location" data-toggle="tab" class="">Nuestra ubicación</a></li>
                </ul>
            </div>
            <div class="col-lg-8">
                <div class="tab-content tab-content-contact">
                    <div id="contact-address" class="tab-pane fade row d-flex">
                        <div class="team-area" style="width: 100%;">
                            <div class="container">
                                <div class="text-center mb-40">
                                    <h4 class="section-title-about">Nuestro Equipo</h4>
                                </div>
                                <div class="row">
                                    <?php foreach ($equipo as $item) { ?>
                                        <div class="col-lg-4 col-md-6 col-sm-6">
                                            <div class="team-wrapper mb-30">
                                                <div class="team-img">
                                                    <a href="#">
                                                        <img src="<?= base_url($item->imagen) ?>" alt="">
                                                    </a>

                                                </div>
                                                <div class="team-content text-center">
                                                    <h4><?= $item->nombre ?></h4>
                                                    <span><?= $item->puesto ?> </span>
                                                    <p style="font-size:12px;">
                                                        <strong> E-mail:</strong><br>
                                                        <?= $item->email ?> <br>
                                                        <strong> Celular:</strong><br>
                                                        <?= $item->celular ?> <br>
                                                        <strong> Skype:</strong><br>
                                                        <?= $item->skype ?> <br>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <!--    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="team-wrapper mb-30">
                                            <div class="team-img">
                                                <a href="#">
                                                    <img src="<?= base_url('assets/home-team-3.jpg') ?>" alt="">
                                                </a>

                                            </div>
                                            <div class="team-content text-center">
                                                <h4>Cecilia Barrionuevo</h4>
                                                <span>Gerente general</span>
                                                <p style="font-size:12px;">
                                                    <strong> E-mail:</strong><br>
                                                    finance@dimentionflowers.com<br>
                                                    <strong> Msn:</strong><br>
                                                    dimentionflowers@andinanet.net <br>
                                                    <strong> Celular:</strong><br>
                                                    (593) 980952205<br>
                                                    <strong> Skype:</strong><br>
                                                    dimentionflowers@andinanet.net <br>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="team-wrapper mb-30">
                                            <div class="team-img">
                                                <a href="#">
                                                    <img src="<?= base_url('assets/home-team-2.jpg') ?>" alt="">
                                                </a>

                                            </div>
                                            <div class="team-content text-center">
                                                <h4>Diana Pástor</h4>
                                                <span>Ejecutiva de Ventas </span>
                                                <p style="font-size:12px;">
                                                    <strong> E-mail:</strong><br>
                                                    sales1@dimentionflowers.com <br>
                                                    <strong> Celular:</strong><br>
                                                    (593) 98 4063 061 <br>
                                                    <strong> Skype:</strong><br>
                                                    dimention.flowers2<br>

                                                </p>
                                            </div>
                                        </div>
                                    </div> -->

                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="contact-form-tab" class="tab-pane fade row d-flex active show">
                        <div class="col">
                            <form action="<?= site_url('front/contacto_mensaje'); ?>" method="post">
                                <?= get_message_from_operation(); ?>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="contact-form-style mb-20">
                                            <input name="name" placeholder="Nombres completo" type="text" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="contact-form-style mb-20">
                                            <input name="email" placeholder="Email" type="email" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="contact-form-style mb-20">
                                            <input name="subject" placeholder="Asunto" type="text" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="contact-form-style">
                                            <textarea name="message" placeholder="Mensaje" required></textarea>
                                            <button class="submit" type="submit">Enviar Mensaje</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <p class="form-messege"></p>
                        </div>
                    </div>
                    <div id="store-location" class="tab-pane fade row d-flex">
                        <div class="col-12">

                            <div id="map" class="google-maps">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d89553.25418528763!2d9.19406272678945!3d45.458941223623455!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4786c1493f1275e7%3A0x3cffcd13c6740e8d!2sMilan!5e0!3m2!1sen!2s!4v1403031740860" width="370" height="150"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="<?= base_url(); ?>assets_front/assets/js/vendor/jquery-1.12.0.min.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0jIY1DdGJ7yWZrPDmhCiupu_K2En_4HY&amp;callback=initMap"></script>

<script>
    function initMap() {
        var location = {
            lat: -0.178315,
            lng: -78.481211
        };
        var map = new google.maps.Map(document.getElementById("map"), {
            zoom: 16,
            center: location,
            scrollwheel: false
        });
        var marker = new google.maps.Marker({
            position: location,
            map: map
        });
    }
</script>