<?php require_once("boot.php"); ?>
<html>

<head>
    <meta charset="utf-8">

    <!-- braintree gateway -->
    <script src="https://js.braintreegateway.com/web/dropin/1.22.1/js/dropin.min.js"></script>

    <!-- bootstrap cdn -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- custom stylesheet -->
    <link rel="stylesheet" type="text/css" href="stylesheet/style.css">

</head>

<body>


    <form method="post" id="payment-form" action="checkout.php">

        <section>

            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" class="form-control" id="name" placeholder="Enter Full Name" name="name">
            </div>

            <div class="form-group">
                <label for="amount">Amount:</label>
                <input id="amount" name="amount" type="tel" min="1" placeholder="0 $" class="form-control">
            </div>


            <div class="bt-drop-in-wrapper">
                <div id="bt-dropin"></div>
            </div>

        </section>

        <input id="nonce" name="payment_method_nonce" type="hidden" />
        <button class="btn btn-primary" type="submit"><span>Transaction</span></button>

    </form>


    <script>
        var form = document.querySelector('#payment-form');
        var client_token = "<?php echo ($gateway->ClientToken()->generate()); ?>";

        braintree.dropin.create({
            authorization: client_token,
            selector: '#bt-dropin',
            paypal: {
                flow: 'vault'
            }
        }, function(createErr, instance) {
            if (createErr) {
                console.log('Create Error', createErr);
                return;
            }
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                instance.requestPaymentMethod(function(err, payload) {
                    if (err) {
                        console.log('Request Payment Method Error', err);
                        return;
                    }

                    // Add the nonce to the form and submit
                    document.querySelector('#nonce').value = payload.nonce;
                    form.submit();
                });
            });
        });
    </script>
    <script src="javascript/demo.js"></script>
</body>

</html>