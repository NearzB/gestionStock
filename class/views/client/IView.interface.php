<?php
namespace gestionStock\views\client;


interface IView
{
    /**
     * @param array $data
     * @return void
     */
    public function showView(array $data);
}