<div class="panel">
    <div>
        <a href="authen-categories.php">Maintain Categories</a>
        <a href="authen-brands.php">Maintain Brands</a>
        <a href="authen-products.php">Maintain Products</a>
    </div>
    <div>
        <!-- 对Category的维护 -->        
        <table>
            <thead>
                <tr>
                    <th>Category ID</th>
                    <th>Category Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($categories as $v): ?>
                <?php if(isset($id) && $id==$v['CategoryID']): ?>
                <tr id="<?= $v['CategoryName'] ?>">
                    <form action="authen-categories.php" method='post'>
                        <td>
                            <?= $v['CategoryID'] ?>
                            <input type="hidden" name='editId' value="<?= $v['CategoryID'] ?>">
                        </td>
                        <td>
                            <input type="text" name='editName' value="<?= $v['CategoryName'] ?>">
                        </td>
                        <td>
                            <input type="submit" name='editSubmit' value='Confirm'>
                            <a href="authen-categories.php">Cancel</a>
                        </td>
                    </form>
                </tr>
                <?php else: ?>
                <tr>
                    <td><?= $v['CategoryID'] ?></td>
                    <td><?= $v['CategoryName'] ?></td>
                    <td>
                        <a href="authen-categories.php?id=<?= $v['CategoryID'] ?>&action=edit#<?= $v['CategoryName'] ?>">Edit</a>
                        <a href="authen-categories.php?id=<?= $v['CategoryID'] ?>&action=delete" class='delete' data-name="<?= $v['CategoryName'] ?>">Delete</a>
                    </td>
                </tr>
                <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p class='msg'><?= $message ?></p>
        <form action="authen-categories.php" method='post'>
            <fieldset>
                <legend>Insert Category</legend>
                <p>
                    <label for="insertN">Category Name:</label>
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
in: $categories $id $message
out: editSubmit (editId, editName), (id, action), insertSubmit (insertN)
-->