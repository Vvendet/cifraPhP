<!DOCTYPE html>
<html>
<head>
    <title>Resultado: Cifra</title>
    <style type="text/css">
        h1{text-align: center}
        h2{text-align: center}
    </style>
</head>
<body>
    <h1>Resultado:</h1>
    <h2>
        <?php
        // ARRAY COM AS PALAVRAS DO ALFABETO 
        $letras = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', ' ');

        //RECEBE OS DADOS POSTADOS 
        $mensagem = $_POST['fmensagem']; // ....... RECEBE A MENSAGEM A SER CRIPTOGRAFADA
        $option   = $_POST['foption']; // ......... RECEBE SE DEVE CRIPTOGRAFAR OU DESCRIPTOGRAFAR
        $chave    = $_POST['fchave']; // .......... RECEBE O VALOR DE QUANTAS LETRAS A FRENTE PARA CRIPTOGRAFAR


        // PREPARA OS DADOS PARA A CRIPTOGRAFIA
        $mensagem = strtolower($mensagem); // ..... CONVERTE A MENSAGEM EM MINUSCULA
        $mensagem = str_split($mensagem); // ...... QUEBRA A MENSAGEM EM ARRAY
        $option   = strtolower($option); // ....... CONVERTE A OPCAO PARA MINUSCULA
        $chave    = intval($chave); // ............ CONVERTE A CHAVE PARA INTEIRO


        // FUNÇÃO PARA CRIPTOGRAFAR
        function criptografar($letras, $chave, $mensagem)
        {
            $novaMensagem = array(); // .................................................... VARIAVEL QUE RECEBERA A MENSAGEM CRIPTOGRAFADA

            foreach ($mensagem as $indiceMensagem => $letraMensagem) { // .................. PERCORRE A MENSAGEM
                foreach ($letras as $indiceLetra => $letra) { // ........................... PERCORRE AS LETRAS
                    if ($letra == $letraMensagem) { // ..................................... SE A LETRA DA MENSAGEM FOR IGUAL A LETRA DO ARRAY
                        if ($indiceLetra == 26) { // ....................................... SE A LETRA DA MENSAGEM FOR ESPAÇO
                            $novaMensagem[] = " "; // ...................................... RETORNA ESPAÇO
                        } else if (($indiceLetra + $chave) > 25) { /* ...................... OU SE O INDICE + A CHAVE FOR MAIOR QUE 25                                                                                                     */
                            $novaMensagem[] = $letras[(($indiceLetra + $chave) - 26)];/* ... A VARIAVEL DA MENSAGEM
                                                                                         CRIPTOGRAFADA RECEBE             
                                                                                             ((INDICE DA LETRA DO ARRAY + CHAVE) - O TAMANHO DO ARRAY QUE É 26).*/
                        } else { 
                            $novaMensagem[] = $letras[($indiceLetra + $chave)]; /* ......... A VARIAVEL DA MENSAGEM  
                                                                                            CRIPTOGRAFADA RECEBE
                                                                                             (INDICE DA LETRA DO ARRAY + CHAVE)*/
                        }
                    }
                }
            }

            return $novaMensagem; // ....................................................... RETORNA A MENSAGEM CRIPTOGRAFADA EM ARRAY
        }


        //  FUNÇÃO PARA DESCRIPTOGRAFAR 
        function descriptografar($letras, $chave, $mensagem)
        {
            $novaMensagem = array(); // .................................................... VARIAVEL QUE RECEBERA A MENSAGEM DESCRIPTOGRAFADA

            foreach ($mensagem as $indiceMensagem => $letraMensagem) { // .................. PERCORRE A MENSAGEM
                foreach ($letras as $indiceLetra => $letra) { // ........................... PERCORRE AS LETRAS
                    if ($letra == $letraMensagem) { // ..................................... SE A LETRA DA MENSAGEM FOR IGUAL A LETRA DO ARRAY
                        if ($indiceLetra == 26) { // ....................................... SE A LETRA DA MENSAGEM FOR ESPAÇO
                            $novaMensagem[] = " "; // ...................................... A VARIAVEL DA MENSAGEM CRIPTOGRAFADA RECEBE O ESPAÇO
                        } else if (($indiceLetra - $chave) < 0) { // ....................... OU SE O INDICE MENOS A CHAVE FOR MENOR QUE 0
                            $novaMensagem[] = $letras[(26 - ($chave - $indiceLetra))]; /* .. A VARIAVEL DA MENSAGEM CRIPTOGRAFADA RECEBE A LETRA
                                                                                             
                                                                                             (O TAMANHO DO ARRAY - (CHAVE - INDICE DA LETRA DO ARRAY)).*/
                        } else { 
                            $novaMensagem[] = $letras[($indiceLetra - $chave)]; /* ......... A VARIAVEL DA MENSAGEM CRIPTOGRAFADA RECEBE A LETRA
                                                                                             (INDICE DA LETRA DO ARRAY - CHAVE)*/
                        }
                    }
                }
            }

            return $novaMensagem; // ....................................................... RETORNA O ARRAY COM A MENSAGEM CRIPTOGRAFADA
        }







        // #######################################( EXECUÇÃO )#############################################
        if ($option == "criptografar" || $option == "c") { // ............. SE A OPÇÃO FOR CRIPTOGRAFAR
            $retorno = criptografar($letras, $chave, $mensagem); /* ....... CHAMA: FUNCTION CRIPTOGRAFAR
                                                                            */
            echo implode('', $retorno); 
        } else if ($option == "descriptografar" || $option == "d") { // ... SE A OPÇÃO FOR DESCRIPTOGRAFAR
            $retorno = descriptografar($letras, $chave, $mensagem); /* .... CHAMA: FUNCTION DESCRIPTOGRAFAR

                                                                           */
            echo implode('', $retorno); 
        }
        ?>
    </h2>
</body>
</html>