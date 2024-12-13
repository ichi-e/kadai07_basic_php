<?php
$pref  = $_POST["pref"];
$selectPoint = isset($_POST["point"]) ? $_POST["point"] : [];
$filePath = "data.json";
$json = file_get_contents($filePath);
$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$arr = json_decode($json, true);

// var_dump($point);

$matchHotels = [];
foreach ($arr as $data) {
    if ($data['pref'] != $pref) {
        continue;
    }
    if (!empty($selectPoint)){
        $hotelPoints = isset($data['point']) && is_array($data['point']) ? $data['point'] : [];
        $matchPoints = !array_diff($selectPoint, $hotelPoints);
        if (!$matchPoints){
            continue;
        }
    }

    $matchHotels[] = $data;

}

?>

<?php include('header.php'); ?>

<main>
    <section class="archive">
        <?php if (empty($matchHotels)): ?>
            <p>該当するホテルが見つかりませんでした。</p>
        <?php else: ?>
            <?php foreach ($matchHotels as $data): ?>
                <a href="detail.php?id=<?php echo $data['id']; ?>">
                    <div class="container">
                        <figure>
                            <img src="img/<?php echo htmlspecialchars($data['img']); ?>" alt="<?php echo htmlspecialchars($data['name']); ?>">
                        </figure>
                        <h2><?php echo htmlspecialchars($data['name']); ?></h2>
                        <?php if (!empty($data['point']) && is_array($data['point'])): ?>
                            <ul class="point">
                                <?php foreach ($data['point'] as $point): ?>
                                    <li><?php echo htmlspecialchars($point); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>
</main>

<?php include('footer.php'); ?>