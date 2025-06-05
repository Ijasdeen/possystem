<?php
session_start(); 

require_once('connection.php'); 


    function getAccessToken($username, $password) {
        $url = "https://e-sms.dialog.lk/api/v1/login/"; // Confirm the endpoint
        $data = json_encode([
            "username" => $username,
            "password" => $password
        ]);
    
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    
        $response = curl_exec($ch);
        $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
        if ($response === false) {
            die("cURL error: " . curl_error($ch));
        }
    
        if ($httpStatusCode !== 200) {
            die("Unexpected HTTP response code: $httpStatusCode. Response: $response");
        }
    
        curl_close($ch);
    
        $result = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            die("JSON Decode Error: " . json_last_error_msg());
        }
    
        if (isset($result['status']) && $result['status'] === 'success') {
            return $result['token'];
        } else {
            $comment = $result['comment'] ?? 'No comment available';
            die("Error: " . $comment);
        }
    }
    
    function generateOTP() {
        return rand(1000, 9999); // Generate a random number between 1000 and 9999
    }
    
     
    
    
    function sendSMS($token, $message, $numbers, $sourceAddress, $transactionId, $paymentMethod = 0) {
        $url = "https://e-sms.dialog.lk/api/v2/sms/";
        $msisdn = array_map(fn($num) => ["mobile" => $num], $numbers);
        $data = json_encode([
            "msisdn" => $msisdn,
            "message" => $message,
            "sourceAddress" => $sourceAddress,
            "transaction_id" => $transactionId,
            "payment_method" => $paymentMethod
        ]);
    
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: Bearer " . $token
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    
        $response = curl_exec($ch);
        $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
        if ($response === false) {
            die("cURL error: " . curl_error($ch));
        }
    
        if ($httpStatusCode !== 200) {
            die("Unexpected HTTP response code: $httpStatusCode. Response: $response");
        }
    
        curl_close($ch);
    
        $result = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            die("JSON Decode Error: " . json_last_error_msg());
        }
    
        return $result;
    }

    
    function sendlineupssms($mobile, $message) {
        $username = "kingsparrowuser";
        $password = "Nowfar@112233";
        $numbers = [$mobile];
        $sourceAddress = "Sparrow";
   
    
        $transactionId = strval(random_int(100000000000000, 999999999999999));
          
    
        $token = getAccessToken($username, $password);
        if (!$token) {
            die("Failed to generate access token.");
        }
    
        return sendSMS($token, $message, $numbers, $sourceAddress, $transactionId);
    }
    
      if(isset($_POST['sendOTP'])){
         $otp = generateOTP(); 
         $mobile = $_POST['mobile']; 
         
         $query ="SELECT id from `admin` where mobilenumber='$mobile'";
         $result = mysqli_query($connection,$query); 
         if($result){
                if(mysqli_num_rowS($result) >0) {
                    $message = "Dear Admin. Your otp for main login is ".$otp."
                    ~Thank you~
                    "; 
                    sendlineupssms($mobile,$message); 
                    echo $otp; 
                }
                else {
                    echo 12; 
                }
         } 
         else {
            echo mysqli_error($connection); 
         }
         $message = "Your OTP NO : ".$otp;
         
      }  

      if(isset($_POST['resetpassword'])){
        $confirmpassword = $_POST['confirmpassword']; 
        $query = "UPDATE `admin` SET `password`='$confirmpassword'";
        echo mysqli_query($connection,$query);
      }
 
 if (isset($_POST['saveColor'])) {
    $name = ucwords(trim($_POST['name'])); // Capitalize first letter of each word

    // Check if color already exists
    $check = $connection->prepare("SELECT id FROM color WHERE name = ?");
    $check->bind_param("s", $name);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo json_encode([
            'status' => 'exist',
            'message' => 'Color already exists.'
        ]);
        exit;
    }

    // Insert new color
    $stmt = $connection->prepare("INSERT INTO color (name) VALUES (?)");
    $stmt->bind_param("s", $name);

    if ($stmt->execute()) {
        echo json_encode([
            'status' => 'success',
            'id' => $stmt->insert_id,
            'message' => 'Color added successfully.'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to insert color.'
        ]);
    }
}



if(isset($_POST['updatecolor'])){
    $id = intval($_POST['id']);
    $name = isset($_POST['name']) ? ucwords(trim($_POST['name'])) : '';

    // Check if brand name exists for another id to prevent duplicates
    $check = $connection->prepare("SELECT id FROM color WHERE name = ? AND id != ?");
    $check->bind_param("si", $name, $id);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo json_encode(['status' => 'exist']);
        exit;
    }

    $stmt = $connection->prepare("UPDATE color SET name = ? WHERE id = ?");
    $stmt->bind_param("si", $name, $id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Update failed']);
    }
    exit;
    
}

 
if (isset($_POST['action']) && $_POST['action'] === 'update_brand') {
    $id = intval($_POST['id']);
    $name = isset($_POST['name']) ? ucwords(trim($_POST['name'])) : '';

 
    $check = $connection->prepare("SELECT id FROM brand WHERE name = ? AND id != ?");
    $check->bind_param("si", $name, $id);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo json_encode(['status' => 'exist']);
        exit;
    }

    $stmt = $connection->prepare("UPDATE brand SET name = ? WHERE id = ?");
    $stmt->bind_param("si", $name, $id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Update failed']);
    }
    exit;

}



if (isset($_POST['deleteBranch'])) {
    $id = $_POST['id'] ?? null;

    if ($id) {
        $query = "DELETE FROM branches WHERE id = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "1"; // Success
        } else {
            echo "0"; // Failed
        }

        $stmt->close();
    } else {
        echo "0"; // Invalid ID
    }
}


if (isset($_POST['deleteWarehouse'])) {
    $id = $_POST['id'] ?? null;

    if ($id) {
        $query = "DELETE FROM warehouse WHERE id = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "1"; // Success
        } else {
            echo "0"; // Failed
        }

        $stmt->close();
    } else {
        echo "0"; // Invalid ID
    }
}
 if (isset($_POST['deleteCashiersection'])) {
    $myid = $_POST['myid'];
    $query = "DELETE FROM cashiers where cashiers.id='$myid'";
    $result = mysqli_query($connection,$query); 
    echo $result ? 1 : 0; 

}

 if (isset($_POST['deleteStore'])) {
    $myid = $_POST['myid'];
    $query = "DELETE FROM store where id='$myid'";
    $result = mysqli_query($connection,$query); 
    echo $result ? 1 : 0; 

}




if (isset($_POST['showoffStore'])) {
    $query = "SELECT * FROM store";
    $result = mysqli_query($connection, $query); 
    $index = 0;

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td>
                        <?php echo ++$index; ?>
                    </td>
                    <td>
                        <?php echo $row['name']; ?>
                    </td>
                    <td>
                        <div class="dropdown">
                          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton<?php echo $row['id']; ?>" data-bs-toggle="dropdown" aria-expanded="false">
                            Choose
                          </button>
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton<?php echo $row['id']; ?>">
                            <li>
                                <a class="dropdown-item editStoreSectionlineup" myid="<?php echo $row['id']; ?>" name="<?php echo $row['name']; ?>">
                                    <i class="menu-icon tf-icons bx bx-edit"></i>&nbsp;Edit
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item deleteStore" myid="<?php echo $row['id']; ?>" href="#">
                                    <i class="menu-icon tf-icons bx bx-trash"></i>&nbsp;Delete
                                </a>
                            </li>
                          </ul>
                        </div>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="3">
                    <span class="text text-danger fw-bold">No store found</span>
                </td>
            </tr>
            <?php
        }
    } else {
        echo mysqli_error($connection); 
    }
}



 if(isset($_POST['showOffCashier'])){
    $query = "SELECT * FROM cashiers";
    $result = mysqli_query($connection,$query); 
    $index =0; 
    if($result){
        if(mysqli_num_rows($result) >0 ){
              while($row = mysqli_fetch_assoc($result)){
                ?>
                <tr>
                    <td>
                        <?php echo ++$index?>
                    </td>
                    <td>
                        <?php echo $row['name']?>
                    </td>
                    <td>
                        <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    Choose
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    <li><a class="dropdown-item editCashiersection" myid="<?php echo $row['id']?>" name="<?php echo $row['name']?>" href="#"><i class="menu-icon tf-icons bx bx-edit"></i>&nbsp;Edit</a></li>
    <li><a class="dropdown-item deleteCashier" myid="<?php echo $row['id']?>" href="#"><i class="menu-icon tf-icons bx bx-trash"></i>&nbsp;Delete</a></li>
                
  </ul>
</div>

                    </td>
                </tr>
                <?php
              }
        }
        else {
            ?>
              <tr>
                <td>
                    <span class="text text-danger fw-bold">No cashier found</span>
                </td>
              </tr>
            <?php
        }
    } 
    else {
        echo mysqli_error($connection); 
    }
 }

 if(isset($_POST['showoffSavedItems'])){
    $myid = $_POST['myid'] ?? null;
    if (!$myid) {
        echo "0"; // No ID provided
        exit;
    }

    $selectedid = 0; 
    $query = "SELECT id from purcahse where purchaseInvoiceNo='$myid'"; 
    $result = mysqli_query($connection, $query);
    if (!$result) {
        echo mysqli_error($connection); // Log error
        exit;
    }
    if(mysqli_num_rows($result) >0) {
        $row = mysqli_fetch_assoc($result);
        $selectedid = $row['id'];
    }

    $squery = "SELECT pr_items.id, pr_items.barcode, pr_items.item_code, pr_items.invoice_item_name, pr_items.item_name, pr_items.tag_name, 
              pr_items.category_id, pr_items.subcategory1_id, pr_items.subcategory2_id, pr_items.subcategory3_id, 
              pr_items.color_id, pr_items.brand_id, pr_items.unit_id, pr_items.quantity, 
              pr_items.cost_price, pr_items.retail_mini_price, pr_items.retail_price, 
              pr_items.retail_discount, pr_items.retail_discount_percent, pr_items.sale_price
              FROM purcahse 
              JOIN pr_items ON purcahse.id = pr_items.purchase_id_fk
              WHERE purcahse.id = '$selectedid'";
    $sresult = mysqli_query($connection, $squery);
    if (!$sresult) {
        echo mysqli_error($connection); // Log error
        exit;
    }
    if ($sresult && mysqli_num_rows($sresult) > 0) {
        $index = 0;
        while ($row = mysqli_fetch_assoc($sresult)) {
            $lineTotal = $row['quantity'] * $row['cost_price'];
            ?>
            <tr>
                <td><?php echo htmlspecialchars($row['item_code']); ?></td>
                <td><?php echo htmlspecialchars($row['barcode']); ?></td>
                <td><?php echo htmlspecialchars($row['batch_id']); ?></td>
                <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                <td><?php echo htmlspecialchars($row['cost_price']); ?></td>
                <td><?php echo htmlspecialchars($row['retail_mini_price']); ?></td>
                <td><?php echo htmlspecialchars($row['retail_discount']); ?></td>
                <td><?php echo htmlspecialchars($row['sale_price']); ?></td>
                <td><?php echo number_format($lineTotal, 2); ?></td>
            </tr>
            <?php
        }
    } else {
        ?>
        <tr>
            <td colspan="10" class="text-danger fw-bold">No items found</td>
        </tr>
        <?php
    }



 }


  if (isset($_POST['showOffSuppliers'])) {
    $query = "SELECT id, supplier_name FROM supplier";
    if ($result = mysqli_query($connection, $query)) {
        if (mysqli_num_rows($result) > 0) {
            $options = '<option value="">--Choose one--</option>';
            while ($row = mysqli_fetch_assoc($result)) {
                $id = htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8');
                $name = htmlspecialchars($row['supplier_name'], ENT_QUOTES, 'UTF-8');
                $options .= "<option value=\"$id\">$name</option>";
            }
            echo $options;
        } else {
            echo '<option value="">-- No Supplier found --</option>';
        }
    } else {
        error_log(mysqli_error($connection)); // Better to log errors in production
        echo '<option value="">-- Error fetching suppliers --</option>';
    }
}

