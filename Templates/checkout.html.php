<div id='checkout-wraper'>
    <p>This is a demo website, DO NOT input your personal information!</p>
    <p class='error top'></p>
    <form action="pay.php" method="post" class='checkout-form'>
        <fieldset class='form-field'>
            <legend>Checkout</legend>
            <p>
                <label for="firstName" >First Name*:</label>
                <input type="text" id='firstName' name='firstName' placeholder="John" />
                <span></span>
            </p>
            <p>
                <label for="lastName">Last Name*:</label>
                <input type="text" id='lastName' name='lastName' placeholder='Smith' />
                <span></span>
            </p>
            <p>
                <label for="contactNumber">Contact Number*:</label>
                <input type="text" id='contactNumber' name='contactNumber' placeholder='0432888888' />
                <span></span>
            </p>
            <p>
                <label for="email">Email:</label>
                <input type="email" id='email' name='email' placeholder="SportsWarehouse@gmail.com"  />
                <span></span>
            </p>
            <p>
                <label for="postcode">PostCode*:</label>
                <input type="text" id='postcode' name='postcode' placeholder="2000" />
                <span></span>
            </p>
            <p>
                <label for="address">Address*:</label>
                <input type="text" id='address' name='address' placeholder="Sydney street 1" />
                <span></span>
            </p>      
        </fieldset>
        <p><input type="submit" name='submitAndPay' value='Pay'></p>
    </form>
</div>
<!-- checkout form validation -->
<script src="js/checkout.js"></script>