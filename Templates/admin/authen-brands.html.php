<div class="panel">
    <div>
        <a href="authen-categories.php">Maintain Categories</a>
        <a href="authen-brands.php">Maintain Brands</a>
        <a href="authen-products.php">Maintain Products</a>
    </div>
    <div>
        <!-- 对Brand的维护 -->        
        <table>
            <thead>
                <tr>
                    <th>Brand ID</th>
                    <th>Brand Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($brands as $v): ?>
                <?php if(isset($id) && $id==$v['BrandID']): ?>
                <tr id="<?= $v['BrandName'] ?>">
                    <form action="authen-brands.php" method='post'>
                        <td>
                            <?= $v['BrandID'] ?>
                            <input type="hidden" name='editId' value="<?= $v['BrandID'] ?>">
                        </td>
                        <td>
                            <input type="text" name='editName' value="<?= $v['BrandName'] ?>">
                        </td>
                        <td>
                            <input type="submit" name='editSubmit' value='Confirm'>
                            <a href="authen-brands.php">Cancel</a>
                        </td>
                    </form>
                </tr>
                <?php else: ?>
                <tr>
                    <td><?= $v['BrandID'] ?></td>
                    <td><?= $v['BrandName'] ?></td>
                    <td>
                        <a href="authen-brands.php?id=<?= $v['BrandID'] ?>&action=edit#<?= $v['BrandName'] ?>">Edit</a>
                        <a href="authen-brands.php?id=<?= $v['BrandID'] ?>&action=delete" class='delete' data-name="<?= $v['BrandName'] ?>">Delete</a>
                    </td>
                </tr>
                <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p class='msg'><?= $message ?></p>
        <form action="authen-brands.php" method='post'>
            <fieldset>
                <legend>Insert Brand</legend>
                <p>
                    <label for="insertN">Brand Name:</label>
                    <input type="text" name='insertN' id='insertN'>
                </p>
            </fieldset>
            <p>
                <input type="submit" name='insertSubmit' value='Confirm'>
            </p>
        </form>
        
    </div>
</div>

<!-- 
in: $brands $id $message
out: editSubmit (editId, editName), (id, action), insertSubmit (insertN)
-->