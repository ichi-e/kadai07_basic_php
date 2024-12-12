<?php
$id = $_GET['id'];
$filePath = "data.json";
$json = file_get_contents($filePath);
$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$arr = json_decode($json, true);

$hotel = null;
foreach ($arr as $data) {
    if ($data['id'] == $id) {
        $hotel = $data;
        break;
    }
}
?>

<?php include('header.php'); ?>

<main>
    <section class="single">
        <p class="pref"><?php echo htmlspecialchars($data['pref']); ?></p>
        <h1><?php echo htmlspecialchars($data['name']); ?></h1>

        <figure>
            <img src="img/<?php echo htmlspecialchars($data['img']); ?>" alt="<?php echo htmlspecialchars($data['name']); ?>">
        </figure>

        <?php if (!empty($data['point']) && is_array($data['point'])): ?>
            <ul class="point">
                <?php foreach ($data['point'] as $point): ?>
                    <li><?php echo htmlspecialchars($point); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <div class="stars" data-rec="<?php echo htmlspecialchars($data['rec']); ?>"></div>

        <p class="memo"><?php echo nl2br(htmlspecialchars($data['memo'])); ?></p>
        <p class="url"><a href="<?php echo htmlspecialchars($data['url']); ?>" target="_blank"><?php echo htmlspecialchars($data['url']); ?></a></p>

        <p class="back"><a href="index.php">戻る</a></p>
    </section>
</main>

<?php include('footer.php'); ?>