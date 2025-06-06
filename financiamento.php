<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8" />
  <title>Financiamento - SIT</title>
  <link rel="stylesheet" href="styles/style.css" />
</head>
<body>
  <header>
    <a href="index.html">
      <img src="imagens/logo.png" alt="Logo SIT" class="logo" />
    </a>
        <h1>Financiamento</h1>
    </header>

    <?php
   
    $valorCarro = $entrada = $meses = null;
    $erro = "";
    $resultado = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
        $valorCarro = filter_input(INPUT_POST, 'valorCarro', FILTER_VALIDATE_FLOAT);
        $entrada = filter_input(INPUT_POST, 'entrada', FILTER_VALIDATE_FLOAT);
        $meses = filter_input(INPUT_POST, 'meses', FILTER_VALIDATE_INT);

        if ($valorCarro === false || $valorCarro <= 0) {
            $erro = "Por favor, insira um valor válido para o valor do carro.";
        } elseif ($entrada === false || $entrada < 0) {
            $erro = "Por favor, insira um valor válido para a entrada.";
        } elseif ($entrada > $valorCarro) {
            $erro = "A entrada não pode ser maior que o valor do carro.";
        } elseif ($meses === false || $meses <= 0) {
            $erro = "Por favor, insira um número válido de meses (maior que zero).";
        }

        if (empty($erro)) {
           
            $valorFinanciado = $valorCarro - $entrada;
            $taxaAnual = 0.05;  
            $taxaMensal = $taxaAnual / 12;

            
            $prestacao = ($taxaMensal * $valorFinanciado) / (1 - pow(1 + $taxaMensal, -$meses));

            $resultado = "
                <div class='resultado'>
                    <p><strong>Valor financiado:</strong> €" . number_format($valorFinanciado, 2, ',', '.') . "</p>
                    <p><strong>Prestação mensal:</strong> €" . number_format($prestacao, 2, ',', '.') . "</p>
                    <p><strong>Total pago após {$meses} meses:</strong> €" . number_format($prestacao * $meses, 2, ',', '.') . "</p>
                </div>
            ";
        }
    }
    ?>

    <section class="simulador-section">
        <h2>Simulador de Financiamento</h2>
        <?php if ($erro): ?>
            <p class="erro"><?= htmlspecialchars($erro) ?></p>
        <?php endif; ?>

        <form method="post" action="">
            <label for="valorCarro">Valor do Carro (€):</label>
            <input type="number" step="0.01" name="valorCarro" id="valorCarro" required value="<?= htmlspecialchars($valorCarro ?? '') ?>" />

            <label for="entrada">Entrada (€):</label>
            <input type="number" step="0.01" name="entrada" id="entrada" required value="<?= htmlspecialchars($entrada ?? '') ?>" />

            <label for="meses">Número de Meses:</label>
            <input type="number" name="meses" id="meses" required value="<?= htmlspecialchars($meses ?? '') ?>" />

            <button type="submit">Calcular</button>
        </form>

        <?= $resultado ?>
    </section>
</body>
</html>
