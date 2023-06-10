    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Tabela kursów walut</button>
          <button class="nav-link" id="nav-history-tab" data-bs-toggle="tab" data-bs-target="#nav-history" type="button" role="tab" aria-controls="nav-history" aria-selected="false">Historia przewalutowań</button>
          <form method="POST" action='api/update_currencies.php'>
            <button class="btn btn-outline-warning m-1" type="submit">Zaktualizuj kursy</button>
          </form>
        </div>
    </nav>