<?php
// =========================================================
// VARIÁVEL QUE GUARDA QUAL EXERCÍCIO ESTÁ SELECIONADO
// Se nenhum foi enviado pelo formulário, começa no exercício 1
// =========================================================
$ex = $_POST['exercicio'] ?? '1';

// Variável que vai guardar o texto do resultado para exibir na tela
$resultado = '';


// =========================================================
// EXERCÍCIO 1 — TABUADA
// Verifica se o exercício 1 está ativo E se o campo 'n' foi enviado
// =========================================================
if ($ex == '1' && isset($_POST['n'])) {
    $n = intval($_POST['n']); // Converte o valor recebido para número inteiro

    $resultado = "<b>Tabuada do $n:</b><br><br>";

    // Loop de 1 a 10 para montar cada linha da tabuada
    for ($i = 1; $i <= 10; $i++)
        $resultado .= "$n × $i = <b>" . ($n * $i) . "</b><br>";
}


// =========================================================
// EXERCÍCIO 2 — DESCONTO
// Recebe o preço e a porcentagem de desconto
// =========================================================
if ($ex == '2' && isset($_POST['preco'])) {
    $p = floatval($_POST['preco']); // Preço original
    $d = floatval($_POST['desc']);  // Porcentagem de desconto

    // Calcula o preço final: subtrai a porcentagem do preço original
    $final = $p - ($p * $d / 100);

    $resultado = "Preço final: <b>R$ " . number_format($final, 2, ',', '.') . "</b>";
}


// =========================================================
// EXERCÍCIO 3 — APROVAÇÃO (4 notas bimestrais)
// Soma as 4 notas, divide por 4 e verifica se a média é >= 5
// =========================================================
if ($ex == '3' && isset($_POST['n1'])) {
    // Soma as 4 notas e divide por 4 para obter a média
    $media = (floatval($_POST['n1']) + floatval($_POST['n2']) + floatval($_POST['n3']) + floatval($_POST['n4'])) / 4;

    // Operador ternário: se média >= 5, Aprovado; senão, Reprovado
    $sit = $media >= 5 ? '✅ Aprovado' : '❌ Reprovado';

    $resultado = "Média: <b>" . number_format($media, 2, ',', '.') . "</b> → $sit";
}


// =========================================================
// EXERCÍCIO 5 — SOMA DOS QUADRADOS
// Eleva cada número ao quadrado e soma os três resultados
// =========================================================
if ($ex == '5' && isset($_POST['a'])) {
    $a = floatval($_POST['a']);
    $b = floatval($_POST['b']);
    $c = floatval($_POST['c']);

    // O operador ** é a exponenciação (potência) em PHP
    $resultado = "{$a}² + {$b}² + {$c}² = <b>" . ($a**2 + $b**2 + $c**2) . "</b>";
}


// =========================================================
// EXERCÍCIO 6 — SALÁRIO LÍQUIDO
// Aplica 10% de gratificação e depois desconta 20% de IR
// =========================================================
if ($ex == '6' && isset($_POST['sal'])) {
    $b = floatval($_POST['sal']); // Salário bruto

    // Passo 1: adiciona 10% de gratificação (multiplica por 1.10)
    // Passo 2: desconta 20% de IR (multiplica por 0.80)
    $liq = ($b * 1.10) * 0.80;

    $resultado = "Salário líquido: <b>R$ " . number_format($liq, 2, ',', '.') . "</b>";
}


// =========================================================
// EXERCÍCIO 7 — NOTAS E SITUAÇÃO
// Média >= 6: Aprovado | >= 3 e < 6: Exame | < 3: Retido
// =========================================================
if ($ex == '7' && isset($_POST['m1'])) {
    $media = (floatval($_POST['m1']) + floatval($_POST['m2']) + floatval($_POST['m3']) + floatval($_POST['m4'])) / 4;

    // Sequência de if/elseif para determinar a situação
    if ($media >= 6)     $sit = '✅ Aprovado';
    elseif ($media < 3)  $sit = '❌ Retido';
    else                 $sit = '⚠️ Exame';

    $resultado = "Média: <b>" . number_format($media, 2, ',', '.') . "</b> → $sit";
}


