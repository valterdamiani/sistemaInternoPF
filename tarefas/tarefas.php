  <!-- tela de tarefas -->
  <?php header("Cache-Control: no-cache, must-revalidate"); 
    
    include 'connections.php';
    include 'sessionFranqueado.php';
  
    $usuario= $_SESSION['colaborador'];

    // consulta nas tabelas LEADS e SOLICITACOESLEAD

    $pesq = $pdo->prepare("
        SET time_zone='America/Sao_Paulo'");
    $pesq->execute();

    $tasks = $pdo->prepare("
        SELECT `id`, `titulo`, `tarefa`, `status`, `criador`, `responsavel`, `dataInicio`, `dataPausa`, `dataFim` 
        FROM `tarefasInternas` 
        WHERE id >= 1
        ORDER BY id ASC
        ");
        
        $tasks->execute();
        $taskLine = $tasks->fetchAll();
?>
  <!DOCTYPE html>
  <html lang='en'>
    <head>
      <meta charset='UTF-8' />
      <meta name='viewport' content='width=device-width, initial-scale=1.0' />
      <meta http-equiv='X-UA-Compatible' content='ie=edge' />
      <link rel='stylesheet' type='text/css' href='reset.css' media='screen' />
      <title>Quadro de Tarefas</title>
      <?php require_once "head.php";?>
      <script>
        function start(id){
          var startBtn = document.getElementById(id);
          startBtn.style.display = 'none';
          var devTag = document.getElementById(id + 'b');
          devTag.style.display = 'block'
        }


        function newTask(){
          document.getElementById('modal').style.display = 'block';
          document.getElementById('addBtn').style.display = 'none';
          document.getElementById('closeBtn').style.display = 'block';
          document.getElementById('newTaskTitle').value = '';
          document.getElementById('cardTxt1').value = '';
        }
        function closeNewTask(){
          document.getElementById('modal').style.display = 'none';
          document.getElementById('addBtn').style.display = 'block';
          document.getElementById('closeBtn').style.display = 'none';
        }
      </script>  
      <style>
        @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');
        body {
            background-color: rgba(141, 196, 79, 0.4);
            font-family: 'Open Sans', serif;
        }
        
        .inline {
            display: flex;
        }
        .taskTitle{
            /* background-color: rgb(141, 196,79); */
            /* background-color: rgb(1, 137, 203); */
            font-size: 45px;
            border: 0 none;
            height: 80px;
        }

        .card {
            width: 220px;
            height: 250px;
            margin: 15px 15px 15px 15px;
            border-radius: 13px;
            border: 2px solid rgb(141, 196,79);
            padding: 0%;
        }
        
        .cardTitle{
            border: 0 none;
            width: 100%;
            height: 20%;
            font-size: 22px;
            text-align: center;
            background-color: rgb(141, 196, 79);
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            box-shadow: none;
            outline: none;
        }

        .cardTaskTxtDiv{
            width: 100%;
            background-color: rgba(1, 137, 203, 0.2);
            height: 64%;
            border: none;
            padding: 1%;
            /* height: 155px; */
            /* border-bottom-left-radius: 13px;
            border-bottom-right-radius: 13px; */
        }
        
        .cardTaskTxt{
            width: 100%;
            border: 0 none;
            padding: 2%;
            /* margin-left: 1%; */
            height: 96%;
            background-color: transparent;
            /* overflow: auto; */
            outline: none;
            -webkit-box-shadow: none;
            -moz-box-shadow: none;
            box-shadow: none;
            resize: none; /*remove the resize handle on the bottom right*/
            overflow-wrap: break-word;
        }

        .changeBox{
          width: 100%;
          height: 100%;
          background-color: rgb(141, 196, 79);
          border-bottom-left-radius: 10px;
          border-bottom-right-radius: 10px;
          text-align: center;
          border: 0 none;
          padding: 0%;    
        }
        
        .startBtn{
          margin-top: 3%;
          margin-bottom: 3px;
          width: 60%;
          /* height: 75%; */
          border: 2px solid rgba(1, 137, 203);
          background-color: transparent;
          box-shadow: none;
          border-radius: 10px;
          outline: none;
          font-size: 25px;
          color: rgb(1, 137, 203);
        }
        
        .devImg{
          width: 38px;
          height: 38px;
          border-radius: 19px;
          margin-top: 1px;
        }
        
        .devSelect{
          width: 75%;
          height: 40px;      
          display: inline-block;
          vertical-align: top;
          border-bottom-left-radius: 13px;
          margin-right: 5px;
          padding: 1%;
          background-color: transparent;
          border: none;
          outline: none;
        }

        .taskAddBtn{
          width: 50px;
          height: 50px;
          background-color: rgba(1, 137, 203);
          border-radius: 25px;
          font-size: 30px;
          color: white;
          border: none;
          position: fixed;
          bottom: 25px;
          right: 25px;
          outline: none;
        }
        .taskAddBtn:hover{
          background-color: rgb(141, 196, 79);
        }
        .taskModal{
          position: fixed;
          z-index:1;
          top: 35%;
          right: 40%;
          width: 20%;
          height: 320px;
          border-radius: 13px;
          /* border: 2px solid rgb(141, 196,79); */
          padding: 0%;
          /* margin: 1% 1% 1% 1%; */
          /* border: 2px solid rgba(1, 137, 203); */
        }
        .newTaskCardTxtDiv{
          width: 100%;
          background-color: rgba(1, 137, 203, 0.2);
          height: 64%;
          border: none;
        }
        .newTaskTxt{
          width: 100%;
          border: 0 none;
          padding: 1%;
          height: 100%;
          font-size: 22px;
          background-color: rgb(162, 205, 226);
          overflow: auto;
          outline: none;
          -webkit-box-shadow: none;
          -moz-box-shadow: none;
          box-shadow: none;
          resize: none; /*remove the resize handle on the bottom right*/
          border-radius: 0px;
          /* margin-left: 1%; */
        }
        .newTaskchangeBox{
          width: 100%;
          height: 18%;
          background-color: rgb(141, 196, 79);
          border-bottom-left-radius: 13px;
          border-bottom-right-radius: 13px;
          text-align: center;
          border: 0 none;
          padding: 0%; 
        }
        .saveBtn{
          margin-top: 2%;
          width: 60%;
          height: 65%;
          border: 2px solid rgba(1, 137, 203);
          background-color: rgba(1, 137, 203);
          box-shadow: none;
          border-radius: 10px;
          outline: none;
          font-size: 25px;
          color: black;
          /* color: rgb(1, 137, 203); */
        }
        .saveBtn:hover{
          background-color: rgba(141, 196, 79);
        }
      </style>
    </head>
    <body>
    <?php require_once "navbar.php";?>
      <!-- <a class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a> -->
      <button id='addBtn' class="taskAddBtn" onclick="newTask()">+</button>
      <button id='closeBtn' class="taskAddBtn" onclick="closeNewTask()" style='display: none'>X</button>
      <!-- <div> -->
      <!-- New task modal start -->
      <form method=post enctype="multipart/form-data" action="cadastrando_tarefasInternas">
        <div id='modal' class='taskModal' style="display: none;">
          <Input id='newTaskTitle' class='cardTitle' placeholder='New Title' name="title">
          <div class='newTaskCardTxtDiv'>
            <textarea id='cardTxt1' class='newTaskTxt' name="task"></textarea>
          </div>
          <div id='changeBox1' class='newTaskchangeBox' onclick='insert(id)'>
            <button class='saveBtn' onclick="insert()">Salvar</button>
          </div>
        </div>
      </form>
      <!-- New task modal end -->

      <div class='taskTitle'>Tarefas</div>   
      <div id='linha1' class='inline' style='white-space: nowrap; overflow: hidden;'>   
          <?php
            foreach($taskLine as $linha) { 
                $id= $linha["id"];
                $title = $linha["titulo"];
                $task = $linha["tarefa"];
                $status = $linha["status"];
                
                if($status == NULL){
                  echo"
                  <div id='cardBox'>
                    <div id='card".$id."' class='card'>
                      <Input id='cardTitle".$id."' class='cardTitle' placeholder='New Title' value=".$id."-".$title.">
                      <div class='cardTaskTxtDiv'>
                      <textarea id='cardTxt".$id."' class='cardTaskTxt' value=". $task .">". $task ."</textarea>
                      </div>
                      <form method=post enctype='multipart/form-data' action='cadastrando_updateTarefasInternas'>
                        <input type='hidden' name='id' id='$id' value='$id' style='white-space: pre-wrap;'>
                        <div id='changeBox".$id."' class='changeBox' onclick='start(id)'>
                          <button class='startBtn'>Iniciar</button>
                        </div>
                      </form>
                    </div>
                  </div>
                  ";
                }
            }
          ?>
      </div>
      <div id='linha2' class='inline' style='white-space: nowrap; overflow: hidden;'>
        <?php
          foreach($taskLine as $linha) {
              $id= $linha["id"];
              $title = $linha["titulo"];
              $task = $linha["tarefa"];
              $status = $linha["status"];
              $responsavel = $linha["responsavel"];

              if($status == 'Em Andamento'){
              echo"
                <div id='cardBox'>    
                    <div id='card".$id."' class='card'>
                      <Input id='cardTitle".$id."' class='cardTitle' placeholder='New Title' value=". $id . "-" . $title .">
                      <div class='cardTaskTxtDiv'>
                        <textarea id='cardTxt".$id."' class='cardTaskTxt' value=". $task .">". $task ."</textarea>
                      </div>
                      <form method=post enctype='multipart/form-data' action='cadastrando_updateTarefasInternas'>
                        <div id='changeBox".$id."b' class='changeBox'>
                          <input type='hidden' name='id' id='$id' value='$id'>
                          <select name='status' id='status".$id."' class='devSelect' onchange='this.form.submit()'>
                            <option value='Fazendo'>Fazendo</option>
                            <option value='Pausado'>Pausado</option>
                            <option value='Finalizado'>Finalizado</option>
                          </select>
                          <img class='devImg' src='../arquivos/colaboradores/".$responsavel."numero1.jpg'>
                        </div>
                      </form>
                    </div>
                </div>
              ";
            }
          }
        ?>
      </div>
      <div id='linha3' class='inline' style='white-space: nowrap; overflow: hidden;'>
        <?php
          foreach($taskLine as $linha) {
              $id= $linha["id"];
              $title = $linha["titulo"];
              $task = $linha["tarefa"];
              $status = $linha["status"];
              $responsavel = $linha["responsavel"];

              if($status == 'Pausado'){
              
              echo"
                <div id='cardBox'>    
                    <div id='card".$id."' class='card'>
                      <Input id='cardTitle".$id."' class='cardTitle' placeholder='New Title' value=". $id . "-" . $title .">
                      <div class='cardTaskTxtDiv'>
                        <textarea id='cardTxt".$id."' class='cardTaskTxt' value=". $task .">". $task ."</textarea>
                      </div>
                      <form method=post enctype='multipart/form-data' action='cadastrando_updateTarefasInternas'>
                        <div id='changeBox".$id."b' class='changeBox'>
                          <input type='hidden' name='id' id='$id' value='$id'>
                          <select name='status' id='status".$id."' class='devSelect' onchange='this.form.submit()'>
                            <option value='Pausado'>Pausado</option>
                            <option value='Fazendo'>Fazendo</option>
                            <option value='Finalizado'>Finalizado</option>
                          </select>
                          <img class='devImg' src='../arquivos/colaboradores/".$responsavel."numero1.jpg'>
                        </div>
                      </form>
                    </div>
                </div>
              ";
            }
          }
        ?>
      </div>
  <?php require_once "footer.php";?>
    </body>
  </html>
