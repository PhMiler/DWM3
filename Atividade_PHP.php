<?php
if (\$_SERVER['REQUEST_METHOD'] == "POST") {
    $inputTexto = \$_POST['atividade1'];
    $padrao = '/[aeiouAEIOU]/';
    $substituto = "*";
    $resultadoTexto = preg_replace($padrao, $substituto, $inputTexto);
}

if (\$_SERVER['REQUEST_METHOD'] == "POST") {
    $inputNumero = \$_POST['atividade2'];
    $statusPrimo = 'é um número primo';
    if ($inputNumero < 2) {
        $statusPrimo = 'não é um número primo';
    }
    for ($i = 2; $i <= sqrt($inputNumero); $i++) {
        if ($inputNumero % $i == 0) {
            $statusPrimo = 'não é um número primo';
            break;
        }
    }
}

function inverterString($texto)
{
    return implode('', array_reverse(str_split($texto)));
}

if (\$_SERVER['REQUEST_METHOD'] == "POST") {
    $inputTexto2 = \$_POST['atividade3'];
    $textoInvertido = inverterString($inputTexto2);
}

function verificarSinal($num)
{
    if ($num == 0) {
        return 'é zero';
    }
    return ($num > 0) ? 'é positivo' : 'é negativo';
}

if (\$_SERVER['REQUEST_METHOD'] == "POST") {
    $inputNumero2 = \$_POST['atividade4'];
    $statusNumero = verificarSinal($inputNumero2);
}

if (\$_SERVER['REQUEST_METHOD'] == "POST") {
    $inputTexto3 = \$_POST['atividade5'];
    $palavras = explode(" ", $inputTexto3);
    $totalPalavras = count($palavras);
    $listaPalavras = implode("<br>", array_map('trim', $palavras));
}

if (\$_SERVER['REQUEST_METHOD'] == "POST") {
    $inputTexto4 = \$_POST['atividade6'];
    $textoReverso = inverterString($inputTexto4);
    $statusPalindromo = ($inputTexto4 == $textoReverso) ? 'é um palíndromo' : 'não é um palíndromo';
}

if (\$_SERVER['REQUEST_METHOD'] == "POST") {
    $numeros = range(1, 20);
    foreach ($numeros as $indice => $valor) {
        if ($valor % 3 == 0) {
            $numeros[$indice] = 'X';
        }
    }
    $resultadoNumeros = implode(' ', $numeros);
}

if (\$_SERVER['REQUEST_METHOD'] == "POST") {
    $inputTexto5 = \$_POST['atividade8'];
    $textoSemEspacos = preg_replace('/\s+/', '', $inputTexto5);
}

if (\$_SERVER['REQUEST_METHOD'] == "POST") {
    $limiteFibonacci = 10;
    $sequenciaFibonacci = [1, 1];
    for ($i = 2; $i < $limiteFibonacci; $i++) {
        $sequenciaFibonacci[] = $sequenciaFibonacci[$i - 1] + $sequenciaFibonacci[$i - 2];
    }
    $resultadoFibonacci = implode(' ', $sequenciaFibonacci);
}

if (\$_SERVER['REQUEST_METHOD'] == "POST") {
    $inputTexto6 = strtolower(str_replace(' ', '', \$_POST['atividade10']));
    $alfabetoCompleto = range('a', 'z');
    $letrasUsadas = array_unique(str_split($inputTexto6));
    $statusPangrama = (count($letrasUsadas) === 26 && !array_diff($alfabetoCompleto, $letrasUsadas)) ? 'é um pangrama' : 'não é um pangrama';
    $faltandoLetras = implode(' ', array_diff($alfabetoCompleto, $letrasUsadas));
}
?>
