<?php
if (!function_exists('formatarData')) {
    /**
     * Função que formata uma data para o padrão brasileiro
     * @param string $data
     * @return string
     */
    function formatarData($data){
        return date('d/m/Y', strtotime($data));
    }
}

if (!function_exists('formatarDataHora')) {
    /**
     * Função que formata uma data e hora para o padrão brasileiro
     * @param string $data
     * @return string
     */
    function formatarDataHora($data){
        return date('d/m/Y H:i', strtotime($data));
    }
}