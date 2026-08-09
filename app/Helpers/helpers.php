<?php

if (! function_exists('formatar_preco')) {
    function formatar_preco($valor)
    {
        return 'R$ ' . number_format($valor, 2, ',', '.');
    }
}