if(isset($_POST['showoffColors'])){
    $query = "SELECT * FROM color";
    $result = mysqli_query($connection,$query); 
    if($result){
          if(mysqli_num_rows($result) >0) {
            ?>
            <option value="">--Choose one--</option>
            <?php
           
            while($row = mysqli_fetch_assoc($result)){
                ?>
                <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
                <?php
            }

          }
          else {
            ?>
            <option value="">--No data found--</option>
            <?php

          }
    } 
    else {
        echo mysqli_error($connection); 
    }
}



if(isset($_POST['showoffBrands'])){
    $query = "SELECT * FROM brand";
    $result = mysqli_query($connection,$query); 
    if($result){
          if(mysqli_num_rows($result) >0) {
            ?>
            <option value="">--Choose one--</option>
            <?php
           
            while($row = mysqli_fetch_assoc($result)){
                ?>
                <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
                <?php
            }

          }
          else {
            ?>
            <option value="">--No data found--</option>
            <?php

          }
    } 
    else {
        echo mysqli_error($connection); 
    }
}

if(isset($_POST['showoffsubcategory2'])){
    $subcategory1Id = $_POST['subcategory1Id']; 
    $query = "SELECT * FROM subcategory2 where subcategory1_id_fk='$subcategory1Id'";

    $result = mysqli_query($connection,$query); 
    if($result){
          if(mysqli_num_rows($result) >0) {
            ?>
            <option value="">--Choose one--</option>
            <?php
           
            while($row = mysqli_fetch_assoc($result)){
                ?>
                <option value="<?php echo $row['id']?>"><?php echo $row['subcategory2_name']?></option>
                <?php
            }

          }
          else {
            ?>
            <option value="">--No data found--</option>
            <?php

          }
    } 
    else {
        echo mysqli_error($connection); 
    }
}

if(isset($_POST['getLastPurchaseId'])){
    $query = "SELECT id FROM purcahse ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($connection, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo $row['id'] + 1;
    } else {
        echo "0"; // No purchases found
    }
}



if(isset($_POST['showoffsubcategory322'])){
    $subcategory2Id = $_POST['subcategory2Id']; 
    $query = "SELECT * FROM subcategory3 where subcategory2_id_fk='$subcategory2Id'";
    

    $result = mysqli_query($connection,$query); 
    if($result){
          if(mysqli_num_rows($result) >0) {
            ?>
            <option value="">--Choose one--</option>
            <?php
           
            while($row = mysqli_fetch_assoc($result)){
                ?>
                <option value="<?php echo $row['id']?>"><?php echo $row['subcategory3_name']?></option>
                <?php
            }

          }
          else {
            ?>
            <option value="">--No data found--</option>
            <?php

          }
    } 
    else {
        echo mysqli_error($connection); 
    }
}

if(isset($_POST['showoffsubcategory1'])){
    $categoryId = $_POST['categoryId']; 
    $query = "SELECT * FROM subcategory1 where category_id_fk='$categoryId'";

    $result = mysqli_query($connection,$query); 
    if($result){
          if(mysqli_num_rows($result) >0) {
            ?>
            <option value="">--Choose one--</option>
            <?php
           
            while($row = mysqli_fetch_assoc($result)){
                ?>
                <option value="<?php echo $row['id']?>"><?php echo $row['subcategoryname']?></option>
                <?php
            }

          }
          else {
            ?>
            <option value="">--No data found--</option>
            <?php

          }
    } 
    else {
        echo mysqli_error($connection); 
    }
}


if(isset($_POST['showoffcategory'])){
    $query = "SELECT * FROM categories";
    $result = mysqli_query($connection,$query); 
    if($result){
          if(mysqli_num_rows($result) >0) {
            ?>
            <option value="">--Choose one--</option>
            <?php
           
            while($row = mysqli_fetch_assoc($result)){
                ?>
                <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
                <?php
            }

          }
          else {
            ?>
            <option value="">--No data found--</option>
            <?php

          }
    } 
    else {
        echo mysqli_error($connection); 
    }
}
 

if (isset($_POST['savePurchase'])) {
 
    if (isset($_POST['savePurchase'])) {
    // Collect and sanitize input values
    $barcode = $_POST['barcode'] ?? '';
    $itemCode = $_POST['itemCode'] ?? '';
    $invoiceItemName = $_POST['invoiceItemName'] ?? '';
    $itemName = $_POST['itemName'] ?? '';
    $tagName = $_POST['tagName'] ?? '';
    $category = intval($_POST['category'] ?? 0);
    $subcategory1 = intval($_POST['subcategory1'] ?? 0);
    $subCategory2 = intval($_POST['subCategory2'] ?? 0);
    $subcategory3 = intval($_POST['subcategory3'] ?? 0);
    $color = intval($_POST['color'] ?? 0);
    $brand = intval($_POST['brand'] ?? 0);
    $unit = intval($_POST['unit'] ?? 0);
    $quantity = floatval($_POST['quantity'] ?? 0);
    $costPrice = floatval($_POST['costPrice'] ?? 0);
    $retailMiniPrice = floatval($_POST['retailMiniPrice'] ?? 0);
    $retailPrice = floatval($_POST['retailPrice'] ?? 0);
    $retailDiscount = floatval($_POST['retailDiscount'] ?? 0);
    $retailDiscountPercent = floatval($_POST['retailDiscountPercent'] ?? 0);
    $salePrice = floatval($_POST['salePrice'] ?? 0);
    $purchaseInvoiceNo222 = $_POST['purchaseInvoiceNo'] ?? '';
    $supplier_date = $_POST['supplierInvoiceDate'] ?? '';
    $tagname = $_POST['tagNames'] ?? '';
    $supplierInvoiceNo = $_POST['supplierInvoiceNumber'] ?? '';
    $purcahseplace = 'warehouse';
    $place_id_fk = 1;
    $batch_id = 1;
    $supplier_id_fk = intval($_POST['chooseSupplierDropdown'] ?? 0);
    $lastPrItemId = 0;

    date_default_timezone_set('Asia/Kolkata');
$kolkataDateTime = date('Y-m-d H:i:s'); 

    // Insert into purcahse table
    $sql = "INSERT INTO purcahse (supplier_date, tagname, supplierInvoiceNo, purchaseInvoiceNo, purcahseplace, place_id_fk, batch_id, supplier_id_fk,purcahsed_datetime)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?,?)";

    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssssiis", $supplier_date, $tagname, $supplierInvoiceNo, $purchaseInvoiceNo222, $purcahseplace, $place_id_fk, $batch_id, $supplier_id_fk,$kolkataDateTime);

    if (!$stmt->execute()) {
        echo "Error (purchase insert): " . $stmt->error;
        exit;
    }
    $stmt->close();

    // Get the inserted purchase ID
    $purchaseId = $connection->insert_id;

    // Insert into pr_items table
    $sqlItems = "INSERT INTO pr_items (
        purchase_id_fk, barcode, item_code, invoice_item_name, item_name, tag_name,
        category_id, subcategory1_id, subcategory2_id, subcategory3_id,
        color_id, brand_id, unit_id, quantity, cost_price, retail_mini_price,
        retail_price, retail_discount, retail_discount_percent, sale_price
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmtItems = $connection->prepare($sqlItems);

    $stmtItems->bind_param(
        "isssssiiiiiiiddddddd",
        $purchaseId,
        $barcode,
        $itemCode,
        $invoiceItemName,
        $itemName,
        $tagName,
        $category,
        $subcategory1,
        $subCategory2,
        $subcategory3,
        $color,
        $brand,
        $unit,
        $quantity,
        $costPrice,
        $retailMiniPrice,
        $retailPrice,
        $retailDiscount,
        $retailDiscountPercent,
        $salePrice
    );

    if (!$stmtItems->execute()) {
        echo "Error (pr_items insert): " . $stmtItems->error;
        exit;
    }

    $lastPrItemId = $stmtItems->insert_id;
    $stmtItems->close();

    echo $lastPrItemId;
}


}



if(isset($_POST['saveSizes'])){
$saveSizes = $_POST['saveSizes'] ?? null;
$myid = $_POST['myid'] ?? null;
$sizesJson = $_POST['sizes'] ?? null;

// Decode sizes JSON string into an array
$sizes = json_decode($sizesJson, true);

// Check if data is valid
if (is_array($sizes) && !empty($myid)) {
    foreach ($sizes as $row) {
        $sizeName = $row['sizeName'] ?? NULL;
        $qty = $row['warehouse'] ?? NULL; // Assuming "warehouse" holds quantity value
     
        $stmt = $connection->prepare("INSERT INTO sizes (pr_id_fk, size, qty) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $myid, $sizeName, $qty);
        $stmt->execute();
    }

    echo "Sizes saved successfully.";
} else {
    echo "Invalid data received.";
}


}


 
if (isset($_POST['Updateform'])) {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Sanitize and get values
        $admin_name = mysqli_real_escape_string($connection, $_POST['admin_name'] ?? '');
        $shop_name = mysqli_real_escape_string($connection, $_POST['shop_name'] ?? '');
        $shop_mobile = mysqli_real_escape_string($connection, $_POST['shop_mobile'] ?? '');

        // Handle file upload
        $shop_logo_name = '';
        if (!empty($_FILES['admin_logo']['name'])) {
            $fileTmp = $_FILES['admin_logo']['tmp_name'];
            $fileName = $_FILES['admin_logo']['name'];
            $fileType = mime_content_type($fileTmp);

            // Allow only images
            if (strpos($fileType, 'image/') !== 0) {
                echo 'Only image files are allowed.';
                exit;
            }

            // Sanitize filename (remove spaces and special chars)
            $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
            $safeName = time() . '_' . preg_replace("/[^a-zA-Z0-9_-]/", "", pathinfo($fileName, PATHINFO_FILENAME)) . '.' . $fileExt;

            $upload_dir = 'uploads/';
            $upload_path = $upload_dir . $safeName;

            // Check if upload directory exists
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            if (!move_uploaded_file($fileTmp, $upload_path)) {
                echo 'Failed to upload logo.';
                exit;
            }

            $shop_logo_name = $safeName;
        }

        // Build SQL query
        $update_query = "UPDATE admin SET 
                            admin_name = '$admin_name',
                            shop_name = '$shop_name',
                            mobilenumber = '$shop_mobile'";

        if ($shop_logo_name !== '') {
            $update_query .= ", shop_logo = '$shop_logo_name'";
        }

        $update_query .= " LIMIT 1";

        // Execute the query
        if (mysqli_query($connection, $update_query)) {
            echo 1; 
        } else {
            echo 'Error: ' . mysqli_error($connection);
        }
    }
}



 if (isset($_POST['changepassword'])) {
    $oldpassword = mysqli_real_escape_string($connection, $_POST['oldpassword']);
    $confirmpassword = mysqli_real_escape_string($connection, $_POST['confirmpassword']);

    // Check if admin with old password exists
    $query = "SELECT id FROM `admin` WHERE password = '$oldpassword' LIMIT 1";
    $result = mysqli_query($connection, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $adminId = $row['id'];

            // Update password for that admin
            $updateQuery = "UPDATE `admin` SET password = '$confirmpassword' WHERE id = '$adminId'";
            $updateResult = mysqli_query($connection, $updateQuery);

            echo $updateResult ? 1 : 0; // 1 = success, 0 = update failed
        } else {
            echo 12; // Old password incorrect
        }
    } else {
        echo "Query Error: " . mysqli_error($connection);
    }
}


