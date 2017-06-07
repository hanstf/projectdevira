<?php $uri = explode('admin/', $_SERVER['REQUEST_URI'])[1] ?>
   <div class="header-area">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-6">
                <div class="header-logo">
                    <h1>ADMIN PAGE</h1>
                </div>
            </div>
            <div class="col-md-8 col-sm-12 hidden-xs">
                <div class="mainmenu text-center">
                    <nav>
                        <ul id="nav">
                            <li><a href="transaction-list.php" class="<?php if ($uri == 'transaction-list.php') { echo 'active'; }?>">TRANSACTION LIST</a></li>
                            <li><a href="add-book.php" class="<?php if ($uri == 'add-book.php') { echo 'active'; }?>">ADD BOOK</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>


<!--Header Area End-->


<!-- Mobile Menu Start -->
<div class="mobile-menu-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="mobile-menu">
                    <nav id="dropdown">
                        <ul>
                            <li><a href="transaction-list.php" class="<?php if ($uri == 'transaction-list.php') { echo 'active'; }?>">TRANSACTION LIST</a></li>
                            <li><a href="add-book.php" class="<?php if ($uri == 'add-book.php') { echo 'active'; }?>">ADD BOOK</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Mobile Menu End -->