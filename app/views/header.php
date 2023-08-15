<!DOCTYPE html>
<html lang="en"
      dir="ltr">

    <?php $member = $_SESSION['user']; 
        $notices = $data['notices']; 
    ?>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible"
              content="IE=edge">
        <meta name="viewport"
              content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?=$data['page_title'] . " | " . WEBSITE_TITLE?></title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">

        <!-- Bootstrap JS Bundle (Popper.js included) -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

        <!-- Prevent the demo from appearing in search engines -->
        <meta name="robots"
              content="noindex">

        <!-- Perfect Scrollbar -->
        <link type="text/css"
              href="assets/vendor/perfect-scrollbar.css"
              rel="stylesheet">

              <!-- App CSS -->
        <link type="text/css"
              href="assets/css/app.css"
              rel="stylesheet">
        <link type="text/css"
              href="assets/css/app.rtl.css"
              rel="stylesheet">

        <!-- Material Design Icons -->
        <link type="text/css"
              href="assets/css/vendor-material-icons.css"
              rel="stylesheet">
        <link type="text/css"
              href="assets/css/vendor-material-icons.rtl.css"
              rel="stylesheet">

        <!-- Font Awesome FREE Icons -->
        <link type="text/css"
              href="assets/css/vendor-fontawesome-free.css"
              rel="stylesheet">
        <link type="text/css"
              href="assets/css/vendor-fontawesome-free.rtl.css"
              rel="stylesheet">

              <!-- Flatpickr -->
        <link type="text/css"
              href="assets/css/vendor-flatpickr.css"
              rel="stylesheet">
        <link type="text/css"
              href="assets/css/vendor-flatpickr.rtl.css"
              rel="stylesheet">
        <link type="text/css"
              href="assets/css/vendor-flatpickr-airbnb.css"
              rel="stylesheet">
        <link type="text/css"
              href="assets/css/vendor-flatpickr-airbnb.rtl.css"
              rel="stylesheet">

              <!-- Quill Theme -->
        <link type="text/css"
              href="assets/css/vendor-quill.css"
              rel="stylesheet">
        <link type="text/css"
              href="assets/css/vendor-quill.rtl.css"
              rel="stylesheet">

        <!-- Dropzone -->
        <link type="text/css"
              href="assets/css/vendor-dropzone.css"
              rel="stylesheet">
        <link type="text/css"
              href="assets/css/vendor-dropzone.rtl.css"
              rel="stylesheet">

        <!-- Select2 -->
        <link type="text/css"
              href="assets/css/vendor-select2.css"
              rel="stylesheet">
        <link type="text/css"
              href="assets/css/vendor-select2.rtl.css"
              rel="stylesheet">
        <link type="text/css"
              href="assets/vendor/select2/select2.min.css"
              rel="stylesheet">

        <!-- App CSS -->
        <link type="text/css"
              href="assets/css/app.css"
              rel="stylesheet">
        <link type="text/css"
              href="assets/css/app.rtl.css"
              rel="stylesheet">

        <!-- Material Design Icons -->
        <link type="text/css"
              href="assets/css/vendor-material-icons.css"
              rel="stylesheet">
        <link type="text/css"
              href="assets/css/vendor-material-icons.rtl.css"
              rel="stylesheet">

        <!-- Font Awesome FREE Icons -->
        <link type="text/css"
              href="assets/css/vendor-fontawesome-free.css"
              rel="stylesheet">
        <link type="text/css"
              href="assets/css/vendor-fontawesome-free.rtl.css"
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

        <!-- Flatpickr -->
        <link type="text/css"
              href="assets/css/vendor-flatpickr.css"
              rel="stylesheet">
        <link type="text/css"
              href="assets/css/vendor-flatpickr.rtl.css"
              rel="stylesheet">
        <link type="text/css"
              href="assets/css/vendor-flatpickr-airbnb.css"
              rel="stylesheet">
        <link type="text/css"
              href="assets/css/vendor-flatpickr-airbnb.rtl.css"
              rel="stylesheet">

        <!-- Vector Maps -->
        <link type="text/css"
              href="assets/vendor/jqvmap/jqvmap.min.css"
              rel="stylesheet">

    </head>

    <body class="layout-fixed">

        <div class="preloader"></div>

        <!-- Header Layout -->
        <div class="mdk-header-layout js-mdk-header-layout">

            <!-- Header -->

            <div id="header"
                 class="mdk-header js-mdk-header m-0"
                 data-fixed
                 data-effects="waterfall">
                <div class="mdk-header__content">

                    <div class="navbar navbar-expand-sm navbar-main navbar-dark bg-dark  pr-0"
                         id="navbar"
                         data-primary>
                        <div class="container">

                            <!-- Navbar toggler -->

                            <button class="navbar-toggler navbar-toggler-right d-block d-lg-none"
                                    type="button"
                                    data-toggle="sidebar">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <!-- Navbar Brand -->
                            <a href="fixed-dashboard.html"
                               class="navbar-brand ">

                                <svg class="mr-2"
                                     xmlns="http://www.w3.org/2000/svg"
                                     fill="currentColor"
                                     style="width:20px;"
                                     viewBox="0 0 40 40">
                                    <path d="M40 34.16666667c.01-3.21166667-2.58333333-5.82333334-5.795-5.835-1.94-.00666667-3.75666667.955-4.84166667 2.565-.10166666.155-.295.22333333-.47166666.16666666L11.94 25.66666667c-.19-.06-.31-.245-.28833333-.44333334.01-.07333333.015-.14833333.015-.22333333 0-.06833333-.005-.13833333-.01333334-.20666667-.02166666-.20166666.105-.39.3-.44666666l17.96-5.13c.13833334-.04.28666667-.005.39333334.09166666 1.05.97333334 2.42833333 1.51666667 3.86 1.525C37.38833333 20.83333333 40 18.22166667 40 15s-2.61166667-5.83333333-5.83333333-5.83333333C32.52 9.17166667 30.95333333 9.87833333 29.86 11.11c-.11.12166667-.28.16833333-.43666667.11833333L11.91 5.65333333c-.16-.05-.27333333-.19166666-.28833333-.35833333-.30333334-3.20166667-3.14333334-5.55166667-6.345-5.24833333S-.275 3.19.02833333 6.39166667c.28166667 2.99333333 2.79833334 5.28 5.805 5.275 1.64666667-.005 3.21333334-.71333334 4.30666667-1.945.11-.12166667.28-.16833334.43666667-.11833334l16.57 5.27166667c.22.06833333.34166666.30333333.27166666.52333333-.04166666.13333334-.14833333.23833334-.28333333.275L9.90333333 20.59666667c-.13333333.03833333-.275.00833333-.38166666-.08-1.03333334-.86833334-2.33833334-1.34666667-3.68833334-1.35C2.61166667 19.16666667 0 21.77833333 0 25s2.61166667 5.83333333 5.83333333 5.83333333c1.355-.005 2.665-.485 3.7-1.35833333.10833334-.09166667.25833334-.12.39333334-.07666667l18.29 5.81833334c.14.04333333.24666666.15666666.28.3.75666666 3.13166666 3.90833333 5.05666666 7.04 4.3C38.14833333 39.185 39.99 36.85333333 40 34.16666667z" />
                                </svg>

                                <span>flowdash</span>
                            </a>

                            <form class="search-form d-none d-sm-flex flex"
                                  action="fixed-index.html">
                                <button class="btn"
                                        type="submit"><i class="material-icons">search</i></button>
                                <input type="text"
                                       class="form-control"
                                       placeholder="Search">
                            </form>

                            <ul class="nav navbar-nav ml-auto d-none d-md-flex">
                                <li class="nav-item dropdown">
                                    <a href="#notifications_menu"
                                       class="nav-link dropdown-toggle"
                                       data-toggle="dropdown"
                                       data-caret="false">
                                        <i class="material-icons nav-icon navbar-notifications-indicator">notifications</i>
                                    </a>
                                    <div id="notifications_menu"
                                         class="dropdown-menu dropdown-menu-right navbar-notifications-menu">
                                          <div class="dropdown-item d-flex align-items-center py-2">
                                                <span class="flex navbar-notifications-menu__title m-0">Notices</span>
                                            
                                          </div>
                                          <div class="navbar-notifications-menu__content"
                                             data-perfect-scrollbar>
                                          <div class="py-2">

                                                <?php
                                                    // Assuming you have already fetched the notices from the database and stored them in the $notices variable
                                                    if (!empty($notices)) {
                                                        foreach ($notices as $notice) {
                                                            // Format the date (e.g., "2023-07-28 16:15:04" to "24, November")
                                                            $formattedDate = date('d, F', strtotime($notice->date_created));
                                                            ?>

                                                            <div class="dropdown-item d-flex">
                                                                <div class="mr-3">
                                                                    <div class="avatar avatar-sm" style="width: 32px; height: 32px;">
                                                                        <!-- Replace 'assets/images/256_daniel-gaffey-1060698-unsplash.jpg' with the admin photo path -->
                                                                        <img src="<?php    
                                                                        if (!isset($notice->admin_photo) || $notice->admin_photo ===''){
                                                                            echo "assets\images\blank_profile.png";
                                                                        } else {
                                                                           $originalString = $notice->admin_photo;
                                                                           $modifiedString = substr($originalString, 2);
                                                                           echo $modifiedString;
                                                                        }
                                                                        ?>" alt="Avatar" class="avatar-img rounded-circle">
                                                                    </div>
                                                                </div>
                                                                <div class="flex">
                                                                    <!-- Replace 'A.Demian' with the admin's full name -->
                                                                    <a href="view_notice?id=<?= $notice->notice_id ?>"><?= $notice->admin_fname . ' ' . $notice->admin_lname ?></a> left a comment on <a href="view_notice?id=<?php echo $notice->notice_id; ?>"><?= $notice->notice_title ?></a><br>
                                                                    <!-- Replace '1 minute ago' with the formatted date -->
                                                                    <small class="text-muted"><?= $formattedDate ?></small>
                                                                </div>
                                                            </div>

                                                            <?php
                                                        }
                                                    } else {
                                                        echo "No notices found.";
                                                    }
                                                    ?>

                                                  

                                            </div>
                                        </div>
                                        <a href="notices"
                                           class="dropdown-item text-center navbar-notifications-menu__footer">View All</a>
                                    </div>
                                </li>
                            </ul>

                            <ul class="nav navbar-nav d-none d-sm-flex border-left navbar-height align-items-center">
                                <li class="nav-item dropdown">
                                    <a href="#account_menu"
                                       class="nav-link dropdown-toggle"
                                       data-toggle="dropdown"
                                       data-caret="false">
                                        <span class="mr-1 d-flex-inline">
                                            <span class="text-light"><?php echo $member->fname . " " . $member->lname[0] . ".";?></span>
                                        </span>
                                        <img src="<?php  
                                         if (!isset($member->photo) || $member->photo ===''){
                                            echo "assets\images\blank_profile.png";
                                         } else {
                                            $originalString = $member->photo;
                                            $modifiedString = substr($originalString, 2);
                                            echo $modifiedString;
                                        }?>"
                                             class="rounded-circle"
                                             width="32"
                                             alt="Frontted">
                                    </a>
                                    
                                    <div id="account_menu"
                                         class="dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-item-text dropdown-item-text--lh">
                                            <div><strong><?php echo $member->fname . " " . $member->lname; ?></strong></div>
                                        </div>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item"
                                           href="dashboard"><i class="material-icons">dvr</i> Dashboard</a>
                                        <a class="dropdown-item"
                                           href="account_info"><i class="material-icons">account_circle</i> My profile</a>
                                        <a class="dropdown-item"
                                           href="change_password"><i class="material-icons">edit</i> Change Password</a>
                                        <a class="dropdown-item"
                                           href="company_info"><i class="material-icons">business</i> Company Information</a>
                                        
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item"
                                           href="logout"><i class="material-icons">exit_to_app</i> Logout</a>
                                    </div>
                                </li>
                            </ul>

                        </div>
                    </div>

                </div>
            </div>

            <!-- // END Header -->