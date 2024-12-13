<?php
$name  = $_POST["name"];
$pref  = $_POST["pref"];
$url   = $_POST["url"];
$rec   = $_POST["rec"];
$memo  = $_POST["memo"];
$point = $_POST["point"];

// ファイル
$file = $_FILES["img"];
$filename = basename($file["name"]);
$tmp_path = $file["tmp_name"];
$file_err = $file["error"];
$filesize = $file["size"];
$upload_dir = __DIR__ . "/img/";
$sava_filename = date("YmdHis") . $filename;


if (is_uploaded_file($tmp_path)) {
    move_uploaded_file($tmp_path, $upload_dir . $sava_filename);
}

$hotelData = array(
    "id" => date("YmdHis"),
    "name" => $name,
    "pref" => $pref,
    "url" => $url,
    "rec" => $rec,
    "point" => $point,
    "memo" => $memo,
    "img" => $sava_filename
);

$filePath = "data.json";

if (file_exists($filePath)) {
    // 既存のデータを読み込む
    $existingData = json_decode(file_get_contents($filePath), true);
    if (!$existingData) $existingData = [];
} else {
    $existingData = [];
}

// 新しいデータを追加
$existingData[] = $hotelData;

// JSONとして保存
file_put_contents($filePath, json_encode($existingData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

?>

<?php include('header.php'); ?>
<main>
    <p class="complete">登録しました</p>

    <div>
        <p class="back"><a href="input.php">戻る</a></p>
        <p class="back"><a href="index.php">ページを確認する</a></p>
    </div>

</main>
<?php include('footer.php'); ?>