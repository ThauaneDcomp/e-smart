<?php
    $table = $data['table'];
    $tbActive = $data['tbActive'];
?>

<div class="bg-white d-flex align-items-center justify-content-center">
    <div class="col-6 offset bg-light border rounded padding-0">
        <nav class="navbar navbar-expand-lg navbar-light navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Smart e-PING</a>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Ajuda</a>
                    </li>
                </ul>

                <!-- <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a id="reset-session" href="http://localhost/smart_e-ping-2/public/home/resetSession" class="btn btn-danger text-white">
                            Resetar cash
                        </a>
                    </li>
                </ul> -->
            </div>
        </nav>

        <div class="col padding-15">
            <?=$data['progressNavigation']?>
        </div>

        <div class="container-form col-10 offset-1 margin-top-60">
            <h5 class="text-secondary text-center">Selecione as tabelas e colunas que deseja realizar interoperabilidade. Você pode realizar sua escolha em mais de uma tabela ou coluna.</h5>

            <form id="formSelectData" class="text-secondary">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Tabelas disponíveis<span class="text-danger"> *</span></h6>

                        <div class="overflow-overlay container-list rounded border bg-white padding-15 margin-bottom-15">
                            <div class="list-table list-group border-0">
                                <?php
                                $i = 0;
                                foreach ($table AS $item){
                                    $situation = '';

                                    if($i == 0){
                                        $status = "bg-secondary text-white";
                                    }else{
                                        $status = "";
                                    }

                                    foreach ($tbActive as $tbA) {
                                        if($tbA['table'] == $item['Tables_in_' . $_SESSION['database']]){
                                            $situation = 'active';
                                            $status = "";
                                        }
                                    }

                                    echo "<a id='" . $item['Tables_in_' . $_SESSION['database']] . "' class='c-pointer table-item border-0 rounded-0 list-group-item list-group-item-action {$status} {$situation}'> " . $item['Tables_in_' . $_SESSION['database']] . " </a>";

                                    $i++;
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h6>Colunas disponíveis<span class="text-danger"> *</span></h6>

                        <div class="overflow-overlay container-list rounded border bg-white padding-15 margin-bottom-15">
                            <?php
                            $i = 0;
                            foreach ($table AS $item){
                                if($i == 0){
                                    $visible = "show";
                                }else{
                                    $visible = "invisible d-none";
                                }

                                echo "<div table='{$item['Tables_in_' . $_SESSION['database']]}' class='column-list list-group border-0 {$visible}'>";

                                foreach ($item['column'] AS $col){
                                    $situation = "";

                                    foreach ($tbActive AS $tbA){
                                        foreach ($tbA['column'] AS $colA){
                                            if($colA == $col['Field']){
                                                $situation = "active";
                                            }
                                        }
                                    }

                                    echo "<a table='{$item['Tables_in_' . $_SESSION['database']]}' id='{$col['Field']}' data-type='{$col['Type']}' class='c-pointer border-0 rounded-0 list-group-item list-group-item-action {$situation}'>{$col['Field']}</a>";
                                }

                                echo "</div>";

                                $i++;
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label><span class="text-danger">*</span> Campos Obrigatórios.</label>
                </div>

                <div class="form-group text-center">
                    <a id="btBack" href="index" class="btn btn-md btn-secondary">Voltar</a>
                    <button id="btSelect" type="button" class="btn btn-md btn-primary">Avançar</button>

                    <div id="containerInfo" class="alert invisible margin-15" role="alert"></div>
                </div>
            </form>
        </div>

    </div>
</div>
