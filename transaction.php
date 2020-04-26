<?php require_once("boot.php"); ?>

<html>

<head>
    <!-- bootstrap cdn -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- custom stylesheet -->
    <link rel="stylesheet" type="text/css" href="stylesheet/style.css">
</head>

<body>

    <?php
    if (isset($_GET["id"])) {
        $transaction = $gateway->transaction()->find($_GET["id"]);

        $transactionSuccessStatuses = [
            Braintree\Transaction::AUTHORIZED,
            Braintree\Transaction::AUTHORIZING,
            Braintree\Transaction::SETTLED,
            Braintree\Transaction::SETTLING,
            Braintree\Transaction::SETTLEMENT_CONFIRMED,
            Braintree\Transaction::SETTLEMENT_PENDING,
            Braintree\Transaction::SUBMITTED_FOR_SETTLEMENT
        ];

        if (in_array($transaction->status, $transactionSuccessStatuses)) {
            $header = "Sweet Success!";
            $icon = "success";
            $message = "Your test transaction has been successfully processed. ";
        } else {
            $header = "Transaction Failed";
            $icon = "fail";
            $message = "Your test transaction has a status of " . $transaction->status . ". See the Braintree API response and try again.";
        }
    }
    ?>

    <div class="transaction-message container">
        <div class="wrapper">
            <div class="response">
                <div class="content">
                    
                    <h1><?php echo ($header) ?></h1>
                    <br>
                    <section>
                        <p><?php echo ($message) ?></p>
                        <br>
                    </section>
                    <section>
                        <a class="btn btn-success " href="index.php">
                            <span>Do Another Transaction</span><br>
                        </a>
                    </section>
                </div>
            </div>
        </div>

        <aside class="drawer dark">


            <article class="content compact">
                <section><br>
                    <h4>Transaction Details:</h4><br>
                    <table cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td><?php echo ("         :    " . $_GET["name"]) ?></td>
                            </tr>

                            <tr>
                                <td>Id</td>
                                <td><?php echo ("         :    " . $transaction->id) ?></td>
                            </tr>

                            <tr>
                                <td>Amount</td>
                                <td><?php echo ("         :    " . $transaction->amount."$") ?></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td><?php echo ("         :    " . $transaction->status) ?></td>
                            </tr>
                            <tr>
                                <td>Created at</td>
                                <td><?php echo ("         :    " . $transaction->createdAt->format('Y-m-d H:i:s')) ?></td>
                            </tr>
                            <tr>
                                <td>Updated at</td>
                                <td><?php echo ("         :    " . $transaction->updatedAt->format('Y-m-d H:i:s')) ?></td>
                            </tr>
                            <tr>
                                <td>Card type</td>
                                <td><?php echo ("         :    " . $transaction->creditCardDetails->cardType) ?></td>
                            </tr>
                            <tr>
                                <td>Expiration date</td>
                                <td><?php echo ("         :    " . $transaction->creditCardDetails->expirationDate) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </section>

            </article>
        </aside>
    </div>

</body>

</html>