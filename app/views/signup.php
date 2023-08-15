<!DOCTYPE html>
<html lang="en"
      dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible"
              content="IE=edge">
        <meta name="viewport"
              content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?=$data['page_title'] . " | " . WEBSITE_TITLE?></title>

        <!-- Prevent the demo from appearing in search engines -->
        <meta name="robots"
              content="noindex">

        <!-- Perfect Scrollbar -->
        <link type="text/css"
              href="<?=ASSETS?>/vendor/perfect-scrollbar.css"
              rel="stylesheet">

        <!-- App CSS -->
        <link type="text/css"
              href="<?=ASSETS?>/css/app.css"
              rel="stylesheet">
        <link type="text/css"
              href="<?=ASSETS?>/css/app.rtl.css"
              rel="stylesheet">

        <!-- Material Design Icons -->
        <link type="text/css"
              href="<?=ASSETS?>/css/vendor-material-icons.css"
              rel="stylesheet">
        <link type="text/css"
              href="<?=ASSETS?>/css/vendor-material-icons.rtl.css"
              rel="stylesheet">

        <!-- Font Awesome FREE Icons -->
        <link type="text/css"
              href="<?=ASSETS?>/css/vendor-fontawesome-free.css"
              rel="stylesheet">
        <link type="text/css"
              href="<?=ASSETS?>/css/vendor-fontawesome-free.rtl.css"
              rel="stylesheet">

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async
                src="https://www.googletagmanager.com/gtag/js?id=UA-133433427-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', 'UA-133433427-1');
        </script>

    </head>

    <body class="layout-login">

        <div class="layout-login__overlay"></div>
        <div class="layout-login__form bg-white"
             data-perfect-scrollbar>
            <div class="d-flex justify-content-center mt-2 mb-5 navbar-light">
                <a href="index.html"
                   class="navbar-brand"
                   style="min-width: 0">
                    <img class="navbar-brand-icon"
                         src="assets/images/stack-logo-blue.svg"
                         width="25"
                         alt="FlowDash">
                    <span>FlowDash</span>
                </a>
            </div>

            <h4 class="m-0">Sign up!</h4>
            <p class="mb-5">Create an account with FlowDash</p>

            <form href="./app/controllers/signup.php"  method="post" enctype="multipart/form-data"
                  novalidate>
                <div class="form-group">
                    <label class="text-label"
                           for="name_2">First Name:</label>
                    <div class="input-group input-group-merge">
                        <input id="name_2"
                               type="text"
                               name="first_name"
                               required=""
                               class="form-control form-control-prepended"
                               placeholder="First Name">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="far fa-key"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-label"
                           for="name_2">Last Name:</label>
                    <div class="input-group input-group-merge">
                        <input id="last_name_2"
                               type="text"
                               name="last_name"
                               required=""
                               class="form-control form-control-prepended"
                               placeholder="Last Name">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="far fa-key"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-label"
                           for="phone_one_2">Mobile 1:</label>
                    <div class="input-group input-group-merge">
                        <input id="email_2"
                               type="phone"
                               name="contact1"
                               required=""
                               class="form-control form-control-prepended"
                               placeholder="Phone Number">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="far fa-key"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-label"
                           for="phone_two_2">Mobile 2:</label>
                    <div class="input-group input-group-merge">
                        <input id="email_2"
                               type="phone"
                               name="contact2"
                               required=""
                               class="form-control form-control-prepended"
                               placeholder="Secondary Phone Number">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="far fa-key"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-label"
                           for="email_2">Email Address:</label>
                    <div class="input-group input-group-merge">
                        <input id="email_2"
                               type="email"
                               name="email"
                               required=""
                               class="form-control form-control-prepended"
                               placeholder="john@doe.com">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="far fa-key"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-label"
                           for="password_2">ID Number:</label>
                    <div class="input-group input-group-merge">
                        <input id="id_number"
                               type="text"
                               name="id_number"
                               required=""
                               class="form-control form-control-prepended"
                               placeholder="Enter ID number">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="far fa-key"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-label"
                           for="file">CV File:</label>
                    <div class="input-group input-group-merge">
                        <input type="file"
                               name="cv"
                               required=""
                               class="form-control form-control-prepended"
                               placeholder="Enter ID number">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="far fa-key"></span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group mb-5">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox"
                               checked=""
                               class="custom-control-input"
                               id="terms" />
                        <label class="custom-control-label"
                               for="terms">I accept <a href="#">Terms and Conditions</a></label>
                    </div>
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-primary mb-2"
                            type="submit" name="signup">Create Account</button><br>
                    <a class="text-body text-underline"
                       href="login.html">Have an account? Login</a>
                </div>
            </form>
        </div>

        <!-- jQuery -->
        <script src="assets/vendor/jquery.min.js"></script>

        <!-- Bootstrap -->
        <script src="assets/vendor/popper.min.js"></script>
        <script src="assets/vendor/bootstrap.min.js"></script>

        <!-- Perfect Scrollbar -->
        <script src="assets/vendor/perfect-scrollbar.min.js"></script>

        <!-- DOM Factory -->
        <script src="assets/vendor/dom-factory.js"></script>

        <!-- MDK -->
        <script src="assets/vendor/material-design-kit.js"></script>

        <!-- App -->
        <script src="assets/js/toggle-check-all.js"></script>
        <script src="assets/js/check-selected-row.js"></script>
        <script src="assets/js/dropdown.js"></script>
        <script src="assets/js/sidebar-mini.js"></script>
        <script src="assets/js/app.js"></script>

        <!-- App Settings (safe to remove) -->
        <script src="assets/js/app-settings.js"></script>

    </body>

</html>