if(isset($_POST['showoffUnits'])){
    $query = "SELECT * FROM unit";
    $result = mysqli_query($connection,$query); 
    if($result){
          if(mysqli_num_rows($result) >0) {
            ?>
            <option value="">--Choose one--</option>
            <?php
           
            while($row = mysqli_fetch_assoc($result)){
                ?>
                <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
                <?php
            }

          }
          else {
            ?>
            <option value="">--No data found--</option>
            <?php

          }
    } 
    else {
        echo mysqli_error($connection); 
    }
}


 if(isset($_POST['assigntobranchesss'])){
    $branch_id = $_POST['branch_id']; 
    $branch_name = $_POST['branch_name']; 
    $cashierIds = $_POST['cashierIds']; 
    $warehouseIds = $_POST['warehouseIds']; 
    $storeIds = $_POST['storeIds']; 

    // Ensure these are arrays, if not convert empty
    $cashierIds = is_array($cashierIds) ? $cashierIds : [];
    $warehouseIds = is_array($warehouseIds) ? $warehouseIds : [];
    $storeIds = is_array($storeIds) ? $storeIds : [];

    // Sort arrays for consistent comparison
    sort($cashierIds);
    sort($warehouseIds);
    sort($storeIds);

    // Convert arrays to comma-separated strings for DB storage
    $cashierIdsStr = implode(',', $cashierIds);
    $warehouseIdsStr = implode(',', $warehouseIds);
    $storeIdsStr = implode(',', $storeIds);

    // Database connection assumed in $connection
    // Check for duplicates in existing records for this branch
    $checkQuery = "SELECT * FROM assign WHERE branch_id_fk = '$branch_id'";
    $checkResult = mysqli_query($connection, $checkQuery);

    $duplicateFound = false;
    while($row = mysqli_fetch_assoc($checkResult)) {
        $existingWarehouse = explode(',', $row['warehouse']);
        $existingStore = explode(',', $row['store']);
        $existingCashiers = explode(',', $row['cashiers']);

        sort($existingWarehouse);
        sort($existingStore);
        sort($existingCashiers);

        if (
            $warehouseIds === $existingWarehouse &&
            $storeIds === $existingStore &&
            $cashierIds === $existingCashiers
        ) {
            $duplicateFound = true;
            break;
        }
    }

    if ($duplicateFound) {
      
    }

    // Insert new record if no duplicate
    $insertQuery = "INSERT INTO assign (branch_id_fk, warehouse, store, branchname, cashiers) 
                    VALUES ('$branch_id', '$warehouseIdsStr', '$storeIdsStr', '$branch_name', '$cashierIdsStr')";

    if (mysqli_query($connection, $insertQuery)) {
        echo "1"; // success response
    } else {
        echo "Insert error: " . mysqli_error($connection);
    }
}



 if (isset($_POST['showOffBranches'])) {
    $query = "SELECT id, `name` FROM branches";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        echo mysqli_error($connection);
        exit;
    }

    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if (count($rows) > 0) {
        echo '<option value="">--Choose one--</option>';
        foreach ($rows as $row) {
            echo '<option value="' . $row['id'] . '">' . htmlspecialchars($row['name']) . '</option>';
        }
    } else {
        echo '<option value="">--No data found--</option>';
    }
}


   if (isset($_POST['warehouseDropdown'])) {
    $query = "SELECT id, name FROM warehouse";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        echo mysqli_error($connection);
        exit;
    }

    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if (count($rows) > 0) {
        echo '<li><a class="dropdown-item" href="#">--Choose one--</a></li>';
        foreach ($rows as $row) {
            echo '<li><a class="dropdown-item warehousedrrpdown" myid="' . $row['id'] . '" href="#">' . htmlspecialchars($row['name']) . '</a></li>';
        }
    } else {
        echo '<li><a class="dropdown-item" href="#">--None--</a></li>';
    }
}




   if (isset($_POST['storeDrodown'])) {
    $query = "SELECT id, name FROM store";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        echo mysqli_error($connection);
        exit;
    }

    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if (count($rows) > 0) {
        echo '<li><a class="dropdown-item" href="#">--Choose one--</a></li>';
        foreach ($rows as $row) {
            echo '<li><a class="dropdown-item storewarehousedrpdown" myid="' . $row['id'] . '" href="#">' . htmlspecialchars($row['name']) . '</a></li>';
        }
    } else {
        echo '<li><a class="dropdown-item" href="#">--None--</a></li>';
    }
}



 if (isset($_POST['showoffCashiers'])) {
    $query = "SELECT id, name FROM cashiers";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        echo mysqli_error($connection);
        exit;
    }

    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if (count($rows) > 0) {
        echo '<li><a class="dropdown-item cashierdropdown" href="#">--Choose one--</a></li>';
        foreach ($rows as $row) {
            echo '<li><a class="dropdown-item cashierdropdown" myid="' . $row['id'] . '" href="#">' . htmlspecialchars($row['name']) . '</a></li>';
        }
    } else {
        echo '<li><a class="dropdown-item cashierdropdown" href="#">--None--</a></li>';
    }
}



 if (isset($_POST['updateStore'])) {
    $id = intval($_POST['id']);
    $name = ucfirst(trim($_POST['name']));  

    // Check if another store with the same name already exists (excluding current one)
    $stmt = $connection->prepare("SELECT id FROM store WHERE name = ? AND id != ?");
    $stmt->bind_param("si", $name, $id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo 12; // Store name already exists for another record
        exit;
    } else {
        // Update store name
        $update = $connection->prepare("UPDATE store SET name = ? WHERE id = ?");
        $update->bind_param("si", $name, $id);
        $update->execute();

        if ($update->affected_rows > 0) {
            echo 1; // Update success
        } else {
            echo "Update failed or no change";
        }

        $update->close();
    }

    $stmt->close();
}


if (isset($_POST['saveStore'])) {
    $name = ucfirst(trim($_POST['name']));  

    // Check if store name already exists
    $stmt = $connection->prepare("SELECT id FROM store WHERE name = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo 12; // Store already exists
        exit;
    } else {
        // Insert new store name
        $insert = $connection->prepare("INSERT INTO store (name) VALUES (?)");
        $insert->bind_param("s", $name);
        $insert->execute();

        if ($insert->affected_rows > 0) {
            echo 1; // Insert success
        } else {
            echo "Insert failed";
        }

        $insert->close();
    }

    $stmt->close();
}

 


 if (isset($_POST['saveName'])) {
    $name = ucfirst(trim($_POST['name']));  

    $stmt = $connection->prepare("SELECT id FROM cashiers WHERE name = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo 12; // Name already exists
        exit; 
    } else {
        // Insert new name
        $insert = $connection->prepare("INSERT INTO cashiers (name) VALUES (?)");
        $insert->bind_param("s", $name);
        $insert->execute();

        if ($insert->affected_rows > 0) {
          echo 1; 
        } else {
            echo "Insert failed";
        }

        $insert->close();
    }

    $stmt->close();
}


if (isset($_POST['updateBranch'])) {
    $id = $_POST['id'] ?? null;
    $name = ucfirst(trim($_POST['name'] ?? ''));
    $address = trim($_POST['address'] ?? '');
    $mobile = trim($_POST['mobile'] ?? '');
    $landline = trim($_POST['landline'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if ($id && $name !== '') {
        $query = "UPDATE branches SET name = ?, address = ?, mobile = ?, landline = ?, email = ? WHERE id = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("sssssi", $name, $address, $mobile, $landline, $email, $id);

        if ($stmt->execute()) {
            echo "1"; // success
        } else {
            echo "0"; // failure
        }

        $stmt->close();
    } else {
        echo "0"; // invalid input
    }
}


if (isset($_POST['updatewarehouse'])) {
    $id = $_POST['id'] ?? null;
    $name = ucfirst(trim($_POST['name'] ?? ''));
    $address = trim($_POST['address'] ?? '');
    $mobile = trim($_POST['mobile'] ?? '');
    $landline = trim($_POST['landline'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if ($id && $name !== '') {
        $query = "UPDATE warehouse SET name = ?, address = ?, mobile = ?, landline = ?, email = ? WHERE id = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("sssssi", $name, $address, $mobile, $landline, $email, $id);

        if ($stmt->execute()) {
            echo "1"; // success
        } else {
            echo "0"; // failure
        }

        $stmt->close();
    } else {
        echo "0"; // invalid input
    }
}


if (isset($_POST['showBranches'])) {
    $query = "SELECT * FROM branches ORDER BY id DESC";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $index = 0;

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo ++$index; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['address']); ?></td>
                    <td><?php echo htmlspecialchars($row['mobile']); ?></td>
                    <td><?php echo htmlspecialchars($row['landline']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Choose Action
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item editBranch" 
                                       href="#" 
                                       myid="<?php echo $row['id']; ?>"
                                       name="<?php echo htmlspecialchars($row['name']); ?>"
                                       address="<?php echo htmlspecialchars($row['address']); ?>"
                                       mobile="<?php echo htmlspecialchars($row['mobile']); ?>"
                                       landline="<?php echo htmlspecialchars($row['landline']); ?>"
                                       email="<?php echo htmlspecialchars($row['email']); ?>">
                                       Edit <i class="menu-icon tf-icons bx bx-edit"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item deleteBranch" 
                                       href="#" 
                                       myid="<?php echo $row['id']; ?>">
                                       Delete <i class="menu-icon tf-icons bx bx-trash"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="7" class="text-danger fw-bold">No data found</td>
            </tr>
            <?php
        }
    } else {
        echo '<tr><td colspan="7" class="text-danger">Error: ' . mysqli_error($connection) . '</td></tr>';
    }
}



if (isset($_POST['showarehouses'])) {
    $query = "SELECT * FROM warehouse ORDER BY id DESC";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $index = 0;

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo ++$index; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['address']); ?></td>
                    <td><?php echo htmlspecialchars($row['mobile']); ?></td>
                    <td><?php echo htmlspecialchars($row['landline']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Choose Action
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item editBranch" 
                                       href="#" 
                                       myid="<?php echo $row['id']; ?>"
                                       name="<?php echo htmlspecialchars($row['name']); ?>"
                                       address="<?php echo htmlspecialchars($row['address']); ?>"
                                       mobile="<?php echo htmlspecialchars($row['mobile']); ?>"
                                       landline="<?php echo htmlspecialchars($row['landline']); ?>"
                                       email="<?php echo htmlspecialchars($row['email']); ?>">
                                       Edit <i class="menu-icon tf-icons bx bx-edit"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item deleteBranch" 
                                       href="#" 
                                       myid="<?php echo $row['id']; ?>">
                                       Delete <i class="menu-icon tf-icons bx bx-trash"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="7" class="text-danger fw-bold">No data found</td>
            </tr>
            <?php
        }
    } else {
        echo '<tr><td colspan="7" class="text-danger">Error: ' . mysqli_error($connection) . '</td></tr>';
    }
}





if(isset($_POST['showOffBrands'])){
    $query = "SELECT * FROM brand";
    $result = mysqli_query($connection,$query); 
    if($result){
        $index = 0; 
        if(mysqli_num_rows($result) >0) {
            while($row = mysqli_fetch_assoc($result)){
                ?>
                    <tr>
                        <td>
                              <?php echo ++$index?>
                        </td>
                        <td>
                            <?php echo $row['name']?>
                        </td>
                        <td>

                                          <div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    Choose Action
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    <li><a class="dropdown-item editbrandsection" 
    name = "<?php echo $row['name']?>"
    myid = "<?php echo $row['id']?>"
    href="#"
     >Edit <i class="menu-icon tf-icons bx bx-edit"></i>
</a></li>
    <li><a class="dropdown-item deleteBrand" myid="<?php echo $row['id']?>" href="#">Delete <i class="menu-icon tf-icons bx bx-trash"></i>
</a></li>
    
</a></li>
  </ul>
</div>
                            
                        </td>
                    </tr>
                <?php
            }
        }
        else {
            ?>
            <tr>
                <td>
                    <span class="text text-danger fw-bold">No data found</span>
                </td>
            </tr>
            <?php
        }
    } 
    else {
        echo mysqli_error($connection); 
    }
}


