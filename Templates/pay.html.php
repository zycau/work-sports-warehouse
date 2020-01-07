<div id='pay-wraper'>
    <p>This is a demo website, DO NOT input your personal information!</p>
    <p class='error top'></p>
    <form action="paySuccess.php" method="post" class='pay-form'>
        <fieldset class='form-field'>
            <legend>Pay</legend>
            <p>
                <label for="cardNumber" >Credit Card Number*:</label>
                <input type="text" id='cardNumber' name='cardNumber' placeholder="8888 8888 8888 8888" />
                <span></span>
            </p>
            <p>
                <label for="expiryDate">Expiry Date*:</label>
                <input type="text" id='expiryDate' name='expiryDate' placeholder='12/25' />
                <span></span>
            </p>
            <p>
                <label for="nameOnCard">Name On Card*:</label>
                <input type="text" id='nameOnCard' name='nameOnCard' placeholder='John Smith' />
                <span></span>
            </p>
            <p>
                <label for="csv">CSV*:</label>
                <input type="text" id='csv' name='csv' placeholder="888" />
                <span></span>
            </p>            
        </fieldset>
        <p><input type="submit" name='pay' value="Pay $<?= $_SESSION['cart']->calcTotal() ?>"></p>
    </form>
</div>
<!-- pay form validation -->
<script src="js/pay.js"></script>

<!-- out:pay(cardNumber, expiryDate, nameOnCard, csv) -->