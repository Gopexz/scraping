<a href='cek.html'>Klik</a>
<?php

function getStringBetween($teks, $sebelum, $sesudah){
    $teks = ''.$teks;
    $ini = strpos($teks, $sebelum);
    if ($ini==0){
        return '';
    }
    $ini += strlen($sebelum);
    $panjang = strpos($teks, $sesudah, $ini) - $ini;
    return substr($teks, $ini, $panjang);

}

// $url = "https://www.bukalapak.com/p/handphone/hp-smartphone/7fybvh-jual-sony-z5-e6683-3-32-gb-garansi-resmi-1-tahun";
$url = $_POST['something'];
$teks = file_get_contents($url);

$the_tag = "div";
$the_class = "c-product-image-gallery__main js-product-image-gallery__main";
libxml_use_internal_errors(true);
    $dom = new DOMDocument();
    $dom->loadHTML($teks);
    $xpath = new DOMXPath($dom);

    foreach ($xpath->query('//'.$the_tag.'[contains(@class,"'.$the_class.'")]/img') as $item) {
        global $img_src;
        $img_src =  $item->getAttribute('src');
        return $img_src;
    }
$a=$img_src;
$data = [
    // 'image' => getStringBetween($teks, '<div class="c-product-image-gallery__main js-product-image-gallery__main">', '</div>'),
    'title' => getStringBetween($teks, '<h1 class="c-product-detail__name">', "</h1>"),
    'price' => getStringBetween($teks, 'data-reduced-price="', '" data-installment'),
    'category' => getStringBetween($teks, '<dd class="c-deflist__value qa-pd-category-value qa-pd-category">', "</dd>"),
    'description' => getStringBetween($teks, '<div class="js-collapsible-product-detail qa-pd-description u-txt--break-word">', '</div>')
];
?>
<table border="1">
    <tr>
        <td>Gambar</td>
        <td> <?php echo $a;?> </td>
    </tr>
    <tr>
        <td>Nama</td>
        <td> <?php echo $data['title'];?> </td>
    </tr>
    <tr>
        <td>Harga</td>
        <td> <?php echo $data['price'];?> </td>
    </tr>
    <tr>
        <td>Kategori</td>
        <td> <?php echo $data['category'];?> </td>
    </tr>
    <tr>
        <td>Deskripsi</td>
        <td> <?php echo $data['description'];?> </td>
    </tr>