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

$url = "https://www.bukalapak.com/p/handphone/hp-smartphone/7fybvh-jual-sony-z5-e6683-3-32-gb-garansi-resmi-1-tahun";

$teks = file_get_contents($url);

$data = [
    'title' => getStringBetween($teks, "<h1 class="c-product-detail__name">", "</h1>"),
    'price' => getStringBetween($teks, 'data-reduced-price="', '" data-installment'),
    'category' => getStringBetween($teks, "<dd class='c-deflist__value qa-pd-category-value'>\n", "\n</dd>"),
    'description' => getStringBetween($teks, "js-collapsible-product-detail qa-pd-description u-txt--break-all'>\n<p>", "</p>")
];
?>

<table border="1">
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