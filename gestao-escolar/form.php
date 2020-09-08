<?php
  include('includes/head.php');
  session_start();
?>

<!DOCTYPE html>
<html lang=pt-br>

<body>
  <div class="mt-4 mb-4" style="text-align: center;">
    <h2 class="display-4">Cadastrar aluno</h2>
  </div>
  <div class="container mb-3" style="max-width: 500px; background-color: rgba(0,0,0,.05); border-radius: 15px; padding: 20px; box-shadow: 0px 0px 30px 0px rgba(150,150,150,0.7);">
    <form action="cadastrar.php" method="post">
      <div class="form-group">
        <label for="fname">Nome do Aluno: </label>
        <input type="text" name="nome" id="nome" value="" required placeholder="Informe o nome do aluno...">
      </div>

      <div class="form-group">
        <label for="fname">R.A: </label>
        <input type="text" name="ra" id="ra" value="" required size="9" maxlength="9" minlength="8" placeholder="Informe o R.A do aluno...">
        <small class='form-text text-muted text-center'>Digite apenas números!</small>
        <small class='form-text text-muted text-center'>Não digite os Zeros iniciais</small>
      </div>

      <div class="form-group">
        <label for="fname">Dígito: </label>
        <input type="text" name="digito" id="digito" minlength="1" maxlength="1" size="1" value="">
        <small class='form-text text-muted text-center'>Digite apenas números!</small>
      </div>

      <div class="form-group">
        <label>Série: </label>
        <select class="custom-select" name="serie" required>
          <option value='EJA 1 - T1'>EJA 1 - T1</option>
          <option value='EJA 1 - T2'>EJA 1 - T2</option>
          <option value='EJA 1 - T3'>EJA 1 - T3</option>
          <option value='EJA 1 - T4'>EJA 1 - T4</option>
          <option value='EJA 2 - T1'>EJA 2 - T1</option>
          <option value='EJA 2 - T2'>EJA 2 - T2</option>
          <option value='EJA 2 - T3'>EJA 2 - T3</option>
          <option value='EJA 2 - T4'>EJA 2 - T4</option>

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
        <label>Turma: </label>
        <select class="custom-select" name="turma" required>
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
        <label>Período</label>
        <select class="custom-select" name='periodo' required>
          <option value='Manhã'>Manhã</option>
          <option value='Tarde'>Tarde</option>
          <option value='Noite'>Noite</option>
        </select>
      </div>

      <div class="form-group">
        <label>Número da Chamada: </label>
        <select class="custom-select" name='numero'>
          <option value='1'>1</option>
          <option value='2'>2</option>
          <option value='3'>3</option>
          <option value='4'>4</option>
          <option value='5'>5</option>
          <option value='6'>6</option>
          <option value='7'>7</option>
          <option value='8'>8</option>
          <option value='9'>9</option>
          <option value='10'>10</option>
          <option value='11'>11</option>
          <option value='12'>12</option>
          <option value='13'>13</option>
          <option value='14'>14</option>
          <option value='15'>15</option>
          <option value='16'>16</option>
          <option value='17'>17</option>
          <option value='18'>18</option>
          <option value='19'>19</option>
          <option value='20'>20</option>
          <option value='21'>21</option>
          <option value='22'>22</option>
          <option value='23'>23</option>
          <option value='24'>24</option>
          <option value='25'>25</option>
          <option value='26'>26</option>
          <option value='27'>27</option>
          <option value='28'>28</option>
          <option value='29'>29</option>
          <option value='30'>30</option>
          <option value='31'>31</option>
          <option value='32'>32</option>
          <option value='33'>33</option>
          <option value='34'>34</option>
          <option value='35'>35</option>
          <option value='36'>36</option>
          <option value='37'>37</option>
          <option value='38'>38</option>
          <option value='39'>39</option>
          <option value='40'>40</option>
          <option value='41'>41</option>
          <option value='42'>42</option>
          <option value='43'>43</option>
          <option value='44'>44</option>
          <option value='45'>45</option>
          <option value='46'>46</option>
          <option value='47'>47</option>
          <option value='48'>48</option>
          <option value='49'>49</option>
          <option value='50'>50</option>
        </select>
      </div>

      <div class="form-group">
        <label>Situação do aluno: </label>
        <select class="custom-select" name='situacao' required>
          <option value='Matriculado'>Matriculado</option>
          <option value='Transferido'>Transferido</option>
        </select>
      </div>

      <div class="form-group">
        <label for="fname">Data da Situação: </label>
        <input type="text" name="data_situacao" id="data_situacao" value="">
      </div>
      <div class="text-center">
        <button type="submit" class="btn btn-outline-primary">Enviar</button>
      </div>
    </form>
  </div>
</body>
</html>