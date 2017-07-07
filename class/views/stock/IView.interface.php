<?php
namespace gestionStock\views\stock;


interface IView
{
    /**
     * @param array $data
     * @return void
     */
    public function showView(array $data);
}