if(isset($_POST['deleteColor'])){
    $id = $_POST['id']; 
    $query = "DELETE FROM color where id='$id'";
    echo mysqli_query($connection,$query);  
}




 
if (isset($_POST['saveBranch'])) {
    $name     = ucwords(trim($_POST['name'] ?? NULL));
    $address  = trim($_POST['address'] ?? NULL);
    $mobile   = trim($_POST['mobile'] ?? NULL);
    $landline = trim($_POST['landline'] ?? NULL);
    $email    = trim($_POST['email'] ?? NULL);

    // Check if name already exists
    $check = $connection->prepare("SELECT id FROM branches WHERE name = ?");
    $check->bind_param("s", $name);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo json_encode([
            'status' => 'exist',
            'message' => 'Branch already exists.'
        ]);
        exit;
    }

    // Insert new branch
    $stmt = $connection->prepare("INSERT INTO branches (name, address, mobile, landline, email) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $address, $mobile, $landline, $email);

    if ($stmt->execute()) {
        echo json_encode([
            'status' => 'success',
            'id' => $stmt->insert_id,
            'message' => 'Branch added successfully.'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to insert branch.'
        ]);
    }
}


if (isset($_POST['savewarehousesection'])) {
    $name     = ucwords(trim($_POST['name'] ?? NULL));
    $address  = trim($_POST['address'] ?? NULL);
    $mobile   = trim($_POST['mobile'] ?? NULL);
    $landline = trim($_POST['landline'] ?? NULL);
    $email    = trim($_POST['email'] ?? NULL);

   
    $check = $connection->prepare("SELECT id FROM warehouse WHERE name = ?");
    $check->bind_param("s", $name);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo json_encode([
            'status' => 'exist',
            'message' => 'Branch already exists.'
        ]);
        exit;
    }

    // Insert new branch
    $stmt = $connection->prepare("INSERT INTO warehouse (name, address, mobile, landline, email) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $address, $mobile, $landline, $email);

    if ($stmt->execute()) {
        echo json_encode([
            'status' => 'success',
            'id' => $stmt->insert_id,
            'message' => 'Branch added successfully.'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to insert branch.'
        ]);
    }
}





if(isset($_POST['showoffColor'])){
    $query = "SELECT * FROM color";
    $result = mysqli_query($connection,$query); 
    if($result){
        $index = 0; 
        if(mysqli_num_rows($result) >0) {
            while($row = mysqli_fetch_assoc($result)){
                ?>
                    <tr>
                        <td>
                              <?php echo ++$index?>
                        </td>
                        <td>
                            <?php echo $row['name']?>
                        </td>
                        <td>

                    <div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    Choose Action
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    <li><a class="dropdown-item editbrandsection" 
    name = "<?php echo $row['name']?>"
    myid = "<?php echo $row['id']?>"
    href="#"
     >Edit <i class="menu-icon tf-icons bx bx-edit"></i>
</a></li>
    <li><a class="dropdown-item deleteColor" myid="<?php echo $row['id']?>" href="#">Delete <i class="menu-icon tf-icons bx bx-trash"></i>
</a></li>
</a></li>
  </ul>
</div>
                            
                        </td>
                    </tr>
                <?php
            }
        }
        else {
            ?>
            <tr>
                <td>
                    <span class="text text-danger fw-bold">No data found</span>
                </td>
            </tr>
            <?php
        }
    } 
    else {
        echo mysqli_error($connection); 
    }
}



if (isset($_POST['action']) && $_POST['action'] === 'delete_brand') {
    $id = intval($_POST['id']);

    $stmt = $connection->prepare("DELETE FROM brand WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to delete brand'
        ]);
    }

    exit;
}


if (isset($_POST['saveBrandssection'])) {
     $name = isset($_POST['name']) ? ucwords(trim($_POST['name'])) : null;


    $query = "INSERT INTO brand (name) VALUES (?)";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("s", $name);

    $check = $connection->prepare("SELECT id FROM brand WHERE name = ?");
    $check->bind_param("s", $name);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo json_encode(['status' => 'exist']);
        exit;
    }

    if ($stmt->execute()) {
        echo json_encode([
            'status' => 'success',
            'id' => $stmt->insert_id // return the inserted brand ID
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to insert brand'
        ]);
    }

    exit;
}


if(isset($_POST['updateBankaccount'])){
 $supplierId = $_POST['supplierId'];
$bankDetailsJson = $_POST['bankDetails'];
$bankDetailsArray = json_decode($bankDetailsJson, true); // decode JSON to array

$query = "DELETE FROM supplier_bank_details where supplier_id_fk='$supplierId'";
$result = mysqli_query($connection,$query);  

if (!empty($bankDetailsArray)) {
    foreach ($bankDetailsArray as $bank) {
        $bankId = isset($bank['id']) ? $bank['id'] : null; // id is passed if editing

        $accountName = $bank['accountName'] ?? null;
        $accountNumber = $bank['accountNo'] ?? null;
        $bankName = $bank['bankName'] ?? null;
        $branchName = $bank['branchName'] ?? null;

        if (!empty($bankId)) {
             
            $query = "UPDATE supplier_bank_details SET 
                        bank_account_name = ?, 
                        account_number = ?, 
                        bank = ?, 
                        branch = ?, 
                        updated_at = NOW()
                      WHERE id = ? AND supplier_id_fk = ?";
            $stmt = $connection->prepare($query);
            $stmt->bind_param("ssssii", $accountName, $accountNumber, $bankName, $branchName, $bankId, $supplierId);
        } else {
            // Insert new record
            $query = "INSERT INTO supplier_bank_details 
                        (supplier_id_fk, bank_account_name, account_number, bank, branch, created_at) 
                      VALUES 
                        (?, ?, ?, ?, ?, NOW())";
            $stmt = $connection->prepare($query);
            $stmt->bind_param("issss", $supplierId, $accountName, $accountNumber, $bankName, $branchName);
        }

        $stmt->execute();
    }

    echo 1; // success
} else {
    echo 0; // no data
}

}

if(isset($_POST['saveBankDetailssectionlineup'])){
      $supplierId = $_POST['supplierId'];
    $bankDetailsJson = $_POST['bankDetails'];
    $bankDetailsArray = json_decode($bankDetailsJson, true); // decode JSON to array

    $query = "DELETE FROM supplier_bank_details where supplier_id_fk='$supplierId'";
    $result = mysqli_query($connection,$query);  

    if (!empty($bankDetailsArray)) {
        foreach ($bankDetailsArray as $bank) {

            $accountName = isset($bank['accountName']) ? $bank['accountName'] : null;
            $accountNumber = isset($bank['accountNo']) ? $bank['accountNo'] : null;
            $bankName = isset($bank['bankName']) ? $bank['bankName'] : null;
            $branchName = isset($bank['branchName']) ? $bank['branchName'] : null;

            $query = "INSERT INTO supplier_bank_details 
                        (supplier_id_fk, bank_account_name, account_number, bank, branch, created_at) 
                      VALUES 
                        (?, ?, ?, ?, ?, NOW())";
            
            $stmt = $connection->prepare($query);
            $stmt->bind_param("issss", $supplierId, $accountName, $accountNumber, $bankName, $branchName);
            $stmt->execute();
        }

        echo 1; // success
    } else {
        echo 0; // no data
    }
}

 
if(isset($_POST['categoryDelete'])){
    $categoryId = $_POST['deleteCategory'];

    $query = "DELETE FROM categories WHERE id = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $categoryId);

    if (mysqli_stmt_execute($stmt)) {
        echo 1; // Success
    } else {
        echo mysqli_error($connection); // Error
    }

    mysqli_stmt_close($stmt);
}



 if (isset($_POST['saveSupplierSectionslength22'])) {
    
    $supplier_name = $_POST['supplier_name']; 
    $address = $_POST['address']; 
    $mobile = $_POST['mobile']; 
    $telephone = $_POST['telephone']; 
    $short_name = $_POST['short_name'];
    $email = $_POST['email'];
    $contactperson_name = $_POST['contactperson_name'];
    $contactperson_mobile2 = $_POST['contactperson_mobile2']; 
    $warehouse_address = $_POST['warehouse_address']; 
    $supplier_type = $_POST['supplier_type'];
    $contactperson_mobile = $_POST['contactperson_mobile']; 
    $location = $_POST['location']; 
    $citylineup = $_POST['citylineup']; 

    if (empty($supplier_name) || empty($mobile)) {
        echo "required_fields_missing";
        exit;
    }

    if(!empty($email)){

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "invalid_email";
        exit;
    }
    }
    date_default_timezone_set('Asia/Kolkata');
$currentDateTime = date('Y-m-d H:i:s');

    $checkQuery = "SELECT id FROM supplier WHERE mobile = ?";
    $stmt = $connection->prepare($checkQuery);
    $stmt->bind_param("s", $mobile);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "exist";  
        $stmt->close();
        exit;
    }
    $stmt->close();

    // Insert new supplier
    $insertQuery = "INSERT INTO supplier (supplier_name, `address`, mobile, telephone, short_name, email, contact_name, contact_number2, warehouse_address, supplier_category, contact_number1,`location`, city,`date`)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?)";
    $stmtss = $connection->prepare($insertQuery);
    $stmtss->bind_param("ssssssssssssss", $supplier_name, $address, $mobile, $telephone, $short_name, $email, $contactperson_name, $contactperson_mobile2, $warehouse_address, $supplier_type, $contactperson_mobile,$location, $citylineup,$currentDateTime);

    if ($stmtss->execute()) {
          $message = "Dear ".$supplier_name.",
You have been successfully registered in our system as a supplier.
Welcome aboard!";
        echo $connection->insert_id;

    sendlineupssms($mobile,$message); 
    } else {
        echo 0;
    }
      
    $stmtss->close();
}


if(isset($_POST['subcategoryaddeformlineup'])){
    $categoryName = $_POST['categoryName']; 
    $subcategory1name = ucfirst($_POST['subcategory1name']);
    $selectedText = $_POST['selectedText']; 

    $code = $_POST['code']; 

    $checklquery = "SELECT id from subcategory1 where subcategoryname='$subcategory1name' and category_id_fk='$categoryName'";
    $checkResult = mysqli_query($connection,$checklquery); 
    if(mysqli_num_rows($checkResult) > 0) {
        echo 12; 
        exit; 
    }
    else {
        $query = "INSERT INTO subcategory1(category_id_fk,category_name,subcategoryname,subcategory1code) VALUES('$categoryName','$selectedText','$subcategory1name','$code')";
        $result = mysqli_query($connection,$query); 
        if($result){
            echo 1; 
        } 
        else {
            echo mysqli_error($connection); 
        }
    }
 
}


