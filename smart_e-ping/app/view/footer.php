<!-- JQUERY 3.2.1 -->
<script src="<?=$this->server?>/<?=$this->nameApp?>/public/js/jquery-3.3.1.min.js"></script>
<!-- POPPER -->
<script src="<?=$this->server?>/<?=$this->nameApp?>/public/js/popper.min.js"></script>
<!-- BOOTSTRAP 4.0 -->
<script src="<?=$this->server?>/<?=$this->nameApp?>/public/js/bootstrap.min.js"></script>
<!-- HOME -->
<script src="<?=$this->server?>/<?=$this->nameApp?>/public/js/api-fiware.js"></script>
<!-- HOME -->
<script src="<?=$this->server?>/<?=$this->nameApp?>/public/js/home.js"></script>
<?php
    if(!empty($data['scripts'])){
        foreach($data['scripts'] AS $script) {
            echo "<script src='{$this->server}/{$this->nameApp}/public/js/{$script}.js'></script>";
        }
    }
?>
</body>
</html>
