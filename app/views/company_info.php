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
                                            aria-current="page">Account</li>
                                    </ol>
                                </nav>
                                <h1 class="m-0">Edit Company Details</h1>
                            </div>
                        </div>

                        <?php $company = $data['company']; ?>

                        <div class="container-fluid page__container">

                        <div class="card card-form">
                                    <div class="row no-gutters">
                                        <div class="col-lg-4 card-body">
                                            <p><strong class="headings-color">Company Branding</strong></p>
                                            <p class="text-muted">Add company logo.</p>
                                        </div>
                                        <div class="col-lg-8 card-form__body card-body">
                                            <div class="form-group">
                                                <form action="company_info" method="post" enctype="multipart/form-data"
                                                    novalidate>
                                                    <label>Company Logo</label>
                                                    <input type="file"
                                                        name="logo"
                                                        required=""
                                                        class="form-control form-control-prepended"
                                                        placeholder="Choose Profile Image"
                                                        accept=".jpg, .jpeg, .png">

                                                        <div class="text-right mb-5">
                                                            <button type="submit" class="btn btn-sm btn-primary dz-clickable">Save photo</button>
                                                        </div>
                                                </form>
                                                     
                                                
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

                            <form method="post" href="company_info">
                                <div class="card card-form">
                                    <div class="row no-gutters">
                                        <div class="col-lg-4 card-body">
                                            <p><strong class="headings-color">Company Information</strong></p>
                                            <p class="text-muted">Edit your company details.</p>
                                        </div>
                                        <div class="col-lg-8 card-form__body card-body">
                                            <div class="row">
                                                <div class="form-group">
                                                    <label for="co_name">Company name</label>
                                                    <input id="co_name"
                                                        name="co_name"
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="Company name"
                                                        <?php if ($company) {
                                                            echo "value=\"" . htmlspecialchars($company->company_name) . "\"";
                                                        } ?>>

                                                </div>
                                                
                                            </div>
                                            <div class="form-group">
                                                <label for="desc">Description (Optional)</label>
                                                <textarea id="desc"
                                                            rows="4"
                                                            name="desc"
                                                            class="form-control"
                                                            placeholder="Description ..."><?php if ($company) {
                                                                echo htmlspecialchars($company->description);
                                                            } ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="co_email">Company Email</label>
                                                <input id="co_email"
                                                        type="text"
                                                        name="co_email"
                                                        class="form-control"
                                                        placeholder="Company Email"
                                                        value="<?php if ($company) {
                                                        echo htmlspecialchars($company->company_email);
                                                        } ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="co_phone">Company Phone</label>
                                                <input id="co_phone"
                                                        type="text"
                                                        name="co_phone"
                                                        class="form-control"
                                                        placeholder="Company Phone"
                                                        value="<?php if ($company) {
                                                            echo htmlspecialchars($company->company_phone);
                                                        } ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="co_tel">Company Tel (Optional)</label>
                                                <input id="co_tel"
                                                        type="text"
                                                        name="co_tel"
                                                        class="form-control"
                                                        placeholder="Company Tel"
                                                        value="<?php if ($company) {
                                                            echo htmlspecialchars($company->company_tel);
                                                        } ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="co_tpin">TPIN (Optional)</label>
                                                <input id="co_tpin"
                                                        type="text"
                                                        name="co_tpin"
                                                        class="form-control"
                                                        placeholder="TPIN Number"
                                                        value="<?php if ($company) {
                                                            echo htmlspecialchars($company->tpin_number);
                                                        } ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="co_address">Address </label>
                                                <input id="co_address"
                                                        type="text"
                                                        name="co_address"
                                                        class="form-control"
                                                        placeholder="Address"
                                                        value="<?php if ($company) {
                                                            echo htmlspecialchars($company->address);
                                                        } ?>">
                                            </div>
                                        </div>
                                    </div>                                
                                </div>

                                <div class="text-right mb-5">
                                    <button 
                                        type="submit"
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