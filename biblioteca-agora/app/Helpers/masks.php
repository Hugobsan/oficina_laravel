<?php
if (!function_exists('unmask')) {
    /**
     * Função que remove todos os tipos de máscara de uma string
     * @param string $string
     * @return string
     */
    function unmask($string)
    {
        return str_replace(['.', '-', '(', ')', ' '], '', $string);
    }
}

if (!function_exists('mask')) {
    /**
     * Função que adiciona uma máscara a uma string
     * @param string $mask
     * @param string $string
     * @return string
     */
    function mask($mask, $string){
        $string = unmask($string);
        $maskared = '';
        $k = 0;
        for ($i = 0; $i <= strlen($mask) - 1; $i++) {
            if ($mask[$i] == '#') {
                if (isset($string[$k]))
                    $maskared .= $string[$k++];
            } else {
                if (isset($mask[$i]))
                    $maskared .= $mask[$i];
            }
        }
        return $maskared;
    }
}

if (!function_exists('maskCPF')) {
    /**
     * Função que adiciona uma máscara de CPF a uma string
     * @param string $string
     * @return string
     */
    function maskCPF($string)
    {
        return mask('###.###.###-##', $string);
    }
}

if (!function_exists('maskTelefone')) {
    /**
     * Função que adiciona uma máscara de telefone a uma string
     * @param string $string
     * @return string
     */
    function maskTelefone($string)
    {
        return mask('(##) #####-####', $string);
    }
}

if (!function_exists('maskCEP')) {
    /**
     * Função que adiciona uma máscara de CEP a uma string
     * @param string $string
     * @return string
     */
    function maskCEP($string)
    {
        return mask('#####-###', $string);
    }
}

if (!function_exists('maskCNPJ')) {
    /**
     * Função que adiciona uma máscara de CNPJ a uma string
     * @param string $string
     * @return string
     */
    function maskCNPJ($string)
    {
        return mask('##.###.###/####-##', $string);
    }
}