if (isset($_POST['deleteSubCategory11'])) {
    $id = (int) $_POST['myid'];

    $stmt = $connection->prepare("DELETE FROM subcategory1 WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo 1; // Success
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

 if(isset($_POST['deleteSubcategory3Request'])){
    $deleteSubcategory3 = $_POST['deleteSubcategory3'];
    $query = "DELETE FROM subcategory3 WHERE id = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $deleteSubcategory3);
    if (mysqli_stmt_execute($stmt)) {
        echo 1; // Success
    } else {
        echo mysqli_error($connection); // Error
    }
 }

if(isset($_POST['fetchSubcategories11'])){
    $cat_id = $_POST['cat_id']; 
    $query = "SELECT id, subcategory2_name FROM subcategory2 WHERE subcategory1_id_fk = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $cat_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        echo '<option value="">--Select one--</option>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $row['id'] . '">' . htmlspecialchars($row['subcategory2_name']) . '</option>';
        }
    } else {
        echo '<option value="">--No data found--</option>';
    }   
}


 if (isset($_POST['updateSuppliersection22'])) {
    $usupplier_name = $_POST['usupplier_name'] ?? '';
    $uaddress = $_POST['uaddress'] ?? '';
    $umobile = $_POST['umobile'] ?? '';
    $utelephone = $_POST['utelephone'] ?? '';
    $ushort_name = $_POST['ushort_name'] ?? '';
    $eumail = $_POST['eumail'] ?? '';
    $ucontactperson_name = $_POST['ucontactperson_name'] ?? '';
    $ucontactperson_mobile = $_POST['ucontactperson_mobile'] ?? '';
    $ucontactperson_mobile2 = $_POST['ucontactperson_mobile2'] ?? '';
    $uwarehouse_address = $_POST['uwarehouse_address'] ?? '';
    $usupplier_type = $_POST['usupplier_type'] ?? '';
    $supplier_id = $_POST['supplier_id'] ?? '';

    $query = "UPDATE supplier SET 
                supplier_name = ?, 
                address = ?, 
                mobile = ?, 
                telephone = ?, 
                short_name = ?, 
                email = ?, 
                contact_name = ?, 
                contact_number1 = ?, 
                contact_number2 = ?, 
                warehouse_address = ?, 
                supplier_category = ?
              WHERE id = ?";

    $stmt = $connection->prepare($query);
    if ($stmt) {
        $stmt->bind_param(
            "sssssssssssi",
            $usupplier_name,
            $uaddress,
            $umobile,
            $utelephone,
            $ushort_name,
            $eumail,
            $ucontactperson_name,
            $ucontactperson_mobile,
            $ucontactperson_mobile2,
            $uwarehouse_address,
            $usupplier_type,
            $supplier_id
        );

        if ($stmt->execute()) {
            echo json_encode([
                'status' => 'success',
                'supplier_id' => $supplier_id
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Update failed: ' . $stmt->error
            ]);
        }

        $stmt->close();
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Query preparation failed: ' . $connection->error
        ]);
    }
}


if(isset($_POST['fetchSubcategories'])){
    $categoryIdFk = $_POST['categoryIdFk']; 
    $query = "SELECT id, subcategoryname FROM subcategory1 WHERE category_id_fk = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $categoryIdFk);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        echo '<option value="">--Select one--</option>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $row['id'] . '">' . htmlspecialchars($row['subcategoryname']) . '</option>';
        }
    } else {
        echo '<option value="">--No data found--</option>';
    } 
}

if(isset($_POST['removeBankdetails'])){
    $myid = $_POST['myid']; 
    $query = "DELETE FROM supplier_bank_details where id='$myid'";
    $result = mysqli_query($connection,$query); 
    if($result){
        echo 1; 
    } 
    else {
        echo mysqli_error($connection); 
    }
}

if(isset($_POST['getBankdetailsdata'])){
    $supplier_id_fk = $_POST['supplier_id_fk']; 
    
    $query = "SELECT * FROM supplier_bank_details where supplier_id_fk ='$supplier_id_fk'";
    $result = mysqli_query($connection,$query); 
    if($result){
         while($row = mysqli_fetch_assoc($result)){
             ?>
             <div class="ubank-detail-entry" style="position: relative; border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
        <button type="button"  class="btn btn-danger btn-sm uremoveBankdetails" 
        myid="<?php echo $row['id']?>"
        supplier_id_fk="<?php echo $row['supplier_id_fk']?>"
        style="position: absolute; top: 5px; right: 5px;">X</button>
        <div class="form-group">
            <label for="">Bank Account Name</label>
            <input type="text" name="accountNo" value="<?php echo $row['bank_account_name']?>"  class="form-control ubankAccountName">
        </div>
        <div class="form-group">
            <label for="">Account NO</label>
            <input type="tel" value="<?php echo $row['account_number']?>" class="form-control ubankAccountNo" >
        </div>
        <div class="form-group">
            <label for="">Bank</label>
            <input type="tel" value="<?php echo $row['bank']?>" name="bankname"  class="form-control ubankname">
        </div>
        <div class="form-group">
            <label for="">Branch</label>
            <input type="tel" value="<?php echo $row['branch']?>" name="branchName"  class="form-control ubranchName">
        </div>
    </div>
             <?php
         }
    } 

}

 if (isset($_POST['errorDataRequest'])) {
    ob_start();

    $query = "SELECT  category_id_fk,subcategory_id_fk ,subcategory2_id_fk ,id, categoryname, subcategory1_name, subcategory2_name, subcategory3_name, subcategory3_code FROM subcategory3";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $index = 0;
        $html = '';

        while ($row = mysqli_fetch_assoc($result)) {
            $html .= '<tr>';
            $html .= '<td>
                        <button class="btn btn-danger btn-sm deleteFromtable" deleteId="' . $row['id'] . '">DELETE</button>
                        &nbsp;
                        <button class="btn btn-info btn-sm editbuttonsection" 
                                myidsection="' . htmlspecialchars($row['id']) . '" 
                                data-categoryname="' . htmlspecialchars($row['categoryname']) . '" 
                                data-subcategory1_name="' . htmlspecialchars($row['subcategory1_name']) . '" 
                                data-subcategory2_name="' . htmlspecialchars($row['subcategory2_name']) . '" 
                                 data-category_id_fk="' . htmlspecialchars($row['category_id_fk']) . '" 
                                data-subcategory_id_fk="' . htmlspecialchars($row['subcategory_id_fk']) . '" 
                                 data-subcategory2_id_fk="' . htmlspecialchars($row['subcategory2_id_fk']) . '" 
                                data-subcategory3_name="' . htmlspecialchars($row['subcategory3_name']) . '" 
                                data-subcategory3_codeliner="' . htmlspecialchars($row['subcategory3_code']) . '">EDIT</button>
                      </td>';
            $html .= '<td>' . (++$index) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['categoryname']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['subcategory1_name']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['subcategory2_name']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['subcategory3_name']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['subcategory3_code']) . '</td>';
            $html .= '</tr>';
        }

        echo $html;
    } else {
        echo 'Query error: ' . mysqli_error($connection);
    }

    ob_end_flush();
}


if(isset($_POST['updateSubcategory3'])){
    $uucategoryName = $_POST['uucategoryName'];
    $usubcategory11 = $_POST['usubcategory11'];
    $usubcategory2 = $_POST['usubcategory2'];
    $uusubcategory3name = $_POST['uusubcategory3name'];
    $uusubcategory3code = $_POST['uusubcategory3code'];
    $subcategory11Text = $_POST['subcategory11Text'];
    $subcategory2Text = $_POST['subcategory2Text'];
    $categoryNameText = $_POST['categoryNameText'];

    $myid = $_POST['myid']; 
    
    $checkDuplicateQuery = "SELECT id FROM subcategory3 WHERE category_id_fk = ? AND subcategory_id_fk = ? AND subcategory2_id_fk = ? AND subcategory3_name = ? AND id != ?";
    $stmt = mysqli_prepare($connection, $checkDuplicateQuery);
    mysqli_stmt_bind_param($stmt, "iiisi", $uucategoryName, $usubcategory11, $usubcategory2, $uusubcategory3name, $myid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    if (mysqli_stmt_num_rows($stmt) > 0) {
        echo 12; // Duplicate found
        mysqli_stmt_close($stmt);
        exit;
    }
    mysqli_stmt_close($stmt);
    $query = "UPDATE subcategory3 SET 
                category_id_fk = ?, 
                categoryname = ?, 
                subcategory_id_fk = ?, 
                subcategory1_name = ?, 
                subcategory2_id_fk = ?, 
                subcategory2_name = ?, 
                subcategory3_name = ?, 
                subcategory3_code = ?
              WHERE id = ?";
    $stmt = mysqli_prepare($connection, $query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "isssssssi", $uucategoryName, $categoryNameText, $usubcategory11, $subcategory11Text, $usubcategory2, $subcategory2Text, $uusubcategory3name, $uusubcategory3code, $myid);
        if (mysqli_stmt_execute($stmt)) {
            echo 1; // Success
        } else {
            echo "Error: " . mysqli_error($connection);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($connection);
    }
    

}

if(isset($_POST['submitSubcategoryForm'])){
    $categoryName = $_POST['categoryName'];
    $subcategory11 = $_POST['subcategory11'];
    $subcategory2 = $_POST['subcategory2'];
    $subcategory3name = $_POST['subcategory3name'];
    $subcategory2code = isset($_POST['subcategory2code']) ? $_POST['subcategory2code'] : null;

    $categoryNameText = $_POST['categoryNameText']; 
    $subcategory11Text = $_POST['subcategory11Text']; 
    $subcategory2Text = $_POST['subcategory2Text'];

    

    $checkDuplicateQuery = "SELECT id FROM subcategory3 WHERE category_id_fk = ? AND subcategory_id_fk = ? AND subcategory2_id_fk = ? AND subcategory3_name = ?";
    $stmt = mysqli_prepare($connection, $checkDuplicateQuery);
    mysqli_stmt_bind_param($stmt, "iiis", $categoryName, $subcategory11, $subcategory2, $subcategory3name);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        echo 12; // Duplicate found
        mysqli_stmt_close($stmt);
        exit;
    }

    mysqli_stmt_close($stmt);
 
    $query = "INSERT INTO subcategory3(category_id_fk,categoryname,subcategory_id_fk,subcategory1_name,subcategory2_id_fk,subcategory2_name,subcategory3_name,subcategory3_code)
    VALUES('$categoryName','$categoryNameText','$subcategory11','$subcategory11Text','$subcategory2','$subcategory2Text','$subcategory3name','$subcategory2code')";
    $result = mysqli_query($connection,$query);
    if($result){
        echo 1; 
    }
    else {
        echo mysqli_error($connection); 
    }
}

if(isset($_POST['changeSubCategorysection'])){
    $value = $_POST['value']; 
    $query = "SELECT id, subcategory2_name from subcategory2 where subcategory1_id_fk = '$value'";
    $result = mysqli_query($connection,$query);
    if(mysqli_num_rows($result) > 0) {
     
        while($row = mysqli_fetch_assoc($result)){
            ?>
            <option value="<?php echo $row['id']?>"><?php echo $row['subcategory2_name']?></option>
            <?php
        }
         
    }
    else {
        echo '<option value="">--No data found--</option>';
    } 
}


 if (isset($_POST['saveCustomersection'])) {
    $customer_name = isset($_POST['customer_name']) ? trim($_POST['customer_name']) : '';
    $customer_mobile = isset($_POST['customer_mobile']) ? trim($_POST['customer_mobile']) : '';
    $dob = isset($_POST['dob']) ? trim($_POST['dob']) : '';
    $customer_nic = isset($_POST['customer_nic']) ? trim($_POST['customer_nic']) : '';
    $credit = isset($_POST['credit']) ? floatval($_POST['credit']) : 0;
    $debit = isset($_POST['debit']) ? floatval($_POST['debit']) : 0;
    $gender = isset($_POST['gender']) ? trim($_POST['gender']) : '';

    // Check for duplicate mobile
    $check_sql = "SELECT id FROM customers WHERE customer_mobile = ?";
    $check_stmt = $connection->prepare($check_sql);
    $check_stmt->bind_param("s", $customer_mobile);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
      
        echo 12;
        exit;
    }

     $sql = "INSERT INTO customers 
        (customer_name, customer_mobile, dob, customer_nic, credit, debit, gender) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssdds", 
        $customer_name, 
        $customer_mobile, 
        $dob, 
        $customer_nic, 
        $credit, 
        $debit, 
        $gender
    );
    $stmt->execute();
    $message = "Dear ".$customer_name.", You have been registered at our shop 
    
    ~Thank you~
    Come Again....

    "; 
     sendlineupssms($customer_mobile,$message); 
    echo 1; 
}


