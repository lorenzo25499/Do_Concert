<!DOCTYPE html>
    <head></head>
    <body>
        <?php
            $dbconn = pg_connect("host=localhost port=5432 
            dbname=DoConcert user=postgres password=Pippo_1927")
                or die('Could not connect: ' . pg_last_error());
            if (!(isset($_POST['registrationButton']))) {
                header("Location: ../registrati/registrati.html");
            }
            else {
                $email = $_POST['email'];
                $q1="select * from utente where email=$1";
                $result=pg_query_params($dbconn, $q1, array($email));
                if ($line=pg_fetch_array($result, null, PGSQL_ASSOC)) {
                    echo "<h1> La tua email è stata già registrata in precendenza. </h1>
                    <a href=../accedi/accedi.html> Clicca qui per effettuare il login
                    </a>";
                }
                else{
                    $nome=$_POST['nome'];
                    $cognome=$_POST['cognome'];
                    $password = md5($_POST['password1']);
                    $q2="insert into utente values ($1,$2,$3,$4)";
                    $data=pg_query_params($dbconn, $q2,
                            array($email, $nome, $cognome, $password)
                    );
                    if($data) {
                        //header("Location: registrationCompleted.html");
                        echo "<h1> La registrazione è completata. Inizia ad usare il nostro sito. <br/></h1>";
                        echo "<a href=../LandingPagePrivata/index.html?name=$nome> Premi qui
                                </a> per iniziare a utilizzare il sito web";
                    }
                }
            }
        ?>
    </body>
</html>