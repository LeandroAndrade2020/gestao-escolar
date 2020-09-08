<!DOCTYPE html>
<html lang="pt-br">
  <?php 
    session_start();
    include('includes/head.php');
  ?>

  <body>
    <div class="container" style="max-width: 500px;">
      <div class="mt-4 mb-4" style="text-align: center;">
        <h2 class="display-4">Busca por Turma</h2>
      </div>

      <div class="modal fade" data-backdrop="static" data-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" id="modalAviso" role="dialog">
          <div class="modal-dialog" style="background-color: rgb(255,255,255,0.5); border-radius: 25px; top: 50%; transform: translateY(-50%);">
              <div class="modal-content" style="position: relative; border: none;">
                  <br><br>
                  <div style="position: relative; width: 100%; text-align: center; padding: none;">
                      <img src="images/loading.gif" style="width: 30%;">
                      <p style="color: black; font-size: 20px">Carregando, aguarde...</p> <br>
                  </div>
              </div>
          </div>
      </div>

      <div style="background-color: rgba(0,0,0,.05); border-radius: 15px; padding: 20px; box-shadow: 0px 0px 30px 0px rgba(150,150,150,0.7);">
        <form action="view_conteudo2.php" method="post">
          <div class="form-group">
            <label>Série: </label><br>
            <select class="custom-select custom-select-sm" name="serie" id="serie">
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
            <label>Turma: </label><br>
            <select class="custom-select custom-select-sm" name="turma" id="turma">
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
          <div class="text-center">
            <button id="btnModalAviso" type="submit" class="btn btn-outline-primary" data-toggle="modal">Enviar</button>
          </div>
        </form>
      </div>
    </div>

    <script>
      // ATIVA MODAL
      $('#btnModalAviso').click(function(e) {
        let serie = $('#serie').val();
        let turma = $('#turma').val();

        let campos = [
            serie,
            turma
        ]

        var camposVazios = 0;
        campos.forEach(function(item){
            console.log(item);
            item == '' ? camposVazios++ : '';
        })

        camposVazios == 0  ? $('#modalAviso').modal('show') : $('#modalAviso').modal('hide');
      })
      
    </script>
  </body>
</html>