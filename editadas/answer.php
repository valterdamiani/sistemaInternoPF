<?php
    include 'connections.php';
    include 'sessionAluno.php';

    $usuario = $_SESSION['colaborador'];
    
    if($_SESSION['contadorResposta']==0){
        $resposta = $_POST['resposta'];
        $idResposta = $_POST['idResposta'];
        $respostaCerta = $_POST['respostaCerta'];
        $exercicio = $_POST['exercicio'];
        $inicio = $_POST['inicio'];
        $imagemMap = $_POST['imagemMap'];
        
        $_SESSION['resposta'] = $resposta;
        $_SESSION['idResposta'] = $idResposta;
        $_SESSION['respostaCerta'] = $respostaCerta;
        $_SESSION['exercicio'] = $exercicio;
        $_SESSION['inicio'] = $inicio;
        $_SESSION['imagemMap'] = $imagemMap;
        
        $setTimeZone = $pdo->prepare("
            SET time_zone='America/Sao_Paulo'");
        $setTimeZone->execute();   
    }else{
        $resposta = $_SESSION['resposta'];
        $idResposta = $_SESSION['idResposta'];
        $respostaCerta = $_SESSION['respostaCerta'];
        $exercicio = $_SESSION['exercicio'];
        $inicio = $_SESSION['inicio'];
        $imagemMap = $_SESSION['imagemMap'];
    }
    
    $sql = $pdo->prepare("SELECT areaMap FROM exercicios WHERE item = :resposta and imagem= :imagem");
    $sql->bindValue(':imagem', $imagemMap);
    $sql->bindValue(':resposta', $respostaCerta);
    $sql->execute();
    $values2 = $sql->fetchAll();    
    $sql = $pdo->prepare("SELECT areaMap FROM exercicios WHERE id = :idResposta");
    $sql->bindValue(':idResposta', $idResposta);
    $sql->execute();
    $valuesClick = $sql->fetchAll();
    $linhaClick = $valuesClick[0];
    $mapClick = $linhaClick["areaMap"];  

    if ($resposta == $respostaCerta){
        $srcEmoji = "data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDI5Ny4yMjEgMjk3LjIyMSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMjk3LjIyMSAyOTcuMjIxOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4Ij4KPGc+Cgk8cGF0aCBkPSJNMjgzLjc2MiwzMi44MzVjMi43MDUtMS45MTMsMy4zNDYtNS42NTgsMS40MzItOC4zNjNjLTEuOTE0LTIuNzA1LTUuNjU3LTMuMzQ3LTguMzYzLTEuNDMybC0xNC45ODQsMTAuNjAyICAgYy0yLjcwNSwxLjkxMy0zLjM0Niw1LjY1OC0xLjQzMiw4LjM2M2MxLjE2OSwxLjY1MiwzLjAyMiwyLjUzNSw0LjkwMiwyLjUzNWMxLjE5OCwwLDIuNDA4LTAuMzU4LDMuNDYxLTEuMTA0TDI4My43NjIsMzIuODM1eiIgZmlsbD0iIzAwMDAwMCIvPgoJPHBhdGggZD0iTTI0NC4wNjQsMjkuMzg3YzAuNjk1LDAuMjYyLDEuNDA5LDAuMzg2LDIuMTEsMC4zODZjMi40MjgsMCw0LjcxMy0xLjQ4NCw1LjYxNy0zLjg5MWw2LjQ2LTE3LjE4MiAgIGMxLjE2Ni0zLjEwMS0wLjQwMy02LjU2MS0zLjUwNS03LjcyN2MtMy4xMDEtMS4xNjctNi41NjIsMC40MDQtNy43MjgsMy41MDVsLTYuNDYsMTcuMTgyICAgQzIzOS4zOTMsMjQuNzYxLDI0MC45NjIsMjguMjIxLDI0NC4wNjQsMjkuMzg3eiIgZmlsbD0iIzAwMDAwMCIvPgoJPHBhdGggZD0iTTI5MS4yMjMsNTUuNjExYy0wLjA0MSwwLTAuMDgyLDAtMC4xMjQsMGwtMTguMzUxLDAuMTU0Yy0zLjMxMywwLjA2Ny01Ljk0NCwyLjYwNS01Ljg3Nyw1LjkxOCAgIGMwLjA2NiwzLjI3MSwyLjczOSw1LjkyOCw1Ljk5Nyw1LjkyOGMwLjA0MSwwLDAuMDgyLDAsMC4xMjQsMGwxOC4zNTEtMC4zMTNjMy4zMTMtMC4wNjgsNS45NDQtMi43MzIsNS44NzctNi4wNDUgICBDMjk3LjE1NCw1Ny45ODIsMjk0LjQ4MSw1NS42MTEsMjkxLjIyMyw1NS42MTF6IiBmaWxsPSIjMDAwMDAwIi8+Cgk8cGF0aCBkPSJNMjU0LjIsMTQ3LjE1NGMtMy4wNzMtMi40MzMtNi43MTEtNC4wODktMTAuNTU3LTQuODY3YzAuMjU0LTAuNDYsMC40OTEtMC45MjgsMC43MTUtMS40MDNsMi40MDgtMi40MDggICBjOS4yNzQtOS4yNzUsMTAuMjQ4LTIzLjg3NCwyLjI2NC0zMy45NjFjLTMuNzY5LTQuNzYxLTkuMDAxLTcuOTI1LTE0LjgxMi05LjEwNmMwLjQxNS0wLjc2NCwwLjc4My0xLjU0NSwxLjExNy0yLjMzOCAgIGM2LjMxNi05LjE0OSw2LjIxMy0yMS40NDUtMC43ODItMzAuMjgzYy0zLjc3LTQuNzY0LTkuMDA0LTcuOTM4LTE0LjgxOC05LjExN2M0LjgtOC44MjYsNC4xODctMTkuODI2LTIuMjI1LTI3LjkyNSAgIGMtNC44NDgtNi4xMjUtMTIuMTA5LTkuNjM5LTE5LjkyMy05LjYzOWMtNi4yNTcsMC0xMi4xNiwyLjIzNi0xNi43OTIsNi4zM2MtMC43MDEtMy45NzktMi4zNjMtNy44MjItNS4wMTItMTEuMTY5ICAgYy00Ljg0OS02LjEyNS0xMi4xMS05LjYzOC0xOS45MjQtOS42MzlsMCwwYy02Ljc5LDAtMTMuMTY0LDIuNjM1LTE3Ljk0Nyw3LjQxOGwtNjAuODQsNjAuODRsLTAuMjMyLTguMTIgICBjLTAuMTA3LTEzLjgzLTExLjM5Mi0yNS4wNDktMjUuMjQ3LTI1LjA0OWMtMTMuNjA0LDAtMjQuNzI5LDEwLjgxNS0yNS4yMjksMjQuMjk4bC0xMi4xNDYsODguMzA2bC05Ljk4MywxMS42MDQgICBjLTUuOTgzLDYuOTU3LTUuNTgyLDE3LjQ4MSwwLjkxNSwyMy45NjJMMTkuOTg3LDE5OS43Yy00LjU3NCw2Ljg4MS0zLjc3MywxNi4yNjYsMi4yMDYsMjIuMjNsNjkuNjY3LDY5LjU1NyAgIGMzLjMyOSwzLjMyMSw3Ljc0OCw1LjE0OCwxMi40NDYsNS4xNDhjMy44NTcsMCw3LjY2OC0xLjI5NSwxMC43MjktMy42NDVsMTQuNTQ0LTExLjE2OGMxMy45OTEtMy4zMDUsMjkuNDE2LTEwLjgxMyw0NS44NzQtMjIuMzMgICBjMTQuMzcxLTEwLjA1OCwyOS45NjItMjMuNDYsNDYuMzM3LTM5LjgzNmwzNC42MzEtMzQuNjMxYzUuMTA3LTUuMTA3LDcuNzk1LTEyLjE4OCw3LjM3NS0xOS40MjcgICBDMjYzLjM3NiwxNTguMzcxLDI1OS44NzksMTUxLjY0OSwyNTQuMiwxNDcuMTU0eiBNMTg4LjEyNCwzMi4wMDljMi42MDMtMi42MDIsNi4wMzItMy45MDMsOS40NjItMy45MDMgICBjMy45MTUsMCw3LjgzMSwxLjY5NSwxMC41MTUsNS4wODZjNC4yNTYsNS4zNzcsMy41MSwxMy4xOC0xLjMzOSwxOC4wMjhsLTYuMTc3LDYuMTc2Yy0wLjk1MiwwLjYzNS0xLjg3OSwxLjMxNC0yLjc0NywyLjA4MyAgIGMtMC43MDEtMy45OC0yLjM2NC03LjgyMy01LjAxMy0xMS4xNjljLTMuMjU3LTQuMTE0LTcuNjA0LTcuMDQzLTEyLjQ3NS04LjUyN0wxODguMTI0LDMyLjAwOXogTTE0Ni4zOTcsMTcuNTMyICAgYzIuNjAyLTIuNjAyLDYuMDMyLTMuOTAzLDkuNDYyLTMuOTAzYzMuOTE2LDAuMDAxLDcuODMxLDEuNjk2LDEwLjUxNSw1LjA4N2M0LjI1Niw1LjM3NywzLjUxLDEzLjE3OS0xLjMzOSwxOC4wMjdsLTcwLjkxOSw3MC4xODYgICBsLTAuMjMzLTguMTE5Yy0wLjA2MS03LjgyNS0zLjctMTQuODEyLTkuMzU2LTE5LjQwNUwxNDYuMzk3LDE3LjUzMnogTTEzLjYyNCwxNzYuMzkxYy0yLjA4Mi0yLjA3OC0yLjIwOS01LjQxLTAuMjkxLTcuNjQgICBsMTIuMjgxLTE0LjI3N2MwLjAwNi0wLjAwNywwLjAxMS0wLjAxNywwLjAxMi0wLjAyNmwxMi43Mi05Mi40ODNjMC03LjI4Niw1Ljk2MS0xMy4yNDcsMTMuMjQ3LTEzLjI0NyAgIGM3LjI4NiwwLDEzLjI0OCw1Ljk2MSwxMy4yNDgsMTMuMjQ3TDY1LjE4Niw3NGMtMTEuOTg4LDEuNjQ2LTIxLjMyMiwxMS43MzMtMjEuNzgsMjQuMDU3bC0xMi4xNDUsODguMzA3bC0zLjUzMyw0LjEwOCAgIEwxMy42MjQsMTc2LjM5MXogTTI0Ny45MzUsMTc2LjUzOWwtMzQuNjMsMzQuNjMxYy0yOS41NzcsMjkuNTc3LTYwLjQ5NCw1My4zMTgtODcuNjUzLDU5LjIzNyAgIGMtMC44MjUsMC4xODEtMS42MDEsMC41MjgtMi4yNzEsMS4wNDNsLTE1LjY1NSwxMi4wMjJjLTEuMDE0LDAuNzc5LTIuMjE5LDEuMTYyLTMuNDE5LDEuMTYyYy0xLjQ0MywwLTIuODgtMC41NTUtMy45NjgtMS42NDEgICBsLTY5LjY3MS02OS41NmMtMi4wODMtMi4wNzctMi4yMS01LjQwOS0wLjI5MS03LjY0bDEyLjI4LTE0LjI3NmMwLjAwNy0wLjAwOCwwLjAxMS0wLjAxNywwLjAxMy0wLjAyNmwxMi43MTktOTIuNDgzICAgYzAtNy4yODYsNS45NjItMTMuMjQ4LDEzLjI0OC0xMy4yNDhjNy4yODYsMCwxMy4yNDcsNS45NjIsMTMuMjQ3LDEzLjI0OGwwLjYyNiwyMS44MjRjMC4xMDQsMy42MjYsMy4wODcsNS45ODcsNi4xOTEsNS45ODcgICBjMS41MTQsMCwzLjA1OC0wLjU2Myw0LjMwOS0xLjgxM2w3MC40MzEtNzAuNDMxYzIuNjAzLTIuNjAzLDYuMDMxLTMuOTAzLDkuNDYyLTMuOTAzYzMuOTE1LDAsNy44MzEsMS42OTUsMTAuNTE1LDUuMDg2ICAgYzQuMjU2LDUuMzc3LDMuNTA5LDEzLjE4LTEuMzQsMTguMDI4bC00OC41MTgsNDguNTE4Yy0yLjUxOSwyLjUyLTIuNTE5LDYuNjAzLDAsOS4xMjFsMCwwYzEuMjc1LDEuMjc1LDIuOTQ2LDEuOTEzLDQuNjE3LDEuOTEzICAgczMuMzQzLTAuNjM4LDQuNjE3LTEuOTEzbDYyLjM3NC02Mi4zNzNjMi42MDItMi42MDMsNi4wMzEtMy45MDMsOS40NjItMy45MDNjMy45MTUsMC4wMDEsNy44MzEsMS42OTYsMTAuNTE1LDUuMDg3ICAgYzQuMjU2LDUuMzc2LDMuNTA5LDEzLjE3OS0xLjM0LDE4LjAyN2wtNjIuMDgxLDYyLjA4MWMtMi41NTMsMi41NTQtMi41NTMsNi42OTIsMCw5LjI0NmMxLjI1OCwxLjI1OCwyLjkwNiwxLjg4Nyw0LjU1NiwxLjg4NyAgIGMxLjY0OCwwLDMuMjk3LTAuNjI5LDQuNTU1LTEuODg3bDQ4LjgxMS00OC44MWMyLjYwMy0yLjYwMyw2LjAzMi0zLjkwMyw5LjQ2Mi0zLjkwM2MzLjkxNSwwLDcuODMxLDEuNjk1LDEwLjUxNSw1LjA4NyAgIGM0LjI1Niw1LjM3NiwzLjUwOSwxMy4xNzktMS4zNCwxOC4wMjdsLTQ4LjM0OSw0OC4zNWMtMi42MTIsMi42MTEtMi42MTIsNi44NDcsMCw5LjQ1OGwwLjA3OCwwLjA3OSAgIGMxLjIwNywxLjIwNywyLjc4OSwxLjgxLDQuMzcsMS44MWMxLjU4MiwwLDMuMTY0LTAuNjAzLDQuMzctMS44MWwyOS45NzQtMjkuOTc0YzIuNzAxLTIuNzAxLDYuMzE3LTQuMTI5LDkuOTIxLTQuMTI5ICAgYzIuODY3LDAsNS43MjYsMC45MDQsOC4xMDcsMi43ODlDMjUzLjExNCwxNjEuNTk4LDI1My41MDgsMTcwLjk2NywyNDcuOTM1LDE3Ni41Mzl6IiBmaWxsPSIjMDAwMDAwIi8+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==";
        $titulo = "Parabéns!";
        
        if($_SESSION['contadorResposta']==0){
            $sql = $pdo->prepare("
                INSERT INTO exercicioResposta (exercicio_fk, usuario_fk, fim, resposta, acerto, inicio, tempo)
                VALUES (:exercicio, :usuario, NOW(6), :resposta, 1, :inicio, TIMESTAMPDIFF(MICROSECOND,:inicio, NOW()))
            ");
    
            $sql->bindValue(':exercicio', $exercicio);
            $sql->bindValue(':usuario', $usuario);
            $sql->bindValue(':resposta', $resposta);
            $sql->bindValue(':inicio', $inicio);
            $sql->execute();
            $lastId = $pdo->lastInsertId();
            
            $_SESSION['exercicioResposta'] = $lastId;
            $_SESSION['acertos']=$_SESSION['acertos']+1;
            
            $sql = $pdo->prepare("
                UPDATE exercicios
                SET tempoRecorde = (SELECT MIN(tempo) FROM exercicioResposta WHERE exercicio_fk =:exercicio AND acerto=1), tempoMedio = (SELECT AVG(tempo) FROM exercicioResposta WHERE exercicio_fk =:exercicio AND acerto=1), aproveitamento = (SELECT SUM(acerto)/COUNT(acerto)*100 FROM exercicioResposta WHERE exercicio_fk =:exercicio)
                WHERE exercicios.id = :exercicio
            ");
            $sql->bindValue(':exercicio', $exercicio);
            $sql->execute();
            
            $_SESSION['contadorResposta'] = $_SESSION['contadorResposta']+1;
            
            $sql = $pdo->prepare("
                UPDATE colaboradores
                SET pontos = pontos +1
                WHERE colaboradores.id = :usuario");
    
            $sql->bindValue(':usuario', $usuario);
            $sql->execute();
        }
    } else {
        $mensagem = "Você selecionou: <b>" . $resposta . "</b>";
        $srcEmoji = "data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgMTA2LjA1OSAxMDYuMDU5IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCAxMDYuMDU5IDEwNi4wNTk7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4KPGc+Cgk8cGF0aCBkPSJNOTAuNTQ0LDkwLjU0MmMyMC42ODctMjAuNjg1LDIwLjY4NS01NC4zNDIsMC4wMDItNzUuMDI0QzY5Ljg1OC01LjE3MiwzNi4xOTgtNS4xNzIsMTUuNTE1LDE1LjUxMyAgIEMtNS4xNzMsMzYuMTk4LTUuMTcxLDY5Ljg1OCwxNS41MTcsOTAuNTQ3QzM2LjE5OCwxMTEuMjMsNjkuODU4LDExMS4yMyw5MC41NDQsOTAuNTQyeiBNMjEuMzAyLDIxLjMgICBDMzguNzk1LDMuODA3LDY3LjI2MSwzLjgwNSw4NC43NTksMjEuMzAyYzE3LjQ5NCwxNy40OTQsMTcuNDkyLDQ1Ljk2Mi0wLjAwMiw2My40NTVjLTE3LjQ5NCwxNy40OTQtNDUuOTYxLDE3LjQ5Ni02My40NTUsMC4wMDIgICBDMy44MDQsNjcuMjYzLDMuODA2LDM4Ljc5NCwyMS4zMDIsMjEuM3ogTTU4Ljg1Nyw0MS42NzFjMC00Ljc5OCwzLjkwMy04LjcwMSw4LjcwMy04LjcwMWM0Ljc5NywwLDguNjk5LDMuOTAyLDguNjk5LDguNzAxICAgYzAsMS4zODEtMS4xMTksMi41LTIuNSwyLjVzLTIuNS0xLjExOS0yLjUtMi41YzAtMi4wNDEtMS42Ni0zLjcwMS0zLjY5OS0zLjcwMWMtMi4wNDQsMC0zLjcwMywxLjY2LTMuNzAzLDMuNzAxICAgYzAsMS4zODEtMS4xMTksMi41LTIuNSwyLjVDNTkuOTc2LDQ0LjE3MSw1OC44NTcsNDMuMDUxLDU4Ljg1Nyw0MS42NzF6IE0zMS4xMzQsNDEuNjQ0YzAtNC43OTcsMy45MDQtOC43MDEsOC43MDMtOC43MDEgICBjNC43OTcsMCw4LjcwMSwzLjkwMyw4LjcwMSw4LjcwMWMwLDEuMzgxLTEuMTE5LDIuNS0yLjUsMi41Yy0xLjM4MSwwLTIuNS0xLjExOS0yLjUtMi41YzAtMi4wNDEtMS42Ni0zLjcwMS0zLjcwMS0zLjcwMSAgIGMtMi4wNDIsMC0zLjcwMywxLjY2LTMuNzAzLDMuNzAxYzAsMS4zODEtMS4xMTksMi41LTIuNSwyLjVTMzEuMTM0LDQzLjAyNCwzMS4xMzQsNDEuNjQ0eiBNNTQuMDg5LDU5LjM3MSAgIGMxMC4wODQsMCwxOS4wODQsNS43NDIsMjIuOTI3LDE0LjYzYzAuNjU4LDEuNTIxLTAuMDQxLDMuMjg2LTEuNTYyLDMuOTQzYy0xLjUyMSwwLjY2LTMuMjg1LTAuMDQyLTMuOTQzLTEuNTYyICAgYy0yLjg5NC02LjY4OS05LjczLTExLjAxMi0xNy40MjEtMTEuMDEyYy03Ljg2OSwwLTE0Ljc0Nyw0LjMxOS0xNy41MjIsMTEuMDA0Yy0wLjQ4LDEuMTU0LTEuNTk2LDEuODUxLTIuNzcxLDEuODUxICAgYy0wLjM4NSwwLTAuNzczLTAuMDc0LTEuMTUtMC4yM2MtMS41My0wLjYzNi0yLjI1Ni0yLjM5Mi0xLjYxOS0zLjkyMUMzNC43MzUsNjUuMTQzLDQzLjc4OCw1OS4zNzEsNTQuMDg5LDU5LjM3MXogTTI1LjIwNCw1Ni44MDEgICBjMC4wMDEtMy40MzYsNC41NTYtNy41MzUsNC41NTYtNy41MzVjMC40MzgsMi43NDcsMS41Miw0LjM0NCwxLjUyLDQuMzQ0YzEuMjE4LDEuODE4LDEuMjE4LDMuNTA3LDEuMjE4LDMuNTA3ICAgYzAsMy43MTItMy42OTIsMy42OC0zLjY5MiwzLjY4QzI1LjIwNCw2MC43OTUsMjUuMjA0LDU2LjgwMSwyNS4yMDQsNTYuODAxeiIgZmlsbD0iIzAwMDAwMCIvPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=";
        $titulo = "Infelizmente você errou!";
        
        if($_SESSION['contadorResposta']==0){
            $sql = $pdo->prepare("
                INSERT INTO exercicioResposta (exercicio_fk, usuario_fk, fim, resposta, acerto, inicio, tempo)
                VALUES (:exercicio, :usuario, NOW(6), :resposta, 0, :inicio, TIMESTAMPDIFF(MICROSECOND,:inicio, NOW()))");
    
            $sql->bindValue(':exercicio', $exercicio);
            $sql->bindValue(':usuario', $usuario);
            $sql->bindValue(':resposta', $resposta);
            $sql->bindValue(':inicio', $inicio);
            $sql->execute();
            $lastId = $pdo->lastInsertId();
            
            $_SESSION['exercicioResposta'] = $lastId;
            $_SESSION['contadorResposta'] = $_SESSION['contadorResposta']+1;
        }
        
    }
    $pesq = $pdo->prepare("
        SELECT tempoRecorde, aproveitamento, COUNT(exercicioResposta.exercicio_fk) AS qtd
        FROM exercicios
        LEFT JOIN exercicioResposta ON exercicios.id = exercicioResposta.exercicio_fk
        WHERE exercicios.id = :exercicio");

    $pesq->bindValue(':exercicio', $exercicio);
    $pesq->execute();
    $values = $pesq->fetchAll();
    $linha = $values[0];
    $tempoRecorde = $linha["tempoRecorde"];
    $aproveitamento = $linha["aproveitamento"];
    $qtd = $linha["qtd"];
    if($qtd>5){
        if($aproveitamento<=20){
            $aproveitamento = 'Difícil';
        }elseif($aproveitamento<=80){
            $aproveitamento = 'Médio';
        }else{
            $aproveitamento = 'Fácil';
        }
    }else{
        $aproveitamento = 'Novo';
    }

    $pesq = $pdo->prepare("
        SELECT tempo
        FROM exercicioResposta
        WHERE id = :id
    ");

    $pesq->bindValue(':id', $_SESSION['exercicioResposta']);
    $pesq->execute();
    $values = $pesq->fetchAll();
    $linha = $values[0];
    $tempo = $linha["tempo"];
    
    $tempo =  "Jogada = " . $_SESSION['jogada'] . "/" . $_SESSION['jogodas'] . "<br>
    Acertos = " . $_SESSION['acertos'] . "<br>
    Nível: " . $aproveitamento . "<br>
    Tempo: " . round($tempo/1000000,1) . "s<br> 
    Recorde: " . round($tempoRecorde/1000000,1) . "s";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Game Piscina Fácil</title>
        <?php require_once "head.php"; ?>
    </head>
    <body>
        <?php require_once "navbar.php"; ?>
        <div class='col-lg-6 col-xl-6' style='margin: 0 auto;'>
            <div class='game'>
                <?php
                    echo "<img class='marginBottom centerDiv' style='display: block; width: 50px; border: 0 !important;' src='". $srcEmoji ."' />";
                    // echo "<div style='clear:both'></div>";
                    echo "<h3 style='text-align:center;'> $titulo </h3>";
                    echo "<h5 style='text-align:center;'>Utilize o fórum para tirar dúvidas.<h5>";
                    echo "<div class='marginBottom aprovacaoGame col-lg-11 col-xl-11 centerDiv'>";
                    echo    "<p> $tempo </p>";
                    echo "</div>";

                    echo "<center>";
                    
                    echo "<button type='button' class='btn btn-outline-danger col-5 col-md-3' data-toggle='modal' data-target='#problemaExercicio'>Reportar</button>";
                    echo "&nbsp; &nbsp;";
                    echo "<button autofocus type='button' class='btn btn-primary col-5 col-md-3' onclick=\"window.location.href = 'game';\">Próxima</button>";
                    echo "</center>";

                ?>
                <br>
                <?php
                    echo "<center>Resposta certa: <h5><b>$respostaCerta</b></h5></center>";
                    echo "<p style='text-align:center;'> $mensagem </p>";
                    if($imagemMap!='0'){
                        echo "<p><img class='border-primary rounded imgMap' src='imagens/". $imagemMap ."' usemap='#image-map' border='0'></p>";
                        echo "<map name='image-map'>";
                        foreach($values2 as $linha2) {
                        $areaMapCerta = $linha2["areaMap"];
                        echo "<area id='area-click' $areaMapCerta title='". $respostaCerta ."'>";
                    }
                    echo "<area id='area-errado'". $mapClick ." title='". $resposta ."'>";
                    echo "</map>";
                    }
                    
                    
                ?>
            </div>
            <br>
            <div class='especificacao'>
                <form class="form-container" method=post enctype="multipart/form-data" action= 'cadastrando_forum'>
                    <div class="col-sm-12 col-lg-12">
                        <h3>Fórum</h3>
                        <p>Faça perguntas sobre o conteúdo do exercício, ou mostre que você domina a arte de limpar piscinas, respondendo dúvidas e se aprofundando no tema!</p>
                    </div>
                    <div class="col-sm-12 col-lg-12">
                        <textarea rows='5' required name = 'comentario' class='form-control' placeholder='Faça aqui seu comentário...'></textarea>
                        <input type= 'hidden' name= 'exercicio' value='<?php echo $exercicio; ?>'>
                        <input type= 'hidden' name= 'exercicioResposta' value='<?php echo $_SESSION['$exercicioResposta']; ?>'>
                        <button style="margin: 8px 0 25px 0;" autofocus type='submit' class='btn btn-primary btn-sm naMesmaLinhaDireita' onclick="window.location.href = 'cadastrando_forum';">Enviar</button>
                    </div>
                </form>
                <br>
                <br>
                
                <table class="table table-striped table-hover">
                
                    <tbody>
                        <?php
                            $pesq = $pdo->prepare("
                                SELECT forumExercicios.id, apelido, dtm, comentario
                                FROM forumExercicios
                                INNER JOIN colaboradores ON colaboradores.id = forumExercicios.usuario_fk
                                WHERE forumExercicios.exercicio_fk = :exercicio 
                                ORDER BY dtm ASC");
                                
                            $pesq->bindValue(':exercicio', $exercicio);
                            $pesq->execute();
                            $values = $pesq->fetchAll();

                            foreach($values as $linha) {
                                
                                $data= strftime('%d/%m/%y %H:%m', strtotime($linha["dtm"]));
                                $id= $linha["id"];
                                $apelido= $linha["apelido"];
                                $comentario =$linha["comentario"];

                                echo "
                                <div class='divComentario'>
                                    <p class='apelidoComentario'>" . $apelido . "</p>
                                    <p class='dataComentario'>" . utf8_encode ( $data ) . "</p>
                                    <p class='comentarioForum'>" . $comentario . "</p>
                                </div>
                               
                                ";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php echo "<!-- Modal -->
            <div class='modal fade' id='problemaExercicio' tabindex='-1' role='dialog' aria-labelledby='EditarResponsavel' aria-hidden='true'>
                <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h5>Reportar Erro no Exercício</h5>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>
                        <div class='modal-body'>
                            <form class='form-container' method=post enctype='multipart/form-data' action= 'cadastrando_problemaExercicio'>
                                <div class='form-group col-md-12'>
                                    <label>Qual problema você encontrou nesse exercício?</label>
                                    <textarea rows='3' required name = 'relato' class='form-control' placeholder='Relate o problema...'></textarea>
                                    <input type= 'hidden' name= 'exercicio' value= '" . $exercicio . "'>
                                    <input type= 'hidden' name= 'exercicioResposta' value= '" . $_SESSION['exercicioResposta'] . "'>
                                </div>
                                <button type='submit' class='btn btn-danger'>Relatar</button>
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>";
            require_once "footer.php"; ?>
        </div>
        <script src="https://rawgit.com/jamietre/ImageMapster/master/dist/jquery.imagemapster.min.js"></script>
        <script>
            $('img')
                .mapster({
                    staticState: true,
                    stroke: true,
                    strokeWidth: 6,
                    strokeColor: 'ff0000',
                    mapKey: 'id'
                })
                .mapster('set',true, 'area-click', {
                    fill: true,
                    fillColor: '00ff00',
                    stroke: true,
                    strokeColor: '00ff00',
                });
        </script>
    </body>
</html>