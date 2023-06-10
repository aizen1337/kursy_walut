<?php
require 'api/classes/Exchange.php';
require 'api/classes/Currency.php';
session_start(); 
?>
<!DOCTYPE html>
<html>
  <?php require_once 'partials/Head.php' ?>
  <body class="text-bg-dark">
        <?php 
        if(isset($_GET['error']) and $_GET['error'] == 'amount_empty') {
          ?>
          <div class="alert alert-danger mb-3" role="alert">
              Pole z kwotą nie może być puste
          </div>
        <?php
        }
        else if(isset($_GET['error']) and $_GET['error'] == 'currencies') {
        ?>
          <div class="alert alert-danger mb-3" role="alert">
            Waluty nie mogą być takie same
          </div>
        <?php
        }
        ?>
    <div class="container">
      <h1 class="display-4 text-center">Zadanie rekrutacyjne</h1>
        <?php require_once 'partials/Navbar.php' ?>
      <form method="POST" action='api/calculate-exchange.php'>
      <div class="input-group mb-3">
        <span class="input-group-text">Podaj kwotę do przewalutowania</span>
        <input type="number" class="form-control" name="amount" min=1 max=100000>
      </div>
      <button class="btn btn-info" type="submit">Sprawdź kurs</button>
      <?php
           if(isset($_SESSION['exchange'])) {
            $exchange_result = $_SESSION['exchange'];
            ?>
            <h1 class="text-center display-4">
              Za <?php 
              echo $exchange_result['amount'];
              echo " "; 
              echo $exchange_result['source']->code
              ;?> 
              możesz kupić 
              <?php 
              echo $exchange_result['result']; 
              echo " "; 
              echo $exchange_result['target']->code
              ;?>
            </h1>
              <?php
       } 
      ?>
      <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
      <table class="table table-dark">
        <thead>
          <tr>
            <th scope="col">Wybierz walutę źródłową</th>
            <th scope="col">Wybierz walutę docelową</th>
            <th scope="col">Waluta</th>
            <th scope="col">Aktualny kurs</th>
            <th scope="col">Kod</th>
          </tr>
        </thead>
        <tbody>
        <?php require 'api/get_currency_data.php';
        foreach($rates as $rate) {
          ?>
          <tr>
            <td scope="row"><input type="radio" name="source" value='<?php echo json_encode($rate)?>' class="form-check-input"></td>
            <td scope="row"><input type="radio" name="target" value='<?php echo json_encode($rate)?>' class="form-check-input"></td>
            <td><?php echo $rate['nazwa_waluty']?></td>
            <td><?php echo $rate['kurs']?></td>
            <td><?php echo $rate['kod']?></td>
          </tr>
          <?php
        };
      ?>
        </tbody>
      </table>
      </div>
      <div class="tab-pane fade" id="nav-history" role="tabpanel" aria-labelledby="nav-history-tab">
      <table class="table table-dark">
        <thead>
          <tr>
            <th scope="col">Kwota</th>
            <th scope="col">Waluta źródłowa</th>
            <th scope="col">Waluta docelowa</th>
            <th scope="col">Data</th>
          </tr>
        </thead>
        <tbody>
        <?php require 'api/get_exchanges_history.php';
        foreach($history as $record) {
          ?>
          <tr>
            <td><?php echo $record['kwota']?></td>
            <td><?php echo $record['waluta_zrodlowa']?></td>
            <td><?php echo $record['waluta_docelowa']?></td>
            <td><?php echo $record['data']?></td>
          </tr>
          <?php
        };
      ?>
        </tbody>
      </table>
      </div>
      </div>
      </form>
    </div>
  </body>
</html>