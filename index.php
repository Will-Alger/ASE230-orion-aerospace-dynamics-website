<?php
require_once "config.php";
include_once "lib/jsonReader.php";
include_once "lib/textReader.php";
include_once "lib/csvReader.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?= COMPANY_NAME ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Premium Bootstrap 5 Landing Page Template" />
    <meta name="keywords" content="bootstrap 5, premium, marketing, multipurpose" />
    <meta content="Themesbrand" name="author" />
    <!-- favicon -->
    <link rel="shortcut icon" href="images/favicon.ico" />

    <!-- css -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />
    <link href="css/style.min.css" rel="stylesheet" type="text/css" />
    <link href="css/extension.css" rel="stylesheet" type="text/css" />
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-offset="20">
    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner">
                <div class="bounce1"></div>
                <div class="bounce2"></div>
                <div class="bounce3"></div>
            </div>
        </div>
    </div>

    <!--Navbar Start-->
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top" id="navbar">
        <div class="container">
            <!-- LOGO -->
            <a class="navbar-brand logo" href="#home">
                <img src="images/orion-dark.png" alt="" class="logo-dark" height="75" />
                <img src="images/orion-light.png" alt="" class="logo-light" height="75" />

            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ms-auto navbar-center" id="navbar-navlist">
                    <li class="nav-item">
                        <a href="#home" class="nav-link active">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="#services" class="nav-link">Services</a>
                    </li>
                    <li class="nav-item">
                        <a href="#about" class="nav-link">About us</a>
                    </li>
                    <li class="nav-item">
                        <a href="#team" class="nav-link">Team</a>
                    </li>
                    <li class="nav-item">
                        <a href="#awards" class="nav-link">Awards</a>
                    </li>
                    <li class="nav-item">
                        <a href="#contact" class="nav-link">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- end container -->
    </nav>
    <!-- Navbar End -->

    <section class="hero-3 bg-center position-relative" style="background-image: url(images/hero-3-bg.png);" id="home">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center">
                        <h1 class="font-weight-semibold mb-4 hero-3-title">Invision Innovation</h1>
                        <p class="mb-5 text-muted subtitle w-75 mx-auto"><?= readTxtFile(MISSION_STATEMENT) ?></p>
                        <div class="modal fade bd-example-modal-lg" id="watchvideomodal" data-keyboard="false" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog modal-lg">
                                <div class="modal-content hero-modal-0 bg-transparent">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    <video id="VisaChipCardVideo" class="w-100" controls="">
                                        <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">

                                    </video>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-light" id="services">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-7 text-center">
                    <h2 class="fw-bold">Our Services</h2>
                    <p class="text-muted">We offer cutting-edge solutions for space exploration, sustainable drone technology, advanced modular space habitats, and comprehensive aerospace education. Our services are designed to pave the way for a future where life beyond Earth is not just possible, but commonplace.</p>
                </div>
            </div>
            <div class="row">
                <?php
                $servicesData = readJsonFile(PRODUCTS_DATA);
                if ($servicesData) {
                    foreach ($servicesData as $key => $service) { ?>
                        <div class="col-lg-6">
                            <div class="service-box position-relative">
                                <div class="service-box-content p-4">
                                    <div class="icon-mono service-icon avatar-md mx-auto mb-4">
                                        <i class="" data-feather="box"></i>
                                    </div>
                                    <h4 class="mb-3 font-size-22 text-left"><?= $key; ?></h4>
                                    <p class="text-muted mb-0 text-left"><?= $service['description']; ?></p>
                                    <?php if (isset($service['applications'])) : ?>
                                        <hr>
                                        <h5 class="mt-3 text-left">Applications:</h5>
                                        <?php foreach ($service['applications'] as $applicationName => $applicationDescription) : ?>
                                            <p class="text-left text-muted"><strong><?= $applicationName; ?>:</strong> <?= $applicationDescription; ?></p>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                <?php }
                }
                ?>
            </div>
        </div>

    </section>
    <!-- Services end -->

    <section class="section" id="about">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-7 text-center">
                    <h2 class="fw-bold">About Us</h2>
                    <p class="text-muted"><?= readTxtFile(OVERVIEW) ?></p>
                </div>
            </div>
            <div class="row">

            </div>
        </div>

    </section>
    <!-- Services end -->

    <!-- Team start -->
    <section class="section" id="team">
        <div class="container">
            <div class="row justify-content-center mb-4">
                <div class="col-lg-7 text-center">
                    <h2 class="fw-bold">Our Team Members</h2>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

            <?php $teamData = readJsonFile('data/team.json'); ?>
            <div class="row">
                <?php foreach ($teamData as $member) : ?>
                    <div class="col-lg-3 col-sm-6">
                        <div class="team-box mt-4 position-relative overflow-hidden rounded text-center shadow">
                            <div class="position-relative overflow-hidden">
                                <img src="<?= $member['img'] ?>" alt="" class="team-img img-fluid d-block mx-auto" />
                                <div class="team-summary"><?= $member['description'] ?></div>
                            </div>
                            <div class="p-4">
                                <h5 class="font-size-19 mb-1"><?= $member['name'] ?></h5>
                                <p class="text-muted text-uppercase font-size-14 mb-0"><?= $member['position'] ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div><!-- end row -->
        </div>
        </div>
    </section>


    <!-- Awards start -->
    <section class="section" id="awards">
        <div class="container">
            <div class="row justify-content-center mb-4">
                <div class="col-lg-7 text-center">
                    <h2 class="fw-bold">Awards</h2>
                    <p class="text-muted">We at <?= COMPANY_NAME ?> take immense pride in our trailblazing achievements and accolades, a testament to our unwavering pursuit of excellence beyond the sky.</p>
                </div>
            </div>
            <div class="row">
                <?php
                $awardsData = readCsvFile(AWARDS_DATA);
                array_shift($awardsData);
                if ($awardsData) {
                    foreach ($awardsData as $award) { ?>
                        <div class="col-lg-4">
                            <div class="card mt-4 border-0 shadow">
                                <div class="card-body p-4" style="min-height:250px">
                                    <h4 class="badge badge-soft-primary font-size-22 my-4"><a href="javascript: void(0);"><?= $award[0]; ?></a></h4>
                                    <p class="text-muted"><?= $award[1]; ?></p>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Contact us start -->
    <section class="section bg-light" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-4">Get in Touch</h2>
                    <div>
                        <form method="post" name="myForm" onsubmit="return validateForm()">
                            <p id="error-msg"></p>
                            <div id="simple-msg"></div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label for="name" class="text-muted form-label">Name</label>
                                        <input name="name" id="name" type="text" class="form-control" placeholder="Enter name*">
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label for="email" class="text-muted form-label">Email</label>
                                        <input name="email" id="email" type="email" class="form-control" placeholder="Enter email*">
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label for="subject" class="text-muted form-label">Subject</label>
                                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter Subject.." />
                                    </div>

                                    <div class="mb-4 pb-2">
                                        <label for="comments" class="text-muted form-label">Message</label>
                                        <textarea name="comments" id="comments" rows="4" class="form-control" placeholder="Enter message..."></textarea>
                                    </div>

                                    <button type="submit" id="submit" name="send" class="btn btn-primary">Send Message</button>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </form>
                        <!-- end form -->
                    </div>
                </div>
                <!-- end col -->

                <div class="col-lg-5 ms-lg-auto">
                    <div class="mt-5 mt-lg-0">
                        <img src="images/contact.png" alt="" class="img-fluid d-block" />
                        <p class="text-muted mt-5 mb-3"><i class="me-2 text-muted icon icon-xs" data-feather="mail"></i> Support@info.com</p>
                        <p class="text-muted mb-3"><i class="me-2 text-muted icon icon-xs" data-feather="phone"></i> +91 123 4556 789</p>
                        <p class="text-muted mb-3"><i class="me-2 text-muted icon icon-xs" data-feather="map-pin"></i> 2976 Edwards Street Rocky Mount, NC 27804</p>
                        <ul class="list-inline pt-4">
                            <li class="list-inline-item me-3">
                                <a href="javascript: void(0);" class="social-icon icon-mono avatar-xs rounded-circle"><i class="icon-xs" data-feather="facebook"></i></a>
                            </li>
                            <li class="list-inline-item me-3">
                                <a href="javascript: void(0);" class="social-icon icon-mono avatar-xs rounded-circle"><i class="icon-xs" data-feather="twitter"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-icon icon-mono avatar-xs rounded-circle"><i class="icon-xs" data-feather="instagram"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <!-- Contact us end -->

    <!-- Footer Start -->
    <footer class="footer" style="background-image: url(images/footer-bg.png);">
        <div class="container">
            <div class="row-12 text-center">
                <div class="col-lg-12">
                    <div class="mb-4">
                        <p class="text-white-50 f-15 mb-0"><a href="index.php"><img src="images/orion-light.png" alt="" class="" height="30" /></a></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <p class="text-white-50 f-15 mb-0"><?= date('Y') . ' © ' . COMPANY_NAME ?></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer End -->

    <!-- Style switcher -->
    <div id="style-switcher">
        <div class="bottom">
            <a href="javascript: void(0);" id="mode" class="mode-btn text-white">
                <i class="mdi mdi-white-balance-sunny mode-light"></i>
                <i class="mdi mdi-moon-waning-crescent mode-dark"></i>
            </a>
            <a href="javascript: void(0);" class="settings" onclick="toggleSwitcher()"><i class="mdi mdi-cog  mdi-spin"></i></a>
        </div>
    </div>

    <!-- javascript -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/smooth-scroll.polyfills.min.js"></script>

    <script src="https://unpkg.com/feather-icons"></script>

    <!-- App Js -->
    <script src="js/app.js"></script>
</body>

</html>