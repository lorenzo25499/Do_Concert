<!DOCTYPE html>
    <head></head>
    <body>
        <?php
            $dbconn = pg_connect("host=localhost port=5432 
            dbname=DoConcert user=postgres password=Pippo_1927")
                or die('Could not connect: ' . pg_last_error());
            if (!(isset($_POST['cercaButton']))) {
                header("Location: ../cerca_concerto/visualizza_concerti.html");
            }
            else {
                $artista = $_POST['artista'];
                $qc = "select count(*) from concerto where artista = $1";
                $resultc=pg_query_params($dbconn, $qc, array($artista));
                $linec=pg_fetch_array($resultc, null, PGSQL_ASSOC);
                $cb = $linec['count'];
                if($cb==0){
                    echo "<h1>Non ci sono concerti di questo artista!</h1>
                    <a href=../cerca_concerto/visualizza_concerti.html>Premi qui
                    </a> per cercare concerti di  un altro artista
                    <a href=../LandingPagePrivata/index.html> o premi qui
                    </a> per ritornare alla home";
                }
                else{
                    $qlista = "select codice, artista, città, luogo, prezzo, data
                                from concerto
                                where artista = $1";
                    $resultlista=pg_query_params($dbconn, $qlista, array($artista));
                    $resultl=pg_fetch_all($resultlista);
                    $i = 0;
                    echo "<h4><a href=../cerca_concerto/cerca_concerto.html>Premi qui
                    </a> per acquistare i biglietti
                    <a href=../LandingPagePrivata/index.html> o premi qui
                    </a> per ritornare alla home </h4>";
                    while($i < $cb){
                        print_r("<h3>".$resultl[$i]['codice']."</h3>");
                        print_r($resultl[$i]['artista']."</br>");
                        print_r($resultl[$i]['città'].", ");
                        print_r($resultl[$i]['luogo']."</br>");
                        print_r($resultl[$i]['prezzo']."€</br>");
                        print_r($resultl[$i]['data']."</br></br>");
                        $i++;
                    }
                }    
            }
        ?>
    </body>
</html>