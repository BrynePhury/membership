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
                                                aria-current="page">Reciepts</li>
                                        </ol>
                                    </nav>
                                    <h1 class="m-0">Reciepts</h1>
                                </div>
                                
                                
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="membersDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Generate Receipt
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="membersDropdown">
                                            <?php
                                            $members = $data['members'];
                                            if (is_array($members) && !empty($members)) {
                                                foreach ($members as $member) {
                                                    $memberId = $member->id_number;
                                                    echo '<a class="dropdown-item" href="http://localhost/membership/public/reciept_form?member_id=' . $memberId . '">';
                                                    echo $member->fname . " " . $member->lname;
                                                    echo '</a>';
                                                }
                                            } else {
                                                echo '<div class="dropdown-item">No members available</div>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    




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

                                            <?php
                                                                            
                                                function getSessionNameFromDatabase($sessionCode)
                                                {
                                                    $db = new Database();
                                                                            
                                                    // Query the database to retrieve the session name
                                                    $query = "SELECT session_name FROM sessions WHERE session_code = :sessionCode";
                                                    $params = array(':sessionCode' => $sessionCode);
                                                    $result = $db->read($query, $params);
                                                                            
                                                    if ($result && !empty($result)) {
                                                        return $result[0]->session_name; // Return the session name
                                                    } else {
                                                        return null; // Return null if session name not found
                                                    }
                                                }
                                                function getMemberNameFromDatabase($memberId)
                                                {
                                                    $db = new Database();
                                                                            
                                                    // Query the database to retrieve the member name
                                                    $query = "SELECT CONCAT(fname, ' ', lname) AS member_name FROM members WHERE member_id = :memberId";
                                                    $params = array(':memberId' => $memberId);
                                                    $result = $db->read($query, $params);
                                                                            
                                                    if ($result && !empty($result)) {
                                                        return $result[0]->member_name; // Return the member name
                                                    } else {
                                                        return null; // Return null if member name not found
                                                    }
                                                }                             
                                                                            
                                                    ?>

                                                <table class="table mb-0 thead-border-top-0">
                                                    <thead>
                                                        <tr>
                                                            <th>Member</th>
                                                            <th>Session</th>
                                                            <th style="width: 24px;"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="list" id="staff02">
                                                        <?php 
                                                            $receipts = $data['receipts'];

                                                            if (is_array($receipts)) {
                                                                foreach ($receipts as $receipt) {

                                                                ?>
                                                                <tr>
                                                                <td><?php echo $receipt->fname . " " . $receipt->lname; ?></td>
                                                                <td><?php echo $receipt->session_name; ?></td>
                                                                <!-- <td><?php //echo $receipt->member_id; ?></td> -->
                                                                                                
                                                                <td>                      
                                                                    <a 
                                                                        href="http://localhost/membership/public/view_receipt?receipt=<?php echo $receipt->receipt_no; ?>"
                                                                        class="btn btn-success ml-3">View</a>
                                                                    </td>
                                                                </tr>
                                                                                            
                                                                    <?php
                                                                        }
                                                            } else {
                                                                // Handle the case when there are no receipts available or an error occurred
                                                                echo "<tr><td colspan='3'>No receipts available.</td></tr>";
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