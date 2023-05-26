<?php
require_once("funcoes_diversas.php");

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
class classCadastro {
    protected $Nome;
    protected $DiaNascimento;
    protected $MesNascimento;
    protected $AnoNascimento;
    protected $CPF;
    protected $RG;
    protected $Endereco;
    protected $Numero;
    protected $Complemento;
    protected $Bairro;
    protected $Cidade;
    protected $Estado;
    protected $CEP;
    protected $Telefone;
    protected $Celular;
    protected $Empresa;
    protected $Usuario;
    protected $Senha;
    protected $Email;
    
    // Construtor
    function __construct() {
        $this->Nome = "";
        $this->DiaNascimento = "";
        $this->MesNascimento = "";
        $this->AnoNascimento = "";
        $this->CPF = "";
        $this->RG = "";
        $this->Endereco = "";
        $this->Numero = "";
        $this->Complemento = "";
        $this->Bairro = "";
        $this->Cidade = "";
        $this->Estado = "";
        $this->CEP = "";
        $this->Telefone = "";
        $this->Celular = "";
        $this->Empresa = "";
        $this->Usuario = "";
        $this->Senha = "";
        $this->Email = "";
    }

    function SetNome($Nome) {
        $this->Nome = $Nome;
    }
    
    function SetDataNascimento($Data) {
        $this->DiaNascimento = Dia_Data($Data);
        $this->MesNascimento = Mes_Data($Data);
        $this->AnoNascimento = Ano_Data($Data);
    }
    
    function SetCPF($CPF) {
        $this->CPF = $CPF;
    }
    
    function SetRG($RG) {
        $this->RG = $RG;
    }
    
    function SetEndereco($Rua,$Numero) {
        $this->Endereco = $Rua;
        $this->Numero = $Numero;
    }
    
    function SetComplemento($Complemento) {
        $this->Complemento = $Complemento;
    }
    
    function SetBairro($Bairro) {
        $this->Bairro = $Bairro;
    }
    
    function SetCidade($Cidade) {
        $this->Cidade = $Cidade;
    }
    
    function SetEstado($Estado) {
        $this->Estado = $Estado;
    }
    
    function SetCEP($CEP) {
        $this->CEP = $CEP;
    }
    
    function SetTelefone($Telefone) {
        $this->Telefone = $Telefone;
    }
    
    function SetCelular($Celular) {
        $this->Celular = $Celular;
    }
    
    function SetEmpresa($Empresa) {
        $this->Empresa = $Empresa;
    }
    
    function SetUsuario($Usuario) {
        $this->Usuario = $Usuario;
    }
    
    function SetSenha($Senha) {
        $this->Senha = $Senha;
    }
    
    function SetEmail($Email) {
        $this->Email = $Email;
    }

    function GetNome() {
        return $this->Nome;
    }
    
    function GetDataNascimento() {
        return $this->DiaNascimento."/".$this->MesNascimento."/".$this->AnoNascimento;
    }

    function GetDiaNascimento() {
        return $this->DiaNascimento;
    }

    function GetMesNascimento() {
        return $this->MesNascimento;
    }

    function GetAnoNascimento() {
        return $this->AnoNascimento;
    }
    
    function GetCPF() {
        return $this->CPF;
    }
    
    function GetRG() {
        return $this->RG;
    }
    
    function GetEndereco() {
        return $this->Endereco;
    }
    
    function GetNumero() {
        return $this->Numero;
    }
    
    function GetComplemento() {
        return $this->Complemento;
    }
    
    function GetBairro() {
        return $this->Bairro;
    }
    
    function GetCidade() {
        return $this->Cidade;
    }
    
    function GetEstado() {
        return $this->Estado;
    }
    
    function GetCEP() {
        return $this->CEP;
    }
    
    function GetTelefone() {
        return $this->Telefone;
    }
    
    function GetCelular() {
        return $this->Celular;
    }
    
    function GetEmpresa() {
        return $this->Empresa;
    }
    
    function GetUsuario() {
        return $this->Usuario;
    }
    
    function GetSenha() {
        return $this->Senha;
    }
    
    function GetEmail() {
        return $this->Email;
    }
}