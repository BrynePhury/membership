<?php require_once'header.php';?>

            <!-- Header Layout Content -->
            <div class="mdk-header-layout__content">

                <div class="mdk-drawer-layout js-mdk-drawer-layout"
                     data-push
                     data-responsive-width="992px">
                    <div class="mdk-drawer-layout__content page">

                    <?php $member = $data['member'];
                    $memberId = $member->id_number;?>

                        <div class="container-fluid page__heading-container">
                            <div class="page__heading">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                                        <li class="breadcrumb-item">Reciepts</li>
                                        <li class="breadcrumb-item active"
                                            aria-current="page">Generate Reciept</li>
                                    </ol>
                                </nav>

                                <h1 class="m-0"><?php echo $member->fname . " " . $member->lname;?></h1>
                            </div>
                        </div>

                        <div class="container-fluid page__container">

                                <div class="col-lg-8 card-form__body card-body">
                                    <form id="invoiceForm" action="http://localhost/membership/public/receipt_form_two" method="post">

                                        <div class="form-group">
                                            <?php 
                                            $fees = $data['fees'];
                                            $myArray = array();
                                            foreach ($fees as $fee): ?>
                                                <label for="<?php echo $fee->fee_id; ?>"><?php echo $fee->fee_description; ?>:</label>
                                                <input type="text" class="form-control" name="<?php $myArray[] = $fee->fee_id;
                                                 echo $fee->fee_id; ?>" id="amount_paid_<?php echo $fee->fee_id; ?>" placeholder="Enter amount paid for <?php echo $fee->fee_description; ?>">
                                                <div class="invalid-feedback">
                                                    Amount must be less than or equal to the selected fee amount.
                                                </div>
                                            <?php endforeach; ?>
                                        </div>

                                        <?php
                                        $delimiter = ',';
                                        $string = implode($delimiter, $myArray);?>

                                        <!-- Add the member ID as a hidden input field -->
                                        <input type="hidden" name="member_id" value="<?php echo $memberId; ?>">
                                        <input type="hidden" name="fee_str" value="<?php echo $string; ?>"> 

                                        <button type="submit" class="btn btn-primary" name="save_class">Save</button>
                                    </form>
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
      'default': 'ui-forms.html',
      'fixed': 'fixed-ui-forms.html',
      'fluid': 'fluid-ui-forms.html',
      'mini': 'mini-ui-forms.html'
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

        <!-- Flatpickr -->
        <script src="assets/vendor/flatpickr/flatpickr.min.js"></script>
        <script src="assets/js/flatpickr.js"></script>

        <!-- jQuery Mask Plugin -->
        <script src="assets/vendor/jquery.mask.min.js"></script>

        <!-- Quill -->
        <script src="assets/vendor/quill.min.js"></script>
        <script src="assets/js/quill.js"></script>

        <!-- Dropzone -->
        <script src="assets/vendor/dropzone.min.js"></script>
        <script src="assets/js/dropzone.js"></script>

        <!-- Select2 -->
        <script src="assets/vendor/select2/select2.min.js"></script>
        <script src="assets/js/select2.js"></script>

    </body>

</html>