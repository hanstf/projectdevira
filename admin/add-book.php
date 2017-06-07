<?php
    require_once '../component/dbconnect.php';
    require_once '../component/database.php';
    $db = new database($pdo);
    $transactions = $db->get("SELECT COUNT(RANDOM_ID) AS TOTAL_ROWS, RANDOM_ID FROM transaction GROUP BY RANDOM_ID");
?>


    <!doctype html>
    <html class="no-js" lang="">
    <?php 
    require 'template/template.php'
?>

        <body>
            <?php
    require 'template/header.php';
?>
                <div class="shopping-cart-area section-padding">
                    <div class="container">
                        <div class="row">

                            <h1>
                   ADD BOOK
               </h1>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="wishlist-table-area table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="product-remove">Random Id</th>
                                                <th class="product-image">Username</th>
                                                <th class="product-quantity">Create Date</th>
                                                <th class="t-product-name">Book Code</th>
                                                <th class="product-edit">Quantity</th>
                                                <th class="product-unit-price">Status</th>
                                                <th class="product-subtotal">Sub Total</th>
                                                <th class="product-subtotal">Total Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                        foreach ($transactions as $key => &$info) {
                                            $transaction = $db->get("SELECT t.USERNAME, t.DT_CREATE, t.BOOK_CODE, t.QUANTITY, t.STATUS, b.price, SUM(b.price) as TOTAL_PRICE FROM transaction t INNER JOIN book b ON t.BOOK_CODE = b.CODE WHERE t.RANDOM_ID = '" . $info[1] . "'");
                                            
                                    ?>
                                                <tr>
                                                    <td class="t-product-name" colspan="<?php echo $info[0] ?>">
                                                        <?php echo $info[1] ?>
                                                    </td>
                                                    <td class="t-product-name" colspan="<?php echo $info[0] ?>">
                                                        <?php echo $transaction[0][0] ?>
                                                    </td>

                                                    <td class="t-product-name" colspan="<?php echo $info[0] ?>">
                                                        <?php echo $transaction[0][1] ?>
                                                    </td>
                                                    <?php
                                        foreach ($transaction as $innerKey => &$detail) {
                                            ?>


                                                        <td class="t-product-name">
                                                            <?php echo $detail[2] ?>
                                                        </td>
                                                        <td class="t-product-name">
                                                            <?php echo $detail[3] ?>
                                                        </td>
                                                        <td class="t-product-name">
                                                            <?php echo $detail[4] ?>
                                                        </td>
                                                        <td class="t-product-name">
                                                            <?php echo $detail[5] ?>
                                                        </td>


                                                        <?php
                                        }
                                            ?>
                                                            <td class="t-product-name" colspan="<?php echo $info[0] ?>">
                                                                <?php echo $transaction[0][6] ?>
                                                            </td>
                                                </tr>
                                                <?php
                                        }
                                    ?>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php 
                require 'template/footer.php';
            ?>
                    <?php 
                require 'template/script.php';
            ?>
        </body>

    </html>