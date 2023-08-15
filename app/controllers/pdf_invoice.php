<div class="card">
    <div class="card-body">
    <div class="badge badge-danger">OVERDUE</div>

    <?php 
    $member = $data['member'];
    $session = $data['session'];
    $fees = $data['fees']; 
    $invoiceDetails= $data['invoiceDetails'];
    $totalAmount = $data['totalAmount'];?>

    <div class="px-3">
        <div class="d-flex justify-content-center flex-column text-center my-5 navbar-light">
            <a href="index.html"
                class="navbar-brand d-flex flex-column m-0"
                style="min-width: 0">
                    <img class="navbar-brand-icon mb-2"
                        src="assets/images/stack-logo-blue.svg"
                        width="25"
                        alt="FlowDash">
                    <span>Invoice</span>
            </a>
            <div class="text-muted">Invoice <?php echo "#".$invoiceDetails[0]->invoice_No; ?></div>
        </div>
        <div class="row mb-5">
            <div class="col-lg">
                <div class="text-label">FROM</div>
                    <p class="mb-4">
                        <strong class="text-body">Adrian Demian</strong><br>
                        959 Emerson Road<br>
                        Winnfield, LA<br>
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