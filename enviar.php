
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Honeypot: se o campo invisível for preenchido, assume que é bot e encerra
if (!empty($_POST['empresa'])) {
    exit;
}

$nome = $_POST['name'];
$email = $_POST['email'];
$mensagem = $_POST['message'];

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.hostinger.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'contato@residencialcenarium.com.br';
    $mail->Password = 'R20Cena&22';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('contato@residencialcenarium.com.br', 'Cenarium');
    $mail->addAddress('contato@residencialcenarium.com.br');
    $mail->addReplyTo($email, $nome);

    $mail->isHTML(true);
    $mail->Subject = 'Mensagem - Residencial Cenarium';
    $mail->Body    = "
        <strong>Nome:</strong> $nome<br>
        <strong>Email:</strong> $email<br>
        <strong>Mensagem:</strong><br>$mensagem
    ";

    $mail->send();
    header('Location: contato.html');
    exit;
} catch (Exception $e) {
    echo "Erro ao enviar: {$mail->ErrorInfo}";
}
?>
