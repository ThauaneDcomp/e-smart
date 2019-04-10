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
                    <li id="confirm-exclud" class="nav-item text-success invisible" style="padding: 6px 6px 0 0"><i class="material-icons">done</i></li>
                    <li class="nav-item">
                        <div id="dropdown-entities" class="dropdown">
                            <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Apagar entidades
                            </button>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <?php
                                foreach ($data['table'] as $tb){
                                    echo "<a class='dropdown-item' href='#' data-database='{$data['database']}'>{$tb['Tables_in_' . $_SESSION['database']]}</a>";
                                }
                                ?>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a id="reset-session" href="http://localhost/smart_e-ping-2/public/home/resetSession" class="btn btn-danger margin-left-15 text-white">
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
            <h5 class="text-secondary text-center">Informe a base de dados ORION que deseja realizar a submissão dos dados.</h5>

            <form id="formSelectData" class="text-secondary">
                <div class="form-group">
                    <label for="database">Você deseja submeter os dados para a base de dados ORION?<span class="text-danger"> *</span></label>
                    <div class="form-check">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="checkOrion" id="checkOrionYes" value="1" checked>
                            <label class="form-check-label" for="checkOrionYes">Sim</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input form-inline" type="radio" name="checkOrion" id="checkOrionNo" value="0">
                            <label class="form-check-label" for="checkOrionNo">Não</label>
                        </div>
                    </div>
                </div>

                <div id="containerDataOrion" class="row overflow-overlay container-list rounded border bg-white padding-15 margin-bottom-15">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="orionIp">IP<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" id="orionIp" name="orionIp" value="http://130.206.119.42" placeholder="10.0.22">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="orionPort">Porta<span class="text-danger"> *</span></label>
                            <input type="number" class="form-control" id="orionPort" name="orionPort" value="10026" placeholder="1026">
                        </div>
                    </div>
                </div>

                <div>
                    <label>Clique aqui para fazer o <i>download</i> do <a href="#">arquivo JSON</a></label>
                </div>

                <div class="form-group">
                    <label><span class="text-danger">*</span> Campos Obrigatórios.</label>
                </div>

                <div class="form-group text-center">
                    <a id="btBack" href="selectData" class="btn btn-md btn-secondary">Voltar</a>
                    <button id="btOptions" type="button" class="btn btn-md btn-primary">Avançar</button>

                    <div id="containerInfo" class="alert invisible margin-15" role="alert"></div>
                </div>
            </form>
        </div>

    </div>
</div>
