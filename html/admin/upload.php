<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $client_id = "da2aeb99e6715be";
    $image = $_FILES['image']['tmp_name'];
    $filename = $_FILES['image']['name'];

    $handle = fopen($image, "r");
    $data = fread($handle, filesize($image));
    fclose($handle);

    $pvars = array('image' => base64_encode($data));
    $timeout = 30;

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image');
    curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL verification
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); // Disable SSL verification

    $out = curl_exec($curl);
    curl_close($curl);

    $pms = json_decode($out, true);
    $url = $pms['data']['link'];

    if ($url != "") {
        echo json_encode(['status' => 'success', 'url' => $url]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Something went wrong.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
