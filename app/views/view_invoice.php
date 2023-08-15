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
                                            <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                                            <li class="breadcrumb-item">Invoices</li>
                                            <li class="breadcrumb-item active"
                                                aria-current="page">View Invoice</li>
                                        </ol>
                                    </nav>
                                    <h1 class="m-0">View Invoice</h1>
                                </div>
                                <a href="view_invoice?download=true&invoice=<?php echo $data['invoice_number']; ?>"
                                    class="btn btn-primary"><i class="material-icons">file_download</i> Download</a>

                            </div>
                        </div>

                        <div class="container-fluid page__container">

                            <div class="row">
                                <div class="col-md-8 offset-md-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="badge badge-danger">OVERDUE</div>

                                            <?php 
                                            $member = $data['member'];
                                            $session = $data['session'];
                                            $fees = $data['fees'];
                                            $invoice = $data['invoice'];  
                                            $invoiceDetails= $data['invoiceDetails'];
                                            $totalAmount = $data['totalAmount'];?>

                                            <div class="px-3">
                                                <div class="d-flex justify-content-center flex-column text-center my-5 navbar-light">
                                                    <a href="index.html"
                                                       class="navbar-brand d-flex flex-column m-0"
                                                       style="min-width: 0">
                                                       <img class="navbar-brand-icon mb-2"
                                                             src="<?php  
                                                                if (!isset($invoice->company_logo) || $invoice->company_logo ===''){
                                                                    echo "assets\images\blank_profile.png";
                                                                } else {
                                                                    $originalString = $invoice->company_logo;
                                                                    $modifiedString = substr($originalString, 2);
                                                                    echo $modifiedString;
                                                                }?>"
                                                             width="70"
                                                             alt="FlowDash">
                                                        <span>Invoice</span>
                                                    </a>
                                                </div>
                                                <div class="row mb-5">
                                                    <div class="col-lg">
                                                        <div class="text-label">FROM</div>
                                                        <p class="mb-4">
                                                            <strong class="text-body"><?php echo $invoice->company_name;?></strong><br>
                                                            <?php echo $invoice->address;?><br>
                                                            <?php echo "+26" . $invoice->company_phone;?><br>
                                                        </p>
                                                        <div class="text-label">Invoice NUMBER</div>
                                                        <?php echo "#".$invoiceDetails[0]->invoice_No; ?>
                                                    </div>
                                                    <div class="col-lg text-right">
                                                        <div class="text-label">TO (Member)</div>
                                                        <p class="mb-4">
                                                            <strong class="text-body"><?php echo $member->fname . " ". $member->lname;?></strong><br>
                                                            <?php echo "Mobile: +26" . $member->contact1;?><br>
                                                            <?php echo "Email: " . $member->email;?><br>
                                                        </p>
                                                        <!-- <div class="text-label">Session</div> -->
                                                        <?php //echo $session->session_name;?>
                                                    </div>
                                                </div>

                                                <div class="table-responsive">
                                                <table class="table border-bottom mb-5">
                                                    <thead>
                                                        <tr class="bg-light">
                                                            <th>Description</th>
                                                            <th>Session</th>
                                                            <th class="text-right">Cost</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($fees as $fee) : ?>
                                                            <tr>
                                                                <td><?php echo $fee->fee_description; ?></td>
                                                                <td><?php echo $session->session_name; ?></td>
                                                                <td class="text-right"><?php echo 'K' .  number_format($fee->amount, 2); ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                        <tr>
                                                            <td><strong>Total amount due</strong></td>
                                                            <td></td>
                                                            <td class="text-right"><strong><?php echo 'K' . number_format($totalAmount, 2); ?></strong></td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                                </div>

                                                <div class="text-label">Notes</div>
                                                <p class="text-muted">We appreciate your business. Should you need us to add VAT or extra notes let us know!</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- // END drawer-layout__content -->
                    
                    <?php require_once'sidebar.php';?>

            </div>
            <!-- // END header-layout__content -->

        </div>
        <!-- // END header-layout -->

        <!-- App Settings FAB -->
        <div id="app-settings">
            <app-settings layout-active="default"
                          :layout-location="{
      'default': 'invoice.html',
      'fixed': 'fixed-invoice.html',
      'fluid': 'fluid-invoice.html',
      'mini': 'mini-invoice.html'
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