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
                                            <li class="breadcrumb-item"><a href="http://localhost/membership/public/home">Home</a></li>
                                            <li class="breadcrumb-item active"
                                                aria-current="page">Invoices</li>
                                        </ol>
                                    </nav>
                                    <h1 class="m-0">Invoices</h1>
                                </div>
                                
                                <?php
                                    $isAdmin = true;
                                    ?>
                                    <?php if ($isAdmin): ?>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="membersDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Create Invoice
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="membersDropdown">
                                                <form action="http://localhost/membership/public/invoices" method="get">
                                                    <?php
                                                    $members = $data['members'];
                                                    if (is_array($members) && !empty($members)) {
                                                        foreach ($members as $member) {
                                                            echo '<div class="dropdown-item">';
                                                            echo '<input class="form-check-input" type="checkbox" id="member_' . $member->id_number . '" name="members[]" value="' . $member->id_number . '">';
                                                            echo '<label class="form-check-label" for="member_' . $member->id_number . '">' . $member->fname . " " . $member->lname . '</label>';
                                                            echo '</div>';
                                                        }
                                                    } else {
                                                        echo '<div class="dropdown-item">No members available</div>';
                                                    }
                                                    ?>
                                                    <div class="dropdown-divider"></div>
                                                    <button type="submit" class="btn btn-primary">Generate</button>
                                                </form>
                                            </div>
                                        </div>
                                    <?php endif; ?>


                                <script>
                                    // Handle click event on "Add Selected Members" button
                                    var addMembersButton = document.getElementById('addMembersButton');
                                    addMembersButton.addEventListener('click', function (event) {
                                        event.preventDefault();
                                        var selectedMembers = [];
                                        var checkboxes = document.querySelectorAll('.dropdown-item input[type="checkbox"]');
                                        checkboxes.forEach(function (checkbox) {
                                            if (checkbox.checked) {
                                                selectedMembers.push(checkbox.value);
                                            }
                                        });
                                        // Redirect to the add_fees page with selected member IDs and class ID
                                        
                                        var members = selectedMembers.join(',');
                                        var url = 'http://localhost/membership/public/invoices?members=' + members;
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
                                                <button class="btn"
                                                    type="button"><i class="material-icons">search</i></button>
                                        </div>

                                        <table class="table mb-0 thead-border-top-0">
                                            <thead>
                                                <tr>

                                                    <th>Member</th>
                                                                                    
                                                    <th style="width: 257px;">Session</th>
                                                                                    
                                                    <th style="width: 24px;"></th>
                                                </tr>
                                            </thead>
                                            <tbody class="list"
                                                id="staff02">
                                                                                
                                                <?php 
                                                    $members = $data['invoice_members'];
                                                    $sessions = $data['invoice_sessions'];
                                                    $invoices = $data['invoices'];

                                                    if (is_array($members) && is_array($sessions) && !empty($invoices)) {
                                                        $count = count($members);
                                                        for ($i = 0; $i < $count; $i++) {
                                                            $member = $members[$i];
                                                            $session = $sessions[$i];
                                                            $invoice = $invoices[$i];
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $member->fname . " " . $member->lname; ?></td>
                                                                <td><?php echo $session->session_name; ?></td>
                                                                <td>
                                                                    <a href="http://localhost/membership/public/view_invoice?invoice=<?php echo $invoice->invoice_no; ?>" class="btn btn-success ml-3">View</a>
                                                                </td>
                                                            </tr>
                                                                <?php
                                                                    }
                                                                } else {
                                                                // Handle the case when there are no invoices available or an error occurred
                                                                    echo "<tr><td colspan='3'>No invoices available.</td></tr>";
                                                                    }
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