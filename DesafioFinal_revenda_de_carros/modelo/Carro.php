<?php

class Carro
{
    private string $modelo;
    private string $cor;
    private ?string $ano = null;
    private ?string $marca = null;
    private ?string $placa = null;
    private ?float $preco = null;

    public function __construct(string $modelo, string $cor)
    {
        $this->modelo = $modelo;
        $this->cor = $cor;
    }

    public function getModelo(): string
    {
        return $this->modelo;
    }

    public function setModelo(string $modelo): void
    {
        $this->modelo = $modelo;
    }

    public function getCor(): string
    {
        return $this->cor;
    }

    public function setCor(string $cor): void
    {
        $this->cor = $cor;
    }

    public function getAno(): ?string
    {
        return $this->ano;
    }

    public function setAno(?string $ano): void
    {
        $this->ano = $ano;
    }

    public function getMarca(): ?string
    {
        return $this->marca;
    }

    public function setMarca(?string $marca): void
    {
        $this->marca = $marca;
    }

    public function getPlaca(): ?string
    {
        return $this->placa;
    }

    public function setPlaca(?string $placa): void
    {
        $this->placa = $placa;
    }

    public function getPreco(): ?float
    {
        return $this->preco;
    }

    public function setPreco(?float $preco): void
    {
        $this->preco = $preco;
    }
}

