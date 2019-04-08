<?php
    session_start();
    $database = isset($_SESSION['database']) ? $_SESSION['database'] : "";
    $url = isset($_SESSION['url']) ? $_SESSION['url'] : "";
    $user = isset($_SESSION['user']) ? $_SESSION['user'] : "";
    $password = isset($_SESSION['password']) ? $_SESSION['password'] : "";
?>

<div class="bg-white d-flex align-items-center justify-content-center margin-top-60">
    <div class="col-6 offset bg-light border rounded padding-0">
        <nav class="navbar navbar-expand-lg navbar-light navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Smart e-PING</a>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Ajuda</a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a id="reset-session" href="http://localhost/smart_e-ping-2/public/home/resetSession" class="btn btn-danger text-white">
                            Resetar cash
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="col padding-15">
            <!-- COMPONENT progress_navigation -->
            <?=$data['progressNavigation']?>
        </div>

        <div class="container-form col-10 offset-1 margin-top-60">
            <h3 class="text-secondary text-center">Seja bem-vindo ao Framework Smart e-PING. Preencha os campos referentes a base de dados que deseja realizar a interoperabilidade.</h3>

            <form method="POST" id="formConnect" class="text-secondary">
                <div class="form-group">
                    <label for="database">Base de dados<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" id="database" name="database" placeholder="Exemplo: nomeDaBase" value="<?=$database?>">
                </div>

                <div class="form-group">
                    <label for="url">URL da base de dados <span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" id="url" name="url" placeholder="Exemplo: 3306/ ou http://server:port/" value="<?=$url?>">
                </div>

                <div class="form-group">
                    <label for="user">Usuário<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" id="user" name="user" placeholder="Usuário" value="<?=$user?>">
                </div>

                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Senha" value="<?=$password?>">
                </div>

                <div class="form-group">
                    <label><span class="text-danger">*</span> Campos Obrigatórios.</label>
                </div>

                <div class="form-group text-center">
                    <button id="btSubmit" type="button" class="btn btn-lg btn-primary">Avançar</button>

                    <div id="containerInfo" class="alert invisible margin-15" role="alert"></div>
                </div>
            </form>
        </div>

    </div>
</div>

