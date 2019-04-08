<?php


class Home extends Controller{
    public function index($name = ''){

        //Loading header
        $this->view('header');

        //Loading component's
        $progressNavigation = $this->component('progress_navigation', [
            'stage' => array('Conexão da base de dados', 'Seleção dos dados', 'Opções'),
            'currentStep' => 0
        ]);

        //Loading View
        $this->view('home/index', ['progressNavigation' => $progressNavigation, 'user' => 'weslan']);

        //Loading footer
        $this->view('footer');

    }

    public function selectData(){
        //Loading header
        $this->view('header');

        //Loading component's
        $progressNavigation = $this->component('progress_navigation', [
            'stage' => array('Conexão da base de dados', 'Seleção dos dados', 'Opções'),
            'currentStep' => 1
        ]);

        $this->model('Connection');

        //Loading data
        session_start();

        $conn = Connection::connect($_SESSION['database'], $_SESSION['url'], $_SESSION['user'], $_SESSION['password']);
        $table = Connection::query($conn, "SHOW TABLES FROM " . $_SESSION['database'] . ";");

        $i = 0;
        foreach ($table AS $tb){

            $sql = "SHOW COLUMNS FROM {$tb['Tables_in_' . $_SESSION['database']]} FROM {$_SESSION['database']};";

            $column = array();

            if($res = mysqli_query($conn, $sql)){
                while ($row = $res->fetch_assoc()){
                    $column[] = $row;
                }
            }else{
                echo $conn->error;
            }

            $table[$i]['column'] = $column;

            $res->close();
            $i++;
        }

        $conn->close();

        //Active tables and columns
        $tbActive = isset($_SESSION['select']) ? $_SESSION['select'] : [];



        //Loading View
        $this->view('home/selectData',
            [
                'progressNavigation' => $progressNavigation,
                'table' => $table,
                'tbActive' => $tbActive
            ]);

        //Loading footer
        $this->view('footer');
    }

    public function options(){

        $this->model('Connection');

        session_start();

        //Loading data
        $conn = Connection::connect($_SESSION['database'], $_SESSION['url'], $_SESSION['user'], $_SESSION['password']);
        $table = Connection::query($conn, "SHOW TABLES FROM " . $_SESSION['database'] . ";");

        $i = 0;
        foreach ($table AS $tb){

            $sql = "SHOW COLUMNS FROM {$tb['Tables_in_' . $_SESSION['database']]} FROM {$_SESSION['database']};";

            $column = array();

            if($res = mysqli_query($conn, $sql)){
                while ($row = $res->fetch_assoc()){
                    $column[] = $row;
                }
            }else{
                echo $conn->error;
            }

            $table[$i]['column'] = $column;

            $res->close();
            $i++;
        }

        $conn->close();

        //Loading header
        $this->view('header');

        //Loading component's
        $progressNavigation = $this->component('progress_navigation', [
            'stage' => array('Conexão da base de dados', 'Seleção dos dados', 'Opções'),
            'currentStep' => 2
        ]);

        //Loading View
        $this->view('home/options', ['progressNavigation' => $progressNavigation, 'table' => $table, 'database' => $_SESSION['database']]);

        //Loading footer
        $this->view('footer');
    }

    public function testingConnection(){
        $database = $_POST['database'];
        $url = $_POST['url'];
        $user = $_POST['user'];
        $password = $_POST['password'];

        $this->model('Connection');

        $conn = Connection::connect($database, $url, $user, $password);

        if ($conn->connect_error) {
            $msg = array(
                "status" => false,
                "msg" => $conn->connect_error
            );
        }else{
            $msg = array(
                "status" => true,
                "msg" => ""
            );
        }

        $conn->close();
        session_start();

        $_SESSION['database'] = $database;
        $_SESSION['url'] = $url;
        $_SESSION['user'] = $user;
        $_SESSION['password'] = $password;

        echo json_encode($msg);
    }

    public function saveSelect(){
        $data = $_POST['select'];

        session_start();
        $_SESSION['select'] = $data;

        echo json_encode(true);
    }

    public function resetSession(){
        session_start();
        session_destroy();


        header("Location: {$this->server}/{$this->nameApp}/public/home");
    }
}