if (isset($_POST['deleteLineup'])) {
    $myid = (int)$_POST['myid'];
    $stmt = mysqli_prepare($connection, "DELETE FROM expense_categories WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $myid);

    if (mysqli_stmt_execute($stmt)) {
        echo 1;
    } else {
        echo mysqli_error($connection);
    }

    mysqli_stmt_close($stmt);
}


if(isset($_POST['updateExpense'])){
    $uamount = $_POST['uamount'];
    $ureason = $_POST['ureason'];
    $uexp_cat = $_POST['uexp_cat'];
    $udate = $_POST['udate'];
    $myid = $_POST['myid'];
    $query = "UPDATE expenses SET amount = ?, reason = ?, expcat_id_fk = ?, datetime = ? WHERE id = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "ssssi", $uamount, $ureason, $uexp_cat, $udate, $myid);
    if (mysqli_stmt_execute($stmt)) {
        echo 1; // Success
    } else {
        echo mysqli_error($connection); // Error
    }
}


if(isset($_POST['updateExpenseCategory'])){
    $myid = $_POST['categoryId'];
    $category_name = ucfirst($_POST['ucategoryName']);
    $show_cashier = $_POST['ushow_cashier'];

    // Check for duplicate category name (excluding current ID)
    $check_sql = "SELECT id FROM expense_categories WHERE expense_categories_name = ? AND id != ?";
    $check_stmt = $connection->prepare($check_sql);
    $check_stmt->bind_param("si", $category_name, $myid);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        echo 12; // Duplicate found
        $check_stmt->close();
        exit;
    }
    $check_stmt->close();

    $query = "UPDATE expense_categories SET expense_categories_name = ?, showcashier = ? WHERE id = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "ssi", $category_name, $show_cashier, $myid);

    if (mysqli_stmt_execute($stmt)) {
        echo 1; // Success
    } else {
        echo mysqli_error($connection); // Error
    }

    mysqli_stmt_close($stmt);
}

if(isset($_POST['sendactionlineupsaveform'])){
    $exp_cat=  $_POST['exp_cat']; 
    $amount=  $_POST['amount'];
    $reason=  $_POST['reason'];
    $date=  $_POST['date'];
    $query = "INSERT INTO expenses (expcat_id_fk, amount, reason, `datetime`) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "isss", $exp_cat, $amount, $reason, $date);
    if (mysqli_stmt_execute($stmt)) {
        echo 1; // Success
    } else {
        echo mysqli_error($connection); // Error
    }
}


if(isset($_POST['deleteExpenses'])){
    $id = $_POST['myid']; 
    $query = "DELETE FROM expenses WHERE id = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        echo 1; // Success
    } else {
        echo mysqli_error($connection); // Error
    }

    mysqli_stmt_close($stmt);
}

if(isset($_POST['fetchExpenses'])){
    $query = "SELECT expenses.expcat_id_fk,expenses.id,expenses.amount,expenses.reason,expenses.datetime,expense_categories.expense_categories_name as cat_name FROM expenses INNER JOIN expense_categories ON expenses.expcat_id_fk = expense_categories.id";
    $result = mysqli_query($connection,$query);
    if($result){
        $index = 0; 
            while($row = mysqli_fetch_assoc($result)){
                ?>
                <tr>
                    <td>
                        <button class="btn btn-danger btn-sm deleteExpenses" myid="<?php echo $row['id']?>">Delete</button>
                        &nbsp; 
                        <button class="btn btn-primary btn-sm editExpenses" 
                        myid="<?php echo $row['id']?>"
                        amount = "<?php echo $row['amount']?>"
                        reason = "<?php echo $row['reason']?>"
                        date = "<?php echo $row['datetime']?>"
                        expcat_id_fk="<?php echo $row['expcat_id_fk']?>"
                        >Edit</button>
                    </td>
                    <td>
                        <?php echo ++$index?>
                    </td>
                    <td>
                        <?php echo $row['cat_name']?>
                    </td>
                    <td>
                        <?php echo $row['amount']?>
                    </td>
                    <td>
                        <?php echo $row['reason']?>
                    </td>

                     <td>
                        <?php echo $row['datetime']?>
                    </td>

                </tr>
                <?php
            }
    } 
    else {
        echo mysqli_error($connection); 
    } 
}


if(isset($_POST['fetchExpenseCategories'])){
    $query = "SELECT * FROM expense_categories";
    $result = mysqli_query($connection,$query); 
    if($result){
        $index = 0; 
            while($row = mysqli_fetch_assoc($result)){
                ?>
                <tr>
                    <td>
                        <button class="btn btn-danger btn-sm deleteExpenseCategories" myid="<?php echo $row['id']?>">Delete</button>
                        &nbsp; 
                        <button class="btn btn-primary btn-sm editExpenseCategories" 
                        myid="<?php echo $row['id']?>"
                        category_name = "<?php echo $row['expense_categories_name']?>"
                        show_cashier = "<?php echo $row['showcashier']?>"
                        >Edit</button>
                    </td>
                    <td>
                        <?php echo ++$index?>
                    </td>
                    <td>
                        <?php echo $row['expense_categories_name']?>
                    </td>
                    <td>
                        <?php echo $row['showcashier'] == 1 ? 'Yes' : 'No' ?>
                    </td>

                </tr>
                <?php
            }
    } 
    else {
        echo mysqli_error($connection); 
    } 
}

if(isset($_POST['expenseCategorysection'])){
    $categoryName = ucfirst($_POST['categoryName']);
    $show_cashier = $_POST['show_cashier'];

    // Check for duplicate category name
    $check_sql = "SELECT id FROM expense_categories WHERE expense_categories_name = ?";
    $check_stmt = $connection->prepare($check_sql);
    $check_stmt->bind_param("s", $categoryName);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        echo 12; // Duplicate found
        exit;
    }

    $query = "INSERT INTO expense_categories (expense_categories_name, showcashier) VALUES (?, ?)";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "si", $categoryName, $show_cashier);

    if (mysqli_stmt_execute($stmt)) {
        echo 1; // Success
    } else {
        echo mysqli_error($connection); // Error
    }

    mysqli_stmt_close($stmt);
}


if(isset($_POST['customerDelete'])){
    $id = $_POST['deleteCustomer']; 
    $query = "DELETE FROM customers WHERE id = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        echo 1; // Success
    } else {
        echo mysqli_error($connection); // Error
    }

    mysqli_stmt_close($stmt);
}

 
if(isset($_POST['deleteSupplier'])){
    $myid = $_POST['myid'];
    $query = "DELETE FROM suppliers WHERE id = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $myid);
    if (mysqli_stmt_execute($stmt)) {
        echo 1; // Success
    } else {
        echo mysqli_error($connection); // Error
    }
}


if(isset($_POST['updateSupplier'])){
    $myid = $_POST['supplier_id'];
    $supplier_name = $_POST['supplier_name'];
    $supplier_mobile = $_POST['supplier_mobile'];
    $supplier_company = $_POST['supplier_company'];
    $supplier_city = $_POST['supplier_city'];
    $supplier_credit = $_POST['supplier_credit'];
    $supplier_debit = $_POST['supplier_debit'];

    // Check for duplicate mobile (excluding current supplier)
    $check_sql = "SELECT id FROM suppliers WHERE supplier_mobile = ? AND id != ?";
    $check_stmt = $connection->prepare($check_sql);
    $check_stmt->bind_param("si", $supplier_mobile, $myid);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        echo 12; // Duplicate found
        exit;
    }
    
    $query = "UPDATE suppliers SET 
                supplier_name = ?, 
                supplier_mobile = ?, 
                supplier_company = ?, 
                supplier_city = ?, 
                supplier_credit = ?, 
                supplier_debit = ? 
              WHERE id = ?";
    
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "ssssddi", $supplier_name, $supplier_mobile, $supplier_company, $supplier_city, $supplier_credit, $supplier_debit, $myid);

    if (mysqli_stmt_execute($stmt)) {
        echo 1; // Success
    } else {
        echo mysqli_error($connection); // Error
    }

    mysqli_stmt_close($stmt);
}
 
if (isset($_POST['saveAccountform'])) {
    $Suppliertypename = ucfirst(trim($_POST['Suppliertypename']));

     $checkStmt = $connection->prepare("SELECT id FROM suppliertype WHERE `type` = ?");
    $checkStmt->bind_param("s", $Suppliertypename);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        echo 12; 
        $checkStmt->close();
        exit;
    }
    $checkStmt->close();
 
    $insertStmt = $connection->prepare("INSERT INTO suppliertype(`type`) VALUES (?)");
    $insertStmt->bind_param("s", $Suppliertypename);

    if ($insertStmt->execute()) {
        echo 1; // Success
    } else {
        echo "Error: " . $insertStmt->error;
    }

    $insertStmt->close();
}


 if(isset($_POST['deleteSuppliersection'])){
    $supplier_id_fk = $_POST['supplier_id_fk']; 
    $query = "DELETE FROM supplier WHERE id = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $supplier_id_fk);
    if (mysqli_stmt_execute($stmt)) {
        echo 1; // Success
    } else {
        echo mysqli_error($connection); // Error
    }
}


 if (isset($_POST['showoffsupplierType'])) {
    $query = "SELECT type FROM suppliertype";
    $result = mysqli_query($connection, $query);

    
    echo '<option value="Local">Local</option>';
    echo '<option value="Overseas">Overseas</option>';

    if ($result && mysqli_num_rows($result) > 0) {
        $options = '';
        $deletableList = '';

        while ($row = mysqli_fetch_assoc($result)) {
            $type = htmlspecialchars($row['type'], ENT_QUOTES, 'UTF-8');

           
            $options .= "<option value=\"$type\">$type</option>";

         
            if ($type !== 'Local' && $type !== 'Overseas') {
                $deletableList .= "
                    <li>
                        $type 
                        <button class='btn btn-danger btn-sm removeSupplierType' data-type=\"$type\">Remove</button>
                    </li>
                ";
            }
        }

        echo $options;

        // Optionally output deletable list (you can place this elsewhere)
        echo "<ul>$deletableList</ul>";
    }
}



 
if(isset($_POST['fetchSuppliers'])){
    $query = "SELECT * FROM supplier";
    $result = mysqli_query($connection,$query); 
    if($result){
        $index = 0; 
            while($row = mysqli_fetch_assoc($result)){
                ?>
                <tr>
                    <td>
                        <?php echo ++$index?>       
                    </td>
                    <td>
                        <?php echo $row['supplier_name']?>
                    </td>
                    <td>
                        <?php echo $row['mobile']?>
                    </td>
                    
                    <td>
                        <?php echo $row['telephone']?>
                    </td>
                    <td>
                        <a href="#" 
                        bank_id="<?php echo $row['id']?>" 
                        class="btn btn-link btn-sm viewbankdetailssection"><u>View bank details</u>
                         </a>
                    </td>
                    <td>
                          <a href="<?php echo $row['location']?>" 
                          target="_blank"
                         class="btn btn-link btn-sm viewbankdetailssection"><u>View on google map</u>
                         </a>
                    </td>
                    <td>
                        <?php echo $row['address']?>
                    </td>
                    <td>
                        <?php echo $row['short_name']?>
                    </td>
                     <td>
                        <?php echo $row['email']?>
                     </td>
                     <td>
                        <?php echo $row['contact_name']?>
                     </td>
                     <td>
                        <?php echo $row['contact_number1']?>
                     </td>
                     <td>
                        <?php echo $row['contact_number2']?>
                     </td>
                     <td>
                        <?php echo $row['supplier_category']?>
                     </td>
                     <td>
                         <?php echo $row['warehouse_address']?>
                     </td>
                     <td>
                        <div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    Choose Action
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    <li><a class="dropdown-item suppliereditbuttonsection" href="#"
       supplier_name = "<?php echo $row['supplier_name']?>"
       mobile = "<?php echo $row['mobile']?>"
       telephone = "<?php echo $row['telephone']?>"
       address = "<?php echo $row['address']?>"
       short_name = "<?php echo $row['short_name']?>"
       email = "<?php echo $row['email']?>"
       contact_name = "<?php echo $row['contact_name']?>"
       contact_number1 = "<?php echo $row['contact_number1']?>"
       contact_number2 = "<?php echo $row['contact_number2']?>"
       supplier_category  = "<?php echo $row['supplier_category']?>"
       warehouse_address = "<?php echo $row['warehouse_address']?>"
       location = "<?php echo $row['location']?>"
       city = "<?php echo $row['city']?>"
       myid = "<?php echo $row['id']?>"
                
    >Edit <i class="menu-icon tf-icons bx bx-edit"></i>
</a></li>
    <li><a class="dropdown-item deleteSupplier" supplier_id_fk="<?php echo $row['id']?>" href="#">Delete <i class="menu-icon tf-icons bx bx-trash"></i>
</a></li>
   
  </ul>
</div>
                     </td>
                    
                </tr>
                <?php
            }
    } 
    else {
        echo mysqli_error($connection); 
    } 
}

 