// =========================================================
// EXERCÍCIO 8 — MAIOR E MENOR
// Usa as funções nativas max() e min() do PHP
// =========================================================
if ($ex == '8' && isset($_POST['x'])) {
    // Agrupa os 3 valores em um array para facilitar
    $nums = [floatval($_POST['x']), floatval($_POST['y']), floatval($_POST['z'])];

    $resultado = "Maior: <b>" . max($nums) . "</b> &nbsp;|&nbsp; Menor: <b>" . min($nums) . "</b>";
}


// =========================================================
// EXERCÍCIO 9 — SOMA DOS ÍMPARES NO INTERVALO
// Percorre todos os números entre início e fim,
// somando apenas os que não são divisíveis por 2
// =========================================================
if ($ex == '9' && isset($_POST['ini'])) {
    $ini = intval($_POST['ini']);
    $fim = intval($_POST['fim']);

    $soma = 0;

    // min/max garante que o loop funciona mesmo se o usuário
    // digitar o valor maior no campo "inicial"
    for ($i = min($ini, $fim); $i <= max($ini, $fim); $i++) {
        if ($i % 2 != 0) // % é o operador módulo (resto da divisão)
            $soma += $i;
    }

    $resultado = "Soma dos ímpares: <b>$soma</b>";
}


// =========================================================
// EXERCÍCIO 10 — PAR OU ÍMPAR
// Usa o operador módulo (%) — se o resto da divisão por 2 for 0, é par
// =========================================================
if ($ex == '10' && isset($_POST['num'])) {
    $n = intval($_POST['num']);

    $tipo = $n % 2 == 0 ? '🟢 Par' : '🔵 Ímpar';

    $resultado = "<b>$n</b> é $tipo";
}


// =========================================================
// EXERCÍCIO 11 — CALCULADORA
// Recebe dois valores e um operador, e executa a operação
// =========================================================
if ($ex == '11' && isset($_POST['a2'])) {
    $a  = floatval($_POST['a2']); // Primeiro valor
    $b  = floatval($_POST['b2']); // Segundo valor
    $op = $_POST['op'];           // Operador (+, -, *, /)

    // Executa a operação de acordo com o operador escolhido
    if      ($op == '+') $r = $a + $b;
    elseif  ($op == '-') $r = $a - $b;
    elseif  ($op == '*') $r = $a * $b;
    elseif  ($op == '/') $r = $b != 0 ? $a / $b : null; // Evita divisão por zero

    // Tratamento especial para divisão por zero
    if ($op == '/' && $b == 0)
        $resultado = "⚠️ Divisão por zero não é permitida.";
    else
        $resultado = "$a $op $b = <b>" . number_format($r, 2, ',', '.') . "</b>";
}


