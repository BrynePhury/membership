<?php require_once'header.php';?>
            <!-- // END Header -->

            <!-- Header Layout Content -->
            <div class="mdk-header-layout__content">

                <div class="mdk-drawer-layout js-mdk-drawer-layout"
                     data-push
                     data-responsive-width="992px">
                    <div class="mdk-drawer-layout__content page">

                        <div class="container-fluid page__heading-container">
                            <div class="page__heading">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                                        <li class="breadcrumb-item">Notices</li>
                                        <li class="breadcrumb-item active"
                                            aria-current="page">Notice</li>
                                    </ol>
                                </nav>
                                <h1 class="m-0">Notice</h1>
                            </div>
                        </div>

                        <?php $notice = $data['notice']; ?> 

                        <div class="container-fluid page__container">
                            <div class="row">
                                <div class="col-lg">
                                    <div class="card">
                                        <div class="card-header card-header-large bg-white d-flex align-items-center">
                                            <h4 class="card-header__title flex m-0"><?php echo $notice->notice_title; ?></h4>
                                            
                                        </div>
                                        
                                        <div class="card-body tab-content">
                                            <div class="tab-pane active show fade"
                                                 id="activity_all">
                                                 <?php echo "    ". $notice->notice_details; ?>
                                            </div>
                                        </div>
                                    </div>
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
      'default': 'ui-tabs.html',
      'fixed': 'fixed-ui-tabs.html',
      'fluid': 'fluid-ui-tabs.html',
      'mini': 'mini-ui-tabs.html'
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