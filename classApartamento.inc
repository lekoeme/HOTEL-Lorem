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
class classApartamento {
    protected $IDApartamento;
    protected $NumeroApartamento;
    protected $NumeroChave;
    protected $TipoApartamento;
    protected $TipoAcomodacao;
    protected $Camas;
    protected $TemTV;
    protected $TemFrigobar;
    protected $TemBanheira;
    protected $TemEscrivaninha;
    
    // Construtor
    function __construct() {
        $this->IDApartamento = 0;
        $this->NumeroApartamento = 0;
        $this->TemTV = "N";
        $this->TemFrigobar = "N";
        $this->TemBanheira = "N";
        $this->TemEscrivaninha = "N";
        $this->Camas = 0;
    }

    function SetIDApartamento($IDApartamento) {
        $this->IDApartamento = $IDApartamento;
    }
    
    function SetNumeroApartamento($NumeroApartamento) {
        $this->NumeroApartamento = $NumeroApartamento;
    }
    
    function SetNumeroChave($NumeroChave) {
        $this->NumeroChave = $NumeroChave;
    }

    function SetTipoApartamento($TipoApartamento) {
        $this->TipoApartamento = $TipoApartamento;
    }

    function SetTipoAcomodacao($TipoAcomodacao) {
        $this->TipoAcomodacao = $TipoAcomodacao;
    }
    
    function SetCamas($Camas) {
        $this->Camas = $Camas;
    }

    function SetTV($TemTV) {
        $this->TemTV = $TemTV;
    }
    
    function SetFrigobar($TemFrigobar) {
        $this->TemFrigobar = $TemFrigobar;
    }

    function SetBanheira($TemBanheira) {
        $this->TemBanheira = $TemBanheira;
    }
    
    function SetEscrivaninha($TemEscrivaninha) {
        $this->TemEscrivaninha = $TemEscrivaninha;
    }

    function GetIDApartamento() {
        return $this->IDApartamento;
    }
    
    function GetNumeroApartamento() {
        return $this->NumeroApartamento;
    }
    
    function GetNumeroChave() {
        return $this->NumeroChave;
    }

    function GetTipoApartamento() {
        return $this->TipoApartamento;
    }

    function GetTipoAcomodacao() {
        return $this->TipoAcomodacao;
    }

    function GetCamas() {
        return $this->Camas;
    }

    function GetTV() {
        return $this->TemTV;
    }
    
    function GetFrigobar() {
        return $this->TemFrigobar;
    }

    function GetBanheira() {
        return $this->TemBanheira;
    }
    
    function GetEscrivaninha() {
        return $this->TemEscrivaninha;
    }
}