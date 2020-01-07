<div>
    <?php if($orderId>0): ?>
    <p class='afterPay'>Thank you! Your order number is <?= $orderId ?>.</p>
    <?php else: ?>
    <p class='afterPay'>There is something wrong and order is not placed.</p>
    <?php endif; ?>
</div>

<!-- in: $orderId -->