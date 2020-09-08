<!DOCTYPE html>
<html lang="pt-br">

<?php 
  session_start();
  include('includes/head.php');
?>

<body>
  <div class="mt-4 mb-4" style="text-align: center;">
    <h2 class="display-4 mb-5" style="font-size: 45px;">Cadastrar Professor</h2>
  </div>
  <div class="container" style="max-width: 450px; background-color: rgba(0,0,0,.05); border-radius: 15px; padding: 30px; margin-bottom: 50px; box-shadow: 0px 0px 30px 0px rgba(150,150,150,0.7);">
    <form action="cadastrar_professor.php" method="post">

      <div class="form-group">
        <label for="fname">Nome do Professor: </label>
        <input type="text" class="form-control" name="nome" id="nome" value="" placeholder="Digite o nome..." required>
      </div>

      <div class="form-group">
        <label for="fname">R.G: </label><br>
        <input class="form-control" type="text" name="rg" value="" placeholder = "Digite o R.G..." required>
        <small class='form-text text-muted text-center'>Digite apenas números!</small>
      </div>

      <div class="form-group">
        <label for="fname">Data de Nascimento: </label>
        <input class="form-control" type="text" name="data_nascimento" id="digito" value="" size="8" minlength="8" 
          maxlength="8" placeholder="Digite a data de nascimento..." required>
        <small class='form-text text-muted text-center'>Digite apenas números!</small>
      </div>

      <div class="form-group">
        <label for="fname">Série: </label>
        <select class="custom-select" name ='ano'>
          <option value='-'>-</option>
          <option value='EJA 1 - T1'>EJA 1 - T1</option>
          <option value='EJA 1 - T2'>EJA 1 - T2</option>
          <option value='EJA 1 - T3'>EJA 1 - T3</option>
          <option value='EJA 1 - T4'>EJA 1 - T4</option>
          <option value='EJA 2 - T1'>EJA 2 - T1</option>
          <option value='EJA 2 - T2'>EJA 2 - T2</option>
          <option value='EJA 2 - T3'>EJA 2 - T3</option>
          <option value='EJA 2 - T4'>EJA 2 - T4</option>
          
          <option value='Fase 1'>Fase 1</option>
          <option value='Fase 2'>Fase 2</option>
          <option value='Berçário 1'>Berçário 1</option>
          <option value='Berçário 2'>Berçário 2</option>
          <option value='Maternal 1'>Maternal 1</option>
          <option value='Maternal 2'>Maternal 2</option>
          <option value='1'>1</option>
          <option value='2'>2</option>
          <option value='3'>3</option>
          <option value='4'>4</option>
          <option value='5'>5</option>
          <option value='6'>6</option>
          <option value='7'>7</option>
          <option value='8'>8</option>
          <option value='9'>9</option>
        </select>
      </div>

      <div class="form-group">
        <label for="fname">Turma</label><br>
        <select class="custom-select" name='turma'>
          <option value='-'>-</option>
          <option value="A">A</option>
          <option value="B">B</option>
          <option value="C">C</option>
          <option value="D">D</option>
          <option value="E">E</option>
          <option value="F">F</option>
          <option value="G">G</option>
          <option value="H">H</option>
        </select>
      </div>

      <div class="form-group">
        <label for="fname">Período</label>
        <select class="custom-select" name='periodo'>
          <option value='Manhã'>Manhã</option>
          <option value='Tarde'>Tarde</option>
          <option value='Noite'>Noite</option>
            <option value='Integral'>Integral</option>
        </select>
      </div>

      <div class="form-group">

        <label for="fname">Disciplina</label><br>
        <select class="custom-select" name='disciplina'>
          <option value='ADM'>ADM</option>
          <option value='Arte'>Arte</option>
           <option value='Portugues'>Portugues</option>
          <option value='Ciencias'>Ciências</option>
          <option value='Matematica'>Matemática</option>
          <option value='Ed. Fisica'>Ed. Fisica</option>
          <option value='Empreendedorismo'>Empreendedorismo</option>
          <option value='FUND I'>Fund I</option>
          <option value='Geografia'>Geografia</option>
          <option value='Historia'>Historia</option>
          <option value='Infantil'>Infantil</option>
          <option value='Ingles'>Ingles</option>
          <option value='PROFESSOR ADJUNTO I'>PROFESSOR ADJUNTO I</option>
          <option value='PROFESSOR ADJUNTO II'>PROFESSOR ADJUNTO II</option>
          <option value='SEDUC'>SEDUC</option>
        </select>
      </div>

      <!-- <input type="submit" value="Enviar"> -->
      <div class="mt-4 mb-4" style="text-align: center;">
        <button type="submit" class="btn btn-outline-primary">Enviar</button>
      </div>
    </form>
  </div>

</body>
</html>