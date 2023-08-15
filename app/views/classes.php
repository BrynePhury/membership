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
                                                aria-current="page">Classes</li>
                                        </ol>
                                    </nav>
                                    <h1 class="m-0">Classes</h1>
                                </div>
                                <a
                                    href="http://localhost/membership/public/classes_form"
                                   class="btn btn-success ml-3">Add Class</a>
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
                                            <button class="btn"
                                                 type="button"><i class="material-icons">search</i></button>
                                        </div>
                        
                                        <table class="table mb-0 thead-border-top-0">
                                            <thead>
                                                <tr>
                                                    <th>Class</th>
                                                    <th style="width: 257px;">Experienced Required</th>
                                                    <th style="width: 257px;">Applicable Fees</th>
                                                    <th style="width: 24px;"></th>
                                                </tr>
                                            </thead>
                                            <tbody class="list" id="staff02">
                                                <?php
                                                    $classes = $data['classes'];
                                                    //Here
                                                    foreach ($classes as $clas) :
                                                        ?>
                                                        <tr onclick="submitForm('<?php echo $clas->class_id; ?>');">
                                                            <td><?php echo $clas->class_name; ?></td>
                                                            <td><?php echo $clas->experience_required; ?></td>
                                                                                    
                                                            <td>
                                                                <div class="dropdown">
                                                                    <button class="custom-select" type="button" id="feesDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    View
                                                                    </button>
                                                                    <div class="dropdown-menu" aria-labelledby="feesDropdown">
                                                                        <?php
                                                                        $classId = $clas->class_id;
                                                                        $fees = $this->loadFees($classId);
                                                                        if (is_array($fees) && !empty($fees)) {
                                                                            foreach ($fees as $fee) :
                                                                            ?>
                                                                            <div class="dropdown-item">
                                                                            <?php echo $fee->fee_description; ?>
                                                                            </div>
                                                                            <?php
                                                                                endforeach;
                                                                                } else {
                                                                                    echo "<div class='dropdown-item'>No fees available for this class.</div>";
                                                                                }
                                                                                ?>
                                                                    </div>
                                                                </div>
                                                            </td>
                        
                                                            <td>                        
                                                                <a href="http://localhost/membership/public/add_fees?class_id=<?php echo $clas->class_id; ?>" class="btn btn-success ml-3">Add</a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                        </table>                                              
                        
                                        <script>
                                            function submitForm(classId) {
                                                document.getElementById('classIdInput').value = classId;
                                                document.getElementById('classForm').submit();
                                            }                              
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
                                        <script>
                                            function saveData(classId) {
                                                var selectedFees = []; // Array to store selected fees
                        
                                                // Get all the checkboxes
                                                var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
                        
                                                // Iterate over the checkboxes and get the values
                                                checkboxes.forEach(function(checkbox) {
                                                    selectedFees.push(checkbox.value);
                                                });
                        
                                                // Create a hidden form
                                                var form = document.createElement('form');
                                                form.method = 'post';
                                                form.action = 'http://localhost/membership/public/classes/save';
                        
                                                // Create an input element for each selected fee and append it to the form
                                                selectedFees.forEach(function(feeId) {
                                                var input = document.createElement('input');
                                                input.type = 'hidden';
                                                input.name = 'fees[]';
                                                input.value = feeId;
                                                form.appendChild(input);
                                                });
                        
                                                // Create an input element for the class_id and append it to the form
                                                var classIdInput = document.createElement('input');
                                                classIdInput.type = 'hidden';
                                                classIdInput.name = 'class_id';
                                                classIdInput.value = classId;
                                                form.appendChild(classIdInput);
                        
                                                // Append the form to the document and submit it
                                                document.body.appendChild(form);
                                                form.submit();
                                            }
                                        </script>
                        
                               
                            </div>
                        
                        </div>                   
                        </div>

                    </div>
                    <?php require_once'sidebar.php';?>

            </div>
            <!-- // END header-layout__content -->

        </div>
        <!-- // END header-layout -->

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