if(isset($_POST['updateCustomersection'])){
    $customer_id = isset($_POST['customer_id']) ? intval($_POST['customer_id']) : 0;
    $customer_name = isset($_POST['customer_name']) ? trim($_POST['customer_name']) : '';
    $customer_mobile = isset($_POST['customer_mobile']) ? trim($_POST['customer_mobile']) : '';
    $dob = isset($_POST['dob']) ? trim($_POST['dob']) : '';
    $customer_nic = isset($_POST['customer_nic']) ? trim($_POST['customer_nic']) : '';
    $credit = isset($_POST['credit']) ? floatval($_POST['credit']) : 0;
    $debit = isset($_POST['debit']) ? floatval($_POST['debit']) : 0;
    $gender = isset($_POST['gender']) ? trim($_POST['gender']) : '';

    // Check for duplicate mobile (excluding current customer)
    $check_sql = "SELECT id FROM customers WHERE customer_mobile = ? AND id != ?";
    $check_stmt = $connection->prepare($check_sql);
    $check_stmt->bind_param("si", $customer_mobile, $customer_id);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        echo 12; // Duplicate found
        $check_stmt->close();
        exit;
    }
    $check_stmt->close();

    $sql = "UPDATE customers SET customer_name = ?, customer_mobile = ?, dob = ?, customer_nic = ?, credit = ?, debit = ?, gender = ? WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssddsi", $customer_name, $customer_mobile, $dob, $customer_nic, $credit, $debit, $gender, $customer_id);

    if ($stmt->execute()) {
        echo 1;
    } else {
        echo mysqli_error($connection);
    }
    $stmt->close();
}


 if (isset($_POST['addthecustomersection'])) {
    $ucustomer_amount = floatval($_POST['ucustomer_amount']); 
    $myid = intval($_POST['myid']); 

    $query = "UPDATE customers SET debit = debit - $ucustomer_amount WHERE id = $myid";
    $result = mysqli_query($connection, $query); 

    if (!$result) {
        echo mysqli_error($connection); 
    }
    else {
        echo 1; 
    }
    
}

 
 if (isset($_POST['fetchEmployees'])) {
    $query = "SELECT * FROM employees";
    $result = mysqli_query($connection, $query); 
    $index = 0; 

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td>
                    <button class="btn btn-info btn-sm editEmployees" myid="<?php echo $row['id']?>">EDIT</button>
                    &nbsp; 
                    <button class="btn btn-danger btn-sm deleteemployees" myid="<?php echo $row['id']?>">DELETE</button>
                    &nbsp; 

                </td>
                <td>
                    <?php echo ++$index; ?>
                </td>
                <td>
                    <?php echo htmlspecialchars($row['name']); ?>
                </td>
                <td>
                    <?php echo htmlspecialchars($row['mobilenumber']); ?>
                </td>
                <td>
                    <?php echo htmlspecialchars($row['nic']); ?>
                </td>
                <td>
                    <?php echo (int)$row['working_days']; ?>
                </td>
                <td>
                    <?php echo number_format((float)$row['basic_salary'], 2); ?>
                </td>
                <td>
                    <?php echo $row['epf'] == 1 ? 'Active' : 'Inactive'; ?>
                </td>
                <td>
                    <?php echo number_format((float)$row['epf_basic_salary'], 2); ?>
                </td>
            </tr>
            <?php
        }
    } else {
        echo "<tr><td colspan='9' class='text-center'>No employees found.</td></tr>";
    }
}


 if (isset($_POST['saveemployeesection'])) {
    // Sanitize inputs
    $fullname       = trim($_POST['fullname']);
    $nicnumber      = trim($_POST['nicnumber']);
    $workingdays    = (int) $_POST['workingdays'];
    $basicsalary    = (float) $_POST['basicsalary'];
    $epfchecks      = isset($_POST['epfchecks']) ? 1 : 0;
    $epfbasicsalary = (float) $_POST['epfbasicsalary'];
    $mobilenumber   = isset($_POST['mobilenumber']) ? trim($_POST['mobilenumber']) : '';
    $myaddress      = trim($_POST['myaddress']);

    // Check if mobile number already exists
    $checkStmt = $connection->prepare("SELECT id FROM employees WHERE mobilenumber = ?");
    $checkStmt->bind_param("s", $mobilenumber);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        echo 12;
        $checkStmt->close();
        $connection->close();
        exit;
    }
    $checkStmt->close();

    // Insert with address field
    $stmt = $connection->prepare("INSERT INTO employees (`name`, `address`, nic, working_days, basic_salary, epf, epf_basic_salary, mobilenumber) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiddds", $fullname, $myaddress, $nicnumber, $workingdays, $basicsalary, $epfchecks, $epfbasicsalary, $mobilenumber);

    if ($stmt->execute()) {
        echo 1;
    } else {
        echo "error: " . $stmt->error;
    }

    $stmt->close();
    $connection->close();
}


 



if(isset($_POST['addtheamountform'])){
    $customer_amount = $_POST['customer_amount']; 
    $myid = $_POST['myid']; 
    $query = "UPDATE customers SET debit='$customer_amount' where id='$myid'"; 
    $result = mysqli_query($connection,$query); 
    if($result){

        echo 1; 
    }
    else {
        echo 0; 
    }
}

if(isset($_POST['fetchCustomers'])){
    $query = "SELECT * FROM customers";
    $result = mysqli_query($connection,$query); 
    if($result){
        $index = 0; 
            while($row = mysqli_fetch_assoc($result)){
                ?>
                <tr>
                    <td>
                        <button class="btn btn-danger btn-sm deleteCustomers" myid="<?php echo $row['id']?>">Delete</button>
                        &nbsp; 
                        <button class="btn btn-primary btn-sm editCustomers" 
                        myid="<?php echo $row['id']?>"
                        customer_name = "<?php echo $row['customer_name']?>"
                        customer_mobile = "<?php echo $row['customer_mobile']?>"
                        dob = "<?php echo $row['dob']?>"
                        customer_nic = "<?php echo $row['customer_nic']?>"
                        gender = "<?php echo $row['gender']?>"
                        credit = "<?php echo $row['credit']?>"
                        debit = "<?php echo $row['debit']?>"
                        >Edit</button>
                        &nbsp; 
                        <button class="btn btn-info btn-sm showoffopeningbalance"
                        myid="<?php echo $row['id']?>"
                        debit = "<?php echo $row['debit']?>"
                        >Opening Balance</button>
                        &nbsp; 
                        <button class="btn btn-success btn-sm baddebitdeduct"
                         myid="<?php echo $row['id']?>"
                        debit = "<?php echo $row['debit']?>"
                        credit = "<?php echo $row['credit']?>"
                        >Bad debt deduct</button>
                    </td>
                    <td>
                        <?php echo ++$index?>
                    </td>
                    <td>
                        <?php echo $row['customer_name']?>
                    </td>
                    <td>
                        <?php echo $row['customer_mobile']?>
                    </td>
                    <td>
                        <?php echo $row['dob']?>
                    </td>
                    <td>
                        <?php echo $row['customer_nic']?>
                    </td>
                      <td>
                        <?php echo $row['gender']?>
                    </td>

                     <td>
                        <?php echo $row['credit']?>
                    </td>

                      <td>
                        <?php echo $row['debit']?>
                    </td>

                </tr>
                <?php
            }
    } 
    else {
        echo mysqli_error($connection); 
    } 
}



if (isset($_POST['changeCategoryName'])) {
    $value = (int)$_POST['value'];  
 
    $stmt = $connection->prepare("SELECT id, subcategoryname AS category_name FROM subcategory1 WHERE category_id_fk = ?");
    $stmt->bind_param("i", $value);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
            ?>
            <option value="">--Select one--</option>
            <?php
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['id'] . '">' . htmlspecialchars($row['category_name']) . '</option>';
        }
      
    } else {
        echo '<option value="">--No data found--</option>';
    }

    $stmt->close();
}

 

 if (isset($_POST['viewbankdetails'])) {
    $id = $_POST['bank_id']; 
    $query = "SELECT * FROM supplier_bank_details WHERE supplier_id_fk = '$id'";
    $result = mysqli_query($connection, $query); 

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            ?>
            <tr>
                <td>
                    <?php echo $row['bank_account_name'] ?? ''?>
                </td>
                <td>
                    <?php echo $row['account_number'] ?? ''?>
                </td>
                <td>
                    <?php echo $row['bank'] ?? ''?>
                </td>
                <td>
                    <?php echo $row['branch'] ?? ''?>
                </td>
                <td>
                   <button class="btn btn-primary btn-sm" onclick="printDiv('printArea')">
                     <i class="bx bx-printer me-2"></i>
                   </button>

                </td>
            </tr>
          
         

            <?php
        } else {
            echo "<h4>No bank details found.</h4>";
        }
    } else {
        echo "Query Error: " . mysqli_error($connection); 
    }
}


if(isset($_POST['deleteSubCategory'])){
    $id = (int)$_POST['deleteId']; 

    $query = "DELETE FROM subcategory2 WHERE id = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        echo 1; // Success
    } else {
        echo mysqli_error($connection); // Error
    }

    mysqli_stmt_close($stmt);
}


if(isset($_POST['subcategoryupdateform'])){
    $category_id = $_POST['category_id'];
    $subcategory1 = $_POST['subcategory1'];
    $subcategory2name = $_POST['subcategory2name'];
    $subcategory2code = $_POST['subcategory2code'];
    $category_name = $_POST['category_name'];
    $subcategory1text = $_POST['subcategory1text'];

    // Update query for subcategory2
    $query = "UPDATE subcategory2 SET 
                category_id_fk = ?, 
                subcategory1_id_fk = ?, 
                subcategory2_name = ?, 
                subcategory2_code = ?, 
                category_name = ?, 
                subcategory1_name = ?, 
                updated_at = NOW() 
              WHERE id = ?";

    $stmt = mysqli_prepare($connection, $query);
    if ($stmt) {
        $id = $_POST['id']; // Assuming the ID is passed in the request
        mysqli_stmt_bind_param($stmt, "iissssi", $category_id, $subcategory1, $subcategory2name, $subcategory2code, $category_name, $subcategory1text, $id);

        if (mysqli_stmt_execute($stmt)) {
            echo 1; // Success
        } else {
            echo "Error: " . mysqli_error($connection);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($connection);
    }
}

if (isset($_POST['showOffAddedata'])) {
    $query = "SELECT * FROM subcategory2";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $index = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>
                    <td>
                        <button class="btn btn-danger btn-sm deleteSubCategories" cat_id="' . htmlspecialchars($row['id']) . '">
                            <i class="menu-icon tf-icons bx bx-trash"></i> Delete
                        </button>
                        &nbsp;
                        <button class="btn btn-primary btn-sm editSubCategories" 
                                myid="' . htmlspecialchars($row['id']) . '" 
                                main_cat_id="' . htmlspecialchars($row['category_id_fk']) . '" 
                                sub_cat1="' . htmlspecialchars($row['subcategory1_name']) . '" 
                                subcategory2_name ="' . htmlspecialchars($row['subcategory2_name']) .'" 
                                code="' . htmlspecialchars($row['subcategory2_code']) . '">
                            <i class="menu-icon tf-icons bx bx-edit"></i> Edit
                        </button>
                    </td>
                    <td>' . ++$index . '</td>
                    <td>' . htmlspecialchars($row['category_name']) . '</td>
                    <td>' . htmlspecialchars($row['subcategory1_name']) . '</td>
                    <td>' . htmlspecialchars($row['subcategory2_name']) . '</td>
                    <td>' . htmlspecialchars($row['subcategory2_code']) . '</td>
                </tr>';
        }
    } else {
        echo '<tr>
                <td colspan="6" class="text-center">
                    <span class="text-danger fw-bold">' . htmlspecialchars(mysqli_error($connection)) . '</span>
                </td>
              </tr>';
    }
}


