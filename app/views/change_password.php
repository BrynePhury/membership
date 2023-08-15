<?php require_once'header.php';?>


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
                                            aria-current="page">Account</li>
                                    </ol>
                                </nav>
                                <h1 class="m-0">Change Password</h1>
                            </div>
                        </div>

                        <div class="container-fluid page__container">
                            <form action="change_password" method="post">
                                <div class="card card-form">
                                    <div class="row no-gutters">
                                        <div class="col-lg-4 card-body">
                                            <p><strong class="headings-color">Update Your Password</strong></p>
                                            <p class="text-muted">Change your password.</p>
                                        </div>
                                        <div class="col-lg-8 card-form__body card-body">
                                            
                                            <div class="form-group">
                                                <label for="opass">Old Password</label>
                                                <input style="width: 270px;"
                                                    id="opass"
                                                    name="oldPassword"
                                                    type="password"
                                                    class="form-control"
                                                    placeholder="Old password">
                                            </div>
                                            <div class="form-group">
                                                <label for="npass">New Password</label>
                                                <input style="width: 270px;"
                                                    id="npass"
                                                    type="password"
                                                    name="newPassword"
                                                    class="form-control"
                                                    placeholder="New password">
                                                
                                            </div>
                                            <div class="form-group">
                                                <label for="cpass">Confirm Password</label>
                                                <input style="width: 270px;"
                                                    id="cpass"
                                                    name="conPassword"
                                                    type="password"
                                                    class="form-control"
                                                    placeholder="Confirm password">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="text-right mb-5">
                                    <button type="submit"
                                        class="btn btn-success">Save</button>
                                </div>

                            </form>
                            
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
      'default': 'edit-account.html',
      'fixed': 'fixed-edit-account.html',
      'fluid': 'fluid-edit-account.html',
      'mini': 'mini-edit-account.html'
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

        <!-- Dropzone -->
        <script src="assets/vendor/dropzone.min.js"></script>
        <script src="assets/js/dropzone.js"></script>

    </body>

</html>