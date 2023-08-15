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
                                            <li class="breadcrumb-item">Home</li>
                                            <li class="breadcrumb-item active"
                                                aria-current="page">Invoice</li>
                                        </ol>
                                    </nav>
                                    <h1 class="m-0">Reports</h1>
                                </div>
                                
                            </div>
                        </div>

                        <div class="container-fluid page__container">

                            <div class="card card-form d-flex flex-column flex-sm-row">
                                <form method="POST" action="">
                                    <div class="card-form__body card-body-form-group flex">
                                        <div class="row">
                                            <div class="col-sm-auto">
                                                <div class="form-group" style="width: 200px;">
                                                    <label for="filter_date">From</label>
                                                    <input id="filter_date" 
                                                    type="text" 
                                                    class="form-control" 
                                                    name="from_date" 
                                                    placeholder="Select date ..." 
                                                    data-toggle="flatpickr"  
                                                    data-flatpickr-alt-format="d/m/Y" 
                                                    data-flatpickr-date-format="d/m/Y">
                                                </div>
                                            </div>
                                            <div class="col-sm-auto">
                                                <div class="form-group" style="width: 200px;">
                                                    <label for="filter_date">To</label>
                                                    <input id="filter_date" 
                                                    type="text"
                                                    class="form-control" 
                                                    name="to_date"
                                                    placeholder="Select date ..." 
                                                    data-toggle="flatpickr"  
                                                    data-flatpickr-alt-format="d/m/Y" 
                                                    data-flatpickr-date-format="d/m/Y">
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <button type="submit" 
                                        class="btn bg-white border-left border-top border-top-sm-0 rounded-top-0 rounded-top-sm rounded-left-sm-0">
                                            <i class="material-icons text-primary icon-20pt">refresh</i></button>
                                    </div>
                                    
                                </form>
                            </div>
                            <?php 
                            if (isset($data['invoices']) && !empty($data['invoices'])){
                            ?>
                            <div class="card">

                                <div class="table-responsive"
                                     data-toggle="lists"
                                     data-lists-values='["js-lists-values-employee-name"]'>

                                     <table class="table mb-0 thead-border-top-0 table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 30px;" class="text-center">#ID</th>
                                                <th>Member Name</th>
                                                <th style="width: 150px;" class="text-center">Session</th>
                                                <th style="width: 200px;" class="text-center">Date Created</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list" id="companies">
                                            <?php 
                                            $invoices = $data['invoices'];
                                            foreach ($invoices as $invoice): ?>
                                            <tr>
                                                <td>
                                                    <div class="badge badge-soft-dark">#<?php echo $invoice->invoice_no; ?></div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="d-flex align-items-center">
                                                            
                                                            <a ><?php echo $invoice->fname . ' ' . $invoice->lname; ?></a>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        
                                                    </div>
                                                </td>
                                                <td style="width: 150px;" class="text-center"><?php echo $invoice->session_name; ?></td>
                                                <td style="width: 200px;" class="text-center"><?php echo $invoice->formatted_date; ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <?php }else{
                                echo "<h2 class=\"breadcrumb-item\">No invoices match your criteria</h2>";
                                }?>
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
      'default': 'companies.html',
      'fixed': 'fixed-companies.html',
      'fluid': 'fluid-companies.html',
      'mini': 'mini-companies.html'
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

    </body>

</html>