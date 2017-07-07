<?php
namespace gestionStock\views\user;


interface IView
{
    /**
     * @param array $data
     * @return void
     */
    public function showView(array $data);
}