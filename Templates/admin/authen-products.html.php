<div class="panel">
    <div>
        <a href="authen-categories.php">Maintain Categories</a>
        <a href="authen-brands.php">Maintain Brands</a>
        <a href="authen-products.php">Maintain Products</a>
    </div>
    <div>
        <form action="authen-products.php" method='post'>
            <label for="searchProduct">Search Product:</label>
            <input type="text" id='searchProduct' name='searchProduct'>
            <input type="submit" name='searchSubmit' value='Search'>
        </form>
    </div>
    <div class='admin-border'>
        <table>
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Photo</th>
                    <th>Price</th>
                    <th>Sale Price</th>
                    <th>Description</th>
                    <th>Brand</th>
                    <th>Category</th>
                    <th>Featured</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($products as $v): ?>
                <?php if(isset($id) && $id==$v['ProductID']): ?>
                    <tr id="edit<?= $v['ProductID'] ?>">
                        <form action="authen-products.php#located" method='post' enctype='multipart/form-data'>
                            <td>
                                <?= $v['ProductID'] ?><input type="hidden" name='editId' value="<?= $v['ProductID'] ?>">
                            </td>
                            <td>
                                <input type="text" name='editName' value="<?= $v['ProductName'] ?>">
                            </td>
                            <td>
                                <input type="file" name='editPhoto' data-width='m'>
                                <input type="hidden" name='oldPhoto' value="images/products/<?= $v['Photo'] ?>">
                            </td>
                            <td>
                                <input type="text" name='editPrice' value="<?= $v['Price'] ?>" data-width='s'>
                            </td>
                            <td>
                                <input type="text" name='editSalePrice' value="<?= $v['SalePrice'] ?>" data-width='s'>
                            </td>
                            <td>
                                <textarea name="editDescription" cols="30" rows="5"><?= $v['Description'] ?></textarea>
                            </td>
                            <td>
                                <select name="editBrand">
                                <?php foreach($brands as $b): ?>
                                <?php if($v['Brand']==$b['BrandID']): ?>
                                    <option value="<?= $b['BrandID'] ?>" selected><?= $b['BrandName'] ?></option>
                                <?php else: ?>
                                    <option value="<?= $b['BrandID'] ?>"><?= $b['BrandName'] ?></option>
                                <?php endif; ?>
                                <?php endforeach; ?>
                                </select>
                            </td>
                            <td>
                                <select name="editCategory">
                                <?php foreach($categories as $c): ?>
                                <?php if($v['Category']==$c['CategoryID']): ?>
                                    <option value="<?= $c['CategoryID'] ?>" selected><?= $c['CategoryName'] ?></option>
                                <?php else: ?>
                                    <option value="<?= $c['CategoryID'] ?>"><?= $c['CategoryName'] ?></option>
                                <?php endif; ?>
                                <?php endforeach; ?>
                                </select>
                            </td>
                            <td>
                                <select name="editFeatured">
                                <?php if($v['Featured']==0): ?>
                                    <option value="1">Yes</option>
                                    <option value="0" selected>No</option>
                                <?php else: ?>
                                    <option value="1" selected>Yes</option>
                                    <option value="0">No</option>
                                <?php endif; ?>
                                </select>
                            </td>
                            <td>
                                <input type="submit" name='editSubmit' value='Confirm'>
                                <a href="authen-products.php#product<?= $v['ProductID'] ?>">Cancel</a>
                            </td>
                        </form>
                    </tr>
                <?php else: ?>
                    <tr id="product<?= $v['ProductID'] ?>">
                        <td><?= $v['ProductID'] ?></td>
                        <td><?= $v['ProductName'] ?></td>   
                        <td><img src="images/products/<?= $v['Photo'] ?>" width='60' height='60'></td>                        
                        <td><?= $v['Price'] ?></td>
                        <td><?= $v['SalePrice'] ?></td>
                        <td><?= $v['Description'] ?></td>
                        <td><?= $v['BrandName'] ?></td>
                        <td><?= $v['CategoryName'] ?></td>
                        <?php if($v['Featured']==1): ?>
                        <td>Yes</td>
                        <?php else: ?>
                        <td>No</td>
                        <?php endif; ?>
                        <td>
                            <a href="authen-products.php?id=<?= $v['ProductID'] ?>&action=edit#edit<?= $v['ProductID'] ?>">Edit</a>
                            <a href="authen-products.php?id=<?= $v['ProductID'] ?>&action=delete&photo=images/products/<?= $v['Photo'] ?>#located" class='delete' data-name="<?= $v['ProductName'] ?>">Delete</a>
                        </td>
                    </tr>
                <?php endif; ?>    
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div>
        <p class='msg' id='located'><?= $message ?></p>
        <form action="authen-products.php#located" method='post' enctype='multipart/form-data'>
            <fieldset>
                <legend>Create New Product</legend>
                <p>
                    <label for="insertN">Product Name:</label>
                    <input type="text" name='insertN' id='insertN'>
                </p>
                <p>
                    <label for="insertPhoto">Photo:</label>
                    <input type="file" name='insertPhoto' id='insertPhoto'>
                </p>
                <p>
                    <label for="insertPrice">Price:</label>
                    <input type="text" name='insertPrice' id='insertPrice'>
                </p>
                <p>
                    <label for="insertSalePrice">Sale Price:</label>
                    <input type="text" name='insertSalePrice' id='insertSalePrice'>
                </p>
                <p>
                    <label for="insertDescription">Description:</label>
                    <textarea name="insertDescription" id="insertDescription" cols="30" rows="10"></textarea>                    
                </p>
                <p>
                    <label for="insertBrand">Brand:</label>
                    <select name="insertBrand" id="insertBrand">
                    <?php foreach($brands as $b): ?>
                        <option value="<?= $b['BrandID'] ?>"><?= $b['BrandName'] ?></option>
                    <?php endforeach; ?>
                    </select>                  
                </p>
                <p>
                    <label for="insertCategory">Category:</label>
                    <select name="insertCategory" id="insertCategory">
                    <?php foreach($categories as $c): ?>
                        <option value="<?= $c['CategoryID'] ?>"><?= $c['CategoryName'] ?></option>
                    <?php endforeach; ?>
                    </select>                  
                </p>
                <p>
                    <label for="insertFeatured">Featured:</label>
                    <select name="insertFeatured" id="insertFeatured">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </p>
            </fieldset>
            <p>
                <input type="submit" name='insertSubmit' value='Confirm'>
            </p>
        </form>
    </div>
</div>


<!-- 
in: $products, $brands, $categories
out: searchProduct, editSubmit, (id, action), insertSubmit
-->