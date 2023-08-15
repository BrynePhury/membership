<?php require_once'header.php';?>

            <!-- // END Header -->

            <!-- Header Layout Content -->
            <div class="mdk-header-layout__content">

                <div class="mdk-drawer-layout js-mdk-drawer-layout"
                     data-push
                     data-responsive-width="992px">
                    <div class="mdk-drawer-layout__content page">

                        <div class="container-fluid  page__heading-container">
                            <div class="page__heading">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                                        <li class="breadcrumb-item active"
                                            aria-current="page">Notices</li>
                                    </ol>
                                </nav>
                                <h1 class="m-0">Notices</h1>
                            </div>
                        </div>

                        <div class="container-fluid page__container">

                            <div class="row">
                                <div class="col-md-3">
                                    <a href="new_notice"
                                       class="btn btn-success mb-3 btn-block">New Notice <i class="material-icons">add_circle_outline</i></a>
                                    
                                </div>
                                <div class="col-md-9">
                                    <div class="d-flex mb-3">
                                        <div class="form-inline">
                                            <div class="search-form search-form--light">
                                                <input type="text"
                                                       class="form-control"
                                                       placeholder="Search ..."
                                                       id="searchSample03">
                                                <button class="btn"
                                                        type="button"><i class="material-icons">search</i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="stories-cards mb-4">

                                <?php
                                    // Assuming you have the $noticesArray containing all notices
                                    $noticesArray = $data['noticesb'];
                                    ?>

                                    <!-- Loop through each notice -->
                                    <?php foreach ($noticesArray as $notice) : ?>
                                        <div class="card">
                                            <div class="d-flex align-items-center flex-wrap">
                                                <div class="m-4">
                                                    <a href="" class="d-flex align-items-center text-muted">
                                                        <!-- LOGO -->
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             width="48"
                                                             height="48">
                                                            <g stroke="currentColor"
                                                               fill="none"
                                                               stroke-width="1.5"
                                                               stroke-linecap="round"
                                                               stroke-linejoin="round">
                                                                <path d="M26.09 37.272l-7.424 1.06 1.06-7.424 19.092-19.092c1.758-1.758 4.606-1.758 6.364 0s1.758 4.606 0 6.364L26.09 37.272zM12 1.498h12c.828 0 1.5.672 1.5 1.5v3c0 .828-.672 1.5-1.5 1.5H12c-.828 0-1.5-.672-1.5-1.5v-3c0-.828.672-1.5 1.5-1.5zM25.5 4.498h6c1.656 0 3 1.344 3 3"
                                                                      stroke-width="3"></path>
                                                                <path d="M34.5 37.498v6c0 1.656-1.344 3-3 3h-27c-1.656 0-3-1.344-3-3v-36c0-1.656 1.344-3 3-3h6M10.5 16.498h15M10.5 25.498h6"
                                                                      stroke-width="3"></path>
                                                            </g>
                                                        </svg>
                                                    </a>
                                                </div>
                                                <div class="stories-card__title flex">
                                                    <h5 class="card-title m-0">
                                                        <a href="view_notice?id=<?php echo $notice->notice_id; ?>" class="text-body"><?php echo $notice->notice_title; ?></a>
                                                    </h5>
                                                    <small class="text-muted">
                                                        <a href="#"><strong><?php echo $notice->admin_fname . ' ' . $notice->admin_lname; ?></strong></a>
                                                        <?php 
                                                            // Convert the original date string to a DateTime object
                                                            $dateTime = new DateTime($notice->date_created);
                                                            
                                                            // Format the date in the desired format (e.g., "d, F")
                                                            $formattedDate = $dateTime->format("d, F");
                                                            
                                                            // Output the formatted date
                                                            echo $formattedDate; // Output: "28, July"
                                                            
                                                            ?>
                                                    </small>
                                                </div>
                                                <div class="ml-auto d-flex align-items-center">
                                                    <div class="avatar-group mr-3">
                                                        
                                                    </div>
                                                    <div class="badge badge-soft-vuejs badge-pill mr-3">VUE.JS</div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Add some space between cards -->
                                        <div style="height: 20px;"></div>
                                    <?php endforeach; ?>


                                        <!-- <div class="card">
                                            <div class="d-flex align-items-center flex-wrap">
                                                <div class="m-4">
                                                    <a href="#"
                                                       class="d-flex align-items-center text-muted">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             width="48"
                                                             height="48">
                                                            <g stroke="currentColor"
                                                               fill="none"
                                                               stroke-width="1.5"
                                                               stroke-linecap="round"
                                                               stroke-linejoin="round">
                                                                <path d="M26.09 37.272l-7.424 1.06 1.06-7.424 19.092-19.092c1.758-1.758 4.606-1.758 6.364 0s1.758 4.606 0 6.364L26.09 37.272zM12 1.498h12c.828 0 1.5.672 1.5 1.5v3c0 .828-.672 1.5-1.5 1.5H12c-.828 0-1.5-.672-1.5-1.5v-3c0-.828.672-1.5 1.5-1.5zM25.5 4.498h6c1.656 0 3 1.344 3 3"
                                                                      stroke-width="3"></path>
                                                                <path d="M34.5 37.498v6c0 1.656-1.344 3-3 3h-27c-1.656 0-3-1.344-3-3v-36c0-1.656 1.344-3 3-3h6M10.5 16.498h15M10.5 25.498h6"
                                                                      stroke-width="3"></path>
                                                            </g>
                                                        </svg>

                                                    </a>
                                                </div>
                                                <div class="stories-card__title flex">
                                                    <h5 class="card-title m-0"><a href=""
                                                           class="text-body">How can I scaffold an App?</a></h5>
                                                    <small class="text-muted"><a href="#"><strong>Bob</strong></a> replied 34 min ago</small>
                                                </div>
                                                <div class="ml-auto d-flex align-items-center">
                                                    <div class="avatar-group mr-3">

                                                        <div class="avatar avatar-xxs"
                                                             data-toggle="tooltip"
                                                             data-placement="top"
                                                             title="Author Name">
                                                            <img src="assets/images/256_rsz_1andy-lee-642320-unsplash.jpg"
                                                                 alt="Avatar"
                                                                 class="avatar-img rounded-circle">
                                                        </div>

                                                        <div class="avatar avatar-xxs"
                                                             data-toggle="tooltip"
                                                             data-placement="top"
                                                             title="Author Name">
                                                            <img src="assets/images/256_michael-dam-258165-unsplash.jpg"
                                                                 alt="Avatar"
                                                                 class="avatar-img rounded-circle">
                                                        </div>

                                                        <div class="avatar avatar-xxs"
                                                             data-toggle="tooltip"
                                                             data-placement="top"
                                                             title="Author Name">
                                                            <img src="assets/images/256_luke-porter-261779-unsplash.jpg"
                                                                 alt="Avatar"
                                                                 class="avatar-img rounded-circle">
                                                        </div>

                                                    </div>
                                                    <div class="badge badge-soft-angular badge-pill mr-3">ANGULAR</div>
                                                </div>
                                            </div>
                                        </div> -->

                                    </div>
                            </div>
                        </div>

                    </div>
                    <!-- // END drawer-layout__content -->

                    <?php require_once'sidebar.php';?>
                <!-- // END drawer-layout -->

            </div>
            <!-- // END header-layout__content -->

        </div>
        <!-- // END header-layout -->

        <!-- App Settings FAB -->
        <div id="app-settings">
            <app-settings layout-active="default"
                          :layout-location="{
      'default': 'discussions.html',
      'fixed': 'fixed-discussions.html',
      'fluid': 'fluid-discussions.html',
      'mini': 'mini-discussions.html'
    }"></app-settings>
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