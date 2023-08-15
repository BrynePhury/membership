<?php require_once'header.php';?>

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
                                                aria-current="page">Applicable Fees</li>
                                        </ol>
                                    </nav>
                                    <h1 class="m-0">Applicable fees for <?php echo $data['class_name']; ?></h1>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="feesDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Add Fee
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="feesDropdown">
                                        <form>
                                            <?php
                                            $classId = $data['class_id'];
                                            $fees = $data['all_fees'];
                                            if (is_array($fees) && !empty($fees)) {
                                                foreach ($fees as $fee) {
                                                    echo '<div class="dropdown-item">';
                                                    echo '<input class="form-check-input" type="checkbox" id="fee_' . $fee->fee_id . '" value="' . $fee->fee_id . '">';
                                                    echo '<label class="form-check-label" for="fee_' . $fee->fee_id . '">' . $fee->fee_description . '</label>';
                                                    echo '</div>';
                                                }
                                            } else {
                                                echo '<div class="dropdown-item">No fees available</div>';
                                            }
                                            ?>
                                            <div class="dropdown-divider"></div>
                                            <button type="button" class="btn btn-primary" id="addFeesButton">Add Selected Fees</button>
                                        </form>
                                    </div>
                                </div>

                                <script>
                                    // Handle click event on "Add Selected Fees" button
                                    var addFeesButton = document.getElementById('addFeesButton');
                                    addFeesButton.addEventListener('click', function (event) {
                                        event.preventDefault();
                                        var selectedFees = [];
                                        var checkboxes = document.querySelectorAll('.dropdown-item input[type="checkbox"]');
                                        checkboxes.forEach(function (checkbox) {
                                            if (checkbox.checked) {
                                                selectedFees.push(checkbox.value);
                                            }
                                        });
                                        // Redirect to the add_fees page with selected fee IDs and class ID
                                        var classId = <?php echo $classId; ?>;
                                        var fees = selectedFees.join(',');
                                        var url = 'http://localhost/membership/public/add_fees?class_id=' + classId + '&fees=' + fees;
                                        window.location.href = url;
                                    });
                                </script>
                            </div>
                        </div>

                        <div class="container-fluid page__container">

                            <div class="card card-form">
                                <div class="row no-gutters">

                                    <div class="table-responsive border-bottom"
                                        data-toggle="lists"
                                        data-lists-values='["js-lists-values-employee-name"]'>

                                        <div class="search-form search-form--light m-3">
                                            <input type="text"
                                                class="form-control search"
                                                placeholder="Search">
                                                <button class="btn"type="button"><i class="material-icons">search</i></button>
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
                                                $classId = $data['class_id'];

                                                if (is_array($fees) && !empty($fees)) {
                                                    foreach ($fees as $fee) :
                                                        ?>
                                                    <tr>
                                                    <td><?php echo $fee->fee_description; ?></td>
                                                    <td><?php echo "K".$fee->amount; ?></td>
                                                    <td>
                                                    <a href="http://localhost/membership/public/add_fees?class_id=<?php echo $classId; ?>&fee_id=<?php echo $fee->fee_id; ?>"
                                                        class="btn btn-success ml-3">Remove</a>

                                                    </td>
                                                                                                
                                                    </tr>
                                                    <?php
                                                        endforeach;
                                                        } else {
                                                            echo "<tr><td colspan='2'>No fees applicable.</td></tr>";                                                            }
                                                        ?>



                                            </tbody>
                                        </table>

                                                                            

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