// =========================================================
// ARRAY COM OS NOMES DOS EXERCÍCIOS
// Usado para montar o <select> do formulário
// =========================================================
$exercicios = [
    '1'  => 'Tabuada',
    '2'  => 'Desconto',
    '3'  => 'Aprovação',
    '5'  => 'Soma dos Quadrados',
    '6'  => 'Salário Líquido',
    '7'  => 'Notas e Situação',
    '8'  => 'Maior e Menor',
    '9'  => 'Soma dos Ímpares',
    '10' => 'Par ou Ímpar',
    '11' => 'Calculadora'
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Exercícios PHP</title>

<!-- Fonte do Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

<style>
  /* Reset básico para remover margin e padding padrão do navegador */
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  /* Corpo da página: fundo cinza claro, conteúdo centralizado verticalmente */
  body {
    font-family: 'Inter', sans-serif;
    background: #f5f5f5;
    min-height: 100vh;
    display: flex;
    align-items: flex-start;
    justify-content: center;
    padding: 40px 16px;
  }

  /* Card branco centralizado com sombra suave */
  .card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.08);
    width: 100%;
    max-width: 440px;
    overflow: hidden;
  }

  /* Cabeçalho roxo do card */
  .card-header {
    background: #4f46e5;
    color: #fff;
    padding: 24px 28px;
  }
  .card-header h1 { font-size: 1.1rem; font-weight: 600; }
  .card-header p  { font-size: .8rem; opacity: .75; margin-top: 3px; }

  /* Área do formulário e resultado */
  .card-body { padding: 24px 28px; }

  /* Estilo dos rótulos dos campos */
  label {
    display: block;
    font-size: .78rem;
    font-weight: 500;
    color: #555;
    margin-bottom: 5px;
    margin-top: 14px;
    text-transform: uppercase;
    letter-spacing: .4px;
  }
  label:first-child { margin-top: 0; } /* Remove margem do primeiro label */

  /* Estilo dos campos de texto e select */
  select, input[type="number"] {
    width: 100%;
    padding: 9px 12px;
    font-size: .95rem;
    font-family: inherit;
    border: 1.5px solid #ddd;
    border-radius: 8px;
    outline: none;
    transition: border-color .2s; /* Animação suave ao focar */
    background: #fafafa;
    color: #222;
  }

  /* Destaca a borda do campo quando está em foco */
  select:focus, input[type="number"]:focus {
    border-color: #4f46e5;
    background: #fff;
  }

  /* Linha divisória entre o select de exercício e os campos */
  .divider {
    border: none;
    border-top: 1.5px solid #eee;
    margin: 20px 0;
  }

  /* Botão de envio do formulário */
  button {
    width: 100%;
    margin-top: 18px;
    padding: 11px;
    background: #4f46e5;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: .95rem;
    font-weight: 600;
    font-family: inherit;
    cursor: pointer;
    transition: background .2s;
  }
  button:hover { background: #4338ca; } /* Cor mais escura ao passar o mouse */

  /* Caixa de resultado com borda roxa à esquerda */
  .resultado {
    margin-top: 18px;
    padding: 14px 16px;
    background: #f0f0ff;
    border-left: 4px solid #4f46e5;
    border-radius: 8px;
    font-size: .95rem;
    line-height: 1.7;
    color: #222;
  }
</style>
</head>
<body>

<div class="card">

  <!-- Cabeçalho do card -->
  <div class="card-header">
    <h1>Exercícios PHP</h1>
    <p>Aulas 4 a 10</p>
  </div>

  <div class="card-body">

    <!-- Formulário: envia os dados para a mesma página (método POST) -->
    <form method="POST">

      <!-- SELECT para escolher o exercício -->
      <!-- onchange="this.form.submit()" faz a página recarregar automaticamente ao trocar -->
      <label>Exercício</label>
      <select name="exercicio" onchange="this.form.submit()">
        <?php foreach ($exercicios as $num => $nome): ?>
          <!-- O atributo "selected" marca a opção que está ativa -->
          <option value="<?= $num ?>" <?= $ex == $num ? 'selected' : '' ?>>
            <?= "$num — $nome" ?>
          </option>
        <?php endforeach; ?>
      </select>

      <!-- Linha divisória visual -->
      <hr class="divider">


      <!-- =====================================================
           CAMPOS DINÂMICOS: cada exercício exibe seus próprios campos
           usando if/elseif no PHP dentro do HTML
           ===================================================== -->

      <?php if ($ex == '1'): ?>
        <label>Número</label>
        <input type="number" name="n" placeholder="Ex: 7" value="<?= $_POST['n'] ?? '' ?>">

      <?php elseif ($ex == '2'): ?>
        <label>Preço (R$)</label>
        <input type="number" step="0.01" name="preco" placeholder="Ex: 250.00" value="<?= $_POST['preco'] ?? '' ?>">
        <label>Desconto (%)</label>
        <input type="number" step="0.1" name="desc" placeholder="Ex: 15" value="<?= $_POST['desc'] ?? '' ?>">

      <?php elseif ($ex == '3'): ?>
        <!-- Loop para gerar os 4 campos de nota -->
        <?php foreach ([1,2,3,4] as $i): ?>
          <label>Nota <?= $i ?>º bimestre</label>
          <input type="number" step="0.1" min="1" max="10" name="n<?= $i ?>" placeholder="1 a 10" value="<?= $_POST["n$i"] ?? '' ?>">
        <?php endforeach; ?>

      <?php elseif ($ex == '5'): ?>
        <!-- Loop para gerar os 3 campos de número -->
        <?php foreach (['a'=>'A','b'=>'B','c'=>'C'] as $k=>$l): ?>
          <label>Número <?= $l ?></label>
          <input type="number" step="any" name="<?= $k ?>" placeholder="Ex: 3" value="<?= $_POST[$k] ?? '' ?>">
        <?php endforeach; ?>

      <?php elseif ($ex == '6'): ?>
        <label>Salário bruto (R$)</label>
        <input type="number" step="0.01" name="sal" placeholder="Ex: 3000.00" value="<?= $_POST['sal'] ?? '' ?>">

      <?php elseif ($ex == '7'): ?>
        <?php foreach ([1,2,3,4] as $i): ?>
          <label>Nota <?= $i ?></label>
          <input type="number" step="0.1" min="0" max="10" name="m<?= $i ?>" placeholder="0 a 10" value="<?= $_POST["m$i"] ?? '' ?>">
        <?php endforeach; ?>

      <?php elseif ($ex == '8'): ?>
        <?php foreach (['x'=>'1','y'=>'2','z'=>'3'] as $k=>$l): ?>
          <label>Número <?= $l ?></label>
          <input type="number" step="any" name="<?= $k ?>" placeholder="Ex: <?= $l * 10 ?>" value="<?= $_POST[$k] ?? '' ?>">
        <?php endforeach; ?>

      <?php elseif ($ex == '9'): ?>
        <label>Valor inicial</label>
        <input type="number" name="ini" placeholder="Ex: 1" value="<?= $_POST['ini'] ?? '' ?>">
        <label>Valor final</label>
        <input type="number" name="fim" placeholder="Ex: 20" value="<?= $_POST['fim'] ?? '' ?>">

      <?php elseif ($ex == '10'): ?>
        <label>Número</label>
        <input type="number" name="num" placeholder="Ex: 42" value="<?= $_POST['num'] ?? '' ?>">

      <?php elseif ($ex == '11'): ?>
        <label>Valor A</label>
        <input type="number" step="any" name="a2" placeholder="Ex: 10" value="<?= $_POST['a2'] ?? '' ?>">
        <label>Operador</label>
        <select name="op">
          <?php foreach (['+'=>'+ Soma', '-'=>'− Subtração', '*'=>'× Multiplicação', '/'=>'÷ Divisão'] as $o=>$l): ?>
            <!-- Mantém o operador selecionado após o envio do formulário -->
            <option value="<?= $o ?>" <?= ($_POST['op'] ?? '') == $o ? 'selected' : '' ?>><?= $l ?></option>
          <?php endforeach; ?>
        </select>
        <label>Valor B</label>
        <input type="number" step="any" name="b2" placeholder="Ex: 5" value="<?= $_POST['b2'] ?? '' ?>">
      <?php endif; ?>


      <!-- Botão que envia o formulário -->
      <button type="submit">Calcular</button>

    </form>

    <!-- Exibe o resultado somente se a variável $resultado não estiver vazia -->
    <?php if ($resultado): ?>
      <div class="resultado"><?= $resultado ?></div>
    <?php endif; ?>

  </div><!-- fim .card-body -->
</div><!-- fim .card -->

</body>
</html>
