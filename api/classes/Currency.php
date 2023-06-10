<?php 
class Currency {
    public string $code;
    public string $name;
    public float $mid;
    public function __construct(string $name, float $mid, string $code) {
        $this->name = $name;
        $this->mid = $mid;
        $this->code = $code;
    }
};