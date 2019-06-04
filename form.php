<?php

/* apenas dispara o envio do formulário caso exista $_POST['enviarFormulario']*/
 
if (isset($_POST['enviar_email'])){
 
 
    /*** INÍCIO - DADOS A SEREM ALTERADOS DE ACORDO COM SUAS CONFIGURAÇÕES DE E-MAIL ***/
     
    $enviaFormularioParaNome = 'Justicia Aerea';
    $enviaFormularioParaEmail = 'testesite@justicaaerea.com.br';
     
    $caixaPostalServidorNome = 'WebSite | Formulário';

    $caixaPostalServidorEmail = 'testesite@justicaaerea.com.br';
    $caixaPostalServidorSenha = 'testesite01';
     
    /*** FIM - DADOS A SEREM ALTERADOS DE ACORDO COM SUAS CONFIGURAÇÕES DE E-MAIL ***/
     
     
    /* abaixo as veriaveis principais, que devem conter em seu formulario*/
     
    $remetenteNome  = $_POST['nome'];
    $remetenteEmail = $_POST['email'];
    $mensagem = $_POST['texto'];
     
    $mensagemConcatenada = 'Formulário gerado via website'.'
    ';
    $mensagemConcatenada .= '-------------------------------
    
    ';
    $mensagemConcatenada .= 'Nome: '.$remetenteNome.'
    ';
    $mensagemConcatenada .= 'E-mail: '.$remetenteEmail.'
    ';
    $mensagemConcatenada .= '-------------------------------
    ';
    $mensagemConcatenada .= 'Mensagem: "'.$mensagem.'"
    ';
     
     
    /*********************************** A PARTIR DAQUI NAO ALTERAR ************************************/
        
    require_once('PHPMailer-5.2-stable/PHPMailerAutoload.php');
    
    $mail = new PHPMailer();
    $mail->SMTPOptions = array(
    
        'ssl' => array(
    
            'verify_peer' => false,
    
           'verify_peer_name' => false,
    
            'allow_self_signed' => true
    
        )
    
    ); 
    $mail->IsSMTP();
    $mail->SMTPAuth  = true;
    $mail->Charset   = 'utf8_decode()';
    $mail->Host  = 'mail.'.substr(strstr($caixaPostalServidorEmail, '@'), 1);
    $mail->Port  = '587';
    $mail->Username  = $caixaPostalServidorEmail;
    $mail->Password  = $caixaPostalServidorSenha;
    $mail->From  = $caixaPostalServidorEmail;
    $mail->FromName  = utf8_decode($caixaPostalServidorNome);
    $mail->IsHTML(true);
    $mail->Body  = utf8_decode($mensagemConcatenada);
    $mail->SMTPDebug = 3;
    $mail->AddAddress($enviaFormularioParaEmail,utf8_decode($enviaFormularioParaNome));
     
    if(!$mail->Send()){
    $mensagemRetorno = 'Erro ao enviar formulário: '. print($mail->ErrorInfo);
    }else{
    $mensagemRetorno = 'Formulário enviado com sucesso!';
    }
     
     echo "<br>".$mensagemRetorno;
    }
    
?>