<?php 
class Exchange {
    private int $amount;
    private Currency $source;
    private Currency $target;
    private float $result;
   function  __construct(int $amount, Currency $source, Currency $target) {
        $this->source = $source;
        $this->target = $target;
        $this->amount = $amount;
        $this->execute();
   }

   private function execute() {
     $multiplier = $this->source->mid / $this->target->mid;
     $this->result = round($this->amount * $multiplier, 2);
     $_SESSION['exchange'] = [
          'amount' => $this->amount,
          'source' => $this->source,
          'target' => $this->target,
          'result' => $this->result
     ];
   }
}