<?php
$root = "../";
$subtitle = 'Payment';
$nav = "rent";
include $root . 'header.php';

session_start();

include_once($root . "db.php");

$result = '';
if (!$_SESSION['reserve']) {
    header('Location: ' . $root . 'rent');
}

if (isset($_POST['confirm'])) {
    

    $sql2 = "SELECT * FROM `bikes` WHERE model = '$_SESSION[bikeID]'";
    $result = mysqli_query($connect, $sql2);
    while($row = mysqli_fetch_array($result)){
        if($row['status'] == '1'){
            $id = $row['ID']; 
            $sql1 = "UPDATE bikes SET status = '2' WHERE ID = '$id'  ";
            $qsql1 = mysqli_query($connect, $sql1);

            $sql = "INSERT INTO reservations(userID, bikeID, startDate, endDate,startTime, endTime, totalPrice, Comments, status) 
            VALUES ('$_SESSION[userID]','$id','$_SESSION[startDate]','$_SESSION[endDate]','$_SESSION[startTime]','$_SESSION[endTime]','$_SESSION[totalprice_afterdiscount]','$_SESSION[comments]', '4')";
            $qsql = mysqli_query($connect, $sql); 
            break;
        }
    }

    unset($_SESSION['reserve'], $_SESSION['bikeID'], $_SESSION['bikePrice'], $_SESSION['bikeName'], $_SESSION['bikeImg'], $_SESSION['startDate'],$_SESSION['endDate'],$_SESSION['startTime'],$_SESSION['endTime'],$_SESSION['totalprice_afterdiscount'],$_SESSION['comments']);

    header('Location: ' . $root . 'rent');
}
?>

<link rel="stylesheet" type="text/css" href="<?php echo $root ?>assets/css/form.css">

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<body>
    <?php include $root . 'navbar.php' ?>
    <section>
        <div class="container">
            <div class="main content-border">
                <div class="forecast">
                    <?php include $root . 'forecast.php'; ?>
                </div>
            </div>
        </div>
        <?php include $root . 'sidenavigation.php' ?>
        <div class="container">
            <div class="main content-border">
                <div class="sub-content">
                    <div class="h2">Payment Summary</div>
                </div>
                <hr class="my-0">
                <form class="form-horizontal sub-content" method="post" action="<?php echo $root ?>rent/payment.php">
                    <div class="row">
                        <?php
                        if ($result != "") {
                            echo '<div class="form-group"><div class="col-sm-12 col-sm-offset-2">' . $result . '</div></div>';
                        }
                        ?>
                        <div class="col-5 pl-0 form-group">



                            <div id="detail" class="mt-3 mb-5">
                                
                                <div class="additional-info-box">
				 					<div class="additional-info-head">
				 						<h3>Payment Details</h3>
                                         ( Credit or Debit Card 
				 						<i class="fa fa-credit-card"></i> )
				 				    </div>
				 				    

                                    <div class="detail-row row mb-2">
                                        <div class="detail-label col-5 pl-0 pt-3">Card Number</div>
                                        <input class="custom-form-control" type="text" name="card-number" id="card-number" placeholder="eg. 1234432112344321" required>
                                    </div>
                                    <div class="detail-row row mb-2">
                                        <div class="detail-label col-5 pl-0">CV Code</div>
                                        <input class="custom-form-control" type="text" name="cv-number" id="cv-number" placeholder="eg. 420" required>
                                    </div>
                                    <div class="detail-row row mb-2">
                                        <div class="detail-label col-5 pl-0">Expiry Date</div>
                                        
                                    </div>
                                    Month
                                    <input class="custom-form-control" type="text" name="text-month" id="cv-number" placeholder="eg. 10" required> 
                                    Year
                                    <input class="custom-form-control" type="text" name="text-year" id="cv-number" placeholder="eg. 12" required>
                                    
                                </div>
                            </div>


                            
                        </div>
                        <div class="col pr-0">
                            <div id="detail" class="mt-3 mb-5">
                                <div class="additional-info-head">
                                    <h3>Reservation Details</h3>
				 				</div>
                                <div class="detail-row row mb-2">
                                    <div class="detail-label col-5 pl-0">Pick up Date/Time</div>
                                    <div class="detail-value col pr-0"><input id='diff' class="custom-form-control text-left" value="<?php echo $_SESSION['startDate'] . ' ' . $_SESSION['startTime']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="detail-row row mb-2">
                                    <div class="detail-label col-5 pl-0">Drop off Date/Time</div>

                                    <div class="detail-value col pr-0"><input id='diff' class="custom-form-control text-left" value="<?php echo $_SESSION['endDate'] . ' ' . $_SESSION['endTime']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="detail-row row mb-2">
                                    <div class="detail-label col-5 pl-0">Message</div>
                                    <div class="detail-value col pr-0">
                                        <textarea class="custom-form-control custom-textarea  text-left" name="Coments" rows="3" cols="50" style="resize: none;" disabled><?php echo $_SESSION['comments']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="detail-label col-7 pl-0">Total Day(s)</div>
                                <div class="col pr-0">
                                    <input id='diff' class="custom-form-control text-right" value="<?php echo $_SESSION['diff'] + 1; ?>" disabled>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="detail-label col-7 pl-0">Price Per Unit (RM)</div>
                                <div class="col pr-0">
                                    <input id='price_per_unit' class="custom-form-control text-right" value="<?php echo $_SESSION['bikePrice']; ?>" disabled>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="detail-label col-7 pl-0">Total Price (RM)</div>
                                <div class="col pr-0">
                                    <?php
                                        $total_price = ($_SESSION['diff'] + 1) * $_SESSION['bikePrice'];
                                        $_SESSION['totalPrice'] = number_format($total_price, 2, '.', '');
                                    ?>
                                    <input id='total_price' class="custom-form-control text-right" value="<?php echo $_SESSION['totalPrice']; ?>" disabled>
                                </div>
                            </div>
                            <div class="row mb-2 mb-4">
                                <div class="detail-label col-7 pl-0">Discount (RM)</div>
                                <div class="col pr-0">
                                    <input id='discount_rate' class="custom-form-control text-right" value="- <?php echo $_SESSION['discountRate']; ?>" disabled>
                                </div>
                            </div>
                            <div class="row mb-2 mb-4">
                                <div class="detail-label col-7 pl-0">Total Price After Discount(RM)</div>
                                <div class="col pr-0">
                                    <?php
                                        $totalprice_afterdiscount = $_SESSION['totalPrice'] - $_SESSION['discountRate'];
                                        $_SESSION['totalprice_afterdiscount'] = number_format($totalprice_afterdiscount, 2, '.', '');
                                    ?>
                                    
                                    <input id='total_price_to_pay' class="custom-form-control text-right" value="<?php echo $_SESSION['totalprice_afterdiscount']; ?>" disabled>
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <div class="custom-control custom-checkbox custom-checkbox-sunshine">
                                    <input type="checkbox" id="c1" class="custom-control-input custom-control-input-sunshine" name="cc" required>
                                    <label class="custom-control-label" for="c1">I agree to the <a id="contract" data-toggle="modal" href="#tnc-modal">contract</a></label>
                                </div>
                            </div>

                            <?php include $root . 't&c.html' ?>
                            <div class="form-group mt-4">
                                <div id="sendButton">
                                    <button type="submit" id="submit" class="btn btn-warning" name="confirm">Pay</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
    </section>
    <?php include $root . 'footer.html' ?>
</body>

</html>