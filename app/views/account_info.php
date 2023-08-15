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
                                <h1 class="m-0">View Account</h1>
                            </div>
                        </div>

                        <div class="container-fluid page__container">
                            
                                <div class="card card-form">
                                    <div class="row no-gutters">
                                        <div class="col-lg-4 card-body">
                                            <p><strong class="headings-color">Basic Information</strong></p>
                                            <p class="text-muted">View your account details.</p>
                                        </div>
                                        <div class="col-lg-8 card-form__body card-body">
                                            <div class="form-group">
                                                <form action="save_acc" method="post" enctype="multipart/form-data"
                                                    novalidate>
                                                    <label>Avatar</label>
                                                    <input type="file"
                                                        name="picture"
                                                        required=""
                                                        class="form-control form-control-prepended"
                                                        placeholder="Choose Profile Image">

                                                        <div class="text-right mb-5">
                                                            <button type="submit" class="btn btn-sm btn-primary dz-clickable">Save photo</button>
                                                        </div>
                                                </form>
                                                     
                                                
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="fname">First name</label>
                                                        <input id="fname"
                                                            type="text"
                                                            class="form-control"
                                                            placeholder="First name"
                                                            value="<?php echo $member->fname;?>"
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="lname">Last name</label>
                                                        <input id="lname"
                                                            type="text"
                                                            class="form-control"
                                                            placeholder="Last name"
                                                            value="<?php echo $member->lname;?>"
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="contact1">Primary Contact</label>
                                                <input id="contact1"
                                                            type="text"
                                                        class="form-control"
                                                        placeholder="Primary Contact"
                                                        value="<?php echo $member->contact1;?>"
                                                        readonly>
                                                
                                            </div>
                                            <div class="form-group">
                                                <label for="contact2">Secondary Contact</label>
                                                <input id="contact2"
                                                            type="text"
                                                        class="form-control"
                                                        placeholder="Secondary Contact"
                                                        value="<?php echo $member->contact2;?>"
                                                        readonly>
                                                
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input id="email"
                                                            type="text"
                                                        class="form-control"
                                                        placeholder="Last name"
                                                        value="<?php echo $member->email;?>"
                                                        readonly>
                                                
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