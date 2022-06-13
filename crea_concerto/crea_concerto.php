<!DOCTYPE html>
    <head></head>
    <body>
        <?php
            $dbconn = pg_connect("host=localhost port=5432 
            dbname=DoConcert user=postgres password=Pippo_1927")
                or die('Could not connect: ' . pg_last_error());
            if (!(isset($_POST['crea_concertoButton']))) {
                header("Location: ../crea_concerto/crea_concerto.html");
            }
            else {
                $codice = $_POST['codice'];
                $q1="select * from concerto where codice=$1";
                $result=pg_query_params($dbconn, $q1, array($codice));
                if ($line=pg_fetch_array($result, null, PGSQL_ASSOC)) {
                    echo "<h1> Questo codice è stato già usato in precedenza. </h1>
                    <a href=../crea_concerto/crea_concerto.html> Clicca qui per riprovare cambiando il codice.
                    </a>";
                }
                else{
                    $email = $_POST['email'];
                    $artista = $_POST['artista'];
                    $citta = $_POST['citta'];
                    $luogo = $_POST['luogo'];
                    $maxspettatori = $_POST['maxspettatori'];
                    $prezzo = $_POST['prezzo'];
                    $data = $_POST['data'];
                    $q2="insert into concerto values ($1,$2,$3,$4,$5,$6,$7,$8,$6)";
                    $data=pg_query_params($dbconn, $q2,
                            array($codice, $email, $artista, $citta, $luogo, $maxspettatori, $prezzo, $data)
                    );
                    if($data) {
                        $q3="select nome from utente where email= $1";
                        $result=pg_query_params($dbconn, $q3, array($email));
                        $line=pg_fetch_array($result, null, PGSQL_ASSOC);
                        $nome=$line['nome'];
                        echo "<h1> Il tuo concerto è stato creato. <br/></h1>";
                        echo "<a href=../i_tuoi_concerti/i_tuoi_concerti.html?name=$nome>
                                Premi qui</a> per visualizzare i tuoi concerti o";
                        echo "<a href=../LandingPagePrivata/index.html?name=$nome> premi qui
                                </a> per continuare ad utilizzare il sito web ";
                    }
                }
            }
        ?>
    </body>
</html>