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

                            

                            <div class="card card-form">
                                <div class="row no-gutters">

                                <div class="col-lg-8 card-form__body">

                                        <div class="table-responsive border-bottom" data-toggle="lists" data-lists-values='["js-lists-values-employee-name"]'>

                                        <form action="http://localhost/membership/public/receipt_form_two" method="post">

                                            <table class="table mb-0 thead-border-top-0">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 18px;">
                                                            <div class="custom-control custom-checkbox">
                                                                <!-- <input type="checkbox" class="custom-control-input js-toggle-check-all" data-target="#staff" id="customCheckAll"> -->
                                                                <!-- <label class="custom-control-label" for="customCheckAll"><span class="text-hide">Toggle all</span></label> -->
                                                            </div>
                                                        </th>
                                                        <th>Description</th>
                                                        <th style="width: 37px;">Cost</th>
                                                        <th style="width: 24px;"></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list" id="staff">
                                                    <?php 
                                                    $fees = $data['fees'];
                                                    foreach ($fees as $fee): ?>
                                                    <tr>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" name="selector[]"class="custom-control-input js-check-selected-row" value="<?php echo $fee->fee_id. ",". $memberId; ?>" id="customCheck_<?php echo $fee->fee_id; ?>">
                                                                <label class="custom-control-label" for="customCheck_<?php echo $fee->fee_id; ?>"><span class="text-hide">Check</span></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="media align-items-center">
                                                                <div class="media-body">
                                                                    <span class="js-lists-values-employee-name"><?php echo $fee->fee_description; ?></span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <?php echo "K".$fee->amount; ?>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>

                                            <!-- Add the member ID as a hidden input field -->
                                            <input type="hidden" name="member_id" value="<?php echo $memberId; ?>">

                                            <button type="submit" class="btn btn-primary" name="save_class">Next</button>
                                            </form>

                                            <script>
                                            // Handle form submission
                                            var form = document.getElementById('invoiceForm');
                                            form.addEventListener('submit', function(event) {
                                                event.preventDefault();

                                                var select = document.getElementById('select05');
                                                var selectedFeeId = select.options[select.selectedIndex].value;
                                                var amountInput = document.getElementById('amount_paid').value;

                                                // Build the query parameters for the GET request
                                                var queryParams = 'fee_id=' + selectedFeeId + '&amount_paid=' + amountInput + '&member_id=' + <?php echo $memberId; ?>;

                                                // Update the form's action URL with the query parameters
                                                form.action = "http://localhost/membership/public/reciept_form?" + queryParams;

                                                // Submit the form
                                                form.submit();
                                            });
                                            </script>


                                        </div>
                                    </div>

                                <div class="col-lg-8 card-form__body card-body">
                                        
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