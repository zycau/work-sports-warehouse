<?php
    $sortArr = [['0','Please select'],['N','Name (A-Z)'],['ND','Name (Z-A)'],['P','Price (low to high)'],['PD','Price (high to low)']];
    $itemNumberArr = [['10','10 items'],['20','20 items']];

    $code = rand(0,10000);
?>

<section id='products'>
    <h2><?= $searchTitle ?></h2>
    <?php if($_SESSION['count']>0): ?>
    <form action="search.php" method='get' id="sortBy">
        <input type="hidden" name='code' value='<?= $code ?>'>
        <div class='sort1'>
            <p>
                <!-- 用于选择按什么排序的功能 -->
                <label for="sort">Sort by</label>
                <select name="sort" id='sort'>
                    <?php foreach($sortArr as $v): ?>
                    <?php if($v[0]==$_SESSION['sortSelect']): ?>
                        <option value="<?= $v[0] ?>" selected><?= $v[1] ?></option>
                    <?php else: ?>
                        <option value="<?= $v[0] ?>"><?= $v[1] ?></option>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </p>    
            <p>
                <!-- 用于选择每页显示几个item -->
                <label for="itemNumber">Items display in one page</label>
                <select name="itemNumber" id='itemNumber'>                    
                    <?php foreach($itemNumberArr as $v): ?>
                    <?php if($v[0]==$_SESSION['itemNumber']): ?>
                        <option value="<?= $v[0] ?>" selected><?= $v[1] ?></option>
                    <?php else: ?>
                        <option value="<?= $v[0] ?>"><?= $v[1] ?></option>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </p>            
        </div>
        <div class='sort2'>
            <!-- 用于选择看哪些类别 -->            
            <?php 
                $chooseCategory = [];
                foreach($PC as $v){
                    if(!in_array([$v['CategoryID'],$v['CategoryName']],$chooseCategory)){
                        $chooseCategory[] = [$v['CategoryID'],$v['CategoryName']];
                    }
                }
            ?>
            <?php if(count($chooseCategory)>0){ ?>
                <p>Select Categories</p>
                <div>                
                    <?php foreach($chooseCategory as $v): ?>
                    <p>
                        <label for="checkbox<?= $v[0] ?>"><?= $v[1] ?></label>
                        <input type="checkbox" id='checkbox<?= $v[0] ?>' name='category<?= $v[0] ?>'>
                    </p>                
                    <?php endforeach; ?>
                </div>
            <?php } ?>
        </div>        
        <!-- 提交按钮 -->
        <input type="submit" name='sortSubmit' aria-label='sort submit' value='Confirm'>
    </form>
    <?php endif; ?>
    <p id='products-msg'><?= $message ?></p>
    <p id='page'>
        <!-- 用于显示页码 -->
        <?php if($_SESSION['count']/$_SESSION['itemNumber']>0): ?>
        <?php for($i=1;$i<=ceil($_SESSION['count']/$_SESSION['itemNumber']);$i++): ?>
        <?php if($i == $_SESSION['page']): ?>
            <a href="search.php?page=<?= $i ?>" class='pageSelected'><?= $i ?></a>
        <?php else: ?>
            <a href="search.php?page=<?= $i ?>"><?= $i ?></a>
        <?php endif; ?>
        <?php endfor; ?>
        <?php endif; ?>
    </p>
    <div id='products-area'>
        <?php foreach ($P as $v): ?>
        <a href="product.php?id=<?= $v['ProductID'] ?>" class='item'>
            <div><img src="images/products/<?= $v['Photo'] ?>" alt="<?= $v['ProductName'] ?> picture" width='140' height='140'></div>
            <div class='item-text'>
            <?php if($v['SalePrice'] != $v['Price']){ ?>
                <p><em>$<?= $v['SalePrice'] ?></em></p>
                <p>was <span>$<?= $v['Price'] ?></span></p>
                <p><?= $v['ProductName'] ?></p>
            <?php }else{ ?>
                <p>$<?= $v['Price'] ?></p>
                <p></p>
                <p><?= $v['ProductName'] ?></p>
            <?php } ?>
            </div>                
        </a>
        <?php endforeach; ?>            
    </div>
</section>