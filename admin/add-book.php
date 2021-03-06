<?php
    require_once '../component/dbconnect.php';
    require_once '../component/database.php';
    $db = new database($pdo);
?>


    <!doctype html>
    <html class="no-js" lang="">
    <?php 
    require 'template/template.php'
?>

        <body>
            <?php
    require 'template/header.php';
        if(isset($_POST["submit"])) {
         if (isset($_POST["code"]) 
        && isset($_POST["title"]) 
        && isset($_POST["description"]) 
        && isset($_POST["stock"]) 
        && isset($_POST["price"])
        && isset($_POST["deleted"])
       ) {
        if (empty($_POST["code"]) 
        || empty($_POST["title"]) 
        || empty($_POST["description"]) 
        || empty($_POST["stock"]) 
        || empty($_POST["price"])
        || empty($_POST["deleted"])
       ) {  
        } else {
        $uploadOk = 1;
        $target_dir = "../img/books/";
        $target_file = $target_dir . basename($_FILES["newImage"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            if (isset($_FILES["newImage"]) == true && $_FILES["newImage"]["tmp_name"] != "" && $_FILES["newImage"]["name"] != "") {
                 $check = getimagesize($_FILES["newImage"]["tmp_name"]);
                 if($check === false) {
                    $uploadOk = 0;
                 } else {
                    $uploadOk = 1;
                 }

                 if ($uploadOk == 0) {
                     echo "<div class='failed-class'>
                                         <div class='container'><div class='row'>
                     <h3>Invalid Image</h3>
                                             </div></div></div>";
                 } else {
                     if (move_uploaded_file($_FILES["newImage"]["tmp_name"], $target_file)) {
                        $uploadOk = 1;
                         echo "<div class='saved-class'>
                                                                                          <div class='container'><div class='row'>
                                                                      <h3>File has been uploaded</h3>
                                                                                              </div></div></div>";
                     } else {
                        $uploadOk = 0;
                         echo "<div class='failed-class'>
                                                                 <div class='container'><div class='row'>
                                             <h3>There was an error while uploading your image</h3>
                                                                     </div></div></div>";
                     }
                 }
            }
            if ($uploadOk == 1) {
                $img = ((isset($_FILES["newImage"]) == true && $_FILES["newImage"]["tmp_name"] != "" && $_FILES["newImage"]["name"] != "") ? "IMAGE = '". $target_file ."', " : "");
                if ($_POST["isnew"] == "true" ) {
                    $db->update(
                                       "INSERT INTO book (ID, CODE, TITLE, DSCP, STOCK, IS_DEL, DT_CREATE, CREATE_BY, DT_UPDATE, UPDATE_BY, PRICE, IMAGE) VALUES ("
                                       . "FLOOR(RAND() * 401) + 100, "
                                       . "'" . $_POST["code"] . "', "
                                       . "'" . $_POST["title"] . "', "
                                       . "'" . $_POST["description"] . "', "
                                       . "" . $_POST["stock"] . ", "
                                       . "'" . $_POST["deleted"] . "', "
                                       . "NOW(), "
                                       . "'hans', "
                                       . "NOW(), "
                                       . "'hans', "
                                       . "" . $_POST["price"] . ", "
                                       . "'". $target_file ."');"
                                        ); // will get the update by and create by from the session available for nw hard code to hans
                            echo "<div class='saved-class'>
                                    <div class='container'><div class='row'>
                <h3>Successfully saved</h3>
                                        </div></div></div>";
                } else {
                    $db->update(
                                       "UPDATE book SET "
                                       . "TITLE = '" . $_POST["title"] . "', "
                                       . "DSCP = '" . $_POST["description"] . "', "
                                       . "STOCK = '" . $_POST["stock"] . "', "
                                       . "IS_DEL = '" . $_POST["deleted"] . "', "
                                       . "PRICE = '" . $_POST["price"] . "', "
                                       . $img
                                       . "DT_UPDATE = NOW(), "
                                       . "UPDATE_BY = 'hans' WHERE CODE = '" .  $_POST["code"] . "'"
                                        ); // will get the update by from the session available for nw hard code to hans
                            echo "<div class='saved-class'>
                                    <div class='container'><div class='row'>
                <h3>Successfully saved</h3>
                                        </div></div></div>";
                }
                
                            unset($_POST);
            }

        } 
        }
    }
    $showPerPage = 2;
    if (isset($_POST["page"])) {
        $books = $db->get("SELECT * FROM book LIMIT " .$showPerPage. " OFFSET ".($showPerPage * $_POST["page"])."");
    if (isset($_POST["searchBtn"])) {
        if (empty($_POST["search"]) == false && $_POST["search"] != "") {
            $books = $db->get("SELECT * FROM book WHERE CODE LIKE '%". $_POST["search"] ."%' OR TITLE LIKE '%". $_POST["search"] ."%' OR DSCP LIKE '%". $_POST["search"] ."%' OR PRICE LIKE '%". $_POST["search"] ."%' LIMIT " .$showPerPage. " OFFSET ".($showPerPage * $_POST["page"])."");
        }
    }
    } else {
         $books = $db->get("SELECT * FROM book LIMIT " .$showPerPage. " OFFSET 0");
    if (isset($_POST["searchBtn"])) {
        if (empty($_POST["search"]) == false && $_POST["search"] != "") {
            $books = $db->get("SELECT * FROM book WHERE CODE LIKE '%". $_POST["search"] ."%' OR TITLE LIKE '%". $_POST["search"] ."%' OR DSCP LIKE '%". $_POST["search"] ."%' OR PRICE LIKE '%". $_POST["search"] ."%' LIMIT " .$showPerPage. " OFFSET 0");
        }
    }
    }
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
                                <form action="" method="post">
                                   <input type="text" style="width:250px;" placeholder="Title, Code, description or price" name="search" id="search" value="<?php echo ((isset($_POST["search"]) == true) ?  $_POST["search"] :  '') ?>"/>
                                   <button class="btn btn-search btn-small" style="margin-top:10px;margin-bottom:10px;" name="searchBtn" id="searchBtn">Search</button>
                                </form>
                                <div class="table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="product-remove">No. </th>
                                                <th class="product-image">Image</th>
                                                <th class="product-image">Code</th>
                                                <th class="product-quantity">Title</th>
                                                <th class="product-name">Description</th>
                                                <th class="product-edit">Stock</th>
                                                <th class="product-subtotal">Price</th>
                                                <th class="product-unit-price">Deleted</th>
                                                <th class="product-subtotal">Create Date</th>
                                                <th class="product-subtotal">Create By</th>
                                                <th class="product-subtotal">Update Date</th>
                                                <th class="product-subtotal">Update By</th>
                                                <th class="product-subtotal"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                        foreach ($books as $key => &$info) {
                                            
                                    ?>
                                                <tr>
                                                    <td class="t-product-name" >
                                                        <?php echo $key+1 ?>
                                                    </td>
                                                    <td class="t-product-name" >
                                                        <img width="170px" height="170px" src="<?php if ($info[11] != '') { echo $info[11]; } else { echo '../img/books/no-image.jpg'; } ?>"></img>
                                                    </td>
                                                    <td class="t-product-name" >
                                                        <?php echo $info[1] ?>
                                                    </td>
                                                    <td class="t-product-name" >
                                                        <?php echo $info[2] ?>
                                                    </td>
                                                    <td class="t-product-name" >
                                                        <?php echo $info[3] ?>
                                                    </td>
                                                    <td class="t-product-name" >
                                                        <?php echo $info[4] ?>
                                                    </td>
                                                    <td class="t-product-name" >
                                                        <?php echo $info[10] ?>
                                                    </td>
                                                    <td class="t-product-name" >
                                                        <?php echo $info[5] ?>
                                                    </td>

                                                    <td class="t-product-name" >
                                                        <?php echo $info[6] ?>
                                                    </td>
                                                    <td class="t-product-name" >
                                                        <?php echo $info[7] ?>
                                                    </td>
                                                    <td class="t-product-name" >
                                                        <?php echo $info[8] ?>
                                                    </td>
                                                     <td class="t-product-name" >
                                                        <?php echo $info[9] ?>
                                                    </td>
                                                    <td class="t-product-name" >
                                                       <?php 
                                                            $obj[$info[1]] = (object) array();
                                                            $booksObj = $obj[$info[1]];
                                                            $booksObj->code = $info[1];
                                                            $booksObj->title = $info[2];
                                                            $booksObj->description = $info[3];
                                                            $booksObj->stock = $info[4];
                                                            $booksObj->price = $info[10];
                                                            $booksObj->deleted = $info[5];
                                                            $booksObj->createDate = $info[6];
                                                            $booksObj->createBy = $info[7];
                                                            $booksObj->updateDate = $info[8];
                                                            $booksObj->updateBy = $info[9];
                                                            $booksObj->image = $info[11];
                                                        ?>
                                                        <a href="#" title="Quick view" data-toggle="modal" onclick='openEditModal(<?php echo json_encode($obj[$info[1]]) ?>)' >EDIT
												        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                        }
                                    ?>


                                        </tbody>
                                    </table>
                                    <button class="btn btn-search btn-small" data-toggle="modal" onclick='openEditModal()' style="margin-top:10px;margin-bottom:10px;margin-left:90%">Add New</button>
                                    <form action="" method="post">
                                        <ul class="pagination">
                                           <?php 
                                            $totalItem = $db->get("SELECT COUNT(*) AS TOTAL FROM book ")[0][0];
    if (isset($_POST["searchBtn"])) {
        if (empty($_POST["search"]) == false && $_POST["search"] != "") {
            $totalItem = $db->get("SELECT COUNT(*) FROM book WHERE CODE LIKE '%". $_POST["search"] ."%' OR TITLE LIKE '%". $_POST["search"] ."%' OR DSCP LIKE '%". $_POST["search"] ."%' OR PRICE LIKE '%". $_POST["search"] ."%'")[0][0];
        }
    }
                                            $totalPage = ceil($totalItem/$showPerPage);
                                            for ($i = 0; $i< $totalPage; $i++) {
                                                if(isset($_POST['page'])) {
                                                    echo '<li><button type="submit" name="page" '. ($_POST['page'] == $i ? 'style="font-weight:bold;border: 0;width: 20px;text-align: center;background: transparent;"': 'style="border: 0;width: 20px;text-align: center;background: transparent;"') .' value="'. $i .'" '. ($_POST['page'] == $i ? 'disabled': '') .'>'.($i+1).'</button></li>';
                                                } else {
                                                    echo '<li><button type="submit" name="page" '. (0 == $i ? 'style="font-weight:bold;border: 0;width: 20px;text-align: center;background: transparent;"': 'style="border: 0;width: 20px;text-align: center;background: transparent;"') .' value="'. $i .'" '. (0 == $i ? 'disabled': '') .'>'.($i+1).'</button></li>';
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="bookModal" tabindex="-1" role="dialog">
                <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h1>Edit This Book</h1>
                        </div>
                        <div class="modal-body">
                            <div class="contact-form-left">
                                <input type="text" placeholder="Book Code" name="codeDisplay" id="codeDisplay" onchange="changeCode()" disabled required/>
								<input type="text" placeholder="Title" name="title" id="title" required/>
                                <input type="text" placeholder="Description" name="description" id="description" required/>
                                <img width="170px" height="170px" id="imageDisplay" style="margin-bottom:10px" ></img>
                                <p>Change this Image</p> <input type="file" name="newImage" id="newImage">
								<input type="text" placeholder="Stock" name="stock" id="stock" required/>
                                <input type="text" placeholder="Price" name="price" id="price" required/>
								Deleted <input type="checkbox" id="deletedCheckbox" onclick="changeDeleted()"/>
                                <input type='hidden' name='deleted' id='deleted' />
                                <input type='hidden' name='code' id='code' />
                                <input type='hidden' name='isnew' id='isnew' />
                                <input type="text" placeholder="Create Date" name="createDate" id="createDate" disabled/>
								<input type="text" placeholder="Create By" name="createBy" id="createBy" disabled/>
                                <input type="text" placeholder="Update Date" name="updateDate" id="updateDate" disabled/>
								<input type="text" placeholder="Update By" name="updateBy" id="updateBy" disabled/>
                                <button class="btn btn-search btn-small" type="submit" name="submit">Save</button>
				            </div>	
                        </div>
                    </div>
                </div>
                </form>
            </div> 
               <script>
                   function openEditModal (content) {
                   console.log(content);
                       if(content) {
                           console.log(content);
                           for (var key in content) {
                                if (key != 'image'){
                                   if (content.hasOwnProperty(key)) {
                                      document.getElementById(key).value = content[key];
                                   }
                                }

                           }
                           if (content.deleted == 'Y') {
                                document.getElementById("deletedCheckbox").checked = true;
                           } else {
                               document.getElementById("deletedCheckbox").checked = false;
                           }

                           document.getElementById("codeDisplay").value = content['code'];

                           if (content['image']) {
                               document.getElementById("imageDisplay").src = content['image'];
                           } else {
                               document.getElementById("imageDisplay").src = "../img/books/no-image.jpg";
                           }
                           document.getElementById("isnew").value = false;
                       } else {
                           document.getElementById("isnew").value = true;
                           document.getElementById("codeDisplay").disabled = false;
                           document.getElementById("deleted").value = 'N';
                       }

                       $("#bookModal").modal();
                   }
                   
                   function changeCode () {
                       document.getElementById("code").value = document.getElementById("codeDisplay").value;
                   }
                   
                   function changeDeleted () {
                       
                       if (document.getElementById("deleted").value == 'Y') {
                           document.getElementById("deleted").value = 'N';
                       } else {
                           document.getElementById("deleted").value = 'Y';
                       }
                       console.log(document.getElementById("deleted").value);
                   }
            </script>   
                <?php 
                require 'template/footer.php';
            ?>
                    <?php 
                require 'template/script.php';
            ?>
        </body>

    </html>