<?php include 'header.php' ?>
<main id="main">
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top header-inner-pages">
        <div class="container d-flex align-items-center justify-content-lg-between">

            <h1 class="logo me-auto me-lg-0"><a href="index.php">Gp<span>.</span></a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.php" class="logo me-auto me-lg-0"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a class="nav-link scrollto " href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#about">About</a></li>
                    <li><a class="nav-link scrollto" href="#services">Services</a></li>
                    <li><a class="nav-link scrollto " href="Livres.php">Livres</a></li>
                    <li><a class="nav-link scrollto" href="#team">Team</a></li>
                    <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="#">Drop Down 1</a></li>
                            <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i
                                            class="bi bi-chevron-right"></i></a>
                                <ul>
                                    <li><a href="#">Deep Drop Down 1</a></li>
                                    <li><a href="#">Deep Drop Down 2</a></li>
                                    <li><a href="#">Deep Drop Down 3</a></li>
                                    <li><a href="#">Deep Drop Down 4</a></li>
                                    <li><a href="#">Deep Drop Down 5</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Drop Down 2</a></li>
                            <li><a href="#">Drop Down 3</a></li>
                            <li><a href="#">Drop Down 4</a></li>
                        </ul>
                    </li>
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

            <a href="#about" class="get-started-btn scrollto">Get Started</a>

        </div>
    </header><!-- End Header -->


    <?php include "../core/livres.php";
    $l = new livres();
    $result = $l->afficherlivre($_GET['id']);
    while ($row = $result->fetch()){
    ?>
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Details de livre</h2>
                <ol>
                    <li><a href="index.php">Accueil</a></li>
                    <li>livres</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-8">
                    <div class="portfolio-details-slider swiper-container">
                        <div class="swiper-wrapper align-items-center">

                            <div class="swiper-slide">
                                <img src="livres/<?php echo $row["image"]; ?>" style="width: 400px ; height: 450px"
                                     alt="">
                            </div>


                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="portfolio-info">
                        <h3>Details de Livre </h3>
                        <ul>
                            <li><strong>Titre </strong>: <?php echo $row["titre"]; ?></li>
                            <li><strong>Categorie </strong>: <?php echo $row["categorie"]; ?></li>
                            <li><strong>Auteur</strong>: <?php echo $row["nomAuteur"]; ?></li>
                            <li><strong>Date de sortie</strong>:<?php echo $row["dateS"]; ?></li>
                            <li><strong>Prix </strong>: <?php echo $row["prix"]; ?> DT</li>
                            <li><strong>Disponiblité </strong>: <?php if ($row['stock'] > 0) { ?>
                                    en stock
                                <?php } else { ?> En rupture de stock     <?php } ?>
                            </li>
                        </ul>
                        <br>
                        <div class="product-rating">
                            <strong>notez ce livre :</strong>
                            <?php
                            if (isset($_SESSION['l'])) {
                                $idc = $_SESSION['l'];

                                //afficher note
                            } else {
                                $idc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
                            }
                            $idl = $_GET['id'];
                            $sql = " SELECT * from note where (id_client='$idc' and  id_livre=$idl)";
                            $db = config::getConnexion();

                            $listnote = $db->query($sql);


                            if ($listnote->rowCount()) {

                            foreach ($listnote

                            as $row1){

                            for ($i = 0;
                            $i < 5;
                            $i++){
                            if ($row1['note'] > $i)
                            {
                            ?>
                            <td width="80%"><a
                                        href="<?php echo "../core/ajouter_note.php?id=" . $idc . "&note=" . ($i + 1) . "&livre=" . $idl . "" ?> "
                                        class="social-info">
                                    <i class="fa fa-star"></i>
                                    <?php }else{ ?>
                            <td>
                                <a href="<?php echo "../core/ajouter_note.php?id=" . $idc . "&note=" . ($i + 1) . "&livre=" . $idl . "" ?> "
                                   class="social-info">
                                    <i class="fa fa-star-o empty"></i> </a>
                                <?php }
                                }
                                }
                                ?>
                                <?php
                                }
                                else{
                                for ($i = 0;
                                $i < 5;
                                $i++){
                                ?>
                            <td>
                                <a href="<?php echo "../core/ajouter_note.php?id=" . $idc . "&note=" . ($i + 1) . "&livre=" . $idl . "" ?> "
                                   class="social-info">
                                    <i class="fa fa-star-o empty"> </i> </a>
                                <?php
                                }
                                } ?>

                        </div>
                        <br>
                        <div class="product-btns">
                            <div class="qty-input">
                                <span class="text-uppercase">Nombre d'exemplaire: </span>
                                <input class="input" type="number" style="width: 90px">

                            </div>
                            <br>
                            <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> ajouter au
                                panier
                            </button>
                            <div class="pull-right">
                                <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                                <button class="main-btn icon-btn"><i class="fa fa-share-alt"></i></button>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="portfolio-description">

                    <h2>Description de livre </h2>
                    <span> Reference :   <?php echo $row["ID"]; ?> </span>
                    <p>
                        <?php echo $row["description"];
                        } ?>
                    </p>

                </div>
                <div>

                </div>

            </div>
    </section><!-- End Portfolio Details Section -->

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6">
                    <div class="footer-info">
                        <h3>Gp<span>.</span></h3>
                        <p>
                            A108 Adam Street <br>
                            NY 535022, USA<br><br>
                            <strong>Phone:</strong> +1 5589 55488 55<br>
                            <strong>Email:</strong> info@example.com<br>
                        </p>
                        <div class="social-links mt-3">
                            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6 footer-newsletter">
                    <h4>Our Newsletter</h4>
                    <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
                    <form action="" method="post">
                        <input type="email" name="email"><input type="submit" value="Subscribe">
                    </form>

                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            &copy; Copyright <strong><span>Gp</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/gp-free-multipurpose-html-bootstrap-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </div>
</footer><!-- End Footer -->

<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/purecounter/purecounter.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

</body>

</html>