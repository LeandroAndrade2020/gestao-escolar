<!DOCTYPE html>
<html lang="pt-br">

<?php 
include('includes/head.php');
?>

<body>
  <div class="container" style="max-width: 500px;">
    <div class="mt-4 mb-4" style="text-align: center;">
      <h2>Busca por Turma</h2>
    </div>
    <form action="gestaoview_conteudo2.php">

      <div class="form-group">
        <label>Série</label><br>
        <select name="serie">

            <option value="Especial 1">Especial 1</option>
            <option value="EJA 1">EJA 1</option>
            <option value="EJA 2">EJA 2</option>
            <option value="Fase 1">Fase 1</option>
            <option value="Fase 2">Fase 2</option>
            <option value="Berçário 1">Berçário 1</option>
            <option value="Berçário 2">Berçário 2</option>
            <option value="Maternal 1">Maternal 1</option>
            <option value="Maternal 2">Maternal 2</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
        </select>
      </div>

      <div class="form-group">
        <label>Turma</label><br>
        <select name="turma">
          <option value="A">A</option>
          <option value="B">B</option>
          <option value="C">C</option>
          <option value="D">D</option>
          <option value="E">E</option>
          <option value="F">F</option>
          <option value="G">G</option>
          <option value="H">H</option>
        <option value="I">I</option>
        <option value="J">J</option>
        <option value="K">K</option>
        <option value="L">L</option>
        <option value="M">M</option>
        <option value="N">N</option>
        </select>
      </div>

      <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
  </div>

</body>

</html>