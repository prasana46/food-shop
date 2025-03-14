<?php 
session_start();
if(!isset($_SESSION['cashier']) || (isset($_SESSION['cashier']) && empty($_SESSION['cashier']))){
    header("location: homepage.php");
}
$action = $_GET['action'] ?? "";
require_once('db-connect.php');
switch($action){
    case 'logout':
        session_destroy();
        header("location: Plogin.php");
        break;
    case 'update_settings':
        $insert_batch_values = "";
        $error = "";
        try{
            foreach($_POST as $field => $value){
                if(!is_numeric($value))
                    $value = addslashes(htmlspecialchars($value));
                $check_field = $conn->query("SELECT * FROM `settings_tbl` where meta_field = '{$field}'");
                if($check_field->num_rows > 0){
                    $result = $check_field->fetch_array();
                    $id = $result['id'];
                    $update = $conn->query("UPDATE `settings_tbl` set `meta_value` = '{$value}' where `id` = {$id}");
                }else{
                    if(!empty($insert_batch_values)) $insert_batch_values .= ", ";
                    $insert_batch_values .= "('{$field}', '{$value}')";
                }
            }
            if(!empty($insert_batch_values)){
                $insert_batch_stmt = "INSERT INTO `settings_tbl` (`meta_field`, `meta_value`) VALUES {$insert_batch_values}";
                $insert_batch_qry = $conn->query($insert_batch_stmt);
            }
        }catch(Exception $e){
            $error = $e->getMessage();
        }
        if(empty($error)){
            $_SESSION['flashdata'] = [
                "type" => 'success',
                "msg" => 'Invoice Data Settings has been updated successfully'
            ];
        }else{
            $_SESSION['flashdata'] = [
                "type" => 'danger',
                "msg" => $error
            ];
        }
        header("location: ./");
        exit;
       
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>glutony hunt</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="assets/css/style.css">

   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- jQuery CSS CDN -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">GLUTTONY HUNT</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./"></a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="javascript:void(0)" id="settingModalBtn" href="settings-modal.php"></a>
                </li>
            </ul>
        </div>
        <div id="user-container" class="dropdown">
            <button  type="button" class="dropdow-toggle btn btn-sm btn-info text-light rounded-pill fw-bold fs-6 px-4"  data-bs-toggle="dropdown" aria-expanded="false"><?= $_SESSION['cashier'] ?? "Not Logged In" ?> <i class="fas fa-angle-down"></i></button>
           
        </div>
    </div>
    </nav>
    <div class="container-md py-3">
        <?php if(isset($_SESSION['flashdata']) && !empty($_SESSION['flashdata'])): ?>
            <div class="flashdata flashdata-<?= $_SESSION['flashdata']['type'] ?? 'default' ?> mb-3">
                <div class="d-flex w-100 align-items-center flex-wrap">
                    <div class="col-11"><?= $_SESSION['flashdata']['msg'] ?? '' ?></div>
                    <div class="col-1 text-center">
                        <a href="javascript:void(0)" onclick="this.closest('.flashdata').remove()" class="flashdata-close"><i class="far fa-times-circle"></i></a>
                    </div>
                </div>
            </div>
        <?php unset($_SESSION['flashdata']); ?>
        <?php endif; ?>
        <form action="save_invoice.php" id="order-form" method="POST">
            <input type="hidden" name="cashier" value="<?= $_SESSION['cashier'] ?? "" ?>">
            <input type="hidden" name="total_amount" value="0">
            <input type="hidden" name="discount_amount" value="0">
        <div class="row">
            <div class="col-lg-4 col-md-5 col-sm-12 col-12">
                <div class="card shadow">
                    <div class="card-header rounded-0">
                        <div class="card-title">Order Form</div>
                    </div>
                    <div class="card-body rounded-0">
                        <div class="container-fluid">
                            <div class="mb-3">
                                <label for="invoice_code" class="form-label">Invoice Code</label>
                                <input type="text" class="form-control rounded-0" name="invoice_code" id="invoice_code" required="required">
                            </div>
                            <div class="mb-3">
                                <label for="customer" class="form-label">Customer Name</label>
                                <input type="text" class="form-control rounded-0" name="customer" id="customer" required="required">
                            </div>
                            <hr>
                            <label for="" class="form-label text-body-emphasis d-block text-center">Item Form</label>
                            <div class="mb-3">
                                <label for="item" class="form-label">Item</label>
                                <input type="text" class="form-control rounded-0" id="item">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <input type="text" class="form-control rounded-0" id="unit" value="pcs">
                                        <label for="unit" class="form-label d-block text-center"><small>Unit</small></label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <input type="number" class="form-control rounded-0 text-center" id="qty" value="1">
                                        <label for="qty" class="form-label d-block text-center"><small>QTY</small></label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" step="any" class="form-control rounded-0 text-end" id="price">
                            </div>
                            <div class="d-flex justify-content-center w-100">
                                <button class="btn btm-sm rounded btn-primary" type="button" id="add_item"><i class="far fa-plus-square"></i> Add Item</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7 col-sm-12 col-12">
                <div class="card shadow">
                    <div class="card-header rounded-0">
                        <div class="card-title">Item List</div>
                    </div>
                    <div class="card-body rounded-0">
                        <div class="container-fluid">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-stripped" id="order-item-tbl">
                                    <colgroup>
                                        <col width="5%">
                                        <col width="10%">
                                        <col width="10%">
                                        <col width="40%">
                                        <col width="17.5%">
                                        <col width="17.5%">
                                    </colgroup>
                                    <thead>
                                        <tr class="bg-gradient bg-dark-subtle">
                                            <th class="bg-transparent text-center border border-dark"></th>
                                            <th class="bg-transparent text-center border border-dark">QTY</th>
                                            <th class="bg-transparent text-center border border-dark">Unit</th>
                                            <th class="bg-transparent text-center border border-dark">Item</th>
                                            <th class="bg-transparent text-center border border-dark">Price</th>
                                            <th class="bg-transparent text-center border border-dark">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="noData">
                                            <th class="text-center border-dark" colspan="6">No Item Listed Yet</th>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr class="bg-gradient bg-dark-subtle bg-opacity-50">
                                            <th class="bg-transparent text-center border border-dark" colspan="5">Sub-Total</th>
                                            <th class="bg-transparent border border-dark text-end" id="subTotalText">0</th>
                                        </tr>
                                        <tr class="bg-gradient bg-dark-subtle bg-opacity-50">
                                            <th class="bg-transparent text-center border border-dark" colspan="5">Discount (%)</th>
                                            <th class="bg-transparent border border-dark"><input type="number" class="form-control form-control-sm rounded-0 text-end" step="any" name="discount_percentage" id="discount_percentage" min="0" max="100" value="0"></th>
                                        </tr>
                                        <tr class="bg-gradient bg-dark-subtle bg-opacity-50">
                                            <th class="bg-transparent text-center border border-dark" colspan="5">Grand Total</th>
                                            <th class="bg-transparent border border-dark text-end" id="grandTotalText">0</th>
                                        </tr>
                                        <tr class="bg-gradient bg-dark-subtle bg-opacity-50">
                                            <th class="bg-transparent text-center border border-dark" colspan="5">Tendered Amount</th>
                                            <th class="bg-transparent border border-dark"><input type="number" class="form-control form-control-sm rounded-0 text-end" step="any" name="tendered_amount" id="tendered_amount" min="0" value="0"></th>
                                        </tr>
                                        <tr class="bg-gradient bg-dark-subtle bg-opacity-50">
                                            <th class="bg-transparent text-center border border-dark" colspan="5">Change</th>
                                            <th class="bg-transparent border border-dark text-end" id="changeText">0</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            
                            <div class="d-flex justify-content-center w-100 my-3">
                                <button class="btn btm-sm rounded btn-primary" type="button" id="order-form-submit"><i class="fas fa-file-invoice"></i> Save & Generate Printable Invoice</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    <?php include_once('settings-modal.php'); ?>
    
    <script src="assets/js/script.js"></script>
    <?php 
    if(isset($conn)){
        $conn->close();
    }
    ?>
    <?php if(isset($_SESSION['generate_receipt_id'])): ?>
    <script>
        setTimeout(function(){
            window.open("printable-receipt.php", "_blank", "width=900px,height=900px")
        },300)
    </script>
    <?php endif; ?>
</body>
</html>