<!DOCTYPE html>
    <head></head>
    <body>
        <?php
            $dbconn = pg_connect("host=localhost port=5432 
            dbname=DoConcert user=postgres password=Pippo_1927")
                or die('Could not connect: ' . pg_last_error());
            if (!(isset($_POST['modificaconcertoButton']))) {
                header("Location: ../modificaconcerto/modificaconcerto.html");
            }
            else{
                $password = md5($_POST['password1']);
                $codice = $_POST['codice'];
                $q1="select * from concerto where codice=$1";
                $result1=pg_query_params($dbconn, $q1, array($codice));
                if (!($line1=pg_fetch_array($result1, null, PGSQL_ASSOC))) {
                    echo "<h1> Questo codice non è collegato a nessun concerto. </h1>
                    <a href= ../modificaconcerto/modificaconcerto.html> Clicca qui </a>per riprovare o
                    <a href= ../LandingPagePrivata/index.html> clicca qui </a> per tornare alla home." ;
                }
                else {
                    $email = $_POST['email'];
                    $q2="select * from utente where email=$1";
                    $result2=pg_query_params($dbconn, $q2, array($email));
                    if($email!="" && !($line2=pg_fetch_array($result2, null, PGSQL_ASSOC))){
                        echo "<h1> Non è presente nessun utente con questa email. </h1>
                        <a href= ../modificaconcerto/modificaconcerto.html> Clicca qui </a>per riprovare o
                        <a href= ../LandingPagePrivata/index.html> clicca qui </a> per tornare alla home." ;
                    }
                    $q3="select * from concerto where codice= $1";
                    $result3=pg_query_params($dbconn, $q3, array($codice));
                    $line3=pg_fetch_array($result3, null, PGSQL_ASSOC);
                    $email1 = $line3['email'];
                    $q4="select * from utente where email = $1 and password = $2";
                    $result4=pg_query_params($dbconn, $q4, array($email1,$password));
                    if (!($line4=pg_fetch_array($result4, null, PGSQL_ASSOC))) {
                        echo "<h1> La password è sbagliata. </h1>
                        <a href= ../modificaconcerto/modificaconcerto.html> Clicca qui </a>per riprovare o
                        <a href= ../LandingPagePrivata/index.html> clicca qui </a> per tornare alla home." ;
                    }
                    else {
                        $artista = $_POST['artista'];
                        $citta = $_POST['citta'];
                        $luogo = $_POST['luogo'];
                        $maxspettatori = $_POST['maxspettatori'];
                        $postidisponibili = $_POST['postidisponibili'];
                        $prezzo = $_POST['prezzo'];
                        $data1 = $_POST['data'];
                        if($email!=""){
                            $qemail="update concerto set email=$1 where codice=$2";
                            $data=pg_query_params($dbconn, $qemail, array($email, $codice));
                        }
                        if($citta!=""){
                            $qcitta="update concerto set citta=$1 where codice=$2";
                            $data=pg_query_params($dbconn, $citta, array($citta, $codice));
                        }
                        if($luogo!=""){
                            $qluogo="update concerto set luogo=$1 where codice=$2";
                            $data=pg_query_params($dbconn, $luogo, array($luogo, $codice));
                        }
                        if($maxspettatori!=""){
                            $qmaxspettatori="update concerto set maxspettatori=$1 where codice=$2";
                            $data=pg_query_params($dbconn, $qmaxspettatori, array($maxspettatori, $codice));
                        }
                        if($postidisponibili!=""){
                            $qpostidisponibili="update concerto set postidisponibili=$1 where codice=$2";
                            $data=pg_query_params($dbconn, $qpostidisponibili, array($postidisponibili, $codice));
                        }
                        if($prezzo!=""){
                            $qprezzo="update concerto set prezzo=$1 where codice=$2";
                            $data=pg_query_params($dbconn, $qprezzo, array($prezzo, $codice));
                        }
                        if($data1!=""){
                            $qdata1="update concerto set data=$1 where codice=$2";
                            $data=pg_query_params($dbconn, $qdata1, array($data1, $codice));
                        }
                        echo "<h1> La modifica è avvenuta con successo. </h1>
                        <a href= ../LandingPagePrivata/index.html> Clicca qui </a> per tornare alla home." ;
                    }
                }
            }
        ?>
    </body>
</html>