if (isset($_POST['subcategoryaddedform'])) {
    // Get form data
    $category_id         = $_POST['category_id']; 
    $subcategory1_id_fk  = $_POST['subcategory1']; 
    $subcategory2_name   = $_POST['subcategory2name']; 
    $subcategory2_code   = $_POST['subcategory2code']; 
    $category_name       = $_POST['category_name']; 
    $subcategory1_name   = $_POST['subcategory1text']; 
 

    $query = "INSERT INTO subcategory2 (
        category_name, 
        subcategory1_name, 
        subcategory2_name, 
        subcategory2_code, 
        subcategory1_id_fk, 
        category_id_fk, 
        created_at, 
        updated_at
    ) VALUES (
        '$category_name', 
        '$subcategory1_name', 
        '$subcategory2_name', 
        '$subcategory2_code', 
        '$subcategory1_id_fk', 
        '$category_id', 
        NOW(), 
        NOW()
    )";

    $result = mysqli_query($connection,$query); 
    if($result){
        echo 1; 
    }
    else {
        echo mysqli_error($connection); 
    }
 
}




if (isset($_POST['updateSubQuery44'])) {
    
    $ucategoryName = htmlspecialchars(trim($_POST['ucategoryName']), ENT_QUOTES, 'UTF-8');
    $usubcategory1name = htmlspecialchars(trim($_POST['usubcategory1name']), ENT_QUOTES, 'UTF-8');
    $usubcategoryCode = htmlspecialchars(trim($_POST['usubcategoryCode']), ENT_QUOTES, 'UTF-8');
    $selectedText = htmlspecialchars(trim($_POST['selectedText']), ENT_QUOTES, 'UTF-8');
    $myid = filter_var($_POST['myid'], FILTER_SANITIZE_NUMBER_INT); // Or another appropriate filter
 
 
    if ($myid === false || $myid <= 0) {
        echo "Invalid ID.";
        exit;  // Or handle the error appropriately (e.g., log, redirect)
    }

    //  Validate other inputs as needed (e.g., length, allowed characters)

    // 2.  **Prepared Statements for Security and Performance**
    $checkExistQuery = "SELECT 1 FROM subcategory1 WHERE category_id_fk = ? AND subcategoryname = ?";
    $checkStmt = mysqli_prepare($connection, $checkExistQuery);

    if ($checkStmt === false) {
        echo "Prepare error: " . mysqli_error($connection);
        exit;
    }

    mysqli_stmt_bind_param($checkStmt, "is", $ucategoryName, $usubcategory1name);  // "ss" for two strings
    mysqli_stmt_execute($checkStmt);
    mysqli_stmt_store_result($checkStmt);

    if (mysqli_stmt_num_rows($checkStmt) > 0) {
        echo 12;
        exit;
    }

    mysqli_stmt_close($checkStmt);


    $updateQuery = "UPDATE subcategory1 SET category_id_fk = ?, category_name = ?, subcategoryname = ?, subcategory1code = ? WHERE id = ?";
    $updateStmt = mysqli_prepare($connection, $updateQuery);

    if ($updateStmt === false) {
        echo "Prepare error: " . mysqli_error($connection);
        exit;
    }

    mysqli_stmt_bind_param($updateStmt, "isssi", $ucategoryName, $selectedText, $usubcategory1name, $usubcategoryCode, $myid); // "ssssi" - 4 strings, 1 integer
    $result = mysqli_stmt_execute($updateStmt);  // mysqli_stmt_execute returns true/false directly

    if ($result) {
        echo 1;
    } else {
        echo "Update error: " . mysqli_error($connection);  //  Include "Update error:" for clarity
    }

    mysqli_stmt_close($updateStmt);

}


if(isset($_POST['showOffSub1Categories'])){
    $query = "SELECT * FROM subcategory1";
    $result = mysqli_query($connection,$query); 
    if($result){
        $index = 0; 
            while($row = mysqli_fetch_assoc($result)){
                ?>
                <tr>
                    <td>
                        <button class="btn btn-danger btn-sm deleteSubCategories"
                        cat_id = "<?php echo $row['id']?>"
                        >Delete</button>
                        &nbsp; 
                        <button class="btn btn-primary btn-sm editSubCategories"
                         myid = "<?php echo $row['id']?>"
                         main_cat_id = "<?php echo $row['category_id_fk']?>"
                         sub_cat1 = "<?php echo $row['subcategoryname']?>"
                         code = "<?php echo $row['subcategory1code']?>"
                         
                        >Edit</button>
                    </td>
                    <td>
                        <?php echo ++$index?>
                    </td>
                    <td>
                        <?php echo $row['category_name']?>
                    </td>
                    <td>
                        <?php echo $row['subcategoryname']?>
                    </td>
                    <td>
                        <?php echo $row['subcategory1code']?>
                    </td>

                </tr>
                <?php
            }
    } 
    else {
        echo mysqli_error($connection); 
    }
}


if (isset($_POST['updateCategory'])) {
    $updateCategoryId = (int) $_POST['updateCategoryId'];
    $updateCategoryName = ucfirst(trim($_POST['updateCategoryName']));
    $updateCategoryCode = trim($_POST['updateCategoryCode']);

    // Use prepared statement with LIMIT 1 for faster checking
    $checkStmt = $connection->prepare("SELECT id FROM categories WHERE name = ? AND id != ? LIMIT 1");
    $checkStmt->bind_param("si", $updateCategoryName, $updateCategoryId);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        echo 12; // Name already exists for a different ID
        $checkStmt->close();
        exit;
    }
    $checkStmt->close();

    // Update category
    $updateStmt = $connection->prepare("UPDATE categories SET name = ?, code = ? WHERE id = ?");
    $updateStmt->bind_param("ssi", $updateCategoryName, $updateCategoryCode, $updateCategoryId);

    if ($updateStmt->execute()) {
        echo 1; // Success
    } else {
        echo "Error: " . $updateStmt->error;
    }

    $updateStmt->close();
}



if (isset($_POST['fetchCategories'])) {
    $query = "SELECT * FROM categories";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $index = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>
                    <td>
                        <button class="btn btn-danger btn-sm deleteCategory" myid="' . htmlspecialchars($row['id']) . '">DELETE</button>
                        &nbsp;
                        <button class="btn btn-info btn-sm editCategory" 
                                name="' . htmlspecialchars($row['name']) . '" 
                                code="' . htmlspecialchars($row['code']) . '" 
                                myid="' . htmlspecialchars($row['id']) . '">Edit</button>
                    </td>
                    <td>' . ++$index . '</td>
                    <td>' . htmlspecialchars($row['name']) . '</td>
                    <td>' . htmlspecialchars($row['code']) . '</td>
                </tr>';
        }
    } else {
        echo '<tr>
                <td colspan="4" class="text-center">
                    <span class="text-danger fw-bold">No data found</span>
                </td>
              </tr>';
    }
}


if(isset($_POST['saveAddCategoryform'])){
    $categoryName = ucfirst($_POST['categoryName']); 
    $categoryCode = $_POST['categoryCode']; 


    $checkQuery = "SELECT * FROM categories WHERE `name` = '$categoryName'";
    $checkResult = mysqli_query($connection, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        echo 12; 
        exit;
    }

    

    $query = "INSERT INTO categories(`name`,code) VALUES('$categoryName','$categoryCode')";
    $result = mysqli_query($connection,$query); 
    if($result){
        echo 1; 
        exit; 
    }
    else {
        echo mysqli_error($connection); 
    }
}

if (isset($_POST['quickLogin'])) {
    $cardInput = mysqli_real_escape_string($connection, $_POST['cardInput']);
    $query = "SELECT admin_name, shop_name, shop_logo, secretkey FROM `admin` WHERE loginkey = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "s", $cardInput);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result); 
        $_SESSION['admin_name'] = $row['admin_name'];
        $_SESSION['shop_name'] = $row['shop_name'];
        $_SESSION['shop_logo'] = $row['shop_logo'];
        $_SESSION['secretkey'] = $row['secretkey'];
        echo 1;
    } else {
        echo 0;
    }

    mysqli_stmt_close($stmt);
}

 
 if (isset($_POST['showoffLoginHistory'])) {
    $query = "SELECT operating, browser, dateandtime FROM login_history ORDER BY id DESC";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $index = 0;
        if (mysqli_num_rows($result) > 0) {
            $rows = '';
            while ($row = mysqli_fetch_assoc($result)) {
                $index++;
                $operating = htmlspecialchars($row['operating'], ENT_QUOTES, 'UTF-8');
                $browser = htmlspecialchars($row['browser'], ENT_QUOTES, 'UTF-8');
                $date = htmlspecialchars($row['dateandtime'], ENT_QUOTES, 'UTF-8');

                $rows .= <<<HTML
<tr>
    <td>$index</td>
    <td>$operating</td>
    <td>$browser</td>
    <td>$date</td>
</tr>
HTML;
            }
            echo $rows;
        }
    } else {
        echo mysqli_error($connection);
    }
}




if (isset($_POST['loginnow'])) {
    $mobileNumber = $_POST['mobileNumber'] ?? '';
    $password = $_POST['password'] ?? '';

    // Sanitize input
    $mobileNumber = trim($mobileNumber);
    $password = trim($password);

    $operating = $_POST['operating']; 
    $browser = $_POST['browser']; 
    $userAgent = $_POST['userAgent']; 

    // Optional: Validate inputs
    if (empty($mobileNumber) || empty($password)) {
        echo "Missing mobile number or password.";
        exit;
    }

    // Use prepared statement for security
    $query = "SELECT * FROM `admin` WHERE mobilenumber = ? AND `password` = ?";
    $stmt = mysqli_prepare($connection, $query);

    if (!$stmt) {
        echo "Query preparation failed: " . mysqli_error($connection);
        exit;
    }
    
    mysqli_stmt_bind_param($stmt, "ss", $mobileNumber, $password);

    if (!mysqli_stmt_execute($stmt)) {
        echo "Query execution failed: " . mysqli_stmt_error($stmt);
        exit;
    }

    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $_SESSION['admin_name'] = $row['admin_name'];
        $_SESSION['shop_name'] = $row['shop_name'];
        $_SESSION['shop_logo'] = $row['shop_logo'];
        $_SESSION['secretkey'] = $row['secretkey'];

        date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d H:i:s'); // Outputs: 2025-06-05 15:47:12

         $insertIntoLoginHistory = "INSERT INTO login_history(dateandtime, operating, browser, useragent) VALUES('$date', '$operating','$browser','$userAgent')";
         mysqli_query($connection,$insertIntoLoginHistory);  

         echo 1;
    } else {
        echo 0; // No matching user
    }
}



?>