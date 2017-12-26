<?php
class barcode {
 
    function __construct() {
        include_once APPPATH . '/third_party/php-barcode-generator/src/BarcodeGeneratorJPG.php';
    }
}
?>