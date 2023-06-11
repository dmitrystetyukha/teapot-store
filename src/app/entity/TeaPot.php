<?php
namespace app\entity;

use app\utils\UUID;

class TeaPot
{
    private string $id;
    private string $fullName;
    private string $description;
    private float $cost;
    private int $stockBalance;

    public function __construct(?string $id, string $fullName, string $description, float $cost, int $stockBalance)
    {
        $this->id           = (is_null($id)) ? md5($fullName) : $id;
        $this->fullName     = $fullName;
        $this->description  = $description;
        $this->cost         = $cost;
        $this->stockBalance = $stockBalance;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @return float
     */
    public function getCost(): float
    {
        return $this->cost;
    }

    /**
     * @return int
     */
    public function getStockBalance(): int
    {
        return $this->stockBalance;
    }

    /**
     * @return 
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}