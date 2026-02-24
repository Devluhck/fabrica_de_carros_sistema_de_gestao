<?php

require_once 'Carro.php';

class Fabrica
{
    private array $carros = [];

    public function getCarros(): array
    {
        return $this->carros;
    }

    public function setCarros(array $carros): void
    {
        $this->carros = $carros;
    }

    public function fabricarCarro(int $quantidade, array $dadosCarros = []): void
    {
        for ($i = 0; $i < $quantidade; $i++) {
            $modelo = $dadosCarros["modelo_{$i}"] ?? '';
            $cor = $dadosCarros["cor_{$i}"] ?? '';
            
            if (!empty($modelo) && !empty($cor)) {
                $carro = new Carro($modelo, $cor);
                
                // Atributos opcionais
                if (!empty($dadosCarros["ano_{$i}"])) {
                    $carro->setAno($dadosCarros["ano_{$i}"]);
                }
                if (!empty($dadosCarros["marca_{$i}"])) {
                    $carro->setMarca($dadosCarros["marca_{$i}"]);
                }
                if (!empty($dadosCarros["placa_{$i}"])) {
                    $carro->setPlaca($dadosCarros["placa_{$i}"]);
                }
                if (!empty($dadosCarros["preco_{$i}"])) {
                    $carro->setPreco((float)$dadosCarros["preco_{$i}"]);
                }
                
                $this->carros[] = $carro;
            }
        }
    }

    public function venderCarro(string $modelo, string $cor): bool
    {
        foreach ($this->carros as $index => $carro) {
            if ($carro->getModelo() === $modelo && $carro->getCor() === $cor) {
                unset($this->carros[$index]);
                $this->carros = array_values($this->carros); // Reindexa o array
                return true;
            }
        }
        return false;
    }

    public function listarCarros(): string
    {
        if (empty($this->carros)) {
            return "<h2>📋 Lista de Carros</h2><p>Nenhum carro fabricado ainda.</p>";
        }

        $info = "<h2>📋 Lista de Carros Fabricados</h2>";
        $info .= "<p><strong>Total de carros:</strong> " . count($this->carros) . "</p>";
        $info .= "<hr style='margin: 20px 0; border: none; border-top: 2px solid #e0e0e0;'>";

        foreach ($this->carros as $index => $carro) {
            $info .= "<div class='carro-card'>";
            $info .= "<h3>🚗 Carro #" . ($index + 1) . "</h3>";
            $info .= "<p><strong>Modelo:</strong> " . htmlspecialchars($carro->getModelo()) . "</p>";
            $info .= "<p><strong>Cor:</strong> " . htmlspecialchars($carro->getCor()) . "</p>";
            
            if ($carro->getMarca() !== null) {
                $info .= "<p><strong>Marca:</strong> " . htmlspecialchars($carro->getMarca()) . "</p>";
            }
            if ($carro->getAno() !== null) {
                $info .= "<p><strong>Ano:</strong> " . htmlspecialchars($carro->getAno()) . "</p>";
            }
            if ($carro->getPlaca() !== null) {
                $info .= "<p><strong>Placa:</strong> " . htmlspecialchars($carro->getPlaca()) . "</p>";
            }
            if ($carro->getPreco() !== null) {
                $info .= "<p><strong>Preço:</strong> R$ " . number_format($carro->getPreco(), 2, ',', '.') . "</p>";
            }
            
            $info .= "</div>";
        }

        return $info;
    }

    public function getModelosDisponiveis(): array
    {
        $modelos = [];
        foreach ($this->carros as $carro) {
            $modelo = $carro->getModelo();
            if (!in_array($modelo, $modelos)) {
                $modelos[] = $modelo;
            }
        }
        sort($modelos);
        return $modelos;
    }

    public function getCoresPorModelo(string $modelo): array
    {
        $cores = [];
        foreach ($this->carros as $carro) {
            if ($carro->getModelo() === $modelo) {
                $cor = $carro->getCor();
                if (!in_array($cor, $cores)) {
                    $cores[] = $cor;
                }
            }
        }
        sort($cores);
        return $cores;
    }
}

