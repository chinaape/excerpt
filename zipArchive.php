<?php
/**
 * PHP ZipArchive 压缩包处理
 */
$zipPath = './Public/Uploads/photo.zip';
$uplPath = './Public/Uploads/';
$zip = new \ZipArchive();

if ($zip->open($zipPath, \ZipArchive::CREATE) == true) {
    foreach ($list as $key => &$item) {
        $arPotos = explode(',', $item['display_img']);
        foreach ($arPotos as $k => $v) {
            if (file_exists($uplPath . $v)) {
                $custName = iconv("UTF-8", "GBK", $item['cust_name']);
                $displayName = iconv("UTF-8", "GBK", $item['display_name']);
                $imgStr = file_get_contents($uplPath . $v);
                $zip->addFromString($custName . DIRECTORY_SEPARATOR . $displayName . '-' . $key . $k . '.jpg', $imgStr);
            }
        }
    }
}
$zip->close();
?>