<?php require_once'header.php';?>

            <!-- // END Header -->

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
                                            <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                                            <li class="breadcrumb-item">home</li>
                                            <li class="breadcrumb-item active"
                                                aria-current="page">Notices</li>
                                        </ol>
                                    </nav>
                                    <h1 class="m-0">New Notice</h1>
                                </div>
                                
                            </div>
                            
                        </div>

                        <div class="container-fluid page__container">
                            <div class="card card-form">
                                <div class="row no-gutters">
                                    <div class="col-lg-8 card-form__body card-body">

                                        <form action="new_notice" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="drop">Notice To:</label>
                                                <div name="drop"class="dropdown"> 
                                                    <select  name="notice_to"class="custom-select">
                                                        <option value="everyone">Everybody</option>
                                                        <?php $classes = $data['classes']; 
                                                            foreach ($classes as $class) { ?>
                                                                <option value="<?php echo $class->class_id; ?>"><?php echo $class->class_name; ?></option><?php
                                                            }
                                                        ?>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="class_name">Notice Title:</label>
                                                <input type="text"
                                                       name="title"
                                                       class="form-control"
                                                       id="class_name"
                                                       placeholder="Enter title ..">
                                            </div>
                                            <div class="form-group">
                                                <label for="experience_required">Notice Details:</label>
                                                <textarea type="text"
                                                    class="form-control"
                                                    name="details"
                                                    id="experience_required"
                                                    placeholder="Enter details .."
                                                    rows="4"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="attachment">Attachment (Optional):</label>
                                                <input type="file" name="attachment" class="form-control">
                                            </div>
                                            <button type="submit"
                                                    class="btn btn-primary"
                                                    name="save_class">Save</button>
                                        </form>
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
      'default': 'blank.html',
      'fixed': 'fixed-blank.html',
      'fluid': 'fluid-blank.html',
      'mini': 'mini-blank.html'
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

    </body>

</html>