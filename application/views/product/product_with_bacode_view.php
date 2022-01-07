<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="description" content="Quickly read barcodes with Dynamsoft Barcode Reader from a live camera stream.">
    <meta name="keywords" content="camera based barcode reading">
    <title>Dynamsoft Barcode Reader Sample - Hello World (Decoding via Camera)</title>
    <script src="https://cdn.jsdelivr.net/npm/dynamsoft-javascript-barcode@8.8.3/dist/dbr.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/js/instascan.min.js"></script>
</head>

<body>
    <h1 style="font-size: 1.5em;">Read Barcodes from a Camera</h1>
    <button id="btn-show-scanner">Show Barcode Scanner</button>
    <script>

        let pScanner = null;
        document.getElementById('btn-show-scanner').onclick = async function() {
            try {
                pScanner = pScanner || Dynamsoft.DBR.BarcodeScanner.createInstance();
                let scanner = await pScanner;
                scanner.onFrameRead = results => {
                    console.log("Barcodes on one frame:");
                    for (let result of results) {
                        console.log(result.barcodeFormatString + ": " + result.barcodeText);
                    }
                };
                scanner.onUnduplicatedRead = (txt, result) => {
                    alert(txt);
                    console.log("Unique Code Found: " + result);
                }
                await scanner.show();
            } catch (ex) {
                alert(ex.message);
                throw ex;
            }
        };
    </script>
</body>

</html>