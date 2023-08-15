<?php require_once'header.php';?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

            <!-- Header Layout Content -->
            <div class="mdk-header-layout__content">

                <div class="mdk-drawer-layout js-mdk-drawer-layout"
                     data-push
                     data-responsive-width="992px">
                    <div class="mdk-drawer-layout__content page">

                        <div class="container-fluid page__heading-container">
                            <div class="page__heading d-flex align-items-center">
                                <div class="flex">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb mb-0">
                                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                                            <li class="breadcrumb-item active"
                                                aria-current="page">Fees</li>
                                        </ol>
                                    </nav>
                                    <h3 class="m-0"><?php echo "Applicable fees for ".$data['class_name'] ?></h3>
                                </div>
                                <a
                                    href="http://localhost/membership/public/fees_form"
                                   class="btn btn-success ml-3">Add Fee</a>
                            </div>
                        </div>

                        <div class="container-fluid page__container">

                            <div class="card card-form">
                                    <div class="row no-gutters">
                                        
                                        <div class="col-lg-8 card-form__body">

                                            <div class="table-responsive border-bottom"
                                                data-toggle="lists"
                                                data-lists-values='["js-lists-values-employee-name"]'>

                                                <div class="search-form search-form--light m-3">
                                                    <input type="text"
                                                        class="form-control search"
                                                        placeholder="Search">
                                                    <button class="btn"
                                                            type="button"><i class="material-icons">search</i></button>
                                                </div>

                                                <table class="table mb-0 thead-border-top-0">
                                                    <thead>
                                                        <tr>

                                                            <th>Description</th>

                                                            
                                                            <th style="width: 257px;">Amount</th>
                                                            
                                                            <th style="width: 24px;"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="list"
                                                        id="staff02">
                                                        
                                                        <?php 
                                                        $fees = $data['fees'];

                                                        if (is_array($fees) && !empty($fees)) {
                                                            foreach ($fees as $fee) :
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $fee->fee_description; ?></td>
                                                                    <td><?php echo $fee->amount; ?></td>
                                                                    <!-- Add more table cells here -->
                                                                </tr>
                                                                <?php
                                                            endforeach;
                                                        } else {
                                                            // Handle the case when there are no fees available or an error occurred
                                                            echo "<tr><td colspan='2'>No fees available.</td></tr>";
                                                        }
                                                        ?>



                                                    </tbody>
                                                </table>


                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="feesDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Select Fees
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="feesDropdown">
                                                        <div class="dropdown-item">
                                                            <input class="form-check-input" type="checkbox" id="option1" value="option1">
                                                            <label class="form-check-label" for="option1">Registration</label>
                                                        </div>
                                                        <div class="dropdown-item">
                                                            <input class="form-check-input" type="checkbox" id="option2" value="option2">
                                                            <label class="form-check-label" for="option2">Annual Sub</label>
                                                        </div>
                                                        <div class="dropdown-item">
                                                            <input class="form-check-input" type="checkbox" id="option3" value="option3">
                                                            <label class="form-check-label" for="option3">Membership</label>
                                                        </div>
                                                        <!-- Add more options as needed -->
                                                    </div>
                                                </div>

                                                <script>
                                                    $(document).ready(function() {
                                                        // When a checkbox is checked/unchecked, update the dropdown button label
                                                        $(".dropdown-item input[type='checkbox']").change(function() {
                                                            var selectedOptions = [];
                                                            $(".dropdown-item input[type='checkbox']:checked").each(function() {
                                                                selectedOptions.push($(this).next("label").text());
                                                            });
                                                            var dropdownButton = $(this).closest(".dropdown").find(".dropdown-toggle");
                                                            dropdownButton.text(selectedOptions.length > 0 ? selectedOptions.join(", ") : "Select Fees");
                                                        });
                                                    });

                                                    </script>

                                                
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
      'default': 'classes.php',
      'fixed': 'fixed-classes.php',
      'fluid': 'fluid-classes.php',
      'mini': 'mini-classes.php'
    }"></app-settings>
        </div>

        
        <div id="dialogContainer" class="dialog-container">
            <div id="dialogOverlay" class="dialog-overlay"></div>

            <div id="dialog" class="dialog">
            <h2 class="dialog-title">AlertDialog Title</h2>
            <form>
                <div class="text-field">
                <label for="field1">Field 1:</label>
                <input type="text" id="field1" name="field1">
                </div>
                <div class="text-field">
                <label for="field2">Field 2:</label>
                <input type="text" id="field2" name="field2">
                </div>
                <div class="text-field">
                <label for="field3">Field 3:</label>
                <input type="text" id="field3" name="field3">
                </div>
                <div class="dialog-buttons">
                <button type="submit">Submit</button>
                </div>
            </form>
            </div>
        </div>

        <script>
            // JavaScript code to show and hide the dialog
            document.addEventListener('DOMContentLoaded', function() {
            var dialogContainer = document.getElementById('dialogContainer');
            var showDialogButton = document.getElementById('showDialogButton');
            var dialogOverlay = document.getElementById('dialogOverlay');

            showDialogButton.addEventListener('click', function() {
                dialogContainer.style.display = 'block';
                dialogOverlay.style.display = 'block';
            });

            dialogOverlay.addEventListener('click', function() {
                dialogContainer.style.display = 'none';
                dialogOverlay.style.display = 'none';
                });
            });
        </script>

        <!-- jQuery -->
        <script src="<?=ASSETS?>/vendor/jquery.min.js"></script>

        <!-- Bootstrap -->
        <script src="<?=ASSETS?>/vendor/popper.min.js"></script>
        <script src="<?=ASSETS?>/vendor/bootstrap.min.js"></script>

        <!-- Perfect Scrollbar -->
        <script src="<?=ASSETS?>/vendor/perfect-scrollbar.min.js"></script>

        <!-- DOM Factory -->
        <script src="<?=ASSETS?>/vendor/dom-factory.js"></script>

        <!-- MDK -->
        <script src="<?=ASSETS?>/vendor/material-design-kit.js"></script>

        <!-- App -->
        <script src="<?=ASSETS?>/js/toggle-check-all.js"></script>
        <script src="<?=ASSETS?>/js/check-selected-row.js"></script>
        <script src="<?=ASSETS?>/js/dropdown.js"></script>
        <script src="<?=ASSETS?>/js/sidebar-mini.js"></script>
        <script src="<?=ASSETS?>/js/app.js"></script>

        <!-- App Settings (safe to remove) -->
        <script src="<?=ASSETS?>/js/app-settings.js"></script>

        <!-- Flatpickr -->
        <script src="<?=ASSETS?>/vendor/flatpickr/flatpickr.min.js"></script>
        <script src="<?=ASSETS?>/js/flatpickr.js"></script>

        <!-- Global Settings -->
        <script src="<?=ASSETS?>/js/settings.js"></script>

        <!-- Chart.js -->
        <script src="<?=ASSETS?>/vendor/Chart.min.js"></script>

        <!-- App Charts JS -->
        <script src="<?=ASSETS?>/js/charts.js"></script>
        <script src="<?=ASSETS?>/js/progress-charts.js"></script>

        <!-- Chart Samples -->
        <script src="<?=ASSETS?>/js/page.analytics.js"></script>

        <!-- Vector Maps -->
        <script src="<?=ASSETS?>/vendor/jqvmap/jquery.vmap.min.js"></script>
        <script src="<?=ASSETS?>/vendor/jqvmap/maps/jquery.vmap.world.js"></script>
        <script src="<?=ASSETS?>/js/vector-maps.js"></script>

    </body>

</html>