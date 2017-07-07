<?php
namespace gestionStock\views\fournisseur;


interface IView
{
    /**
     * @param array $data
     * @return void
     */
    public function showView(array $data);
}