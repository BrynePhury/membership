<?php require_once'header.php';?>

            <!-- Header Layout Content -->
            <div class="mdk-header-layout__content">

                <div class="mdk-drawer-layout js-mdk-drawer-layout"
                     data-push
                     data-responsive-width="992px">
                    <div class="mdk-drawer-layout__content page">

                        <div class="container-fluid page__heading-container">
                            <div class="page__heading d-flex align-items-end">
                                <div class="flex">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb mb-0">
                                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                                            <li class="breadcrumb-item active"
                                                aria-current="page">Members</li>
                                        </ol>
                                    </nav>
                                    <h1 class="m-0">Members</h1>
                                </div>
                                
                            </div>
                        </div>

                        <div class="container-fluid page__container">

                        <div class="card card-form">
                                <div class="row no-gutters">

                                    <div class="table-responsive border-bottom" data-toggle="lists" data-lists-values='["js-lists-values-employee-name"]'>
                                        <div class="search-form search-form--light m-3">
                                            <form action="./home" method="GET"> <!-- Add the form and set the action to the search route -->
                                                <input type="text" class="form-control search" placeholder="Search" name="searchQuery"> <!-- Add the name attribute to the input field -->
                                                <button class="btn" type="submit"><i class="material-icons">search</i></button> <!-- Change the button type to submit -->
                                            </form>
                                        </div>
                                        <table class="table mb-0 thead-border-top-0">
                                            <thead>
                                                <tr>
                                                    <th>Member</th>
                                                    <th style="width: 37px;" class="text-center">Id</th>
                                                    <th style="width: 220px;" class="text-center">Date Joined</th>
                                                    <th style="width: 70px;" class="text-center">Contact</th>
                                                    <th style="width: 24px;" class="text-center"></th>
                                                </tr>
                                            </thead>
                                            <tbody class="list" id="staff02">
                                                <?php 
                                                $members = $data['members'];

                                                foreach ($members as $member) : ?>
                                                    <tr>
                                                        <td><?php echo $member->fname . ' ' . $member->lname; ?></td>
                                                        <td class="text-center"><?php echo $member->id_number; ?></td>
                                                        <td class="text-center"><?php 
                                                                                    $dateObj = new DateTime($member->date_joined);
                                                                                    $formattedDate = $dateObj->format('d M, Y');
                                                                                    echo $formattedDate;
                                                                                            ?></td>
                                                        <td class="text-center"><?php echo $member->contact1; ?></td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="feesDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <?php if ($member->class_name){
                                                                        echo $member->class_name; 
                                                                    } else {
                                                                        echo "Assign Class";
                                                                    } ?>
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="classesDropdown">
                                                                <form action="members" method="post">
                                                                    <?php
                                                                    $classes = $data['classes'];
                                                                    if (is_array($classes) && !empty($classes)) {
                                                                        foreach ($classes as $class) {
                                                                            if ($member->class_id != $class->class_id){
                                                                                echo '<div class="dropdown-item">';
                                                                                echo '<input class="form-check-input" type="radio" name="selected_class" id="class_' . $class->class_id . '" value="' . $class->class_id . "," . $member->id_number .'">';
                                                                                echo '<label class="form-check-label" for="class_' . $class->class_id . '">' . $class->class_name . '</label>';
                                                                                echo '</div>';
                                                                            }
                                                                        }
                                                                    } else {
                                                                        echo '<div class="dropdown-item">No classes available</div>';
                                                                    }
                                                                    ?>
                                                                    <div class="dropdown-divider"></div>
                                                                    <button type="submit" class="btn btn-primary" id="addClassButton">Add Selected Class</button>
                                                                </form>

                                                                </div>
                                                            </div>
                                                        </td>
                                                        <!-- Add more table cells here -->
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                

                                </div>
                            </div>

                            
                        </div>

                    </div>

                    <?php require_once'sidebar.php';?>


            </div>
            <!-- // END header-layout__content -->

        </div>
        <!-- // END header-layout -->

        <!-- App Settings FAB -->
        <div id="app-settings">
            <app-settings layout-active="default"
                          :layout-location="{
      'default': 'home.html',
      'fixed': 'fixed-dashboard.html',
      'fluid': 'fluid-dashboard.html',
      'mini': 'mini-dashboard.html'
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

        <!-- Global Settings -->
        <script src="assets/js/settings.js"></script>

        <!-- Moment.js -->
        <script src="assets/vendor/moment.min.js"></script>
        <script src="assets/vendor/moment-range.js"></script>

        <!-- Chart.js -->
        <script src="assets/vendor/Chart.min.js"></script>

        <!-- App Charts JS -->
        <script src="assets/js/charts.js"></script>
        <script src="assets/js/chartjs-rounded-bar.js"></script>

        <!-- Chart Samples -->
        <script src="assets/js/page.dashboard.js"></script>
        <script src="assets/js/progress-charts.js"></script>

        <!-- Vector Maps -->
        <script src="assets/vendor/jqvmap/jquery.vmap.min.js"></script>
        <script src="assets/vendor/jqvmap/maps/jquery.vmap.world.js"></script>
        <script src="assets/js/vector-maps.js"></script>

    </body>

</html>