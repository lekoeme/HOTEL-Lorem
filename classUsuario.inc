<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of classCadastro
 *
 * @author William
 */
class classUsuario {
    protected $NomeUsuario;
    protected $SenhaAcesso;
    protected $NivelAcesso;
    protected $Hotel;
    
    // Construtor
    function __construct() {
        $this->NomeUsuario = "";
        $this->SenhaAcesso = "";
        $this->NivelAcesso = 0;
        $this->Hotel = 0;
    }

    function SetNomeUsuario($NomeUsuario) {
        $this->NomeUsuario = $NomeUsuario;
    }
    
    function SetSenhaAcesso($SenhaAcesso) {
        $this->SenhaAcesso = $SenhaAcesso;
    }
    
    function SetNivelAcesso($NivelAcesso) {
        $this->NivelAcesso = $NivelAcesso;
    }
    
    function SetHotel($Hotel) {
        $this->Hotel = $Hotel;
    }
    
    function GetNomeUsuario() {
        return $this->NomeUsuario;
    }
    
    function GetSenhaAcesso() {
        return $this->SenhaAcesso;
    }

    function GetNivelAcesso() {
        return $this->NivelAcesso;
    }

    function GetHotel() {
        return $this->Hotel;
    }
}