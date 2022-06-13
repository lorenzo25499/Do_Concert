<!DOCTYPE html>
    <head></head>
    <body>
        <?php
            $dbconn = pg_connect("host=localhost port=5432 
            dbname=DoConcert user=postgres password=Pippo_1927")
                or die('Could not connect: ' . pg_last_error());
            if (!(isset($_POST['ituoiconcertiButton']))) {
                header("Location: ../i_tuoi_concerti/i_tuoi_concerti.html");
            }
            else{
                $email = $_POST['email'];
                $q1="select * from utente where email=$1";
                $result=pg_query_params($dbconn, $q1, array($email));
                if (!($line1=pg_fetch_array($result, null, PGSQL_ASSOC))) {
                    echo "<h1> Email non corretta. </h1>
                    <a href= i_tuoi_concerti.html> Clicca qui per riprovare.
                    </a>";
                }
                else{
                    $password = md5($_POST['password1']);
                    $q2="select * from utente where email = $1 and password = $2";
                    $result=pg_query_params($dbconn, $q2, array($email,$password));
                    if (!($line=pg_fetch_array($result, null, PGSQL_ASSOC))) {
                        echo "<h1> La Password non è corretta</h1>
                        <a href= i_tuoi_concerti.html> Clicca qui per riprovare
                        </a>";
                    }
                    else {
                        $nome = $line1['nome'];
                        $q3="select * from concerto where email= $1";
                        $result=pg_query_params($dbconn, $q3, array($email));
                        if (!($line=pg_fetch_array($result, null, PGSQL_ASSOC))) {
                            echo "<h1> Non hai ancora creato tuoi concerti. <br/></h1>";
                            echo "<a href=../crea_concerto/crea_concerto.html?name=$nome>
                            Premi qui</a> per creare un tuo concerto";
                        }
                        else{
                            $result1=pg_fetch_all($result);
                            $qcount = "select count(*) from concerto where email = $1";
                            $resultc=pg_query_params($dbconn, $qcount, array($email));
                            $linec=pg_fetch_array($resultc, null, PGSQL_ASSOC);
                            $c = $linec['count'];
                            $i = 0;
                            print_r("<h1> Hai creato ".$c. " concerti!</h1>");
                            while($i < $c){
                                print_r("<h3>".$result1[$i]['codice']."</h3>");
                                print_r($result1[$i]['artista']."</br>");
                                print_r($result1[$i]['città'].", ");
                                print_r($result1[$i]['luogo']."</br>");
                                print_r("Capienza massima: ".$result1[$i]['maxspettatori']."</br>");
                                print_r($result1[$i]['prezzo']."€</br>");
                                print_r($result1[$i]['data']."</br>");
                                print_r("Posti disponibili: ".$result1[$i]['postidisponibili']."</br></br>");
                                $i++;
                            }
                        }
                        $qb = "select * from biglietti where email = $1";
                        $resultb = pg_query_params($dbconn, $qb, array($email));
                        if (!($lineb=pg_fetch_array($resultb, null, PGSQL_ASSOC))) {
                            echo "<h1>Non hai ancora acquistato biglietti!</h1>
                            <a href=../LandingPagePrivata/index.html?name=$nome> Premi qui
                            </a> per ritornare alla home";

                        }
                        else{
                            $qcb = "select count(*) from biglietti where email = $1";
                            $resultcb=pg_query_params($dbconn, $qcb, array($email));
                            $linecb=pg_fetch_array($resultcb, null, PGSQL_ASSOC);
                            $cb = $linecb['count'];
                            $i = 0;
                            print_r("<h1> Hai acquistato biglietti di ".$cb. " concerti!</h1>");
                            $qlista = "select concerto.codice, concerto.artista, concerto.città, concerto.luogo, concerto.prezzo, concerto.data, biglietti.numero
                                        from concerto JOIN biglietti ON concerto.codice = biglietti.codice
                                        where biglietti.email = $1";
                            $resultlista=pg_query_params($dbconn, $qlista, array($email));
                            $resultl=pg_fetch_all($resultlista);
                            while($i < $cb){
                                print_r("<h3>".$resultl[$i]['codice']."</h3>");
                                print_r($resultl[$i]['artista']."</br>");
                                print_r($resultl[$i]['città'].", ");
                                print_r($resultl[$i]['luogo']."</br>");
                                print_r($resultl[$i]['prezzo']."€</br>");
                                print_r($resultl[$i]['data']."</br>");
                                print_r("Numero biglietti acquistati: ".$resultl[$i]['numero']."</br></br>");
                                $i++;
                            }
                            echo "<h4><a href=../LandingPagePrivata/index.html?name=$nome>Premi qui
                            </a> per ritornare alla home</h4>";
                        }
                    }
                } 
            }
        ?>
    </body>
</html>