<?php 
session_start();

$root = '../';

if (isset($_POST['reserve'])) {
    $_SESSION['reserve']    = True;
    $startDate              = strip_tags(trim($_POST['startDate']));
    $time                   = strtotime($startDate);
    $_SESSION['startDate']  = date('Y-m-d', $time);
    $endDate                = strip_tags(trim($_POST['endDate']));
    $time1                  = strtotime($endDate);
    $_SESSION['endDate']    = date('Y-m-d', $time1);
    $_SESSION['startTime']  = strip_tags(trim($_POST['startTime']));
    $_SESSION['endTime']    = strip_tags(trim($_POST['endTime']));
    // $totalPrice          = strip_tags(trim($_POST['totalPrice']));
    $_SESSION['comments']   = strip_tags(trim($_POST['Coments']));
    $diff                   = strtotime($endDate . ' ' . $_SESSION['endTime']) -
                              strtotime($startDate . ' ' . $_SESSION['startTime']);
    $_SESSION['diff']       = intval($diff / 60 / 60 / 24);
    $_SESSION['totalPrice'] = number_format($_SESSION['bikePrice'] * $_SESSION['diff'], 2, '.', '');

    // forecastData
    include $root . 'forecastData.php';
    $response               = file_get_contents("forecastdata.json");
    $data                   = json_decode($response);
    $weatherdata = $data->data;
    date('Y-m-d', strtotime($weatherdata[0]->valid_date));
    $discountList  = array();
    for ($a = 0; $a < 15; $a++) {
        $code = $weatherdata[$a]->weather->code;
        $date = date('Y-m-d', strtotime($weatherdata[$a]->valid_date));
        $discount;
        // sunny day: discount rate = 0
        if (
            $code == 700 || $code == 711 || $code == 721 || $code == 731 || $code == 741 ||
            $code == 751 || $code == 800 || $code == 801 || $code == 803 || $code == 804
        ) {
            $discount = 0;
        } else {
            // rainny day: discount rate = 50%
            $discount = 0.5;
        }
        // store in multi array [date][dicount rate]
        $discountList[$a] = array($date, $discount);
    }
    // Discount Price
    $count = -1;
    // Match the date pick and the date in API
    for ($a = 0; $a < count($discountList); $a++) {
        if ($_SESSION['startDate'] == $discountList[$a][0]) {
            // pick day starts at index a
            $count = $a;
        }
    }
    // cal price after discount
    // discount showed if user choose within 15 days
    $discount = 0;
    if ($count >= 0) {
        $diff_count = $_SESSION['diff'] + $count;
        // Condition 1: StartDate within forecast and Dropdate within forecast           
        if ($diff_count <= 15) {  
            for ($i = $count; $i < $diff_count+1; $i++) {
                echo $discount . ' - ' . $discountList[$i][1] . '<br>';
                $discount = $discount + ($_SESSION['bikePrice'] * $discountList[$i][1]);
            }
        } else { // Condition 2: StartDate within forecast and Dropdate later than forecast 
            $nonForecastDay = $diff - 15 + $count;
            for ($i = $count; $i < 15; $i++) {
                $discount = $discount + ($_SESSION['bikePrice'] * $discountList[$i][1]);
            }
        }
    }
    $_SESSION['discountRate'] = number_format($discount, 2, '.', '');
    $_SESSION['totalprice_afterdiscount'] =  number_format($_SESSION['totalPrice'] - $_SESSION['discountRate'], 2, '.', '');
    echo $_SESSION['totalprice_afterdiscount'];

    if (!isset($_SESSION['userID'])) {        
		header('Location: ' . $root . 'account/login.php?next=payment');
    } else {
		header('Location: ' . $root . 'rent/payment.php');
    }
} else if ($_SESSION['reserve']) {
    header('Location: ' . $root . 'rent/payment.php');
} else {
    header('Location: ' . $root . 'rent');
}
?>