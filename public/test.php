<?php
// Teste de codigo direto da AWS
require '../vendor/autoload.php';

use Aws\ResultInterface;
use Aws\S3\S3Client;
use Psr\Http\Message\UriInterface;
use Psr\Log\LoggerInterface;
use Aws\S3\Exception\S3Exception;

ini_set("display_errors", "OFF");
// Session
if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/atendimento/sessao.php")) {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/atendimento/sessao.php";
} else {
    die("Arquivo de sessão não encontrado.");
}

$bucket = 'mys3';
$keyname = '*** Your Object Key ***';

$s3 = new Aws\S3\S3Client([
    'version' => 'latest',
    'region'  => 'us-east-1',
    'credentials' => [
        'key'    => "0000",
        'secret' => "0000",
    ]
]);

try {
    // Upload data.
    $result = $s3->putObject([
        'Bucket' => $bucket,
        'Key'    => $keyname,
        'Body'   => 'Hello, world!',
        'ACL'    => 'public-read'
    ]);

    // Print the URL to the object.
    echo $result['ObjectURL'] . PHP_EOL;
} catch (S3Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
